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
            $sql = "SELECT khoa.* FROM sinhvien JOIN lop ON sinhvien.MaLop = lop.MaLop JOIN nganh ON lop.MaNganh = nganh.MaNganh JOIN khoa on khoa.MaKhoa = nganh.MaKhoa
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
            $stm = $this->conn->prepare("Select sinhvien.*, lop.*, nganh.* from sinhvien join lop on sinhvien.malop = lop.malop join nganh on nganh.manganh = lop.manganh where MSSV = ?");
            $stm->bind_param("s", $MSSV);
            $stm->execute();
            $result = $stm->get_result();
            if ($result->num_rows > 0 )
            {
                $userData = $result->fetch_assoc();
                return $userData;
            }
            else {
                return NULL;
            }

        }
        public function getStudentByEmail($mssv, $email)
        {
            $stm = $this->conn->prepare("Select * from sinhvien where Email = ? and MSSV != ?");
            $stm->bind_param("ss", $email, $mssv);
            $stm->execute();
            $result = $stm->get_result();
            if ($result->num_rows > 0 )
            {
                $userData = $result->fetch_assoc();
                return $userData;
            }
            else {
                return NULL;
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
            return NULL;
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
        public function filterbyKhoaAndRole($isBanCanSu, $MaKhoa)
        {
           $sql = "SELECT sinhvien.*, lop.TenLop FROM sinhvien 
            JOIN lop ON sinhvien.MaLop = lop.MaLop 
            JOIN nganh ON lop.MaNganh = nganh.MaNganh 
            WHERE sinhvien.isBanCanSu = ? and nganh .MaKhoa = ?";
            $students = [];
            $stm = $this->conn->prepare($sql);
            $stm->bind_param("ss", $isBanCanSu, $MaKhoa);
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
        public function filterbyNganhAndRole($isBanCanSu, $MaNganh)
        {
            $sql = "SELECT sinhvien.*, lop.TenLop FROM sinhvien 
            JOIN lop ON sinhvien.MaLop = lop.MaLop 
            WHERE sinhvien.isBanCanSu = ? and lop.MaNganh = ?";
            $students = [];
            $stm = $this->conn->prepare($sql);
            $stm->bind_param("ss", $isBanCanSu, $MaNganh);
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
        public function filterbyLopAndRole($isBanCanSu, $MaLop)
        {
            $sql = "SELECT sinhvien.*, lop.TenLop FROM sinhvien 
            JOIN lop ON sinhvien.MaLop = lop.MaLop 
            WHERE sinhvien.isBanCanSu = ? and lop.MaLop = ?";
            $students = [];
            $stm = $this->conn->prepare($sql);
            $stm->bind_param("ss", $isBanCanSu, $MaLop);
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
        public function getAllStudents()
        {
            $sql = "SELECT sinhvien.*, lop.TenLop FROM sinhvien 
            JOIN lop ON sinhvien.MaLop = lop.MaLop ";
            $students = [];
            $result = $this->conn->query($sql);
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
        public function insertStudent($MSSV, $Ho, $Ten, $Email,$MatKhau, $isBanCanSu, $MaLop)
        {
            $stm = $this->conn->prepare("INSERT INTO sinhvien (MSSV, Ho, Ten, Email, Password, isBanCanSu, MaLop) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stm->bind_param("sssssss", $MSSV, $Ho, $Ten, $Email, $MatKhau, $isBanCanSu, $MaLop);
            $result = $stm->execute();
            $stm->close();
            return $result;
        }
        public function updateStudent($MSSV, $Ho, $Ten, $Email, $isBanCanSu, $MaLop)
        {
            $stm = $this->conn->prepare("UPDATE sinhvien SET Ho = ?, Ten = ?, Email = ?, isBanCanSu = ?, MaLop = ? WHERE MSSV = ?");
            $stm->bind_param("ssssss", $Ho, $Ten, $Email, $isBanCanSu, $MaLop, $MSSV);
            $result = $stm->execute();
            $stm->close();
            return $result;
        }
        public function deleteStudent($MSSV)
        {
            $stm = $this->conn->prepare("DELETE FROM sinhvien WHERE MSSV = ?");
            $stm->bind_param("s", $MSSV);
            return $stm->execute();
        }
        public function changePassword($MSSV, $newPassword)
        {
            $stm = $this->conn->prepare("UPDATE sinhvien SET Password = ? WHERE MSSV = ?");
            $stm->bind_param("ss", $newPassword, $MSSV);
            $result = $stm->execute();
            $stm->close();
            return $result;
        }

        public function verifyCurrentPassword($MSSV, $currentPassword)
        {
            $stm = $this->conn->prepare("SELECT Password FROM sinhvien WHERE MSSV = ?");
            $stm->bind_param("s", $MSSV);
            $stm->execute();
            $result = $stm->get_result();
            $stm->close();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $storedPassword = $row['Password'];
                
                // Kiểm tra xem mật khẩu có được hash không
                // Nếu password bắt đầu bằng $2y$ thì đó là bcrypt hash
                if (substr($storedPassword, 0, 4) === '$2y$') {
                    // Sử dụng password_verify cho mật khẩu đã hash
                    return password_verify($currentPassword, $storedPassword);
                } else {
                    // So sánh trực tiếp cho mật khẩu plain text (tương thích với hệ thống cũ)
                    return $currentPassword === $storedPassword;
                }
            }
            
            return false;
        }

        public function addLopQuanLy($MSSV, $MaLop)
        {
            $stm = $this->conn->prepare("INSERT INTO bcsquanlylop VALUES(?, ?)");
            $stm->bind_param('ss', $MSSV, $MaLop );
            return $stm->execute();
        }
        public function resetLopQuanLy($MSSV)
        {
            $stm = $this->conn->prepare("DELETE FROM bcsquanlylop where MSSV = ?");
            $stm->bind_param('s', $MSSV );
            return $stm->execute();
        }
        public function getLopQuanLy($MSSV)
        {
            $stm = $this->conn->prepare("SELECT MaLop FROM bcsquanlylop WHERE MSSV = ?");
            $stm->bind_param('s', $MSSV);
            $stm->execute();
            $result = $stm->get_result();
            $stm->close();
            $lopQuanLy = [];
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $lopQuanLy[] = $row['MaLop'];
                }
            }
            return $lopQuanLy;
        }
        public function searchStudent($keyword)
        {
            $sql = "SELECT sinhvien.*, lop.TenLop FROM sinhvien 
            JOIN lop ON sinhvien.MaLop = lop.MaLop 
            WHERE MSSV = ? or Ten LIKE ?";

            $stm = $this->conn->prepare($sql);
            $likeStm = '%'.$keyword.'%';
            $stm->bind_param('ss',$keyword, $keyword );
            $data = [];
            $stm->execute();
            $result = $stm->get_result();
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $data[] = $row;
                }
                return $data;
            }
            return NULL;
        }
        // ADMIN
        public function getListAccountAdmin()
        {
            $data = [];
            $sql = "SELECT * FROM admin";
            $stm = $this->conn->prepare($sql);
            $stm->execute();

            $result = $stm->get_result();
            if($result->num_rows > 0)
            {
                while($rows = $result->fetch_assoc())
                {
                    $data[] = $rows;
                }
                return $data;
            }
            return NULL;

        }
        public function addAdmin($adminID, $ho, $ten, $password, $email)
        {
            $sql = "INSERT INTO admin (AdminID, Ho, Ten, Password, Email) VALUES (?,?,?,?,?)";
            $stm = $this->conn->prepare($sql);
            $stm->bind_param("sssss", $adminID, $ho, $ten, $password, $email);
            return $stm->execute();
        }

        public function isContainAdmin($adminID, $email)
        {
            $sql = "SELECT 1 FROM admin WHERE AdminID = ? OR Email = ?";
            $stm = $this->conn->prepare($sql);
            $stm->bind_param('ss', $adminID, $email);
            $stm->execute();
            if($stm->get_result()->num_rows > 0)
            {
                return 1;
            }
            return 0;
        }
        public function isContainEmailWhenEdit($adminID, $email)
        {
            $sql = "SELECT 1 FROM admin WHERE AdminID != ? AND Email = ?";
            $stm = $this->conn->prepare($sql);
            $stm->bind_param('ss', $adminID, $email);
            $stm->execute();
            if($stm->get_result()->num_rows > 0)
            {
                return 1;
            }
            return 0;
        }
        public function getAdminByAdminID($adminID)
        {
            $sql = "SELECT * FROM admin where AdminID = ? LIMIT 1";
            $stm = $this->conn->prepare($sql);
            $stm->bind_param("s", $adminID);
            $stm->execute();
            $res = $stm->get_result();

            if($res->num_rows > 0)
                return $res->fetch_assoc();
            else
                return NULL;
        }
        public function modifyAdmin($adminID, $ho, $ten, $email)
        {
            $sql = "UPDATE admin SET Ho = ? , Ten = ?, Email = ? WHERE adminID = ?";
            $stm = $this->conn->prepare($sql);
            $stm->bind_param("ssss",  $ho, $ten, $email, $adminID);
            return $stm->execute();
        }
        public function deleteAdmin($adminID)
        {
            $stm = $this->conn->prepare("DELETE FROM admin WHERE AdminID = ?");
            $stm->bind_param('s', $adminID);
            return $stm->execute();
        }
        public function searchAdmin($keyword)
        {
            $sql = "SELECT * FROM admin WHERE AdminID  = ?  OR Ten LIKE ? OR Email = ?";
            $likeTen = '%'.$keyword.'%';
            $stm = $this->conn->prepare($sql);
            $stm->bind_param('sss', $keyword, $likeTen, $keyword);
            $stm->execute();
            $result = $stm->get_result();
            $data = [];
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $data[] = $row;
                }
                return $data;
            }
            return NULL;

        }

    } 
        
    

?>
