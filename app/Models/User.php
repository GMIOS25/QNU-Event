<?php 
    class User
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
        // trả về uid nếu login thành công
        public function login($userName, $password)
        {
            global $publicBase;
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
                return $userData["MSSV"];

            } else {
                return NULL;
            }
            

        }
        public function auth()
        {

        }
    }

?>