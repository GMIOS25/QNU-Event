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
        public function loadSKCanNopMinhChung($MSSV)
        {
            $data = [];
        $sql = "SELECT SuKien.* FROM SuKien 
        JOIN dksukien ON SuKien.MaSK = dksukien.MaSK 
        LEFT JOIN minhchungthamgiask ON dksukien.MaSK = minhchungthamgiask.MaSK 
                                     AND dksukien.MSSV = minhchungthamgiask.MSSV 
        WHERE 
            NOW() BETWEEN SuKien.ThoiGianBatDauSK AND DATE_ADD(SuKien.ThoiGianKetThucSK, INTERVAL 7 DAY)
            AND dksukien.MSSV = ? 
            AND dksukien.TrangThai = 'Đăng ký' 
            AND (minhchungthamgiask.TrangThai IS NULL OR minhchungthamgiask.TrangThai != 'Đã duyệt')";
            $sttm = $this->conn->prepare($sql);
            $sttm->bind_param('s', $MSSV);
            if($sttm->execute())
            {
                $result = $sttm->get_result();
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = $result->fetch_assoc())
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
            return NULL;
        }
        public function loadSKCanDuyetMinhChung($MaKhoa)
        {
            $data = [];
        $sql = "SELECT SuKien.* FROM SuKien 
        WHERE 
            NOW() BETWEEN SuKien.ThoiGianBatDauSK AND DATE_ADD(SuKien.ThoiGianKetThucSK, INTERVAL 7 DAY) AND MaKhoa = ?";
            $sttm = $this->conn->prepare($sql);
            $sttm->bind_param("s", $MaKhoa);
            if($sttm->execute())
            {
                $result = $sttm->get_result();
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = $result->fetch_assoc())
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
            return NULL;
        }
        public function loadDanhSachMinhChungChoDuyet($EventID)
        {
            $data = [];
            $sql = "Select  sinhvien.MSSV, sinhvien.Ho, sinhvien.Ten, FileMinhChung, lop.TenLop as Lop, ThoiGianNop from minhchungthamgiask 
            join sinhvien on minhchungthamgiask.MSSV = sinhvien.MSSV
            join lop on sinhvien.MaLop = lop.MaLop
            where MaSK = ? and TrangThai = 'Chờ duyệt'";
            $sttm = $this->conn->prepare($sql);
            $sttm->bind_param("s", $EventID);
            if($sttm->execute())
            {
                $result = $sttm->get_result();
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = $result->fetch_assoc())
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
            return NULL;
        }
        
        /**
         * Lấy danh sách minh chứng chờ duyệt với phân trang
         * 
         * @param string $EventID Mã sự kiện
         * @param int $limit Số lượng items mỗi trang
         * @param int $offset Vị trí bắt đầu
         * @return array|null
         */
        public function loadDanhSachMinhChungChoDuyetWithPagination($EventID, $limit, $offset)
        {
            $data = [];
            $sql = "Select  sinhvien.MSSV, sinhvien.Ho, sinhvien.Ten, FileMinhChung, lop.TenLop as Lop, ThoiGianNop from minhchungthamgiask 
            join sinhvien on minhchungthamgiask.MSSV = sinhvien.MSSV
            join lop on sinhvien.MaLop = lop.MaLop
            where MaSK = ? and TrangThai = 'Chờ duyệt'
            ORDER BY ThoiGianNop DESC
            LIMIT ? OFFSET ?";
            $sttm = $this->conn->prepare($sql);
            $sttm->bind_param("sii", $EventID, $limit, $offset);
            if($sttm->execute())
            {
                $result = $sttm->get_result();
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = $result->fetch_assoc())
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
            return NULL;
        }

        /**
         * Đếm số lượng minh chứng chờ duyệt
         * 
         * @param string $EventID Mã sự kiện
         * @return int
         */
        public function countDanhSachMinhChungChoDuyet($EventID)
        {
            $sql = "SELECT COUNT(*) as total from minhchungthamgiask 
                    where MaSK = ? and TrangThai = 'Chờ duyệt'";
            $sttm = $this->conn->prepare($sql);
            $sttm->bind_param("s", $EventID);
            if($sttm->execute())
            {
                $result = $sttm->get_result();
                $row = $result->fetch_assoc();
                return (int)$row['total'];
            }
            return 0;
        }
        
        public function approveMinhChung($MSSV, $MaSK)
        {
            $sql = "UPDATE MinhChungThamGiaSK SET TrangThai = 'Đã duyệt' WHERE MSSV = ? AND MaSK = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $MSSV, $MaSK);
            return $stmt->execute();
        }
        public function rejectMinhChung($MSSV, $MaSK)
        {
            $sql = "UPDATE MinhChungThamGiaSK SET TrangThai = 'Từ chối' WHERE MSSV = ? AND MaSK = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $MSSV, $MaSK);
            return $stmt->execute();
        }

    }
?>