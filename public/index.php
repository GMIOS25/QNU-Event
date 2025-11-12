<?php
    // Error reporting for development
    error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

    ini_set('display_errors', 1);
    define('BASE_PATH', dirname(__DIR__));

    // Normalize request path relative to the public directory
    $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $publicBase  = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    if ($publicBase !== '' && strpos($requestPath, $publicBase) === 0) {
        $requestPath = substr($requestPath, strlen($publicBase));
    }
    $requestPath = '/' . ltrim($requestPath, '/');

    // Controllers
    require_once BASE_PATH . '/app/Controllers/homepageController.php';
    require_once BASE_PATH . '/app/Controllers/authController.php';
    require_once BASE_PATH . '/app/Controllers/baseController.php';
    require_once BASE_PATH . '/app/Controllers/userController.php';
    require_once BASE_PATH . '/app/Controllers/adminController.php';
    
    $baseController = new baseController();

    // vì mọi request đổ về index nên phải kiểm tra quyền thực thi, tức trạng thái đăng nhập trước khi thực hiện route
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $authController = new authController();
    $unauthPaths = ['/Auth/Login', '/Auth/Logout'];
    if (!isset($_SESSION['UID']) && !in_array($requestPath, $unauthPaths)) {
        header('Location: ' . $publicBase . '/Auth/Login');
        exit;
    }

    if (isset($_SESSION['UID'])) {
        $authController->loadUserData();
    }


    switch ($requestPath) {
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

        case '/':
            $userController = new userController();
            $userController->index();
            break;

        case '/Admin':
            $adminController = new adminController();
            $adminController->index();
            break;

        case '/Staff':
        case '/Account':
        default:
            $baseController->ErrorNotFound();
            break;
    }
?>
