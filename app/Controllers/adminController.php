<?php 
    require_once __DIR__ . "/../Models/Event.php";
    require_once __DIR__ . "/../Models/Khoa.php";
    require_once __DIR__ . "/../Models/Term.php";
    require_once __DIR__ . "/../Models/Nganh.php";
    require_once __DIR__ . "/../Models/Lop.php";
    require_once __DIR__ . "/../Models/User.php";

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
                        $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            if($_SESSION['currentTerm'] === null)
            {
                $_SESSION['message'] = "Chưa có học kỳ hiện tại, vui lòng thêm học kỳ trước khi tạo sự kiện";
                global $publicBase;
                header("Location: ".$publicBase."/Admin/QLSuKien");
                return;
            }
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
            $tenSuKien = trim($_POST['txtTenSuKien']);
            $thoiGianMoDK = trim($_POST['txtThoiGianMoDK']);
            $thoiGianDongDK = trim($_POST['txtThoiGianDongDK']);
            $thoiGianBatDauSK = trim($_POST['txtThoiGianBatDauSK']);
            $thoiGianKetThucSK = trim($_POST['txtThoiGianKetThucSK']);
            $gioiHanSLSV = trim($_POST['txtGioiHanSLSV']);
            $noiToChuc = trim($_POST['txtNoiToChuc']);
            $diemCong  = trim($_POST['txtDiemCong']);
            $khoaToChuc = trim($_POST['txtKhoaToChuc']);
            $ghiChu= trim($_POST['txtGhiChu']);
            $listKhoaThamGia  = $_POST['listkhoathamgia'];
            global $publicBase; 
            if(strtotime($thoiGianMoDK) >= strtotime($thoiGianDongDK))
            {
                $_SESSION['message'] = "Thời gian mở đăng ký không được nằm sau thời gian mở đăng ký nhé má";
                header("Location: ".$publicBase."/Admin/QLSuKien/ThemSuKien");
                return;
            }

            if(strtotime($thoiGianBatDauSK ) >= strtotime($thoiGianKetThucSK))
            {
                $_SESSION['message'] = "Thời gian kết thúc sự kiện không nằm trước thời gian bắt đầu sự kiện";
                header("Location: ".$publicBase."/Admin/QLSuKien/ThemSuKien");
                return;
            }

            if(
                strtotime($thoiGianMoDK) >= strtotime($thoiGianDongDK) || 
                strtotime($thoiGianDongDK) >= strtotime($thoiGianBatDauSK) ||
                strtotime($thoiGianBatDauSK) >= strtotime($thoiGianKetThucSK)
            )
            {
                $_SESSION['message'] = "Thời gian diễn ra phải nằm sau thời gian đăng ký và không được chồng lấn với thời gian ";
                header("Location: ".$publicBase."/Admin/QLSuKien/ThemSuKien");
                return;
            }

            $eventModel = new Event();
            $message = $eventModel->addEvent(
                $tenSuKien,
                $thoiGianMoDK,
                $thoiGianDongDK,
                $thoiGianBatDauSK,
                $thoiGianKetThucSK,
                $gioiHanSLSV,
                $noiToChuc,
                $diemCong,
                $khoaToChuc,
                $ghiChu,
                $listKhoaThamGia
            );
            $khoaModel = new Khoa();
            if($message )
            {

                $_SESSION['message'] = "Thêm sự kiện thành công";
            }
            else
            {
                $_SESSION['message'] = "Thêm sự kiện thất bại";
            }
            
            header("Location: ".$publicBase."/Admin/QLSuKien");;
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
        public function showQLChiTiet()
{
    require_once __DIR__ . "/../Helpers/PaginationHelper.php";
    
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
    
    // Pagination setup
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $itemsPerPage = 10; // Có thể thay đổi số lượng items mỗi trang
    $totalStudents = $eventModel->getRegisteredStudentsCount($_GET['EventID']);
    
    // Create pagination object
    $pagination = new PaginationHelper($totalStudents, $currentPage, $itemsPerPage, null, $_GET);
    
    // Get paginated students
    $listRegisteredStudents = $eventModel->getRegisteredStudentsWithPagination(
        $_GET['EventID'], 
        $pagination->getLimit(), 
        $pagination->getOffset()
    );
    
    $render = __DIR__ . "/../Views/Admin/QLChiTiet.php"; 
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
        public function showQuanLyKhoa($search = null)
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $title = "Khoa";
            $khoaModel = new Khoa();
            if(!is_null($search))
            {
                $listKhoa = $khoaModel->searchKhoa($search);
            }
            else
            {
                $listKhoa = $khoaModel->getAll();
            }
            $render = __DIR__ . "/../Views/Admin/QLKhoa.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        
        public function showQuanLyLop()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $title = "Lop";
            $lopModel = new Lop();
            $nganhModel = new Nganh();
            $khoaModel = new Khoa();
            $listKhoa = $khoaModel->getAll();
            //$listNganh = $nganhModel->getAllNganh();
            $listLop = [];
            if(isset($_GET['search']))
            {
                $listLop = $lopModel->searchLop(trim($_GET['search']));
            }
            else if(isset($_GET['KhoaID']) && $_GET['KhoaID'] != '0' && isset($_GET['NganhID']) && $_GET['NganhID'] != '0')
            {
                $listLop = $lopModel->filterByKhoaAndNganh(trim($_GET['KhoaID']), trim($_GET['NganhID']));
            }
            else if(isset($_GET['KhoaID']) && $_GET['KhoaID'] != '0')
            {
                $listLop = $lopModel->filterByMaKhoa(trim($_GET['KhoaID']));
            }
            else if(isset($_GET['NganhID']) && $_GET['NganhID'] != '0')
            {
                $listLop = $lopModel->filterByMaNganh(trim($_GET['NganhID']));
            }
            else
                $listLop = NULL;

            $listLop = $listLop ?? [];
            $render = __DIR__ . "/../Views/Admin/QLLop.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function showQuanLyNganh()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $title = "Ngành";
            $nganhModel = new Nganh();
            $listKhoa = (new Khoa())->getAll();
            if(isset($_GET['search']))
            {
                $listNganh = $nganhModel->searchNganh(trim($_GET['search']));
            }
            else if(isset($_GET['KhoaID']) && $_GET['KhoaID'] != '0')
            {
                $listNganh = $nganhModel->filterByMaKhoa(trim($_GET['KhoaID']));
            }
            else
                $listNganh = $nganhModel->getAllNganh();


            $render = __DIR__ . "/../Views/Admin/QLNganh.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function showThemKhoa()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $title = "Thêm Khoa";
            $render = __DIR__ . "/../Views/Admin/ThemKhoa.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function submitThemKhoa()
        {
            // validate dữ liệu
            $maKhoa = trim($_POST['MaKhoa']);  
            $tenKhoa = trim($_POST['TenKhoa']);
            $khoaModel = new Khoa();
            if($khoaModel->getKhoaByMaKhoa($maKhoa) != null) 
            {
                $_SESSION['message'] = "Mã khoa đã tồn tại";
                global $publicBase;
                header("Location: ".$publicBase."/Admin/CauHinh/Khoa/ThemKhoa");
                return;
            }
            $message = $khoaModel->insertKhoa(
                $maKhoa,
                $tenKhoa
            );
            if($message )
            {
                $_SESSION['message'] = "Thêm khoa thành công";
            }
            else
            {
                $_SESSION['message'] = "Thêm khoa thất bại";
            }
            global $publicBase;
            header("Location: ".$publicBase."/Admin/CauHinh/Khoa");
        }
        public function showSuaKhoa()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $khoaModel = new Khoa();
            $title = "Sửa Khoa";
            $dataKhoa = $khoaModel->getKhoaByMaKhoa($_GET['KhoaID']);
            $render = __DIR__ . "/../Views/Admin/ThemKhoa.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function submitSuaKhoa()
        {
            $maKhoa = trim($_POST['MaKhoa']);  
            $tenKhoa = trim($_POST['TenKhoa']);
            $khoaModel = new Khoa();
            $message = $khoaModel->updateKhoa(
                $maKhoa,
                $tenKhoa
            );
            if($message )
            {
                $_SESSION['message'] = "Cập nhật khoa thành công";
            }
            else
            {
                $_SESSION['message'] = "Cập nhật khoa thất bại";
            }
            global $publicBase;
            header("Location: ".$publicBase."/Admin/CauHinh/Khoa");
        }
        public function deleteKhoa()
        {
            $khoaModel = new Khoa();
            $message = $khoaModel->deleteKhoa($_GET['KhoaID']);
            if($message )
            {
                $_SESSION['message'] = "Xóa khoa thành công";
            }
            else
            {
                $_SESSION['message'] = "Xóa khoa thất bại";
            }
            global $publicBase;
            header("Location: ".$publicBase."/Admin/CauHinh/Khoa");
        }
        public function showThemNganh()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $title = "Thêm Ngành";
            $listKhoa = (new Khoa())->getAll();
            $render = __DIR__ . "/../Views/Admin/ThemNganh.php";
            include __DIR__ . "/../Views/layout.php" ;
        }

        public function submitThemNganh()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $nganhModel = new Nganh();
            $MaNganh = trim($_POST['MaNganh']);
            $TenNganh = trim($_POST['TenNganh']);
            
            if($nganhModel->getNganh($MaNganh) != null)
            {
                $_SESSION['message'] = "Mã ngành bị trùng";
                global $publicBase;
                header("Location: ".$publicBase."/Admin/CauHinh/Nganh");
            }
            
            $message = $nganhModel->insertNganh($MaNganh, $TenNganh, $_POST['MaKhoa']);

            if($message )
            {
                $_SESSION['message'] = "Thêm ngành thành công";
            }
            else
            {
                $_SESSION['message'] = "Thêm ngành thất bại";
            }
            global $publicBase;
            header("Location: ".$publicBase."/Admin/CauHinh/Nganh");

        }
        public function showSuaNganh()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $title = "Sửa Ngành";
            $nganhModel = new Nganh();
            $dataNganh = $nganhModel->getNganh($_GET['NganhID']);

            $listKhoa = (new Khoa())->getAll();
            $render = __DIR__ . "/../Views/Admin/ThemNganh.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function submitSuaNganh()
        {
                        $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $nganhModel = new Nganh();
            $MaNganh = trim($_POST['MaNganh']);
            $TenNganh = trim($_POST['TenNganh']);
            

            
            $message = $nganhModel->updateNganh($MaNganh, $TenNganh, $_POST['MaKhoa']);

            if($message )
            {
                $_SESSION['message'] = "Sửa ngành thành công";
            }
            else
            {
                $_SESSION['message'] = "Sửa ngành thất bại";
            }
            global $publicBase;
            header("Location: ".$publicBase."/Admin/CauHinh/Nganh");
        }
        public function deleteNganh()
        {
            $nganhModel = new Nganh();
            $message = $nganhModel->deleteNganh($_GET['NganhID']);
            if($message )
            {
                $_SESSION['message'] = "Xóa ngành thành công";
            }
            else
            {
                $_SESSION['message'] = "Xóa ngành thất bại";
            }
            global $publicBase;
            header("Location: ".$publicBase."/Admin/CauHinh/Nganh");
        }

        public function getDSNganhTheoKhoa()
        {
            $khoaID = $_GET['KhoaID'];
            $nganhModel = new Nganh();
            $listNganh = $nganhModel->filterByMaKhoa($khoaID);
            header('Content-Type: application/json');
            echo json_encode($listNganh);
        }
        public function showThemLop()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $title = "Thêm Lớp";
            $listKhoa = (new Khoa())->getAll();
            $render = __DIR__ . "/../Views/Admin/ThemLop.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function submitThemLop()
        {
            // validate dữ liệu
            $maLop = trim($_POST['MaLop']);  
            $tenLop = trim($_POST['TenLop']);
            $maNganh = trim($_POST['MaNganh']);
            $lopModel = new Lop();
            if($lopModel->getLop($maLop) != null) 
            {
                $_SESSION['message'] = "Mã lớp đã tồn tại";
                global $publicBase;
                header("Location: ".$publicBase."/Admin/CauHinh/Lop/ThemLop");
                return;
            }
            $message = $lopModel->insertLop(
                $maLop,
                $tenLop,
                $maNganh
            );
            if($message )
            {
                $_SESSION['message'] = "Thêm lớp thành công";
            }
            else
            {
                $_SESSION['message'] = "Thêm lớp thất bại";
            }
            global $publicBase;
            header("Location: ".$publicBase."/Admin/CauHinh/Lop");
        }
        public function showSuaLop()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $lopModel = new Lop();
            $title = "Sửa Lớp";
            $dataLop = $lopModel->getLop($_GET['LopID']);
            $listKhoa = (new Khoa())->getAll();
            $render = __DIR__ . "/../Views/Admin/ThemLop.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function submitSuaLop()
        {
            $maLop = trim($_POST['MaLop']);  
            $tenLop = trim($_POST['TenLop']);
            $maNganh = trim($_POST['MaNganh']);
            $lopModel = new Lop();
            $message = $lopModel->updateLop(
                $maLop,
                $tenLop,
                $maNganh
            );
            if($message )
            {
                $_SESSION['message'] = "Cập nhật lớp thành công";
            }
            else
            {
                $_SESSION['message'] = "Cập nhật lớp thất bại";
            }
            global $publicBase;
            header("Location: ".$publicBase."/Admin/CauHinh/Lop");
        }
        public function deleteLop()
        {
            $lopModel = new Lop();
            $message = $lopModel->deleteLop($_GET['LopID']);
            if($message )
            {
                $_SESSION['message'] = "Xóa lớp thành công";
            }
            else
            {
                $_SESSION['message'] = "Xóa lớp thất bại";
            }
            global $publicBase;
            header("Location: ".$publicBase."/Admin/CauHinh/Lop");
        }

        public function showQuanLyTaiKhoanSV()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $title = "Tài khoản sinh viên";
            $userModel = new User();
            $khoaModel = new Khoa();
            $listKhoa = $khoaModel->getAll();
            if(isset($_GET['LopID']) && $_GET['LopID'] != 0)
            {
                if(isset($_GET['RoleID']) && $_GET['RoleID'] != 0)
                {
                    $listSV = $userModel->filterByLopAndRole($_GET['RoleID']-1, $_GET['LopID']);
                }
                else
                {
                    $listSV = $userModel->filterByLop($_GET['LopID']);
                }
            }
            else if(isset($_GET['NganhID']) && $_GET['NganhID'] != 0)
            {
                if(isset($_GET['RoleID']) && $_GET['RoleID'] != 0)
                {
                    $listSV = $userModel->filterByNganhAndRole($_GET['RoleID']-1, $_GET['NganhID']);
                }
                else
                {
                    $listSV = $userModel->filterByNganh($_GET['NganhID']);
                }
            }
            else if(isset($_GET['KhoaID']) && $_GET['KhoaID'] != 0)
            {
                if(isset($_GET['RoleID']) && $_GET['RoleID'] != 0)
                {
                    $listSV = $userModel->filterByKhoaAndRole($_GET['RoleID']-1, $_GET['KhoaID']);
                }
                else
                {
                    $_SESSION['message'] = "Vui lòng chọn chi tiết hơn để lọc sinh viên";
                    global $publicBase;
                    header("Location: ".$publicBase."/Admin/QuanLyTaiKhoanSV");
                    return;
                }

            }
            else if(isset($_GET['search']))
            {
                $listSV =  $userModel->searchStudent(trim($_GET['search']));
            }

            $render = __DIR__ . "/../Views/Admin/QLTaiKhoanSV.php";
            include __DIR__ . "/../Views/layout.php" ;
        }

        public function apiGetDSLop()
        {
            $lopModel = new Lop();
            $listLop = $lopModel->filterByMaNganh($_GET['NganhID']);
            header('Content-Type: application/json');
            echo json_encode($listLop);
        }

        public function showThemSinhVien()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $title = "Thêm Sinh Viên";
            $dataKhoa = (new Khoa())->getAll();
            $render = __DIR__ . "/../Views/Admin/ThemTKSinhVien.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function submitThemSinhVien()
        {
            $userModel = new User();
            if($userModel->getStudentInfo(trim($_POST['MSSV'])) != null)
            {
                $_SESSION['message'] = "Mã số sinh viên đã tồn tại";
                global $publicBase;
                header("Location: ".$publicBase."/Admin/QuanLyTaiKhoanSV/ThemSinhVien");
                return;
            }
            if($userModel->getStudentByEmail(trim($_POST['MSSV']),trim($_POST['Email'])) != null)
            {
                $_SESSION['message'] = "Email đã tồn tại";
                global $publicBase;
                header("Location: ".$publicBase."/Admin/QuanLyTaiKhoanSV/ThemSinhVien");
                return;
            }
            if(trim($_POST['MatKhau']) != trim($_POST['XacNhanMatKhau']))
            {
                $_SESSION['message'] = "Mật khẩu và xác nhận mật khẩu không khớp";
                global $publicBase;
                header("Location: ".$publicBase."/Admin/QuanLyTaiKhoanSV/ThemSinhVien");
                return;
            }
            if(($_POST['isBanCanSu'] == 1 || $_POST['isBanCanSu'] == true) && count($_POST['listLopQuanLy']) == 0)
            {
                $_SESSION['message'] = "Ban cán sự phải có ít nhất 1 lớp quản lý";
                global $publicBase;
                header("Location: ".$publicBase."/Admin/QuanLyTaiKhoanSV/ThemSinhVien");
                return;
            }
            if(trim($_POST['MatKhau']) === "")
            {
                // set pass mặc định
                $_POST['MatKhau'] = $_POST['MSSV'];
                
            }
            $isBanCanSu = 0;
            if(isset($_POST['isBanCanSu']) && !is_null($_POST['isBanCanSu']))
            {
                if($_POST['isBanCanSu'] == 1)
                {
                    $isBanCanSu = 1;
                }
            }
            $message = $userModel->insertStudent(
                trim($_POST['MSSV']),
                trim($_POST['Ho']),
                trim($_POST['Ten']),
                trim($_POST['Email']),
                trim($_POST['MatKhau']),
                $isBanCanSu,
                trim($_POST['MaLop'])
            );

            if($message )
            {
                if($_POST['isBanCanSu'] == 1 || $_POST['isBanCanSu'] == true)
                {
                    $listLopQuanLy = $_POST['listLopQuanLy'];
                    foreach ($listLopQuanLy as $lop)
                    {
                        $mess = $userModel->addLopQuanLy(trim($_POST['MSSV']), $lop);
                        if(!$mess)
                        {
                             $_SESSION['message'] = "Thêm sinh viên thất bại";
                                global $publicBase;
                                 header("Location: ".$publicBase."/Admin/QuanLyTaiKhoanSV");
                                 return;
                        }
                    }
                }
                $_SESSION['message'] = "Thêm sinh viên thành công";
            }
            else
            {
                $_SESSION['message'] = "Thêm sinh viên thất bại";
            }
            global $publicBase;
            header("Location: ".$publicBase."/Admin/QuanLyTaiKhoanSV");
        }
        public function showModifyStudent()
        {
            $message = null;
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
            $title = "Sửa sinh viên";
            $dataKhoa = (new Khoa())->getAll();
            $userModel = new User();
            $studentData = $userModel->getStudentInfo(trim($_GET['StudentID']));
            $listLopQuanLy = [];
            if ($studentData && $studentData['isBanCanSu'] == '1') {
                $listLopQuanLy = $userModel->getLopQuanLy($studentData['MSSV']);
            }
            $render = __DIR__ . "/../Views/Admin/ThemTKSinhVien.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function submitModifyStudent()
        {
            $userModel = new User();

            if($userModel->getStudentByEmail($_POST['MSSV'] , trim($_POST['Email'])) != null)
            {
                $_SESSION['message'] = "Email đã tồn tại";
                global $publicBase;
                header("Location: ".$publicBase."/Admin/QuanLyTaiKhoanSV/ThemSinhVien");
                return;
            }

            if(($_POST['isBanCanSu'] == 1 || $_POST['isBanCanSu'] == true) && count($_POST['listLopQuanLy']) == 0)
            {
                $_SESSION['message'] = "Ban cán sự phải có ít nhất 1 lớp quản lý";
                global $publicBase;
                header("Location: ".$publicBase."/Admin/QuanLyTaiKhoanSV/ThemSinhVien");
                return;
            }
            $isBanCanSu = 0;
            if(isset($_POST['isBanCanSu']) && !is_null($_POST['isBanCanSu']))
            {
                if($_POST['isBanCanSu'] == 1)
                {
                    $isBanCanSu = 1;
                }
            }
            $message = $userModel->updateStudent(
                trim($_POST['MSSV']),
                trim($_POST['Ho']),
                trim($_POST['Ten']),
                trim($_POST['Email']),
                $isBanCanSu,
                trim($_POST['MaLop'])
            );

            if($message )
            {
                if($_POST['isBanCanSu'] == 1 || $_POST['isBanCanSu'] == true)
                {
                    $listLopQuanLy = $_POST['listLopQuanLy'];
                    $userModel->resetLopQuanLy(trim($_POST['MSSV']));
                    foreach ($listLopQuanLy as $lop)
                    {
                        $mess = $userModel->addLopQuanLy(trim($_POST['MSSV']), $lop);
                        if(!$mess)
                        {
                             $_SESSION['message'] = "Sửa sinh viên thất bại";
                                global $publicBase;
                                 header("Location: ".$publicBase."/Admin/QuanLyTaiKhoanSV");
                                 return;
                        }
                    }
                }
                $_SESSION['message'] = "Sửa sinh viên thành công";
            }
            else
            {
                $_SESSION['message'] = "Sửa sinh viên thất bại";
            }
            global $publicBase;
            header("Location: ".$publicBase."/Admin/QuanLyTaiKhoanSV");
        }
        public function resetStudentPassword()
        {
            $userModel = new User();
            $mess = $userModel->changePassword(trim($_GET['StudentID']), trim($_GET['StudentID']));
            if($mess)
            {
                $_SESSION['message'] = "Reset pass sinh viên thành công";
            }
            else
            {
                 $_SESSION['message'] = "Reset pass sinh viên thất bại";
            }
            global $publicBase;
            header("Location: ".$publicBase."/Admin/QuanLyTaiKhoanSV/SuaSinhVien?StudentID=".trim($_GET['StudentID']));
        }
        public function showAccountAdmin()
        {
            $title = "QL Tai khoan admin";
            $render = __DIR__ . "/../Views/Admin/QLTaiKhoanAdmin.php";
            require __DIR__ . "/../Views/layout.php";
        }

    }

?>

