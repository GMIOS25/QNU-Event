<?php 
    class HomepageController
    {
        public function index()
        {
            $render = __DIR__ . "/../Views/homepage.php";
            include __DIR__ . "/../Views/layout.php" ;
        }
    }

?>