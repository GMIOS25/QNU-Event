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
        public function showQLSuKien()
        {
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
                $_POST['txtGhiChu']
            );

            if($message)
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