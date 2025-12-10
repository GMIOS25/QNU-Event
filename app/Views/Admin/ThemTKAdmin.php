<head>
    <link rel="stylesheet" href="assest/css/admin/themsinhvien.css">
</head>

<body>

    <div class="page-container">
        <h1 class="main-page-title"><?php echo (isset($adminData)) ? 'Sửa tài khoản admin' : 'Thêm tài khoản admin' ?></h1>

        <div class="custom-card">
            <div class="card-toolbar mb-4">
                <div class="toolbar-title">
                    <i class="bi bi-person-add me-2"></i>
                    <span><?php echo (isset($adminData)) ? 'Sửa tài khoản admin' : 'Nhập thông tin admin mới' ?></span>
                </div>
            </div>

            <form method="POST" action="">

                <div class="form-account-input">
                    <label class="block font-medium mb-2">Mã admin <span class="text-danger">*</span></label>
                    <input type="text" name="AdminID" required <?php echo (isset($adminData)) ? 'readonly' : '' ?> placeholder="Nhập mã số admin..." value="<?php echo (isset($adminData)) ? $adminData['AdminID'] : '' ?>">
                </div>

                <div class="form-group-row">
                    <div class="form-account-input">
                        <label class="block font-medium mb-2">Họ: <span class="text-danger">*</span></label>
                        <input type="text" name="Ho" required placeholder="Nhập họ..." value="<?php echo (isset($adminData)) ? $adminData['Ho'] : '' ?>">
                    </div>
                    <div class="form-account-input">
                        <label class="block font-medium mb-2">Tên:<span class="text-danger">*</span></label>
                        <input type="text" name="Ten" required placeholder="Nhập tên..." value="<?php echo (isset($adminData)) ? $adminData['Ten'] : '' ?>">
                    </div>
                </div>

                <?php if (!isset($adminData)): ?>
                    <div class="form-group-row">
                        <div class="form-account-input">
                            <label class="block font-medium mb-2"> Mật khẩu:  <span class="text-danger">*</span></label>
                            <input type="password" required name="MatKhau" placeholder="Nhập mật khẩu..">
                        </div>
                        <div class="form-account-input">
                            <label class="block font-medium mb-2"> Xác nhận mật khẩu: <span class="text-danger">*</span> </label>
                            <input type="password"  required name="XacNhanMatKhau" placeholder="Nhập lại mật khẩu..">
                        </div>
                    </div>
                
                <?php else: ?>
                    <a style="width: fit-content;" href="Admin/QuanLyTaiKhoanSV/ResetMatKhau?StudentID=<?php echo $adminData['MSSV'] ?>" class="btn btn-submit">Reset mật khẩu</a>
                <?php endif; ?>
                <div class="form-account-input">
                    <label class="block font-medium mb-2">Email: <span class="text-danger">*</span></label>
                    <input type="email" name="Email" required placeholder="Nhập email" value="<?php echo (isset($adminData)) ? $adminData['Email'] : '' ?>">
                </div>


                <div class="form-actions">
                    <button type="submit" class="btn btn-submit">
                        <i class="bi bi-save2 me-2"></i>Lưu
                    </button>
                    <a href="Admin/QuanLyTaiKhoanAdmin" class="btn btn-cancel">Hủy bỏ</a>
                </div>

            </form>
        </div>
    </div>
  
</body>

</html>
