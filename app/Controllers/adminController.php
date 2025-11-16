<?php 
    require_once __DIR__ . "/../Models/Event.php";
    require_once __DIR__ . "/../Models/Khoa.php";
    class adminController
    {
        public function index()
        {
            $title = "Trang chủ";
            $render = __DIR__ . "/../Views/home.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function showQLSuKien($state = null, $search = null, $pageNumber = null)
        {
            $eventModel = new Event();
            $listEventRaw = [];
            if(!is_null($search))
            {
                $listEventRaw = $eventModel->getListEvent("Select * from sukien where MaSK = '$search' or TenSK like '%$search%'") ;
            }
            else if(!is_null($state))
            {
                if($state == 1)
                {
                    $listEventRaw = $eventModel->getListEvent("SELECT * FROM sukien 
                        WHERE NOW() BETWEEN ThoiGianDongDK AND ThoiGianBatDauSK") ;
                }
                else if($state == 2)
                {
                    $listEventRaw = $eventModel->getListEvent("SELECT * FROM sukien 
                        WHERE NOW() BETWEEN ThoiGianMoDK AND ThoiGianDongDK") ;
                }
                else if($state == 3)
                {
                    $listEventRaw = $eventModel->getListEvent("SELECT * FROM sukien 
                        WHERE NOW() > ThoiGianKetThucSK") ;
                }
                else if($state == 4)
                {
                    $listEventRaw = $eventModel->getListEvent("SELECT * FROM sukien 
                        WHERE NOW() BETWEEN ThoiGianBatDauSK AND ThoiGianKetThucSK") ;
                }
                else
                {
                    $listEventRaw = $eventModel->getAllEvent();
                }

            }
            else
            {
                $listEventRaw = $eventModel->getAllEvent();
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
                    $descripState = "Chờ diễn ra"; // hoặc đổi text khác tùy cậu
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
        public function showThemSuKien($message = null)
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

                $this->showThemSuKien("Thêm sự kiện thành công!");
            }
            else
            {
                $this->showThemSuKien("Thêm sự kiện thất bại!");
            }
        }
    }

?>