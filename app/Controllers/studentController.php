<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    
    }
    // controller này cho chức năng của sinh viên
    class studentController
    {
        public function index()
        {
            $title = "Trang chủ";
            $render = __DIR__ . "/../Views/Student/home.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
    }

?>