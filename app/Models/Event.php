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

    }

?>