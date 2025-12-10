<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assest/css/Student/ThongTinCaNhan.css">
</head>

<body>
    <div class="container">
        <div class="information-student">
            <h1 class="title">Thông tin cá nhân</h1>

            <div class="wrap-text">
                <label for="masv">Mã sinh viên</label>
                <input disabled type="text" name="masv" id="masv" value="<?php echo $student['MSSV'] ?>">
            </div>

            <div class="wrap-text">
                <label for="hoten">Họ và tên</label>
                <input disabled type="text" name="hoten" id="hoten" value="<?php echo $student['Ho']." ".$student['Ten'] ?>">
            </div>

            <div class="wrap-text">
                <label for="lop">Lớp</label>
                <input disabled type="text" name="lop" id="lop" value="<?php echo $student['TenLop'] ?>">
            </div>

            <div class="wrap-text">
                <label for="email">Email</label>
                <input disabled type="text" name="email" id="email" value="<?php echo $student['Email'] ?>">
            </div>

            <div class="wrap-text wrap-checkbox">
                <label for="bcs">Ban cán sự</label>
                <input disabled type="checkbox" name="bcs" id="bcs" <?php echo $student['isBanCanSu'] ? "checked" : "" ?>>
            </div>

            <div class="wrap-button">
                <button type="button" class="btn btn-primary" id="btn-change-password">
                    Thay đổi mật khẩu
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Đổi Mật Khẩu -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Thay đổi mật khẩu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="changePasswordForm">
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Mật khẩu cũ <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                            <div class="invalid-feedback" id="currentPasswordError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Mật khẩu mới <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required minlength="6">
                            <small class="form-text text-muted">Mật khẩu phải có ít nhất 6 ký tự</small>
                            <div class="invalid-feedback" id="newPasswordError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                            <div class="invalid-feedback" id="confirmPasswordError"></div>
                        </div>
                        <div class="alert alert-danger d-none" id="errorMessage" role="alert"></div>
                        <div class="alert alert-success d-none" id="successMessage" role="alert"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary" id="submitChangePassword">
                        <span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status" aria-hidden="true"></span>
                        Đổi mật khẩu
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="javascript/student/DoiMatKhau.js"></script>
</body>
