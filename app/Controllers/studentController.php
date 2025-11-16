<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    
    }
    // controller này cho chức năng của sinh viên
    class studentController
    {
        public function index()
        {
            $title = "Trang chủ";
            $render = __DIR__ . "/../Views/home.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function showDKSK()
        {
            $title = "Đăng ký sự kiện";
            $render = __DIR__ . "/../Views/Student/DangKySuKien.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function showNopMinhChung()
        {
            $title = "Nộp minh chứng";
            $render = __DIR__ . "/../Views/Student/NopMinhChung.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function showTuDanhGiaRL()
        {
            $title = "Tự đánh giá rèn luyện";
            $render = __DIR__ . "/../Views/Student/TuDanhGiaRL.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function showXemDiem()
        {
            $title = "Xem điểm rèn luyện";
            $render = __DIR__ . "/../Views/Student/XemDiem.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public  function showLichSK()
        {
            $title = "Lịch sự kiện";
            $render = __DIR__ . "/../Views/Student/LichSuKien.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
    }

?>