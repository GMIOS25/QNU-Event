<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    
    }
    class baseController
    {
        public function ErrorNotFound()
        {
            include __DIR__ . "/../Views/404.php";
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