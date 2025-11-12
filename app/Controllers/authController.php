<?php 
    class authController
    {
        private $conn;
        public function __construct()
        {
           require_once __DIR__ . "/../Models/User.php";
        }
        public function renderLogin($message)
        {
            $title = "Đăng nhập";
            include __DIR__ . "/../Views/auth/login.php" ;
        }
        public function login()
        {
            $userModal = new User();
            
            global $publicBase;
            $userName = $_POST['txt_username'];
            $password = $_POST['txt_password'];
            $loginUID = $userModal->login($userName, $password);

            if ($loginUID != NULL) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['UID'] = $loginUID;

                // về index (này exmaple thôi, sau này tùy vào role route hướng khác nữa)
                header('Location: ' . $publicBase . '/');
                exit;

            } else {
                $this->renderLogin("Sai tài khoản hoặc mật khẩu");
            }
            

        }
    }

?>
