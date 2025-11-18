<?php 
    require_once __DIR__ . "/../Models/Event.php";
    require_once __DIR__ . "/../Models/User.php";
    require_once __DIR__ . "/../Models/MinhChung.php";
    class bcsController{
        public function showDuyetMinhChung()
        {
            $minhChungModel = new MinhChung();
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $title = "Minh chứng tham gia sự kiện ";
            $eventModel = new Event();
            $userModel = new User();
            $khoaSV = $userModel->getKhoaSV($_SESSION['UID']);
            $listSKMinhChung = $minhChungModel->loadSKCanDuyetMinhChung($khoaSV['MaKhoa']);
            $title = "Tự đánh giá rèn luyện";
            $render = __DIR__ . "/../Views/BCS/ListSuKienCanDuyet.php";
            include __DIR__ . "/../Views/layout.php" ;

        }
        public function showDuyetPhieuRL()
        {
            
            $title = "Tự đánh giá rèn luyện";
            $render = __DIR__ . "/../Views/BCS/DuyetPhieuRL.php";
            include __DIR__ . "/../Views/layout.php" ;

        }
        public function showDanhSachMinhChung()
        {
            $minhChungModel = new MinhChung();
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $title = "Minh chứng tham gia sự kiện ";
            $eventModel = new Event();
            $userModel = new User();
            if(isset($_GET['EventID']))
            {
                $eventID = $_GET['EventID'];
                $listMinhChung = $minhChungModel->loadDanhSachMinhChungChoDuyet($eventID);
            }
            $title = "Danh sách minh chứng chờ duyệt";
            $render = __DIR__ . "/../Views/BCS/DanhSachMinhChung.php";
            include __DIR__ . "/../Views/layout.php" ;

        }
    }

?>