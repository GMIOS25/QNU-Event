<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php global $publicBase; echo $publicBase; ?>/" />
</head>
<body>
    <form action="<?php  $_SERVER['PHP_SELF'] ?>" method="POST">
        <label for="txt_username">Tên đăng nhập</label>
        <input type="text" name="txt_username" required>
        <label for="txt_password">Mật khẩu</label>
        <input type="password" name="txt_password" required>
        <?php 
            if(isset($message))
            {
                echo $message;
            }
        ?>
        <button type="submit">Đăng nhập</button>
    </form>
</body>
</html>