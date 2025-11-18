<?php 
    class MinhChung
    {
        private $conn;
        public function __construct()
        {
           require_once __DIR__ . "/../Configs/database.php";
           $this->conn = Database::getConnection();
        }
        public function NopMinhChung($MSSV, $MaSK, $minhchung_img_path)
        {
            $sql = "INSERT INTO MinhChungThamGiaSK (MSSV, MaSK,ThoiGianNop, FileMinhChung, TrangThai) VALUES (?, ?, NOW(), ?, 'Chờ duyệt')";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $MSSV, $MaSK, $minhchung_img_path);
            return $stmt->execute();
        }
        public function getMinhChungDaNop($MSSV)
        {
            $sql = "SELECT IDMinhChung, TenSK ,ThoiGianNop, TrangThai FROM MinhChungThamGiaSK join SuKien on MinhChungThamGiaSK.MaSK = SuKien.MaSK WHERE MSSV = ? ORDER BY ThoiGianNop DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $MSSV);
            $stmt->execute();
            $result = $stmt->get_result();
            $minhchungList = [];
            while ($row = $result->fetch_assoc()) {
                $minhchungList[] = $row;
            }
            return $minhchungList;
        }
    }
?>