<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    
    }
    
    require_once __DIR__ . "/../Models/Event.php";
    require_once __DIR__ . "/../Models/User.php";
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
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $listEvent = [];
            $title = "Đăng ký sự kiện";
            $userModel = new User();
            $eventModel = new Event();
            //$userData = $userModel->getStudentInfo($_SESSION['UID']);
            $maKhoaSV = $userModel->getKhoaSV($_SESSION['UID'])["MaKhoa"];
            $rawEventList = $eventModel->getListSKDangKy($maKhoaSV);
            $eventDaDKList = $eventModel->getListSKDaDangKy($_SESSION['UID']);
            foreach($rawEventList as $event)
            {
                $slSVDangKySK = $eventModel->getSLSinhVienDangKySK($event['MaSK']);
                $listEvent[] =
                [
                    "MaSK" =>$event['MaSK'],
                    "TenSK" => $event['TenSK'],
                    "ThoiGianBatDauSK" => $event['ThoiGianBatDauSK'],
                    "ThoiGianKetThucSK" => $event['ThoiGianKetThucSK'],
                    "NoiToChuc" => $event['NoiToChuc'],
                    "SoLuongDK" => $slSVDangKySK.'/'.$event['GioiHanThamGia']
                ];
            }

            $render = __DIR__ . "/../Views/Student/DangKySuKien.php";
            include __DIR__ . "/../Views/layout.php" ;


        }
        public function submitDKSK() 
        {
            global $publicBase;
            $userModel = new User();
            $eventModel = new Event();
            if(!$eventModel->checkDKTrung($_GET['EventID'], $_SESSION['UID']) )
            {
                if($eventModel->DangKySuKien($_SESSION['UID'], $_GET['EventID']))
                {
                    $_SESSION['message'] = "Đăng ký thành công!";
                }
                else
                {
                    $_SESSION['message'] = "Đăng ký thất bại!";
                }
            }
            else
            {
                $_SESSION['message'] = "Trùng lịch sự kiện đã dk!";
            }
            header("Location: ".$publicBase."/Student/DangKySuKien");

        }
        public function huyDKSK()
        {
            global $publicBase;
            $userModel = new User();
            $eventModel = new Event();
            if($eventModel->HuyDKSuKien($_SESSION['UID'], $_GET['EventID']))
            {
                $_SESSION['message'] = "Hủy thành công!";
            }
            else
            {
                $_SESSION['message'] = "Hủy thất bại";
            }
            header("Location: ".$publicBase."/Student/DangKySuKien");
        }
        public function showNopMinhChung()
        {
            $title = "Minh chứng tham gia sự kiện ";
            $eventModel = new Event();
            $listSKMinhChung = $eventModel->loadSKCanNopMinhChung($_SESSION['UID']);

            $render = __DIR__ . "/../Views/Student/MinhChungSuKien.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function showNopMinhChungThamGiaSK()
        {
            $title = "Nộp minh chứng";
            $render = __DIR__ . "/../Views/Student/uploadMinhChung.php";
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
            global $publicBase;
            $eventModel = new Event();

            $startWeekDate = date('Y-m-d', strtotime('monday this week'));
            $endWeekDate = date('Y-m-d', strtotime('sunday this week'));

            $currentDate = $startWeekDate;
            while(strtotime($currentDate) <= strtotime($endWeekDate)) {
                $dailyEvents = $eventModel->getSKDaDangKyByDay($_SESSION['UID'], $currentDate);
                $listEventWeek[] = [
                    'date' => $currentDate,
                    'eventsList' => $dailyEvents
                ];
                $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));

            }
            //$rawDataEvent = $eventModel->getSKDaDangKyByDayRange($_SESSION['UID'], $startWeekDate, $endWeekDate);
            $render = __DIR__ . "/../Views/Student/LichSuKien.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
    }

?>