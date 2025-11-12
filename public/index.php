<?php
    // Error reporting for development
    error_reporting(E_ALL);
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
    $homeController = new HomepageController();
    $authController = new authController();

    // vì mọi request đổ về index nên phải kiểm tra quyền thực thi, tức trạng thái đăng nhập trước khi thực hiện route
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_SESSION['UID']) && $requestPath != '/Login')
    {
        header('Location: ' . $publicBase . '/Login');
        exit; 
    }


    // Các route
    switch (true) {
        // kiểm tra nếu chưa đăng nhập thì dẫn về trang đăng nhập
        case $requestPath === '/Login' && $_SERVER['REQUEST_METHOD'] === "POST":
            $authController->login(); break;
        case $requestPath === '/Login':
            $authController->renderLogin(""); break;
        case $requestPath === '/' || $requestPath === '/index.php':
            $homeController->index();
            break;
        default:
            // Fallback: show homepage for unknown root paths
            $homeController->index();
            break;
    }
?>
