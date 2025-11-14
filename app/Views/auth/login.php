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
    <main class="login-page">
        <section class="login-card">
            <div class="login-brand">
                <h1>QNU Event</h1>
                <p>Quản lý sự kiện - Trường Đại học</p>
            </div>

            <form class="login-form" action="" method="POST" autocomplete="off">
                <h2>Đăng nhập</h2>

                 <?php if(!empty($message)): ?>
                    <div class="form-message"><?php echo $message; ?></div>
                <?php endif; ?>

                <label for="txt_username">Mã sinh viên hoặc Email</label>
                <input id="txt_username" type="text" name="txt_username" required value="<?php echo isset($_POST['txt_username'])?htmlspecialchars($_POST['txt_username']):''; ?>" />

                <label for="txt_password">Mật khẩu</label>
                <input id="txt_password" type="password" name="txt_password" required />

                <div class="form-row">
                    <label class="remember"><input type="checkbox" name="remember" /> Ghi nhớ đăng nhập</label>
                    <a class="forgot" href="#">Quên mật khẩu?</a>
                </div>

                <button type="submit" class="btn-submit">Đăng nhập</button>

                <div class="signup-link">Bạn chưa có tài khoản? <a href="#">Đăng ký</a></div>
            </form>

            <aside class="login-aside">
                <div class="aside-content">
                    <h3>Chào mừng đến với QNU Event</h3>
                    <p>Quản lý đăng ký, minh chứng và điểm rèn luyện tín chỉ cho sinh viên.</p>
                </div>
            </aside>
        </section>
    </main>
</body>
</html>