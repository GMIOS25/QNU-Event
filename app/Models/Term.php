<?php 
    class Term{
        private $conn;
        public function __construct()
        {
           require_once __DIR__ . "/../Configs/database.php";
           $this->conn = Database::getConnection();
        }

        public function getAllHK()
        {
            $sql = "SELECT * FROM hocky ORDER BY ThoiGianBatDau DESC";
            $stmt = $this->conn->prepare($sql);
            $data = [];
            $stmt->execute();
                $result = $stmt->get_result();
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $data[] = $row;
                    }
                    return $data;
                }
                else
                {
                    return NULL;
                }
            
        }
        public function getHocKyById($maHK)
        {
            $sql = "SELECT * FROM hocky WHERE MaHK = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $maHK);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null;
            }
        }
        public function addHocKy($maHK, $tenHK, $thoiGianBatDau, $thoiGianKetThuc)
        {
            $sql = "INSERT INTO hocky (MaHK, TenHK, ThoiGianBatDau, ThoiGianKetThuc) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssss", $maHK, $tenHK, $thoiGianBatDau, $thoiGianKetThuc);
            return $stmt->execute();
        }
        public function getStateHocKy($MaHocKy)
        {
            $sql = "SELECT * FROM hocky WHERE MaHK = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $MaHocKy);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $currentDate = date('Y-m-d H:i:s');
                if ($currentDate < $row['ThoiGianBatDau']) {
                    return 0; // Chưa bắt đầu
                } elseif ($currentDate >= $row['ThoiGianBatDau'] && $currentDate <= $row['ThoiGianKetThuc']) {
                    return 1; // Đang diễn ra
                } else {
                    return 2; // Đã kết thúc
                }
            } else {
                return -1; // Không tìm thấy học kỳ
            }
        }
        public function updateHocKy($maHK, $tenHK, $thoiGianBatDau, $thoiGianKetThuc)
        {
            $sql = "UPDATE hocky SET TenHK = ?, ThoiGianBatDau = ?, ThoiGianKetThuc = ? WHERE MaHK = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssss", $tenHK, $thoiGianBatDau, $thoiGianKetThuc, $maHK);
            return $stmt->execute();
        }
        public function checkTrungHocKy($maHK, $thoiGianBatDau, $thoiGianKetThuc)
        {
            $sql = "SELECT * FROM hocky WHERE (MaHK != ?) AND ((ThoiGianBatDau <= ? AND ThoiGianKetThuc >= ?) OR (ThoiGianBatDau <= ? AND ThoiGianKetThuc >= ?))";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssss", $maHK, $thoiGianKetThuc, $thoiGianKetThuc, $thoiGianBatDau, $thoiGianBatDau);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return true; // Trùng học kỳ
            } else {
                return false; // Không trùng học kỳ
            }
        }
        public function endHocKy($maHK)
        {
            $currentDateTime = date('Y-m-d H:i:s');
            $sql = "UPDATE hocky SET ThoiGianKetThuc = ? WHERE MaHK = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $currentDateTime, $maHK);
            return $stmt->execute();
        }
    }

?>