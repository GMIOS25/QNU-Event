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
    $homeController = new HomepageController();

    // Các route
    switch (true) {
        case $requestPath === '/' || $requestPath === '/index.php':
            $homeController->index();
            break;
        default:
            // Fallback: show homepage for unknown root paths
            $homeController->index();
            break;
    }
?>
