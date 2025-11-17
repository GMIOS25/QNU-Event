<head>
    <link rel="stylesheet" href="assest/css/admin/qlsukien.css">
</head>
<div class="page-container">
        <div class="event-manager-card">
            
            <div class="card-title">QUẢN LÝ SỰ KIỆN</div>

            <div class="toolbar d-flex justify-content-between align-items-center mb-4">
                <div class="toolbar-left d-flex align-items-center">
                    <i class="bi bi-grid-3x3-gap-fill me-2"></i>
                    <span>Danh sách sự kiện</span>
                </div>
                <div class="toolbar-right">
                    <a href="Admin/QLSuKien/ThemSuKien" class="btn btn-primary d-flex align-items-center">
                        <i class="bi bi-plus-circle me-2"></i>
                        <span>Thêm sự kiện</span>
                    </a>
                </div>
            </div>

            <div class="filter-bar d-flex align-items-center mb-3">
                <div class="filter-item d-flex align-items-center me-3">
                    <span class="me-2">Trạng thái:</span>
                    <select class="form-select custom-filter-select"   
                    onchange="window.location.href = 'Admin/QLSuKien?state='+ this.value">
                        <option value="0">Tất cả </option>
                        <option value="5" <?php if(isset($_GET['state'])) { if ($_GET['state'] == 5) echo "selected";} ?>>Chưa mở đăng ký</option>
                        <option value="2" <?php if(isset($_GET['state'])) { if ($_GET['state'] == 2) echo "selected";} ?>>Đang mở đăng ký</option>
                        <option value="1" <?php if(isset($_GET['state'])) { if ($_GET['state'] == 1) echo "selected";} ?>>Sắp diễn ra</option>
                        <option value="4" <?php if(isset($_GET['state'])) { if ($_GET['state'] == 4) echo "selected";} ?>>Đang diễn ra</option>
                        <option value="3" <?php if(isset($_GET['state'])) { if ($_GET['state'] == 3) echo "selected";} ?>>Đã kết thúc</option>
                    </select>
                </div>
                <div class="search-bar ms-auto position-relative">
                    <form action="Admin/QLSuKien" method="GET" class="form d-flex">
                        <?php 
                            if(isset($_GET["txtSearch"]))
                                echo '<a  href="Admin/QLSuKien">Hủy tìm kiếm</a>
                                         <input type="text" name="txtSearch" class="form-control custom-search" required value="'.$_GET["txtSearch"].'" placeholder="Tìm kiếm ...">';
                            else
                            {
                                echo '<input type="text" name="txtSearch" class="form-control custom-search" required placeholder="Tìm kiếm ...">';
                            }
                        ?>
                       
                       <button type="submit" 
                                class="btn btn-primary d-flex justify-content-center align-items-center"
                                style="width: 50px;">
                            <i class="bi bi-search" style="font-size: 10px;"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div class="event-table">
                <div class="event-table-header">
                    <div class="header-cell" style="flex-basis: 12%;">Mã sự kiện</div>
                    <div class="header-cell" style="flex-basis: 33%;">Tên sự kiện</div>
                    <div class="header-cell" style="flex-basis: 18%;">Trạng thái</div>
                    <div class="header-cell" style="flex-basis: 17%;">Phòng</div>
                    <div class="header-cell" style="flex-basis: 20%;">Chức năng</div>
                </div>
                
                <div class="event-table-body">
                    <!-- <div class="event-table-row">
                        <div class="data-cell" style="flex-basis: 12%;">SK0036</div>
                        <div class="data-cell" style="flex-basis: 33%;">Tham dự giải cầu lông QNU 2025</div>
                        <div class="data-cell" style="flex-basis: 18%;">Sắp diễn ra</div>
                        <div class="data-cell" style="flex-basis: 17%;">Nhà thi đấu</div>
                        <div class="data-cell" style="flex-basis: 20%;">
                            <button class="btn btn-detail">
                                <i class="bi bi-camera"></i>
                                <span>Quản lý chi tiết</span>
                            </button>
                        </div>
                    </div> -->
                    <?php 
                        foreach ($listEvent as $event) 
                        {
                            echo '
                                <div class="event-table-row">
                                    <div class="data-cell" style="flex-basis: 12%;">'.$event['MaSK'].'</div>
                                    <div class="data-cell" style="flex-basis: 33%;">'.$event['TenSK'].'</div>
                                    <div class="data-cell" style="flex-basis: 18%;">'.$event['TrangThai'].'</div>
                                    <div class="data-cell" style="flex-basis: 17%;">'.$event['NoiToChuc'].'</div>
                                    <div class="data-cell" style="flex-basis: 20%;">
                                        <a href="Admin/QLSuKien/QLChiTiet?EventID='.$event['MaSK'].'" class="btn btn-detail">
                                            <i class="bi bi-camera"></i>
                                            <span>Quản lý chi tiết</span>
                                        </a>
                                    </div>
                                </div>
                            ';
                        }
                    
                    ?>
                </div>
            </div>

            <div class="pagination-container d-flex justify-content-center mt-4">
                <div class="pagination">
                    <?php 
                        function buildPageUrl($i) {
                            $base = 'Admin/QLSuKien?page=' . $i;

                            if (isset($_GET['txtSearch'])) {
                                $base .= '&txtSearch=' . urlencode($_GET['txtSearch']);
                            }
                            if (isset($_GET['state'])) {
                                $base .= '&state=' . urlencode($_GET['state']);
                            }
                            return $base;
                        }

                        $currentPage = isset($_GET['page']) ? $_GET['page'] :1; 
                        $maxPage = ceil($numRows/5);
                        echo '<ul class="pagination">';

                        for ($i = max(1, $currentPage - 3); $i < $currentPage; $i++) {
                            echo '
                                <li class="page-item">
                                    <a class="page-link" href="'. buildPageUrl($i) .'">'. $i .'</a>
                                </li>
                            ';
                        }

                        echo '
                            <li class="page-item active">
                                <a class="page-link" href="'. buildPageUrl($i) .'">'. $currentPage .'</a>
                            </li>
                        ';

                        for ($i = $currentPage + 1; $i <= min($maxPage, $currentPage + 3); $i++) {
                            echo '
                                <li class="page-item">
                                    <a class="page-link" href="'. buildPageUrl($i) .'">'. $i .'</a>
                                </li>
                            ';
                        }

                        echo '</ul>';

                    
                    ?>
                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const currentPage = urlParams.get("page") || "1"; 
    
    document.querySelectorAll(".page-item a").forEach(a => {
        if (a.textContent.trim() === currentPage) {
            a.parentElement.classList.add("active");
        }
        });
    });
    </script>