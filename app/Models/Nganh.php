<?php 
    class Nganh
    {
        private $conn;
        public function __construct()
        {
           require_once __DIR__ . "/../Configs/database.php";
           $this->conn = Database::getConnection();
        }
        public function getAllNganh()
        {
            $sql = "SELECT nganh.MaNganh, nganh.TenNganh, khoa.TenKhoa 
                    FROM nganh 
                    LEFT JOIN khoa ON nganh.MaKhoa = khoa.MaKhoa
                    ORDER BY nganh.MaNganh ASC";
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
        public function getNganh($MaNganh)
        {
            $sql = "SELECT * FROM nganh WHERE MaNganh = ?";
            $stmt = $this->conn->prepare($sql);
            $data = [];
            $stmt->bind_param('s', $MaNganh);
            $stmt->execute();
                            $result = $stmt->get_result();
                if(mysqli_num_rows($result) > 0)
                {
                    return $result->fetch_assoc();

                }
                else
                {
                    return NULL;
                }
        }
        public function insertNganh($MaNganh, $TenNganh, $MaKhoa)
        {
            $sql = "INSERT INTO nganh (MaNganh, TenNganh, MaKhoa) VALUES(?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('sss', $MaNganh, $TenNganh, $MaKhoa );
            return $stmt->execute();
        }
        public function updateNganh($MaNganh, $TenNganh, $MaKhoa)
        {
            $sql = "UPDATE nganh SET  TenNganh = ?, MaKhoa = ? WHERE MaNganh = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('sss',  $TenNganh, $MaKhoa, $MaNganh );
            return $stmt->execute();
        }
        public function deleteNganh($MaNganh)
        {
            $sql = "DELETE from Nganh WHERE MaNganh = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('s', $MaNganh );
            return $stmt->execute();
        }
        public function searchNganh($keyword)
        {
            $sql = "SELECT nganh.MaNganh, nganh.TenNganh, khoa.TenKhoa FROM nganh join khoa on khoa.MaKhoa = nganh.MaKhoa WHERE nganh.MaNganh = ? OR TenNganh LIKE ?";
            $stm = $this->conn->prepare($sql);
            $likeKeyword = "%".$keyword."%";
            $stm->bind_param('ss', $keyword, $likeKeyword);
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
            $sql = "SELECT nganh.MaNganh, nganh.TenNganh, khoa.TenKhoa FROM nganh join khoa on khoa.MaKhoa = nganh.MaKhoa WHERE nganh.MaKhoa = ?";
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
    }
?>