<?php 
    class authController
    {
        private $conn;
        public function __construct()
        {
           require_once __DIR__ . "/../Configs/database.php";
           $this->conn = Database::getConnection();
        }
        public function  __destruct() 
        {
            Database::closeConnection($this->conn);
        }
        public function renderLogin($message)
        {
            $title = "Đăng nhập";
            include __DIR__ . "/../Views/auth/login.php" ;
        }
        public function login()
        {
            global $publicBase;
            $userName = $_POST['txt_username'];
            $password = $_POST['txt_password'];
            
            $stm = $this->conn->prepare("Select * from sinhvien where (MSSV = ? or Email = ?) and Password = ?");
            $stm->bind_param("sss", $userName, $userName, $password);
            $stm->execute();
            $result = $stm->get_result();
            $stm->close();
            if ($result->num_rows > 0) {
                $userData = $result->fetch_assoc();
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['UID'] = $userData['MSSV'];

                // về index (này exmaple thôi, sau này tùy vào role route hướng khác nữa)
                header('Location: ' . $publicBase . '/');
                exit;
                exit;

            } else {
                $this->renderLogin("Sai tài khoản hoặc mật khẩu");
            }
            

        }
    }

?>
