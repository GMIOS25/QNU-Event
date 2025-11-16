<?php 
    require_once __DIR__ . "/../Models/Event.php";
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
        public function showThemSuKien()
        {
            $title = "Thêm sự kiện";
            $render = __DIR__ . "/../Views/Admin/ThemSuKien.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
        public function submitThemSuKien()
        {
            $eventModel = new Event();
        }
    }

?>