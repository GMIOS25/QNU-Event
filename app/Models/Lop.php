<?php 
    class Lop
    {
        private $conn;
        public function __construct()
        {
           require_once __DIR__ . "/../Configs/database.php";
           $this->conn = Database::getConnection();
        }
        public function getAllLop()
        {
            $sql = "SELECT lop.MaLop, lop.TenLop, lop.MaNganh, nganh.TenNganh, nganh.MaKhoa, khoa.TenKhoa 
                    FROM lop 
                    JOIN nganh ON lop.MaNganh = nganh.MaNganh
                    LEFT JOIN khoa ON nganh.MaKhoa = khoa.MaKhoa
                    ORDER BY lop.MaLop ASC";
            $stmt = $this->conn->prepare($sql);
            $data = [];
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $data[] = $row;
                }
                return $data;
            }
            else
                return NULL;
        }
        public function getLop($MaLop)
        {
            $sql = "SELECT * FROM Lop WHERE MaLop = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('s', $MaLop);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                return $result->fetch_assoc();
            }
            else
                return NULL;
        }
        public function insertLop($MaLop, $TenLop, $MaNganh)
        {
            $sql = "INSERT INTO Lop (MaLop, TenLop, MaNganh) VALUES(?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('sss', $MaLop, $TenLop, $MaNganh );
            return $stmt->execute();
        }
        public function updateLop($MaLop, $TenLop, $MaNganh)
        {
            $sql = "UPDATE Lop SET TenLop = ?, MaNganh = ? WHERE MaLop = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('sss',  $TenLop, $MaNganh, $MaLop );
            return $stmt->execute();
        }
        public function deleteLop($MaLop)
        {
            $sql = "DELETE from Lop WHERE MaLop = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('s', $MaLop );
            return $stmt->execute();
        }
        public function searchLop($keyword)
        {
            $sql = "SELECT lop.MaLop, lop.TenLop, lop.MaNganh, nganh.TenNganh, nganh.MaKhoa, khoa.TenKhoa 
                    FROM Lop 
                    JOIN nganh on lop.MaNganh = nganh.MaNganh
                    LEFT JOIN khoa on nganh.MaKhoa = khoa.MaKhoa
                    WHERE lop.MaLop = ? OR lop.TenLop LIKE ? OR nganh.TenNganh LIKE ?";
            $stm = $this->conn->prepare($sql);
            $likeKeyword = "%".$keyword."%";
            $stm->bind_param('sss', $keyword, $likeKeyword, $likeKeyword);
            $data = [];
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
            else
                return NULL;
        }
        public function filterByMaKhoa($MaKhoa)
        {
            $sql = "SELECT lop.MaLop, lop.TenLop, lop.MaNganh, nganh.TenNganh, nganh.MaKhoa, khoa.TenKhoa 
                    FROM Lop 
                    JOIN nganh on lop.MaNganh = nganh.MaNganh
                    LEFT JOIN khoa on nganh.MaKhoa = khoa.MaKhoa
                    WHERE nganh.MaKhoa = ?";
            $stm = $this->conn->prepare($sql);
            $stm->bind_param('s', $MaKhoa);
            $data = [];
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
            else
                return NULL;
        }
        public function filterByMaNganh($MaNganh)
        {
            $sql = "SELECT lop.MaLop, lop.TenLop, lop.MaNganh, nganh.TenNganh, nganh.MaKhoa, khoa.TenKhoa 
                    FROM Lop 
                    JOIN nganh on lop.MaNganh = nganh.MaNganh
                    LEFT JOIN khoa on nganh.MaKhoa = khoa.MaKhoa
                    WHERE lop.MaNganh = ?";
            $stm = $this->conn->prepare($sql);
            $stm->bind_param('s', $MaNganh);
            $data = [];
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
            else
                return NULL;
        }
        public function filterByKhoaAndNganh($MaKhoa, $MaNganh)
        {
            $sql = "SELECT lop.MaLop, lop.TenLop, lop.MaNganh, nganh.TenNganh, nganh.MaKhoa, khoa.TenKhoa 
                    FROM Lop 
                    JOIN nganh on lop.MaNganh = nganh.MaNganh
                    LEFT JOIN khoa on nganh.MaKhoa = khoa.MaKhoa
                    WHERE nganh.MaKhoa = ? AND lop.MaNganh = ?";
            $stm = $this->conn->prepare($sql);
            $stm->bind_param('ss', $MaKhoa, $MaNganh);
            $data = [];
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
            else
                return NULL;
        }

    }
?>
