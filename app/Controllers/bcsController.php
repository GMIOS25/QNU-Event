<?php 
    class bcsController{
        public function showDuyetMinhChung()
        {
            $title = "Tự đánh giá rèn luyện";
            $render = __DIR__ . "/../Views/BCS/DuyetMinhChung.php";
            include __DIR__ . "/../Views/layout.php" ;

        }
        public function showDuyetPhieuRL()
        {
            $title = "Tự đánh giá rèn luyện";
            $render = __DIR__ . "/../Views/BCS/DuyetPhieuRL.php";
            include __DIR__ . "/../Views/layout.php" ;

        }
    }

?>