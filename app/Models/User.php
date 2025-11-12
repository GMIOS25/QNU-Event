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
            //Database::closeConnection($this->conn);
        }
        // trả về uid nếu login thành công
        public function login($userName, $password)
        {
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
        public function loginAdmin($userName, $password)
        {
            
            $stm = $this->conn->prepare("Select * from admin where (AdminID = ? or Email = ?) and Password = ?");
            $stm->bind_param("sss", $userName, $userName, $password);
            $stm->execute();
            $result = $stm->get_result();
            $stm->close();
            if ($result->num_rows > 0) {
                $userData = $result->fetch_assoc();
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                return $userData["AdminID"];

            } else {
   
                return NULL;
            }
        }
        // lấy thông tin user từ db
        public function getStudentInfo($MSSV)
        {
            $stm = $this->conn->prepare("Select * from sinhvien where MSSV = ?");
            $stm->bind_param("s", $MSSV);
            $stm->execute();
            $result = $stm->get_result();
            if ($result->num_rows > 0 )
            {
                $userData = $result->fetch_assoc();
                return $userData;
            }

        }
        public function getAdminInfo($AdminID)
        {
            $stm = $this->conn->prepare("Select * from admin where AdminID = ?");
            $stm->bind_param("s", $AdminID);
            $stm->execute();
            $result = $stm->get_result();
            if ($result->num_rows > 0 )
            {
                $userData = $result->fetch_assoc();
                return $userData;
            }
        }
    }

?>