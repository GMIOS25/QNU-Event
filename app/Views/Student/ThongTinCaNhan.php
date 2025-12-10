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
    <!-- POPUP ĐỔI MẬT KHẨU -->
    <div class="modal" id="changePasswordModal">
        <div class="modal-overlay"></div>
        <div class="modal-dialog">
            <h2>Thay đổi mật khẩu</h2>

            <div class="modal-body">
                <div class="form-group">
                    <label for="oldPassword">Mật khẩu cũ</label>
                    <input type="password" id="oldPassword" placeholder="Nhập mật khẩu cũ">
                </div>

                <div class="form-group">
                    <label for="newPassword">Mật khẩu mới</label>
                    <input type="password" id="newPassword" placeholder="Nhập mật khẩu mới">
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Nhập lại mật khẩu mới</label>
                    <input type="password" id="confirmPassword" placeholder="Nhập lại mật khẩu mới">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btn-cancel">
                    Huỷ
                </button>
                <button type="button" class="btn btn-primary" id="btn-confirm">
                    Xác nhận
                </button>
            </div>
        </div>
    </div>
    <script src="javascript/ThongTinCaNhan.js"></script>
</body>
