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
        case '/Student/ThongTinCaNhan':
            $studentController->showThongTinCaNhan();
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
        case '/Admin/CauHinh/Khoa':
            if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search']))
                $adminController->showQuanLyKhoa($_GET['search']);
            else
                $adminController->showQuanLyKhoa();
                break;
        case '/Admin/CauHinh/Khoa/ThemKhoa':
            if($_SERVER['REQUEST_METHOD'] === 'POST') // dành cho submit form
            {
                $adminController->submitThemKhoa();
            }
            else
            {
                $adminController->showThemKhoa();
            }
            break;
        case '/Admin/CauHinh/Khoa/XoaKhoa':
            if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['KhoaID'])) 
            {
                $adminController->deleteKhoa();
                break;
            }
        case '/Admin/CauHinh/Lop':
                $adminController->showQuanLyLop();
                break;
        case '/Admin/CauHinh/Lop/ThemLop':
            if($_SERVER['REQUEST_METHOD'] === 'POST') // dành cho submit form
            {
                $adminController->submitThemLop();
            }
            else
            {
                $adminController->showThemLop();
            }
            break;
        case '/Admin/CauHinh/Lop/SuaLop':
            if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['LopID'])) 
            {
                $adminController->showSuaLop();
                break;
            }
            else if($_SERVER['REQUEST_METHOD'] === 'POST') // dành cho submit form
            {
                $adminController->submitSuaLop();
                break;
            }
        case '/Admin/CauHinh/Lop/XoaLop':
            if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['LopID'])) 
            {
                $adminController->deleteLop();
                break;
            }
        case '/Admin/CauHinh/Nganh':
                $adminController->showQuanLyNganh();
                break;
        case '/Admin/CauHinh/Nganh/ThemNganh':
            if($_SERVER['REQUEST_METHOD'] === 'POST') // dành cho submit form
            {
                $adminController->submitThemNganh();
            }
            else
            {
                $adminController->showThemNganh();
            }
            break;
        case '/Admin/CauHinh/Nganh/SuaNganh':
            if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['NganhID']))
            {
                $adminController->showSuaNganh();
                
            }
            else if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $adminController->submitSuaNganh();
            }
            break;
        case '/Admin/CauHinh/Nganh/XoaNganh':
            if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['NganhID']))
            {
                $adminController->deleteNganh();
                break;
                
            }
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
        case '/Admin/CauHinh/Khoa/SuaKhoa':
            if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['KhoaID'])) 
            {
                $adminController->showSuaKhoa();
                break;
            }
            else if($_SERVER['REQUEST_METHOD'] === 'POST') // dành cho submit form
            {
                $adminController->submitSuaKhoa();
                break;
            }
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
        case '/Admin/QuanLyTaiKhoanSV':
            $adminController->showQuanLyTaiKhoanSV();
            break;
        case '/Admin/QuanLyTaiKhoanSV/ThemSinhVien':
            if($_SERVER['REQUEST_METHOD'] === 'POST') // dành cho submit form
            {
                $adminController->submitThemSinhVien();
            }
            else
            {
                $adminController->showThemSinhVien();
            }
            break;
        case '/Admin/QuanLyTaiKhoanSV/SuaSinhVien':
            if($_SERVER['REQUEST_METHOD'] === 'POST') // dành cho submit form
            {
                $adminController->submitModifyStudent();
            }
            else if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['StudentID']))
            {
                $adminController->showModifyStudent();
            }
            break;
        case '/Admin/QuanLyTaiKhoanSV/ResetMatKhau':
            if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['StudentID']))
            {
                $adminController->resetStudentPassword();
                break;
            }
        // Xử lú api
        case '/api/Admin/GetDSNganhTheoKhoa':
            if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['KhoaID'])) 
            {
                $adminController->getDSNganhTheoKhoa();
                break;
            }
        case '/api/Admin/GetDSLopTheoNganh':
            if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['NganhID'])) 
            {
                $adminController->apiGetDSLop();
                break;
            }
        case '/Student/ThongTinCaNhan':
            $studentController->showThongTinCaNhan();
            break;
        case '/Account':
        default:
            $baseController->ErrorNotFound();
            break;
    }
?>
