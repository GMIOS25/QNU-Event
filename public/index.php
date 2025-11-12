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
    if(!isset($_SESSION['UID']) && $requestPath != '/Login')
    {
        header('Location: ' . $publicBase . '/Login');
        
        exit; 
    }

    $authController->loadUserData();


    // load data user

    if($requestPath === "/Login")
    {
       
        switch(true)
        {
            // nếu gửi form login bằng post
            case $requestPath === '/Login' && $_SERVER['REQUEST_METHOD'] === "POST":
                $authController->login(); break;
            // nếu vô đường dẫn login
            case $requestPath === '/Login':
                $authController->renderLogin(""); break;
            default:
                $baseController->ErrorNotFound();
            break;
        }
    }
    // ROUTE CHO CÁC PAGE CỦA STUDENT
    else if($requestPath === "/")
    {
        //$homeController = new HomepageController();

        $userController = new userController();
        switch (true)
        {
            // để tạm
            case $requestPath === "/":
                $userController->index();
            default:
                $baseController->ErrorNotFound();
            break;
        }
    }
    // ROUTE CHO CÁC PAGE CỦA BCS
    else if($requestPath === "/Staff")
    {
        switch (true)
        {
            default:
                $baseController->ErrorNotFound();
            break;
        }
    }
    // ROUTE CHO CÁC PAGE CỦA ADMIN
    else if($requestPath === "/Admin")
    {
        $adminController = new adminController();
        switch (true)
        {
            // để tạm
            case $requestPath === "/Admin":
                $adminController->index();break;
            default:
                $baseController->ErrorNotFound();
            break;
        }
    }
    // ROUTE CHO CÁC PAGE QUẢN LÝ TÀI KHOẢN CÁ NHÂN
    else if($requestPath === "/Account")
    {
        switch (true)
        {
            default:
                $baseController->ErrorNotFound();
            break;
        }
    }
    else
    {
        $baseController->ErrorNotFound();
    }

    
    // ROUTE CHO CÁC CHỨC NĂNG LOGIN
?>
