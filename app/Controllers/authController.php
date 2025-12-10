<?php 
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    class authController
    {
        
        private $conn;
        public function __construct()
        {
           require_once __DIR__ . "/../Models/User.php";
            require_once __DIR__ . "/../Models/Term.php";
        }
        public function renderLogin($message)
        {
            $title = "Đăng nhập";
            include __DIR__ . "/../Views/auth/login.php" ;
        }
        public function login()
        {
            global $publicBase;
            $userModal = new User();
            
            
            $userName = $_POST['txt_username'];
            $password = $_POST['txt_password'];
            $loginUID = $userModal->login($userName, $password);

            if ($loginUID != NULL) {
  
                $_SESSION['UID'] = $loginUID;
                $_SESSION['role'] = 0; // role sinh viên
                $termModel = new Term();
                
                header('Location: ' . $publicBase . '/Student');
                exit;

            }
            // check xem có phải tài khoản admin hay k 
            else 
                {
                $loginUID = $userModal->loginAdmin($userName, $password);
                if ($loginUID != NULL) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['UID'] = $loginUID;
                    $_SESSION['role'] = 2; // role admin
                    header('Location: ' . $publicBase . '/Admin');
                    exit;
                }   
                else
                {
                    $this->renderLogin("Sai tài khoản hoặc mật khẩu");
                }
            }
        }
        // load user data into session
        public function loadUserData()
        {
            $userModal = new User();
            $userData = NULL;
            if($_SESSION['role'] == 2)
            {
                $userData = $userModal->getAdminInfo($_SESSION['UID']);
            }
            else
            {
                $userData = $userModal->getStudentInfo($_SESSION['UID']);
                if($userData['isBanCanSu'] == 1)
                {
                    $_SESSION['role'] = 1;
                }
            }
            $_SESSION['FullName'] = $userData['Ho'] . " ". $userData['Ten'];
            // tra nếu user đó đang dùng bị xóa , tránh lỗi session
            if(is_null($userData))
            {
                session_destroy();
            }

        }

        public function logout()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            session_unset();
            session_destroy();

            global $publicBase;
            header('Location: ' . $publicBase . '/Auth/Login');
            exit;
        }

    }

?>
