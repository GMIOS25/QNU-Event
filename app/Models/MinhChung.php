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
            $sql = "INSERT INTO minhchungthamgiask (MSSV, MaSK,ThoiGianNop, FileMinhChung, TrangThai) VALUES (?, ?, NOW(), ?, 'Chờ duyệt')";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $MSSV, $MaSK, $minhchung_img_path);
            return $stmt->execute();
        }
        public function getMinhChungDaNop($MSSV)
        {
            $sql = "SELECT IDMinhChung, TenSK ,ThoiGianNop, TrangThai FROM minhchungthamgiask join sukien on minhchungthamgiask.MaSK = sukien.MaSK WHERE MSSV = ? ORDER BY ThoiGianNop DESC";
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
        $sql = "SELECT DISTINCT sukien.* FROM sukien
        JOIN dksukien ON sukien.MaSK = dksukien.MaSK 
        LEFT JOIN minhchungthamgiask ON dksukien.MaSK = minhchungthamgiask.MaSK 
                                     AND dksukien.MSSV = minhchungthamgiask.MSSV 
        WHERE 
            NOW() BETWEEN sukien.ThoiGianBatDauSK AND DATE_ADD(sukien.ThoiGianKetThucSK, INTERVAL 7 DAY)
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
        $sql = "SELECT sukien.* FROM sukien JOIN chophepsvkhoathamgia ON sukien.MaSK = chophepsvkhoathamgia.MaSK  WHERE 
            NOW() BETWEEN sukien.ThoiGianBatDauSK AND DATE_ADD(sukien.ThoiGianKetThucSK, INTERVAL 7 DAY)
            AND chophepsvkhoathamgia.MaKhoa = ?";
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
        public function searchSKCanDuyetMinhChung($MaKhoa, $keywork)
        {
            $data = [];
        $sql = "SELECT sukien.* FROM sukien 
        WHERE 
            NOW() BETWEEN sukien.ThoiGianBatDauSK AND DATE_ADD(sukien.ThoiGianKetThucSK, INTERVAL 7 DAY) AND MaKhoa = ? AND (MaSK = ? OR TenSK LIKE ?)";
            $sttm = $this->conn->prepare($sql);
            $likeTenSK = '%'. $keywork . '%';
            $sttm->bind_param("sss", $MaKhoa, $keywork, $likeTenSK);
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
            $sql = "Select IDMinhChung ,sinhvien.MSSV, sinhvien.Ho, sinhvien.Ten, FileMinhChung, lop.TenLop as Lop, ThoiGianNop from minhchungthamgiask 
            join sinhvien on minhchungthamgiask.MSSV = sinhvien.MSSV
            join lop on sinhvien.MaLop = lop.MaLop
            join bcsquanlylop on lop.MaLop = bcsquanlylop.MaLop
            where MaSK = ? and bcsquanlylop.MSSV =? and TrangThai = 'Chờ duyệt'
            ORDER BY ThoiGianNop DESC
            LIMIT ? OFFSET ?";
            $sttm = $this->conn->prepare($sql);
            $sttm->bind_param("ssii", $EventID,$_SESSION['UID'], $limit, $offset);
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
        // fix vì mỗi minh chứng nên rõ ràng 1 trạng thái, nếu where theo mssv và MaSK thì có thể update hết tất cả các minh chứng đã nộp của sk đấy
        // tức là minh chứng đã từ chối -> sv nộp lại -> duyệt cái sv nộp thì minh chứng đã từ chối trc đó sẽ chuyển sang đã duyệt
        public function approveMinhChung($IDMinhChung)
        {
            $sql = "UPDATE minhchungthamgiask SET TrangThai = 'Đã duyệt' WHERE IDMinhChung = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $IDMinhChung);
            return $stmt->execute();
        }
        public function rejectMinhChung($IDMinhChung)
        {
            $sql = "UPDATE minhchungthamgiask SET TrangThai = 'Từ chối' WHERE IDMinhChung = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $IDMinhChung);
            return $stmt->execute();
        }

    }
?>