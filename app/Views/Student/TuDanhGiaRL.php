<!-- index.php -->
<?php
session_start();
$studentName = $_SESSION['FullName'] ?? '';
$studentId   = $_SESSION['StudentId'] ?? '';
$className   = $_SESSION['ClassName'] ?? '';

$listChiTieu = [
    ['MaChiTieu' => 1, 'NoiDung' => 'Thái độ học tập', 'DiemToiDa' => 10],
    ['MaChiTieu' => 2, 'NoiDung' => 'Tham gia hoạt động ngoại khóa', 'DiemToiDa' => 10],
    ['MaChiTieu' => 3, 'NoiDung' => 'Chấp hành nội quy', 'DiemToiDa' => 10],
]; // Đây là ví dụ, bạn có thể lấy từ database
$svDanhGia = $_POST['DanhGia'] ?? [];
$message = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = "Bạn đã gửi đánh giá rèn luyện thành công!";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tự đánh giá rèn luyện</title>

    <!-- CSS riêng cho form tự đánh giá -->
    <link rel="stylesheet" href="assest/css/bcs/TuDanhGiaRL.css">
</head>

<body>
<div class="page-container-tudg">
    <h1 class="main-page-title">ĐÁNH GIÁ RÈN LUYỆN SINH VIÊN</h1>

    <?php if($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <div class="custom-card-tudg">
        <form id="form-tuDG" method="POST" action="">
            <div class="form-group mb-3">
    <label class="form-label">Họ và tên</label>
    <input type="text" name="studentName" class="form-control" 
           value="<?= htmlspecialchars($studentName) ?>" readonly>
</div>
<div class="form-group mb-3">
    <label class="form-label">Mã sinh viên</label>
    <input type="text" name="studentId" class="form-control" 
           value="<?= htmlspecialchars($studentId) ?>" readonly>
</div>
<div class="form-group mb-3">
    <label class="form-label">Lớp</label>
    <input type="text" name="className" class="form-control" 
           value="<?= htmlspecialchars($className) ?>" readonly>
</div>

            <div class="table-tuDG mt-4">
                <div class="table-header">
                    <div class="col-cell c-stt">STT</div>
                    <div class="col-cell c-noi-dung">Nội dung đánh giá</div>
                    <div class="col-cell c-diem">Điểm tối đa</div>
                    <div class="col-cell c-danh-gia">Tự đánh giá</div>
                </div>

                <div class="table-body">
                    <?php foreach($listChiTieu as $index => $ct): ?>
                        <div class="table-row">
                            <div class="col-cell c-stt"><?= $index + 1 ?></div>
                            <div class="col-cell c-noi-dung"><?= htmlspecialchars($ct['NoiDung']) ?></div>
                            <div class="col-cell c-diem"><?= $ct['DiemToiDa'] ?></div>
                            <div class="col-cell c-danh-gia">
                                <input type="number" name="DanhGia[<?= $ct['MaChiTieu'] ?>]" 
                                       class="form-control input-danh-gia" min="0" max="<?= $ct['DiemToiDa'] ?>" required
                                       value="<?= isset($svDanhGia[$ct['MaChiTieu']]) ? $svDanhGia[$ct['MaChiTieu']] : '' ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="form-actions mt-4">
                <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                <button type="reset" class="btn btn-secondary">Hủy</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelector('form').addEventListener('submit', function(e){
        const inputs = document.querySelectorAll('.input-danh-gia');
        let valid = true;
        inputs.forEach(input => {
            const val = parseFloat(input.value);
            const min = parseFloat(input.min);
            const max = parseFloat(input.max);
            if(isNaN(val) || val < min || val > max){
                valid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });
        if(!valid){
            e.preventDefault();
            alert('Vui lòng nhập điểm hợp lệ cho tất cả tiêu chí.');
        }
    });
</script>
</body>
</html>
