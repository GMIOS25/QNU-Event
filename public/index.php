<?php
    // Error reporting for development
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

    ini_set('display_errors', 1);
    define('BASE_PATH', dirname(__DIR__));
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    // Normalize request path relative to the public directory
    $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $publicBase  = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    if ($publicBase !== '' && strpos($requestPath, $publicBase) === 0) {
        $requestPath = substr($requestPath, strlen($publicBase));
    }
    $requestPath = '/' . ltrim($requestPath, '/');

    // Controllers
    require_once BASE_PATH . '/app/Controllers/authController.php';
    require_once BASE_PATH . '/app/Controllers/bcsController.php';
    require_once BASE_PATH . '/app/Controllers/baseController.php';
    require_once BASE_PATH . '/app/Controllers/studentController.php';
    require_once BASE_PATH . '/app/Controllers/adminController.php';
    
    
    // vì mọi request đổ về index nên phải kiểm tra quyền thực thi, tức trạng thái đăng nhập trước khi thực hiện route
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    
    }

    // khởi tạo controller
    $baseController = new baseController();
    $authController = new authController();
    $studentController = new studentController();
    $adminController = new adminController();
    $bcsController = new bcsController();

    $unauthPaths = ['/Auth/Login', '/Auth/Logout'];
    if (!isset($_SESSION['UID']) && !in_array($requestPath, $unauthPaths)) {
        header('Location: ' . $publicBase . '/Auth/Login');
        exit;
    }

    if (isset($_SESSION['UID'])) {
        $authController->loadUserData();

    }
    $termModel = new Term();
    $_SESSION['currentTerm'] = $termModel->getCurrentHocKy();

    switch ($requestPath) {
        case '/':
            $baseController->redirect();
            break;
        case '/Auth/Login':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $authController->login();
            } else {
                $authController->renderLogin('');
            }
            break;

        case '/Auth/Logout':
            $authController->logout();
            break;

        case '/Student':
            
            $studentController->index();
            break;
        case '/Student/NopMinhChungThamGiaSK':
            $studentController->showNopMinhChung();
            break;
        case '/Student/NopMinhChungThamGiaSK/NopMinhChung':
            if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['EventID'])) 
            {
                $studentController->showNopMinhChungThamGiaSK();
                break;
            }
            else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['EventID'])) // dành cho submit form
            {
                $studentController->submitNopMinhChungThamGiaSK();
                break;
            }
        case '/Student/DangKySuKien':
            $studentController->showDKSK();
            break;
        case '/Student/DangKySuKien/DangKy':
            $studentController->submitDKSK();
            break;
        case '/Student/DangKySuKien/HuyDangKy':
            $studentController->huyDKSK();
            break;
        case '/Student/LichSuKien':
            $studentController->showLichSK();
            break;
        case '/Student/XemDiemRL':
            $studentController->showXemDiem();
            break;
        case '/Student/TuDanhGiaRL':
            $studentController->showTuDanhGiaRL();
            break;
        case '/BCS/DuyetMinhChung':
            $bcsController->showDuyetMinhChung();
            break;
        case '/BCS/DuyetMinhChung/DanhSachMinhChung':
            if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['EventID'])) 
            {
                $bcsController->showDanhSachMinhChung();
                break;
            }
        case '/BCS/DuyetMinhChung/Approve':
            $bcsController->approveMinhChung();
            break;
        case '/BCS/DuyetMinhChung/Reject':
            $bcsController->rejectMinhChung();
            break;
        case '/BCS/DuyetPhieuRL':
            $bcsController->showDuyetPhieuRL();
            break;
        case '/Admin':
            
            $adminController->index();
            break;
        case '/Admin/QLSuKien':
            $adminController->showQLSuKien((isset($_GET['state'])) ? $_GET['state'] : NULL , 
            (isset($_GET['txtSearch'])) ? $_GET['txtSearch'] : NULL, (isset($_GET['page'])) ? $_GET['page'] :1, 5);
            break;
        case '/Admin/QLSuKien/QLChiTiet':

            if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['EventID']))
            {
                $adminController->showQLChiTiet();
                break;
            }
        case '/Admin/QLSuKien/ThemSuKien': 
            if($_SERVER['REQUEST_METHOD'] === 'POST') // dành cho submit form
            {
                $adminController->submitThemSuKien();
            }
            else
            {
                $adminController->showThemSuKien();
            }
            break;
        case '/Admin/QLSuKien/SuaSuKien': 
            if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['EventID'])) 
            {
                $adminController->showSuaSuKien();
                break;
            }
            else if($_SERVER['REQUEST_METHOD'] === 'POST') // dành cho submit form
            {
                $adminController->submitSuaSuKien();
                break;
            } 
        case '/Admin/CauHinh/HocKy':
                $adminController->showQuanLyHocKy();
                break;
        case '/Admin/CauHinh/HocKy/ThemHocKy':
            if($_SERVER['REQUEST_METHOD'] === 'POST') // dành cho submit form
            {
                $adminController->submitThemHocKy();
            }
            else
            {
                $adminController->showThemHocKy();
            }
            break;
        case '/Admin/CauHinh/HocKy/SuaHocKy':
            if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['TermID'])) 
            {
                $adminController->showSuaHocKy();
                break;
            }
            else if($_SERVER['REQUEST_METHOD'] === 'POST') // dành cho submit form
            {
                $adminController->submitSuaHocKy();
                break;
            }
        case '/Admin/CauHinh/HocKy/KetThucHocKy':
            if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['TermID'])) 
            {
                $adminController->ketThucHocKy();
                break;
            }
        case '/Account':
        default:
            $baseController->ErrorNotFound();
            break;
    }
?>
