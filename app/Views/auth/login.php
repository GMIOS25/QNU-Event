<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <base href="<?php global $publicBase; echo $publicBase; ?>/" />
    <link rel="stylesheet" href="assest/css/auth/login.css" />
    <title>Đăng nhập - QNU Event</title>
</head>
<body>
    <div class="bg-wrap"></div>
    <div class="bg-frame"></div>

    <main class="center-wrap">
        <div class="login-card">
            <div class="logo-wrap">
                <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/11/Logo-Dai-hoc-Quy-Nhon-1.png" alt="QNU logo" onerror="this.style.display='none'" />
            </div>

            <h3 class="card-title">HỆ THỐNG QUẢN LÝ SỰ KIỆN</h3>

            <form class="login-form" action="" method="POST" autocomplete="off">
                <?php if(!empty($message)): ?>
                    <div class="form-message"><?php echo $message; ?></div>
                <?php endif; ?>

                <label for="txt_username">Mã sinh viên hoặc Email :</label>
                <input id="txt_username" type="text" name="txt_username" placeholder="Nhập tài khoản ..." required value="<?php echo isset($_POST['txt_username'])?htmlspecialchars($_POST['txt_username']):''; ?>" />

                <label for="txt_password">Mật khẩu :</label>
                <input id="txt_password" type="password" name="txt_password" placeholder="Nhập mật khẩu ..." required />

                <div class="form-row">
                    <label class="remember"><input type="checkbox" name="remember" /> Lưu đăng nhập</label>
                </div>

                <button type="submit" class="btn-submit">Đăng nhập</button>
            </form>
        </div>
    </main>
</body>
</html>