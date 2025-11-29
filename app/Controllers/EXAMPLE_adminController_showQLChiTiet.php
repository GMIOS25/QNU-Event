/**
 * Example: Cập nhật adminController.php - Method showQLChiTiet()
 * 
 * Thay thế method showQLChiTiet() hiện tại bằng code sau:
 */

public function showQLChiTiet()
{
    require_once __DIR__ . "/../Helpers/PaginationHelper.php";
    
    $message = null;
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }
    $eventModel = new Event();
    $title = "Quản lý chi tiết sự kiện";
    $dataEvent = $eventModel->getEvent($_GET['EventID']);
    $tenKhoaToChuc = $eventModel->getTenKhoaToChuc($_GET['EventID']);
    $stateEvent = $eventModel->getStateEvent($_GET['EventID']);
    $listKhoaThamGia = $eventModel->getDSTenKhoaDuocPhepThamGia($_GET['EventID']);
    
    // Pagination setup
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $itemsPerPage = 10; // Có thể thay đổi số lượng items mỗi trang
    $totalStudents = $eventModel->getRegisteredStudentsCount($_GET['EventID']);
    
    // Create pagination object
    $pagination = new PaginationHelper($totalStudents, $currentPage, $itemsPerPage, null, $_GET);
    
    // Get paginated students
    $listRegisteredStudents = $eventModel->getRegisteredStudentsWithPagination(
        $_GET['EventID'], 
        $pagination->getLimit(), 
        $pagination->getOffset()
    );
    
    $render = __DIR__ . "/../Views/Admin/QLChiTiet.php"; 
    include __DIR__ . "/../Views/layout.php" ;
}
