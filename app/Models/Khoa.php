<?php 
    class Khoa 
    {
        private $conn = null;
        public function __construct()
        {
           require_once __DIR__ . "/../Configs/database.php";
           $this->conn = Database::getConnection();
        }
        public function getAll()
        {
            $sql = "Select * from Khoa";
            $result = $this->conn->query($sql);
            $data = [];
            if($result->num_rows > 0)
            {
                
                while($rows = $result->fetch_assoc())
                {
                    $data[] = $rows;
                }

            }
            return $data;
        }
    }

?>