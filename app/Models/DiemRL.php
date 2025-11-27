<?php 
    require_once __DIR__ . "/../Configs/database.php";
    class DiemRL {
        private $conn;
        public function __construct() {
            $this->conn = Database::getConnection();
        }
        public function getDiemRLSV($mssv, $termID) {
            $stmt = $this->conn->prepare("SELECT * FROM diemrlsv WHERE mssv = ? AND MaHK = ?");
            $stmt->bind_param("ss", $mssv, $termID);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null;
            }
        }
        // khởi tạo điểm rèn luyện cho sinh viên khi sinh viên chưa có cột điểm rèn luyện trong học kỳ

        public function initDiemRLSV($mssv, $termID)
        {
            $tmp = $this->getDiemRLSV($mssv, $termID);
            if($tmp === null){ 
                $stmt = $this->conn->prepare("INSERT INTO diemrlsv (mssv, MaHK, SoDiem) VALUES (?, ?, 0)");
                $stmt->bind_param("ss", $mssv, $termID);
                return $stmt->execute();
            }
        }

        public function writeLogDiemRLSV($mssv, $termID, $type, $soDiem, $Content)
        {
            $sql = "Insert into biendongdrl (LoaiGD, MSSV, MaHK, Sodiem, NoiDung) values (?, ?, ?, ?, ?)";
            $sttmt = $this->conn->prepare($sql);
            $sttmt->bind_param("sssis", $type, $mssv, $termID, $soDiem, $Content);
            return $sttmt->execute();
        }
        public function congDiemRLSV($MSSV, $termID, $soDiem, $Content)
        {
            $this->initDiemRLSV($MSSV, $termID);
            $stmt = $this->conn->prepare("UPDATE diemrlsv SET SoDiem = SoDiem + ? WHERE mssv = ? AND MaHK = ?");
            $stmt->bind_param("iss", $soDiem, $MSSV, $termID);
            $result = $stmt->execute();
            if ($result) {
                $this->writeLogDiemRLSV($MSSV, $termID, 'Cộng', $soDiem, $Content);
            }
            return $result;
        }
        public function truDiemRLSV($MSSV, $termID, $soDiem, $Content)
        {
            $this->initDiemRLSV($MSSV, $termID);
            $stmt = $this->conn->prepare("UPDATE diemrlsv SET SoDiem = SoDiem - ? WHERE mssv = ? AND MaHK = ?");
            $stmt->bind_param("iss", $soDiem, $MSSV, $termID);
            $result = $stmt->execute();
            if ($result) {
                $this->writeLogDiemRLSV($MSSV, $termID, 'Trừ', $soDiem, $Content);
            }
            return $result;
        }
    }

?>