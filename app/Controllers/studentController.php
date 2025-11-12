<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    
    }
    class studentController
    {
        public function index()
        {
            $title = "Trang chủ";
            $render = __DIR__ . "/../Views/homepage.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
    }

?>