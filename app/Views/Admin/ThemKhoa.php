  <head>
    <link rel="stylesheet" href="assest/css/admin/qlhocky.css">
</head>
<div class="page-container">
  <div class="custom-card mb-5">
        <div class="card-toolbar mb-4">
            <div class="toolbar-title">
                <i class="bi bi-calendar-week me-2"></i>
                <span>
                    <?php 
                        if (isset($dataKhoa) && $dataKhoa != null) {
                            echo "SỬA KHOA";
                        } else {
                            echo "THÊM KHOA MỚI";
                        }
                    ?>
                </span>
            </div>
        </div>
        <!-- <div class="warning-box">
                <i class="bi bi-exclamation-triangle-fill warning-icon"></i>
                <span class="warning-text">
                    Khi một học kỳ được thêm, học kỳ đó sẽ được sử dụng để phân loại các sự kiện và hoạt động trong hệ thống. Vui lòng đảm bảo rằng thông tin nhập vào là chính xác trước khi thêm học kỳ mới. <br>
                    Lưu ý: Mã học kỳ và thời gian không được trùng với các học kỳ đã tồn tại, không thể xóa học kỳ đã thêm mà chỉ có thể kết thúc chúng nếu học kỳ đang diễn ra.

                </span>
        </div> -->
        <form action="" class="grid grid-cols-1 md:grid-cols-2 gap-6" method="POST">
            <div>
                <label class="block font-medium mb-2">Mã khoa</label>
                <input type="text" <?php echo isset($dataKhoa) ? 'readonly' : '' ?> name="MaKhoa" value="<?php echo isset($dataKhoa) ? $dataKhoa['MaKhoa'] : '' ?>" class="w-full  border rounded-lg" required>
            </div>
            <div>
                <label class="block font-medium mb-2">Tên khoa</label>
                <input type="text" name="TenKhoa" value="<?php echo isset($dataKhoa) ? $dataKhoa['TenKhoa'] : '' ?>" class="w-full  border rounded-lg" required>
            </div>
            <div class="md:col-span-2 text-center mt-6">
                <button type="submit" class="btn btn-blue text-lg px-12 py-1"><?php echo isset($dataKhoa) ? "Cập nhật khoa" : "Thêm khoa" ?></button>
                <a href="Admin/CauHinh/Khoa" class="btn btn-red text-lg px-12 py-1">HỦY</a>
            </div>
        </form>
    </div>
</div>
