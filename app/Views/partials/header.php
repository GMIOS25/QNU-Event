<header class="qnu-header">
  <div class="qnu-header-left">
    <img src="./assest/img/logo.webp" alt="Logo QNU" class="qnu-logo" />
    <div class="qnu-text">
      <p class="vn">TRƯỜNG ĐẠI HỌC QUY NHƠN</p>
      <p class="en">QUY NHON UNIVERSITY</p>
    </div>
  </div>
  <div class="qnu-header-right">
    <i class="fa fa-user-circle"></i>
    <div class="user-info">
        <span class="username"><?php echo $_SESSION['FullName']?></span>
        <span class="rolename"><?php 
          if ($_SESSION['role'] == 0)
            echo "Sinh viên";
          else if($_SESSION['role'] == 1)
            echo "Ban cán sự";
          else if($_SESSION['role'] == 2)
            echo "Admin";
          else
            echo "404";
        
    
        ?></span>
    </div>
  </div>
</header>
