<?php 
    class Event
    {
        private $conn;
        public function __construct()
        {
           require_once __DIR__ . "/../Configs/database.php";
           $this->conn = Database::getConnection();
        }
        public function addKhoaThamGia($MaSK, $MaKhoa)
        {
            $stmt = $this->conn->prepare("INSERT INTO `chophepsvkhoathamgia`(`mask`, `makhoa`) VALUES (?, ?)");
            $stmt->bind_param("ss", $MaSK, $MaKhoa);
            if ($stmt->execute())
            {
                return 1;
            }
            else
                return 0;
        }
        public function deleteAllKhoaThamGia($MaSK)
        {
            $stmt = $this->conn->prepare("DELETE FROM `chophepsvkhoathamgia` WHERE mask = ?");
            $stmt->bind_param("s", $MaSK);
            if ($stmt->execute())
            {
                return 1;
            }
            else
                return 0;
        }
        public function addEvent($tenSK, $thoiGianMoDK, $thoiGianDongDK, $thoiGianBatDauSK, $thoiGianKetThucSK, $GioiHanThamGia, $NoiToChuc, $DiemCong, $KhoaToChuc, $GhiChu, $listKhoaThamGia)
        {
            $stmt = $this->conn->prepare("INSERT INTO `sukien`( `tensk`, `thoigianmodk`, `thoigiandongdk`, `thoigianbatdausk`, `thoigianketthucsk`, `gioihanthamgia`,`noitochuc`, `diemcong`, `makhoa`, `ghichu`, mahk) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssisisss", $tenSK, $thoiGianMoDK, $thoiGianDongDK, $thoiGianBatDauSK, $thoiGianKetThucSK, $GioiHanThamGia, $NoiToChuc , $DiemCong, $KhoaToChuc, $GhiChu, $_SESSION['currentTerm']['MaHK']);
            if ($stmt->execute())
            {
                // thêm vào bảng list khoa đc phép tham gia
                foreach($listKhoaThamGia as $maKhoa)
                {
                    $mess = $this->addKhoaThamGia($stmt->insert_id, $maKhoa); // lấy id cột autoincrement để insert
                    if(!$mess)
                    {
                        return 0;
                    }
                }
                return 1;
            }
            else
            {
                return 0;
            }
        }
        public function getNumRows($sql)
        {
            $result = $this->conn->query($sql);      
            return (int)mysqli_num_rows($result); 
        }
        public function getAllEvent($limitElement=null,$page=null)
        {
            if($page == null)
                $sql = "Select * from sukien ORDER BY thoigianbatdausk DESC";
            else
                $sql = "Select * from sukien ORDER BY thoigianbatdausk DESC LIMIT ".$limitElement." OFFSET ".(($page*5) -$limitElement).""; 
            $result = $this->conn->query($sql);
            $data = [];
            if (mysqli_num_rows($result) > 0)   
            {
                while ($row = mysqli_fetch_array($result))
                {
                    $data[] = $row;
                }
                return $data;
            }
            else
            {
                return 0;
            }            
        }
        
        public function getListEvent($sql)
        {
            $result = $this->conn->query($sql);
            $data = [];
            if (mysqli_num_rows($result) > 0)   
            {
                while ($row = mysqli_fetch_array($result))
                {
                    $data[] = $row;
                }
                return $data;
            }
            else
            {
                return 0;
            }  
        }
        public function getEvent($eventID)
        {
            $data = [];
            $sttm = $this->conn->prepare("Select * from sukien where mask = ?");
            $sttm->bind_param('s', $eventID);
            if($sttm->execute())
            {
                $result = $sttm->get_result();
                if(mysqli_num_rows($result) > 0)
                {
                    $data = $result->fetch_assoc();
                    return $data;
                }
                else
                {
                    return NULL;
                }
            }
            return NULL;
        }
        public function getTenKhoaToChuc($eventID)
        {
            $data = [];
            $sttm = $this->conn->prepare("select tenkhoa from sukien join khoa on sukien.makhoa = khoa.makhoa
                                WHERE sukien.mask = ?");
            $sttm->bind_param('s', $eventID);
            if($sttm->execute())
            {
                $result = $sttm->get_result();
                if(mysqli_num_rows($result) > 0)
                {
                    $data = $result->fetch_assoc();
                    return $data['TenKhoa'];
                }
                else
                {
                    return NULL;
                }
            }
            return NULL;
        }
        public function getDSTenKhoaDuocPhepThamGia($eventID)
        {
            $data = [];
            $sttm = $this->conn->prepare("select * from chophepsvkhoathamgia JOIN khoa on chophepsvkhoathamgia.makhoa = khoa.makhoa 
                                WHERE mask = ?");
            $sttm->bind_param('s', $eventID);
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
        // 0 - chưa mở dk
        // 1 - đang mở dk
        // 2 - đang chờ diễn ra
        // 3 - đang diễn ra
        // 4 - đã kết thúc
        public function getStateEvent($eventID)
        {
            $sttm = $this->conn->prepare("select * from sukien 
                                WHERE mask = ?");
            $sttm->bind_param('s', $eventID);
            if($sttm->execute())
            {
                $result = $sttm->get_result();
                if(mysqli_num_rows($result) > 0)
                {
                    $eventRawData = $result->fetch_assoc();
                    $currentTime = time();
                    $descripState = 0;
                    $moDK = strtotime($eventRawData["ThoiGianMoDK"]);
                    $dongDK = strtotime($eventRawData["ThoiGianDongDK"]);
                    $batDau = strtotime($eventRawData["ThoiGianBatDauSK"]);
                    $ketThuc = strtotime($eventRawData["ThoiGianKetThucSK"]);

                    if ($currentTime >= $batDau && $currentTime <= $ketThuc) {
                        $descripState = 3;
                    } elseif ($currentTime > $ketThuc) {
                        $descripState = 4;
                    } elseif ($currentTime >= $moDK && $currentTime <= $dongDK) {
                        $descripState = 1;
                    } elseif ($currentTime < $moDK) {
                        $descripState = 0;
                    } else {
                        // Sau khi đóng đăng ký nhưng chưa tới ngày diễn ra
                        $descripState = 2; // hoặc đổi text khác tùy cậu
                    }
                    return $descripState;

                }
                else
                {
                    return NULL;
                }
            }
            return NULL;
        }

        public function modifyEvent($eventID, $tenSK, $thoiGianMoDK, $thoiGianDongDK, $thoiGianBatDauSK, $thoiGianKetThucSK, $GioiHanThamGia, $NoiToChuc, $DiemCong, $KhoaToChuc, $GhiChu, $listKhoaThamGia)
        {
            $sttm =  $this->conn->prepare("UPDATE sukien 
            SET tensk = ?, thoigianmodk = ?, thoigiandongdk = ?, thoigianbatdausk = ?, thoigianketthucsk = ?, 
                gioihanthamgia = ?, noitochuc = ?, diemcong = ?, makhoa = ?, ghichu = ?, mahk = ?
            WHERE mask = ?");
            $sttm->bind_param(
                    "sssssisissss",
                    $tenSK,
                    $thoiGianMoDK,
                    $thoiGianDongDK,
                    $thoiGianBatDauSK,
                    $thoiGianKetThucSK,
                    $GioiHanThamGia,
                    $NoiToChuc,
                    $DiemCong,
                    $KhoaToChuc,
                    $GhiChu,
                    $_SESSION['currentTerm']['MaHK'],
                    $eventID
                );
            if($sttm->execute())
            {
                $this->deleteAllKhoaThamGia($eventID);
                foreach($listKhoaThamGia as $maKhoa)
                {
                    $mess = $this->addKhoaThamGia($eventID, $maKhoa); // lấy id cột autoincrement để insert
                    if(!$mess)
                    {
                        return 0;
                    }
                }
                return 1;
            }
            else 
            {
                return 0;
            }
        }
        public function getSLSinhVienDangKySK($MaSK)
        {
            $sttm = $this->conn->prepare("Select COUNT(mssv) as SL from sukien join dksukien on sukien.mask = dksukien.mask
             where sukien.mask = ? and trangthai = 'Đăng ký'");
            $sttm->bind_param('s', $MaSK);
            if($sttm->execute())
            {
                $result = $sttm->get_result();
                if(mysqli_num_rows($result) > 0)
                {
                    return $result->fetch_assoc()['SL'];
                }
                else
                {
                    return NULL;
                }
            }
        }
        public function getListSKDangKy($MaKhoa)
        {
            $data = [];
            $sttm = $this->conn->prepare("Select DISTINCT sukien.* from sukien JOIN chophepsvkhoathamgia on sukien.`mask` = chophepsvkhoathamgia.`mask`
                         WHERE chophepsvkhoathamgia.`makhoa`= ? AND (NOW() BETWEEN `thoigianmodk` AND `thoigiandongdk`)");
            $sttm->bind_param('s', $MaKhoa);
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
        public function getListSKDaDangKy($MSSV)
        {
            $data = [];
            $sttm = $this->conn->prepare("Select sukien.* from dksukien join sukien on sukien.mask = dksukien.mask 
             Where trangthai = 'Đăng ký' and mssv = ? and sukien.mahk = ?");
            $sttm->bind_param('ss', $MSSV, $_SESSION['currentTerm']['MaHK']);
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
        public function DangKySuKien($MSSV, $EventID)
        {
            $sttm = $this->conn->prepare("INSERT INTO dksukien(mssv, mask, thoigiandk, trangthai) values(?, ?, NOW(), 'Đăng ký')");
            $sttm->bind_param('ss', $MSSV, $EventID);
            if($sttm->execute())
            {
                return 1;
            }
            return 0;
        }
        
        public function HuyDKSuKien($MSSV, $eventID)
        {
            $sttm = $this->conn->prepare("UPDATE dksukien SET trangthai = 'Hủy đăng ký' where mssv=? and mask=? and trangthai = 'Đăng ký'");
            $sttm->bind_param('ss', $MSSV, $eventID);
            if($sttm->execute())
            {
                return 1;
            }
            return 0;
        }
        
        public function checkDKTrung($EventID, $MSSV)
        {
            // Check if student has already registered for an event that overlaps with this event's time
            $data = [];
            $sttm = $this->conn->prepare("SELECT sk1.* 
                FROM dksukien dk
                JOIN sukien sk1 ON dk.mask = sk1.mask
                JOIN sukien sk2 ON sk2.mask = ?
                WHERE dk.mssv = ? 
                AND dk.trangthai = 'Đăng ký'
                AND (
                    (sk1.thoigianbatdausk <= sk2.thoigianketthucsk AND sk1.thoigianketthucsk >= sk2.thoigianbatdausk)
                )");
            $sttm->bind_param('ss', $EventID, $MSSV);
            if($sttm->execute())
            {
                $result = $sttm->get_result();
                if(mysqli_num_rows($result) > 0)
                {
                    return true; // Has overlapping event
                }
            }
            return false; // No overlap
        }
        
        public function getSKDaDangKyByDay($MSSV, $date)
        {
            $data = [];
            $sttm = $this->conn->prepare("SELECT sukien.* 
                FROM dksukien 
                JOIN sukien ON sukien.mask = dksukien.mask
                WHERE trangthai = 'Đăng ký' 
                AND mssv = ? 
                AND DATE(thoigianbatdausk) = ?");
            $sttm->bind_param('ss', $MSSV, $date);
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
        
        public function getRegisteredStudents($EventID)
        {
            $data = [];
            $sql = "SELECT 
                        sinhvien.mssv, 
                        sinhvien.ho, 
                        sinhvien.ten, 
                        khoa.tenkhoa,
                        dksukien.trangthai,
                        dksukien.thoigiandk
                    FROM dksukien
                    JOIN sinhvien ON dksukien.mssv = sinhvien.mssv
                    LEFT JOIN lop ON sinhvien.malop = lop.malop
                    LEFT JOIN nganh ON lop.manganh = nganh.manganh
                    LEFT JOIN khoa ON nganh.makhoa = khoa.makhoa
                    WHERE dksukien.mask = ? AND dksukien.trangthai = 'Đăng ký'
                    ORDER BY dksukien.thoigiandk DESC";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $EventID);
            
            if($stmt->execute())
            {
                $result = $stmt->get_result();
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
         * Lấy danh sách sinh viên đăng ký sự kiện với phân trang
         * 
         * @param string $EventID Mã sự kiện
         * @param int $limit Số lượng items mỗi trang
         * @param int $offset Vị trí bắt đầu
         * @return array|null
         */
        public function getRegisteredStudentsWithPagination($EventID, $limit, $offset)
        {
            $data = [];
            $sql = "SELECT 
                        sinhvien.MSSV, 
                        sinhvien.Ho, 
                        sinhvien.Ten, 
                        khoa.TenKhoa,
                        lop.TenLop,
                        CASE
                         WHEN minhchungthamgiask.trangthai IS NULL THEN 'Đăng ký'
                        WHEN minhchungthamgiask.trangthai = 'Đã duyệt' THEN 'Đã duyệt' 
                        WHEN minhchungthamgiask.trangthai = 'Chờ duyệt' THEN 'Chờ duyệt' 
                        WHEN minhchungthamgiask.trangthai   = 'Từ chối'  THEN 'Từ chối'
                            ELSE 'Không hợp lệ'
                            END AS TrangThai,
                        dksukien.thoigiandk
                    FROM dksukien
                    LEFT JOIN sinhvien ON dksukien.mssv = sinhvien.mssv
                    LEFT JOIN lop ON sinhvien.malop = lop.malop
                    LEFT JOIN nganh ON lop.manganh = nganh.manganh
                    LEFT JOIN khoa ON nganh.makhoa = khoa.makhoa
                    LEFT JOIN minhchungthamgiask on dksukien.mask = minhchungthamgiask.mask and sinhvien.mssv = minhchungthamgiask.mssv
                    WHERE dksukien.mask = ?  
                    ORDER BY dksukien.thoigiandk DESC
                    LIMIT ? OFFSET ?";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sii", $EventID, $limit, $offset);
            
            if($stmt->execute())
            {
                $result = $stmt->get_result();
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
         * Đếm số lượng sinh viên đăng ký sự kiện
         * 
         * @param string $EventID Mã sự kiện
         * @return int
         */
        public function getRegisteredStudentsCount($EventID)
        {
            $sql = "SELECT COUNT(*) as total
                    FROM dksukien
                    WHERE dksukien.mask = ? AND dksukien.trangthai = 'Đăng ký'";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $EventID);
            
            if($stmt->execute())
            {
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return (int)$row['total'];
            }
            return 0;
        }
        public function deleteEvent($EventID)
        {
            $sql = "DELETE from sukien where mask = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $EventID);
            return $stmt->execute();
        }
    

    }

?>