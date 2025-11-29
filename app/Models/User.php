<?php 
    class User
    {
        private $conn;

        public function __construct()
        {
           require_once __DIR__ . "/../Configs/database.php";
           $this->conn = Database::getConnection();
        }
        // public function  __destruct() 
        // {
        //     Database::closeConnection($this->conn);
        // }
        // trả về uid nếu login thành công
        public function getKhoaSV($MSSV)
        {
            $sql = "SELECT Khoa.* FROM sinhvien JOIN lop ON sinhvien.MaLop = lop.MaLop JOIN nganh ON lop.MaNganh = nganh.MaNganh JOIN khoa on khoa.MaKhoa = nganh.MaKhoa
             WHERE sinhvien.MSSV = '".$MSSV."'";
            if($result = $this->conn->query($sql))
            {
                if($result->num_rows >0 )
                    return $result->fetch_assoc();

            }
            return NULL;
           
        }
        public function login($userName, $password)
        {
            $stm = $this->conn->prepare("Select * from sinhvien where (MSSV = ? or Email = ?) and Password = ?");
            $stm->bind_param("sss", $userName, $userName, $password);
            $stm->execute();
            $result = $stm->get_result();
            $stm->close();
            if ($result->num_rows > 0) {
                $userData = $result->fetch_assoc();
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


        // STUDENT 
        public function filterByKhoa($MaKhoa)
        {
            $sql = "SELECT sinhvien.*, lop.TenLop FROM sinhvien 
            JOIN lop ON sinhvien.MaLop = lop.MaLop 
            JOIN nganh ON lop.MaNganh = nganh.MaNganh 
            WHERE nganh.MaKhoa = ?";
            $students = [];
            $stm = $this->conn->prepare($sql);
            $stm->bind_param("s", $MaKhoa);
            $stm->execute();
            $result = $stm->get_result();
            $stm->close();
            if($result)
            {
                $students = [];
                while($row = $result->fetch_assoc())
                {
                    $students[] = $row;
                }
                return $students;
            }
            return NULL;
        }
        public function filterByNganh($MaNganh)
        {
            $sql = "SELECT sinhvien.*, lop.TenLop FROM sinhvien 
            JOIN lop ON sinhvien.MaLop = lop.MaLop 
            JOIN nganh ON lop.MaNganh = nganh.MaNganh 
            WHERE nganh.MaNganh = ?";
            $students = [];
            $stm = $this->conn->prepare($sql);
            $stm->bind_param("s", $MaNganh);
            $stm->execute();
            $result = $stm->get_result();
            $stm->close();
            if($result)
            {
                $students = [];
                while($row = $result->fetch_assoc())
                {
                    $students[] = $row;
                }
                return $students;
            }
            return NULL;
        }
        public function filterByLop($MaLop)
        {
            $sql = "SELECT sinhvien.*, lop.TenLop FROM sinhvien 
            JOIN lop ON sinhvien.MaLop = lop.MaLop 
            WHERE lop.MaLop = ?";
            $students = [];
            $stm = $this->conn->prepare($sql);
            $stm->bind_param("s", $MaLop);
            $stm->execute();
            $result = $stm->get_result();
            $stm->close();
            if($result)
            {
                $students = [];
                while($row = $result->fetch_assoc())
                {
                    $students[] = $row;
                }
                return $students;
            }
            return NULL;
        }

        // ADMIN
    } 
        
    

?>