<?php 
    class Event
    {
        private $conn;
        public function __construct()
        {
           require_once __DIR__ . "/../Configs/database.php";
           $this->conn = Database::getConnection();
        }
        public function addEvent($tenSK, $thoiGianMoDK, $thoiGianDongDK, $thoiGianBatDauSK, $thoiGianKetThucSK, $GioiHanThamGia, $NoiToChuc, $DiemCong, $KhoaToChuc, $GhiChu)
        {
            $stmt = $this->conn->prepare("INSERT INTO `sukien`( `TenSK`, `ThoiGianMoDK`, `ThoiGianDongDK`, `ThoiGianBatDauSK`, `ThoiGianKetThucSK`, `GioiHanThamGia`,`NoiToChuc`, `DiemCong`, `MaKhoa`, `GhiChu`) 
            VALUES (?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssisiss", $tenSK, $thoiGianMoDK, $thoiGianDongDK, $thoiGianBatDauSK, $thoiGianKetThucSK, $GioiHanThamGia, $NoiToChuc , $DiemCong, $KhoaToChuc, $GhiChu);
            $stmt->execute();
            if ($stmt->execute())
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        public function addKhoaThamGia($MaSK, $MaKhoa)
        {
            $sttm = $this->conn->prepare("")
        }
    }

?>