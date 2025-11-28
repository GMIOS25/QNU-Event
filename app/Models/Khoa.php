<?php 
    class Khoa 
    {
        private $conn = null;
        public function __construct()
        {
           require_once __DIR__ . "/../Configs/database.php";
           $this->conn = Database::getConnection();
        }
        public function getAll()
        {
            $sql = "Select * from Khoa";
            $result = $this->conn->query($sql);
            $data = [];
            if($result->num_rows > 0)
            {
                
                while($rows = $result->fetch_assoc())
                {
                    $data[] = $rows;
                }

            }
            return $data;
        }
        public function insertKhoa($makhoa, $tenkhoa)
        {
            $sql = "Insert into Khoa (MaKhoa, TenKhoa) values (?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $makhoa, $tenkhoa);
            return $stmt->execute();
        }
        public function deleteKhoa($makhoa)
        {
            $sql = "Delete from Khoa where MaKhoa = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $makhoa);
            return $stmt->execute();
        }
        public function getKhoaByMaKhoa($makhoa)
        {
            $sql = "Select * from Khoa where MaKhoa = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $makhoa);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null;
            }
        }
        public function updateKhoa($makhoa, $tenkhoa)
        {
            $sql = "Update Khoa set TenKhoa = ? where MaKhoa = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $tenkhoa, $makhoa);
            return $stmt->execute();
        }
        public function searchKhoa($keyword)
        {
            $sql = "Select * from Khoa where TenKhoa like ? or MaKhoa like ?";
            $stmt = $this->conn->prepare($sql);
            $likeKeyword = "%" . $keyword . "%";
            $stmt->bind_param("ss", $likeKeyword, $likeKeyword);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = [];
            if($result->num_rows > 0)
            {
                while($rows = $result->fetch_assoc())
                {
                    $data[] = $rows;
                }
            }
            return $data;
        }
        
    }

?>