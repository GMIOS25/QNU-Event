<header class="qnu-header">
  <div class="qnu-header-left">
    <img src="./assest/img/logo.webp" alt="Logo QNU" class="qnu-logo" />
    <div class="qnu-text">
      <p class="vn">TRƯỜNG ĐẠI HỌC QUY NHƠN</p>
      <p class="en">QUY NHON UNIVERSITY</p>
    </div>
  </div>
  <div class="qnu-header-right dropdown">
    <div class="qnu-header-toggle dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" role="button" style="cursor: pointer;">
      <i class="fa fa-user-circle"></i>
      <div class="user-info">
        <span class="username"><?php echo $_SESSION['FullName']?></span>
        <span class="rolename">
          <?php 
            if ($_SESSION['role'] == 0)
              echo "Sinh viên";
            else if($_SESSION['role'] == 1)
              echo "Ban cán sự";
            else if($_SESSION['role'] == 2)
              echo "Admin";
            else
              echo "404";
          ?>
        </span>
      </div>
    </div> 
    

    <ul class="dropdown-menu dropdown-menu-end">
      <li><a class="dropdown-item" href="Student/ThongTinCaNhan">Thông tin cá nhân</a></li>
      <li><a class="dropdown-item" href="Auth/Logout">Đăng xuất</a></li>
    </ul>
  </div>
</header>
