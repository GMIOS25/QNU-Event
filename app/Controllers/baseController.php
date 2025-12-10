<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    
    }
    class baseController
    {
        public function ErrorNotFound()
        {
            $title = "Lỗi 404";
            $render =  __DIR__ . "/../Views/404.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function accessdenine()
        {
            $title = "Lỗi 403";
            $render = __DIR__ . "/../Views/accessdenine.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function redirect()  {
            global $publicBase;
            if($_SESSION['role'] == 2)
            {
                header('Location: ' . $publicBase . '/Admin');
            }
            else
            {
                header('Location: ' . $publicBase . '/Student');
            }
        }
    }

?>