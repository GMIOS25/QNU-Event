<?php
/**
 * PaginationHelper - Lớp hỗ trợ phân trang tối ưu
 * Xử lý logic phân trang và tạo URL với query parameters
 */
class PaginationHelper
{
    private $currentPage;
    private $totalItems;
    private $itemsPerPage;
    private $totalPages;
    private $baseUrl;
    private $queryParams;
    
    /**
     * Khởi tạo pagination helper
     * 
     * @param int $totalItems Tổng số items
     * @param int $currentPage Trang hiện tại (mặc định 1)
     * @param int $itemsPerPage Số items mỗi trang (mặc định 10)
     * @param string $baseUrl URL cơ bản (mặc định lấy từ REQUEST_URI)
     * @param array $queryParams Các query parameters cần giữ lại
     */
    public function __construct($totalItems, $currentPage = 1, $itemsPerPage = 10, $baseUrl = null, $queryParams = [])
    {
        $this->totalItems = max(0, (int)$totalItems);
        $this->itemsPerPage = max(1, (int)$itemsPerPage);
        $this->totalPages = $this->totalItems > 0 ? (int)ceil($this->totalItems / $this->itemsPerPage) : 1;
        $this->currentPage = max(1, min((int)$currentPage, $this->totalPages));
        
        // Xử lý base URL
        if ($baseUrl === null) {
            $uri = $_SERVER['REQUEST_URI'];
            $this->baseUrl = strtok($uri, '?');
        } else {
            $this->baseUrl = $baseUrl;
        }
        
        // Lưu query parameters (loại bỏ 'page' để tránh trùng lặp)
        $this->queryParams = $queryParams;
        unset($this->queryParams['page']);
    }
    
    /**
     * Lấy OFFSET cho SQL query
     * 
     * @return int
     */
    public function getOffset()
    {
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }
    
    /**
     * Lấy LIMIT cho SQL query
     * 
     * @return int
     */
    public function getLimit()
    {
        return $this->itemsPerPage;
    }
    
    /**
     * Lấy trang hiện tại
     * 
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }
    
    /**
     * Lấy tổng số trang
     * 
     * @return int
     */
    public function getTotalPages()
    {
        return $this->totalPages;
    }
    
    /**
     * Lấy tổng số items
     * 
     * @return int
     */
    public function getTotalItems()
    {
        return $this->totalItems;
    }
    
    /**
     * Lấy số items mỗi trang
     * 
     * @return int
     */
    public function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }
    
    /**
     * Kiểm tra có trang trước không
     * 
     * @return bool
     */
    public function hasPrevious()
    {
        return $this->currentPage > 1;
    }
    
    /**
     * Kiểm tra có trang sau không
     * 
     * @return bool
     */
    public function hasNext()
    {
        return $this->currentPage < $this->totalPages;
    }
    
    /**
     * Lấy số trang trước
     * 
     * @return int|null
     */
    public function getPreviousPage()
    {
        return $this->hasPrevious() ? $this->currentPage - 1 : null;
    }
    
    /**
     * Lấy số trang sau
     * 
     * @return int|null
     */
    public function getNextPage()
    {
        return $this->hasNext() ? $this->currentPage + 1 : null;
    }
    
    /**
     * Tạo URL cho một trang cụ thể
     * 
     * @param int $page Số trang
     * @return string
     */
    public function buildUrl($page)
    {
        $params = array_merge($this->queryParams, ['page' => $page]);
        $queryString = http_build_query($params);
        return $this->baseUrl . ($queryString ? '?' . $queryString : '');
    }
    
    /**
     * Lấy danh sách các trang để hiển thị
     * Hiển thị tối đa 7 trang (3 trước, trang hiện tại, 3 sau)
     * 
     * @param int $maxPages Số trang tối đa hiển thị (mặc định 7)
     * @return array
     */
    public function getPageRange($maxPages = 7)
    {
        if ($this->totalPages <= $maxPages) {
            return range(1, $this->totalPages);
        }
        
        $half = floor($maxPages / 2);
        $start = max(1, $this->currentPage - $half);
        $end = min($this->totalPages, $this->currentPage + $half);
        
        // Điều chỉnh nếu ở đầu hoặc cuối
        if ($this->currentPage <= $half) {
            $end = min($this->totalPages, $maxPages);
        } elseif ($this->currentPage >= $this->totalPages - $half) {
            $start = max(1, $this->totalPages - $maxPages + 1);
        }
        
        return range($start, $end);
    }
    
    /**
     * Lấy thông tin hiển thị (VD: "Hiển thị 1-10 trong 100 kết quả")
     * 
     * @return array
     */
    public function getDisplayInfo()
    {
        if ($this->totalItems == 0) {
            return [
                'from' => 0,
                'to' => 0,
                'total' => 0
            ];
        }
        
        $from = ($this->currentPage - 1) * $this->itemsPerPage + 1;
        $to = min($this->currentPage * $this->itemsPerPage, $this->totalItems);
        
        return [
            'from' => $from,
            'to' => $to,
            'total' => $this->totalItems
        ];
    }
    
    /**
     * Render HTML pagination
     * 
     * @return string HTML của pagination
     */
    public function render()
    {
        if ($this->totalPages <= 1) {
            return '';
        }
        
        $html = '<div class="pagination-container d-flex justify-content-center mt-4">';
        $html .= '<ul class="pagination">';
        
        // Nút Previous
        if ($this->hasPrevious()) {
            $html .= '<li class="page-item">';
            $html .= '<a class="page-link" href="' . $this->buildUrl($this->getPreviousPage()) . '">&lt;</a>';
            $html .= '</li>';
        } else {
            $html .= '<li class="page-item disabled">';
            $html .= '<span class="page-link">&lt;</span>';
            $html .= '</li>';
        }
        
        // Các trang
        $pageRange = $this->getPageRange();
        
        // Hiển thị trang đầu nếu không có trong range
        if (!in_array(1, $pageRange)) {
            $html .= '<li class="page-item">';
            $html .= '<a class="page-link" href="' . $this->buildUrl(1) . '">1</a>';
            $html .= '</li>';
            $html .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
        
        foreach ($pageRange as $page) {
            if ($page == $this->currentPage) {
                $html .= '<li class="page-item active">';
                $html .= '<span class="page-link">' . $page . '</span>';
                $html .= '</li>';
            } else {
                $html .= '<li class="page-item">';
                $html .= '<a class="page-link" href="' . $this->buildUrl($page) . '">' . $page . '</a>';
                $html .= '</li>';
            }
        }
        
        // Hiển thị trang cuối nếu không có trong range
        if (!in_array($this->totalPages, $pageRange)) {
            $html .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
            $html .= '<li class="page-item">';
            $html .= '<a class="page-link" href="' . $this->buildUrl($this->totalPages) . '">' . $this->totalPages . '</a>';
            $html .= '</li>';
        }
        
        // Nút Next
        if ($this->hasNext()) {
            $html .= '<li class="page-item">';
            $html .= '<a class="page-link" href="' . $this->buildUrl($this->getNextPage()) . '">&gt;</a>';
            $html .= '</li>';
        } else {
            $html .= '<li class="page-item disabled">';
            $html .= '<span class="page-link">&gt;</span>';
            $html .= '</li>';
        }
        
        $html .= '</ul>';
        $html .= '</div>';
        
        return $html;
    }
}
?>
