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
</body>
