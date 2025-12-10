<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    
    }
    
    require_once __DIR__ . "/../Models/Event.php";
    require_once __DIR__ . "/../Models/User.php";
    require_once __DIR__ . "/../Models/MinhChung.php";
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
            $soLuongDK = $eventModel->getRegisteredStudentsCount($_GET['EventID']);
            $limitDK = $eventModel->getEvent($_GET['EventID'])['GioiHanThamGia'];
            if($soLuongDK == $limitDK)
            {
                $_SESSION['message'] = "Vượt quá số lượng sinh viên cho phép tham gia!";
                
                header("Location: ".$publicBase."/Student/DangKySuKien");
                return;
            }
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
            $minhChungModel = new MinhChung();
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $title = "Minh chứng tham gia sự kiện ";
            $eventModel = new Event();
            $listSKMinhChung = $minhChungModel->loadSKCanNopMinhChung($_SESSION['UID']);
            $listMinhChungNop = $minhChungModel->getMinhChungDaNop($_SESSION['UID']);
            $render = __DIR__ . "/../Views/Student/MinhChungSuKien.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function showNopMinhChungThamGiaSK()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $title = "Nộp minh chứng";
            $render = __DIR__ . "/../Views/Student/uploadMinhChung.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function submitNopMinhChungThamGiaSK()
        {
            $minhChungModel = new MinhChung();
            global $publicBase;
            
            // Debug: Check if file was uploaded
            if(!isset($_FILES["imgMinhChung"]) || $_FILES["imgMinhChung"]["error"] !== UPLOAD_ERR_OK) {
                $_SESSION['message'] = "Lỗi upload file! Mã lỗi: " . (isset($_FILES["imgMinhChung"]) ? $_FILES["imgMinhChung"]["error"] : "File không tồn tại");
                header("Location: ".$publicBase."/Student/NopMinhChungThamGiaSK/NopMinhChung?EventID=".$_GET['EventID']);
                exit();
            }
            
            // Check if EventID exists
            if(!isset($_GET['EventID'])) {
                $_SESSION['message'] = "Thiếu mã sự kiện!";
                header("Location: ".$publicBase."/Student/NopMinhChungThamGiaSK");
                exit();
            }
            
            // Create directory if not exists
            $target_dir = __DIR__ . "/../../public/userdata/imgMinhChung/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            // Upload file
            $target_file = $target_dir . time() . "_" . basename($_FILES["imgMinhChung"]["name"]);
            $messageUpload = move_uploaded_file($_FILES["imgMinhChung"]["tmp_name"], $target_file);
            
            if(!$messageUpload) {
                $_SESSION['message'] = "Không thể lưu file! Kiểm tra quyền thư mục.";
                header("Location: ".$publicBase."/Student/NopMinhChungThamGiaSK/NopMinhChung?EventID=".$_GET['EventID']);
                exit();
            }
            
            // Save to database
            $relative_path = str_replace(__DIR__ . "/../../public/", "", $target_file);
            if($minhChungModel->NopMinhChung($_SESSION['UID'], $_GET['EventID'], $relative_path))
            {
                $_SESSION['message'] = "Nộp minh chứng thành công!";
                header("Location: ".$publicBase."/Student/NopMinhChungThamGiaSK");
                exit();
            }
            else
            {
                // Delete uploaded file if database insert fails
                if(file_exists($target_file)) {
                    unlink($target_file);
                }
                $_SESSION['message'] = "Lỗi lưu vào database!";
                header("Location: ".$publicBase."/Student/NopMinhChungThamGiaSK/NopMinhChung?EventID=".$_GET['EventID']);
                exit();
            }
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

            $message = null;

            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
                
            }

            
            $title = "Lịch sự kiện";
            global $publicBase;
            $eventModel = new Event();
            if(!isset($_GET['StartDate']) || !isset($_GET['EndDate']))
            {
                $startWeekDate = date('d-m-Y', strtotime('monday this week'));
                $endWeekDate = date('d-m-Y', strtotime('sunday this week'));
            }
            else 
            {
                $startWeekDate = trim($_GET['StartDate']);
                $endWeekDate = trim($_GET['EndDate']);
                // validate
            
                $start = strtotime($startWeekDate);
                $end   = strtotime($endWeekDate);
                
                global $publicBase;
                if (!$start || !$end) {
                    $_SESSION['message'] = "Ngày sai định dạng!";        
                    header("Location: ".$publicBase."/Student/LichSuKien");
                    return;
                }

                $diffDays = ($end - $start) / (60 * 60 * 24);
                
                if ($diffDays > 8) {
                    $_SESSION['message'] = "Tính làm quá tải database tao à???";
                    header("Location: ".$publicBase."/Student/LichSuKien");
                    return;
                }

                if ($end < $start) {
                    $_SESSION['message'] = "Ngày sai định dạng!";
                    header("Location: ".$publicBase."/Student/LichSuKien");
                    return;
                }
            }



            
            $currentDate = $startWeekDate;
            while(strtotime($currentDate) <= strtotime($endWeekDate)) {
                $dailyEvents = $eventModel->getSKDaDangKyByDay($_SESSION['UID'], date('Y-m-d', strtotime($currentDate)));
                $listEventWeek[] = [
                    'date' => $currentDate,
                    'eventsList' => $dailyEvents
                ];
                $currentDate = date('d-m-Y', strtotime($currentDate . ' +1 day'));

            }
            
            //$rawDataEvent = $eventModel->getSKDaDangKyByDayRange($_SESSION['UID'], $startWeekDate, $endWeekDate);
            $render = __DIR__ . "/../Views/Student/LichSuKien.php";
            
            include __DIR__ . "/../Views/layout.php" ;
            
        }
        public function showThongTinCaNhan()
        {
            $title = "Thông tin cá nhân";
            $userModel = new User();
            $student = $userModel->getStudentInfo($_SESSION['UID']);
            $render = __DIR__ . "/../Views/Student/ThongTinCaNhan.php";
            include __DIR__ . "/../Views/layout.php" ;
        }

        public function submitChangePassword()
        {
            // Đảm bảo response là JSON
            header('Content-Type: application/json');
            
            // Kiểm tra phương thức request
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                echo json_encode([
                    'success' => false,
                    'message' => 'Phương thức request không hợp lệ'
                ]);
                return;
            }

            // Kiểm tra người dùng đã đăng nhập
            if (!isset($_SESSION['UID'])) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Bạn cần đăng nhập để thực hiện chức năng này'
                ]);
                return;
            }

            // Lấy dữ liệu từ POST
            $currentPassword = isset($_POST['currentPassword']) ? trim($_POST['currentPassword']) : '';
            $newPassword = isset($_POST['newPassword']) ? trim($_POST['newPassword']) : '';
            $confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : '';

            // Validate dữ liệu đầu vào
            $errors = [];

            if (empty($currentPassword)) {
                $errors['currentPassword'] = 'Vui lòng nhập mật khẩu cũ';
            }

            if (empty($newPassword)) {
                $errors['newPassword'] = 'Vui lòng nhập mật khẩu mới';
            } elseif (strlen($newPassword) < 6) {
                $errors['newPassword'] = 'Mật khẩu mới phải có ít nhất 6 ký tự';
            }

            if (empty($confirmPassword)) {
                $errors['confirmPassword'] = 'Vui lòng xác nhận mật khẩu mới';
            } elseif ($newPassword !== $confirmPassword) {
                $errors['confirmPassword'] = 'Mật khẩu xác nhận không khớp';
            }

            if ($currentPassword === $newPassword && !empty($currentPassword)) {
                $errors['newPassword'] = 'Mật khẩu mới phải khác mật khẩu cũ';
            }

            // Nếu có lỗi validation, trả về lỗi
            if (!empty($errors)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Vui lòng kiểm tra lại thông tin',
                    'errors' => $errors
                ]);
                return;
            }

            // Xác thực mật khẩu cũ
            $userModel = new User();
            $MSSV = $_SESSION['UID'];

            if (!$userModel->verifyCurrentPassword($MSSV, $currentPassword)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Mật khẩu cũ không chính xác',
                    'errors' => [
                        'currentPassword' => 'Mật khẩu cũ không chính xác'
                    ]
                ]);
                return;
            }

            // Cập nhật mật khẩu
            if ($userModel->changePassword($MSSV, $newPassword)) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Đổi mật khẩu thành công!'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Có lỗi xảy ra khi cập nhật mật khẩu. Vui lòng thử lại!'
                ]);
            }
        }
    }

?>