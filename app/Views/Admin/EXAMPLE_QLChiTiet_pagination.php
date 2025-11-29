<!-- 
    Example: Cập nhật QLChiTiet.php - Phần pagination
    
    Tìm đoạn code pagination cũ (dòng 238-247) và thay thế bằng:
-->

<!-- Pagination mới - Sử dụng component tái sử dụng -->
<?php 
if(isset($pagination)) {
    include __DIR__ . "/../partials/pagination.php";
}
?>

<!-- 
    Hoặc nếu muốn sử dụng render() method:
-->
<?php 
if(isset($pagination)) {
    echo $pagination->render();
}
?>
