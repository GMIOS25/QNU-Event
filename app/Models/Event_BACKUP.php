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
            $stmt = $this->conn->prepare("INSERT INTO `chophepsvkhoathamgia`(`MaSK`, `MaKhoa`) VALUES (?, ?)");
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
            $stmt = $this->conn->prepare("DELETE FROM `chophepsvkhoathamgia` WHERE MaSK = ?");
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
            $stmt = $this->conn->prepare("INSERT INTO `sukien`( `TenSK`, `ThoiGianMoDK`, `ThoiGianDongDK`, `ThoiGianBatDauSK`, `ThoiGianKetThucSK`, `GioiHanThamGia`,`NoiToChuc`, `DiemCong`, `MaKhoa`, `GhiChu`) 
            VALUES (?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssisiss", $tenSK, $thoiGianMoDK, $thoiGianDongDK, $thoiGianBatDauSK, $thoiGianKetThucSK, $GioiHanThamGia, $NoiToChuc , $DiemCong, $KhoaToChuc, $GhiChu);
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
                $sql = "Select * from SuKien ORDER BY ThoiGianBatDauSK DESC";
            else
                $sql = "Select * from SuKien ORDER BY ThoiGianBatDauSK DESC LIMIT ".$limitElement." OFFSET ".(($page*5) -$limitElement).""; 
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
            $sttm = $this->conn->prepare("Select * from SuKien where MaSK = ?");
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
            $sttm = $this->conn->prepare("select TenKhoa from SuKien join Khoa on SuKien.MaKhoa = Khoa.MaKhoa
                                WHERE sukien.MaSK = ?");
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
            $sttm = $this->conn->prepare("select * from chophepsvkhoathamgia JOIN Khoa on chophepsvkhoathamgia.MaKhoa = Khoa.MaKhoa 
                                WHERE MaSK = ?");
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
            $sttm = $this->conn->prepare("select * from SuKien 
                                WHERE MaSK = ?");
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
            SET TenSK = ?, ThoiGianMoDK = ?, ThoiGianDongDK = ?, ThoiGianBatDauSK = ?, ThoiGianKetThucSK = ?, 
                GioiHanThamGia = ?, NoiToChuc = ?, DiemCong = ?, MaKhoa = ?, GhiChu = ?
            WHERE MaSK = ?");
            $sttm->bind_param(
                    "sssssisisss",
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
            $sttm = $this->conn->prepare("Select COUNT(MSSV) as SL from SuKien join dksukien on sukien.MaSK = dksukien.MaSK
             where sukien.MaSK = ? and TrangThai = 'Đăng ký'");
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
            $sttm = $this->conn->prepare("Select DISTINCT sukien.* from sukien JOIN chophepsvkhoathamgia on sukien.`MaSK` = chophepsvkhoathamgia.`MaSK`
                         WHERE chophepsvkhoathamgia.`MaKhoa`= ? AND (NOW() BETWEEN `ThoiGianMoDK` AND `ThoiGianDongDK`)");
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
            $sttm = $this->conn->prepare("Select SuKien.* from dksukien join sukien on sukien.MaSk = dksukien.MaSK
             Where TrangThai = 'Đăng ký' and MSSV = ?");
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
        public function DangKySuKien($MSSV, $EventID)
        {
            $sttm = $this->conn->prepare("INSERT INTO dksukien(MSSV, MaSK, ThoiGianDK, TrangThai) values(?, ?, NOW(), 'Đăng ký')");
            $sttm->bind_param('ss', $MSSV, $EventID);
            if($sttm->execute())
            {
                return 1;
            }
            return 0;
        }
        public function HuyDKSuKien($MSSV, $eventID)
        {
            $sttm = $this->conn->prepare("UPDATE dksukien SET TrangThai = 'Hủy đăng ký' where MSSV=? and MaSK=? and TrangThai = 'Đăng ký'");
            $sttm->bind_param('ss', $MSSV, $eventID);
            if($sttm->execute())
            {
                return 1;
            }
            return 0;
        }
        public function checkDKTrung($eventID, $MSSV)
        {
            $eventData = $this->getEvent($eventID);
            $start = $eventData['ThoiGianBatDauSK'];
            $end   = $eventData['ThoiGianKetThucSK'];
               $sql = "
                    SELECT 1
                    FROM dksukien JOIN sukien ON dksukien.MaSK = sukien.MaSK WHERE dksukien.MSSV = '".$MSSV."'
                    AND dksukien.TrangThai = 'Đăng ký' AND NOT (
                            sukien.ThoiGianKetThucSK <= '".$start."' 
                        OR sukien.ThoiGianBatDauSK >= '".$end."' 
                    )
                    LIMIT 1
                ";
            $result = $this->conn->query($sql);
            if($result->num_rows > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        public function getSKDaDangKyByDay($MSSV, $date)
        {
            $data = [];
            $sttm = $this->conn->prepare("Select SuKien.* from SuKien join dksukien on SuKien.MaSK = dksukien.MaSk 
            Where Date(ThoiGianBatDauSK) = ?  and MSSV = ? and TrangThai = 'Đăng ký'");
            $sttm->bind_param('ss', $date, $MSSV);
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
                        sinhvien.MSSV, 
                        sinhvien.Ho, 
                        sinhvien.Ten, 
                        khoa.TenKhoa,
                        dksukien.TrangThai,
                        dksukien.ThoiGianDK
                    FROM dksukien
                    JOIN sinhvien ON dksukien.MSSV = sinhvien.MSSV
                    LEFT JOIN lop ON sinhvien.MaLop = lop.MaLop
                    LEFT JOIN nganh ON lop.MaNganh = nganh.MaNganh
                    LEFT JOIN khoa ON nganh.MaKhoa = khoa.MaKhoa
                    WHERE dksukien.MaSK = ? AND dksukien.TrangThai = 'Đăng ký'
                    ORDER BY dksukien.ThoiGianDK DESC";
            
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

    

    }

?>
