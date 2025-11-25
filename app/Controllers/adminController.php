<?php 
    require_once __DIR__ . "/../Models/Event.php";
    require_once __DIR__ . "/../Models/Khoa.php";
    require_once __DIR__ . "/../Models/Term.php";
    class adminController
    {
        public function index()
        {
            $title = "Trang chủ";
            $render = __DIR__ . "/../Views/home.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function showQLSuKien($state = null, $search = null, $page = null, $limitElement = null)
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $eventModel = new Event();
            $numRows = 0;
            $listEventRaw = [];
            if(!is_null($search))
            {
                $numRows = $eventModel->getNumRows("Select * from SuKien where MaSK = '$search' or TenSK like '%$search%' ");
                $listEventRaw = $eventModel->getListEvent("Select * from sukien where MaSK = '$search' or TenSK like '%$search%' LIMIT ".$limitElement." OFFSET ".(($page*5) -$limitElement)."") ;
            }
            else if(!is_null($state))
            {
                if($state == 1)
                {
                    $numRows = $eventModel->getNumRows("SELECT * FROM sukien 
                        WHERE NOW() BETWEEN ThoiGianDongDK AND ThoiGianBatDauSK ORDER BY ThoiGianBatDauSK");
                    $listEventRaw = $eventModel->getListEvent("SELECT * FROM sukien 
                        WHERE NOW() BETWEEN ThoiGianDongDK AND ThoiGianBatDauSK ORDER BY ThoiGianBatDauSK DESC LIMIT ".$limitElement." OFFSET ".(($page*5) -$limitElement)."") ;
                }
                else if($state == 2)
                {
                    $numRows = $eventModel->getNumRows("SELECT * FROM sukien 
                        WHERE NOW() BETWEEN ThoiGianMoDK AND ThoiGianDongDK ORDER BY ThoiGianBatDauSK DESC");
                    $listEventRaw = $eventModel->getListEvent("SELECT * FROM sukien 
                        WHERE NOW() BETWEEN ThoiGianMoDK AND ThoiGianDongDK ORDER BY ThoiGianBatDauSK DESC LIMIT ".$limitElement." OFFSET ".(($page*5) -$limitElement)."") ;
                }
                else if($state == 3)
                {
                    $numRows = $eventModel->getNumRows("SELECT * FROM sukien 
                        WHERE NOW() > ThoiGianKetThucSK ORDER BY ThoiGianBatDauSK DESC ");
                    $listEventRaw = $eventModel->getListEvent("SELECT * FROM sukien 
                        WHERE NOW() > ThoiGianKetThucSK ORDER BY ThoiGianBatDauSK DESC LIMIT ".$limitElement." OFFSET ".(($page*5) -$limitElement)."") ;
                }
                else if($state == 4)
                {
                    $numRows = $eventModel->getNumRows("SELECT * FROM sukien 
                        WHERE NOW() BETWEEN ThoiGianBatDauSK AND ThoiGianKetThucSK ORDER BY ThoiGianBatDauSK DESC");
                    $listEventRaw = $eventModel->getListEvent("SELECT * FROM sukien 
                        WHERE NOW() BETWEEN ThoiGianBatDauSK AND ThoiGianKetThucSK ORDER BY ThoiGianBatDauSK DESC LIMIT ".$limitElement." OFFSET ".(($page*5) -$limitElement)."") ;
                }
                else if($state == 5)
                {
                    $numRows = $eventModel->getNumRows("SELECT * FROM sukien 
                        WHERE NOW() < ThoiGianMoDK ORDER BY ThoiGianBatDauSK DESC");
                    $listEventRaw = $eventModel->getListEvent("SELECT * FROM sukien 
                        WHERE NOW() < ThoiGianMoDK ORDER BY ThoiGianBatDauSK DESC LIMIT ".$limitElement." OFFSET ".(($page*5) -$limitElement)."") ;
                }
                else
                {
                    $numRows = $eventModel->getNumRows("Select * from SuKien");
                    $listEventRaw = $eventModel->getAllEvent($limitElement,$page);
                }

            }
            else
            {
                $numRows = $eventModel->getNumRows("Select * from SuKien");
                $listEventRaw = $eventModel->getAllEvent($limitElement, $page);
            }
            
            $listEvent = [];
            foreach ($listEventRaw as $eventRawData)    
            {
                $currentTime = time();

                $moDK = strtotime($eventRawData["ThoiGianMoDK"]);
                $dongDK = strtotime($eventRawData["ThoiGianDongDK"]);
                $batDau = strtotime($eventRawData["ThoiGianBatDauSK"]);
                $ketThuc = strtotime($eventRawData["ThoiGianKetThucSK"]);

                if ($currentTime >= $batDau && $currentTime <= $ketThuc) {
                    $descripState = "Đang diễn ra";
                } elseif ($currentTime > $ketThuc) {
                    $descripState = "Đã kết thúc";
                } elseif ($currentTime >= $moDK && $currentTime <= $dongDK) {
                    $descripState = "Đang mở đăng ký";
                } elseif ($currentTime < $moDK) {
                    $descripState = "Chưa mở đăng ký";
                } else {
                    // Sau khi đóng đăng ký nhưng chưa tới ngày diễn ra
                    $descripState = "Chờ diễn ra";
                }

                $listEvent[] = [
                    "MaSK" => $eventRawData["MaSK"],
                    "TenSK" => $eventRawData["TenSK"],
                    "TrangThai" => $descripState,
                    "NoiToChuc" => $eventRawData["NoiToChuc"]
                ];
            }
            $title = "Quản lý sự kiện";
            $render = __DIR__ . "/../Views/Admin/QLSuKien.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function showThemSuKien()
        {

            $khoaModel = new Khoa();
            $title = "Thêm sự kiện";
            $listKhoa = $khoaModel->getAll();
            $render = __DIR__ . "/../Views/Admin/ThemSuKien.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function submitThemSuKien()
        {
            // echo "test";
            // exit;
            // validate dữ liệu
            

            $eventModel = new Event();
            $message = $eventModel->addEvent(
                $_POST['txtTenSuKien'],
                $_POST['txtThoiGianMoDK'],
                $_POST['txtThoiGianDongDK'],
                $_POST['txtThoiGianBatDauSK'],
                $_POST['txtThoiGianKetThucSK'],
                $_POST['txtGioiHanSLSV'],
                $_POST['txtNoiToChuc'],
                $_POST['txtDiemCong'],
                $_POST['txtKhoaToChuc'],
                $_POST['txtGhiChu'],
                $_POST['listkhoathamgia']
            );

            if($message )
            {

                $_SESSION['message'] = "Thêm sự kiện thành công";
            }
            else
            {
                $_SESSION['message'] = "Thêm sự kiện thất bại";
            }
            global $publicBase;
            header("Location: ".$publicBase."/Admin/QLSuKien");
        }
        public function showQLChiTiet()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $eventModel = new Event();
            $title = "Quản lý chi tiết sự kiện";
            $dataEvent = $eventModel->getEvent($_GET['EventID']);
            $tenKhoaToChuc = $eventModel->getTenKhoaToChuc($_GET['EventID']);
            $stateEvent = $eventModel->getStateEvent($_GET['EventID']);
            $listKhoaThamGia = $eventModel->getDSTenKhoaDuocPhepThamGia($_GET['EventID']);
            $render = __DIR__ . "/../Views/Admin/QLChiTiet.php"; 
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function showSuaSuKien()
        {
            $khoaModel = new Khoa();
            $eventModel = new Event();
            $title = "Sửa sự kiện";
            $dataEvent = $eventModel->getEvent($_GET['EventID']);

            $dsKhoaThamGia = $eventModel->getDSTenKhoaDuocPhepThamGia($_GET['EventID']);
            $listKhoa = $khoaModel->getAll();
            $render = __DIR__ . "/../Views/Admin/ThemSuKien.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function submitSuaSuKien()
        {
            $eventModel = new Event();
            $message = $eventModel->modifyEvent( 
                $_POST['EventID'],               
                $_POST['txtTenSuKien'],
                $_POST['txtThoiGianMoDK'],
                $_POST['txtThoiGianDongDK'],
                $_POST['txtThoiGianBatDauSK'],
                $_POST['txtThoiGianKetThucSK'],
                $_POST['txtGioiHanSLSV'],
                $_POST['txtNoiToChuc'],
                $_POST['txtDiemCong'],
                $_POST['txtKhoaToChuc'],
                $_POST['txtGhiChu'],
                $_POST['listkhoathamgia']);
            if($message )
            {

                $_SESSION['message'] = "Sửa sự kiện thành công";
            }
            else
            {
                $_SESSION['message'] = "Sửa sự kiện thất bại";
            }
            global $publicBase; 
            header("Location: ".$publicBase."/Admin/QLSuKien/QLChiTiet?EventID=".$_POST['EventID']."");
        }
        public function showQuanLyHocKy()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $title = "Học kỳ";
                        $termModel = new Term();
            $semestersList = $termModel->getAllHK();
            $render = __DIR__ . "/../Views/Admin/QLHocKy.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function showThemHocKy()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }

            $title = "Thêm học kỳ";
            $render = __DIR__ . "/../Views/Admin/ThemHocKy.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function submitThemHocKy()
        {
            // validate dữ liệu
            $maHk = trim($_POST['MaHK']);
            $tenHk = trim($_POST['TenHK']);
            $thoigianbatdau = strtotime($_POST['ThoiGianBatDau']);
            $thoigianketthuc = strtotime($_POST['ThoiGianKetThuc']);
            if ($thoigianbatdau >= $thoigianketthuc) {
                $_SESSION['message'] = "Thời gian kết thúc phải sau thời gian bắt đầu";
                global $publicBase;
                header("Location: ".$publicBase."/Admin/CauHinh/HocKy/ThemHocKy");
                return;
            }
            $termModel = new Term();
            if($termModel->getHocKyById($maHk) != null) 
            {
                $_SESSION['message'] = "Mã học kỳ đã tồn tại";
                global $publicBase;
                header("Location: ".$publicBase."/Admin/CauHinh/HocKy/ThemHocKy");
                return;
            }
            if($termModel->checkTrungHocKy($maHk, $_POST['ThoiGianBatDau'], $_POST['ThoiGianKetThuc'])) 
            {
                $_SESSION['message'] = "Học kỳ trùng với học kỳ đã tồn tại";
                global $publicBase;
                header("Location: ".$publicBase."/Admin/CauHinh/HocKy/ThemHocKy");
                return;
            }
            $message = $termModel->addHocKy(
                $maHk,
                $tenHk,
                $_POST['ThoiGianBatDau'],
                $_POST['ThoiGianKetThuc']
            );
            if($message )
            {

                $_SESSION['message'] = "Thêm học kỳ thành công";
            }
            else
            {
                $_SESSION['message'] = "Thêm học kỳ thất bại";
            }
            global $publicBase;
            header("Location: ".$publicBase."/Admin/CauHinh/HocKy");
        }
        public function showSuaHocKy()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $termModel = new Term();
            $title = "Sửa học kỳ";
            $dataHocKy = $termModel->getHocKyById($_GET['TermID']);
            $render = __DIR__ . "/../Views/Admin/ThemHocKy.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function submitSuaHocKy()
        {
            
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            // validate dữ liệu
            $maHk = trim($_POST['MaHK']);
            $tenHk = trim($_POST['TenHK']);
            $thoigianbatdau = strtotime($_POST['ThoiGianBatDau']);
            $thoigianketthuc = strtotime($_POST['ThoiGianKetThuc']);
            if ($thoigianbatdau >= $thoigianketthuc) {
                $_SESSION['message'] = "Thời gian kết thúc phải sau thời gian bắt đầu";
                global $publicBase;
                header("Location: ".$publicBase."/Admin/CauHinh/HocKy/SuaHocKy?TermID=".$maHk."");
                return;
            }
            $termModel = new Term();
            if($termModel->checkTrungHocKy($maHk, $_POST['ThoiGianBatDau'], $_POST['ThoiGianKetThuc'])) 
            {
                $_SESSION['message'] = "Học kỳ trùng với học kỳ đã tồn tại";
                global $publicBase;
                header("Location: ".$publicBase."/Admin/CauHinh/HocKy/SuaHocKy?TermID=".$maHk."");
                return;
            }
            $message = $termModel->updateHocKy(
                $maHk,
                $tenHk,
                $_POST['ThoiGianBatDau'],
                $_POST['ThoiGianKetThuc']
            );
            if($message )
            {

                $_SESSION['message'] = "Sửa học kỳ thành công";
            }
            else
            {
                $_SESSION['message'] = "Sửa học kỳ thất bại";
            }
            global $publicBase;
            header("Location: ".$publicBase."/Admin/CauHinh/HocKy");
        }
        public function KetThucHocKy()  {
            $termModel = new Term();
            $message = $termModel->endHocKy($_GET['TermID']);
            if($message ) {
                $_SESSION['message'] = "Kết thúc học kỳ thành công";
            } else {
                $_SESSION['message'] = "Kết thúc học kỳ thất bại";
            }
            global $publicBase;
            header("Location: ".$publicBase."/Admin/CauHinh/HocKy");
        }
    }

?>