/**
 * Example: Cập nhật bcsController.php - Method showDanhSachMinhChung()
 * 
 * Thay thế method showDanhSachMinhChung() hiện tại bằng code sau:
 */

public function showDanhSachMinhChung()
{
    require_once __DIR__ . "/../Helpers/PaginationHelper.php";
    
    $minhChungModel = new MinhChung();
    $message = null;
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }
    $title = "Minh chứng tham gia sự kiện ";
    $eventModel = new Event();
    $userModel = new User();
    
    if(isset($_GET['EventID']))
    {
        $eventID = $_GET['EventID'];
        
        // Pagination setup
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $itemsPerPage = 15; // Có thể thay đổi số lượng items mỗi trang
        $totalMinhChung = $minhChungModel->countDanhSachMinhChungChoDuyet($eventID);
        
        // Create pagination object
        $pagination = new PaginationHelper($totalMinhChung, $currentPage, $itemsPerPage, null, $_GET);
        
        // Get paginated data
        $listMinhChung = $minhChungModel->loadDanhSachMinhChungChoDuyetWithPagination(
            $eventID,
            $pagination->getLimit(),
            $pagination->getOffset()
        );
    }
    
    $title = "Danh sách minh chứng chờ duyệt";
    $render = __DIR__ . "/../Views/BCS/DanhSachMinhChung.php";
    include __DIR__ . "/../Views/layout.php" ;
}
