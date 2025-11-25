<head>
    <link rel="stylesheet" href="./assest/css/student/home.css">
</head>
<div class="home-student-container">
  <!-- Tiêu đề hệ thống -->
  <header class="home-header">
    <h1 class="home-title">HỆ THỐNG QUẢN LÝ SỰ KIỆN QNU</h1>
  </header>
  <?php if($_SESSION['role'] < 2): ?>
  <!-- CARD: Truy cập nhanh -->
  <section class="home-section-card">
    <div class="home-section-header">
      <span class="home-section-icon"><i class="bi bi-three-dots-vertical"></i></span>
      <span class="home-section-title">Truy cập nhanh</span>
    </div>

    <div class="home-section-body">
      <div class="home-quick-grid">
        
        <a href="Student/DangKySuKien" class="home-quick-card">
          <div class="home-quick-icon"><i class="bi bi-pencil-square"></i></div>
          <div class="home-quick-title">Đăng ký sự kiện</div>
          <p class="home-quick-desc">
            Xem danh sách sự kiện đang mở và đăng ký tham gia.
          </p>
        </a>

        <!-- Lịch sự kiện -->
        <a href="Student/LichSuKien" class="home-quick-card">
          <div class="home-quick-icon"><i class="bi bi-calendar"></i></div>
          <div class="home-quick-title">Lịch sự kiện</div>
          <p class="home-quick-desc">
            Theo dõi lịch các sự kiện trong tuần\.
          </p>
        </a>

        <!-- Xem điểm -->
        <a href="Student/XemDiemRL" class="home-quick-card">
          <div class="home-quick-icon"><i class="bi bi-mortarboard"></i></div>
          <div class="home-quick-title">Xem điểm rèn luyện</div>
          <p class="home-quick-desc">
            Kiểm tra điểm rèn luyện tích lũy từ các sự kiện đã tham gia.
          </p>
        </a>
        
      </div>
    </div>

  </section>
   
  <?php else: ?>
  <!-- CARD: Truy cập nhanh -->
  <section class="home-section-card">
    <div class="home-section-header">
      <span class="home-section-icon"><i class="bi bi-three-dots-vertical"></i></span>
      <span class="home-section-title">Truy cập nhanh</span>
    </div>

    <div class="home-section-body">
      <div class="home-quick-grid">
        
        <a href="Admin/QLSuKien" class="home-quick-card">
          <div class="home-quick-icon"><i class="bi bi-calendar"></i></div>
          <div class="home-quick-title">Quản lý sự kiện</div>

        </a>

        <!-- Lịch sự kiện -->
        <a href="Admin/QLSuKien/ThemSuKien" class="home-quick-card">
          <div class="home-quick-icon"><i class="bi bi-calendar-plus"></i></div>
          <div class="home-quick-title">Thêm sự kiện</div>
        </a>

        <!-- Xem điểm -->
        <a href="Admin/QLDiem/KyLuatKhenThuong" class="home-quick-card">
          <div class="home-quick-icon"><i class="bi bi-file-earmark-plus-fill"></i></div>
          <div class="home-quick-title">Kỷ luật/Khen thưởng</div>
        </a>
        
      </div>
    </div>

  </section>
  <?php endif; ?>
    <section class="home-section-card">
    <div class="home-section-header">
        <span class="home-section-icon">📆</span>
        <span class="home-section-title">Thời gian hiện tại</span>
    </div>

    <div class="home-section-body">
            <h2 class="home-semester-title">
        <?php echo isset($_SESSION['currentTerm']) ? "Học kỳ hiện tại: " . $_SESSION['currentTerm']['TenHK'] : "Chưa cài đặt học kỳ hiện tại" ; ?>
      </h2>
        <div class="home-date-grid">
        <div class="home-stat-item">
            <div class="home-stat-number" id="day-number"><?php echo date('d') ?></div>
            <div class="home-stat-label">Ngày</div>
        </div>

        <div class="home-stat-item">
            <div class="home-stat-number" id="month-number"><?php echo date('m') ?> </div>
            <div class="home-stat-label">Tháng</div>
        </div>

        <div class="home-stat-item">
            <div class="home-stat-number" id="year-number"><?php echo date('Y')?> </div>
            <div class="home-stat-label">Năm</div>
        </div>
        </div>
    </div>
    </section>
</div>
