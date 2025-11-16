<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sidebar Menu – Bootstrap 5</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --sidebar-width: 280px;
    }
    body { background:#f8f9fa; }
    .sidebar {
      width: var(--sidebar-width);
      max-height: 100vh;
      background: #fff;
    }
    .sidebar .section-title {
      font-weight: 600;
      color: #212529;
    }
    .sidebar .list-group-item {
      border: 0;
      border-radius: 0;
      padding: .75rem 1rem;
      color: #212529;
      background: transparent;
    }
    /* Active (đang chọn) */
    .sidebar .list-group-item.active {
      background: #0d6efd;
      color: #fff;
    }
    /* Nút mở/đóng nhóm */
    .sidebar .toggle {
      width: 100%;
      text-align: left;
      background: transparent;
      border: 0;
      padding: .75rem 1rem;
      display: flex;
      gap: .5rem;
      align-items: center;
      justify-content: space-between;
      color: #212529;
    }
    .toggle .label {
      display: inline-flex;
      gap: .5rem;
      align-items: center;
      font-weight: 600;
    }
    .toggle:focus { box-shadow: none; }
    .toggle[aria-expanded="true"] .chevron {
      transform: rotate(180deg);
    }
    .chevron {
      transition: transform .2s ease;
    }

    /* Submenu: thụt trái + vạch dọc */
    .submenu {
      margin-left: .5rem;
      border-left: 2px solid #e9ecef;
    }
    .submenu .list-group-item {
      padding-left: 1.25rem;
    }

    /* Responsive: biến thành offcanvas trên màn nhỏ */
    @media (max-width: 991.98px) {
      .sidebar { width: 100%; min-height: auto; }
    }
  </style>
</head>
<body>
    <!-- SIDEBAR -->
    <aside class="sidebar border-end">
      <div class="p-3 pb-2">
        <span class="section-title small text-secondary text-uppercase">Menu</span>
      </div>

      <div class="list-group list-group-flush">
        <a href="Student" class="list-group-item d-flex align-items-center gap-2">
          <i class="bi bi-house-door"></i> Tổng quan
        </a>
      <?php if($_SESSION['role']  < 2): ?>
        <div>
          <button class="toggle" data-bs-toggle="collapse" data-bs-target="#grpAccounts" aria-expanded="false">
            <span class="label"><i class="bi bi-calendar-event"></i> Sự kiện</span>
            <i class="bi bi-chevron-down chevron"></i>
          </button>
          <div id="grpAccounts" class="collapse submenu">
            <a class="list-group-item" href="Student/DangKySuKien">Đăng ký sự kiện</a>
            <a class="list-group-item" href="Student/LichSuKien">Lịch sự kiện</a>
            <a class="list-group-item" href="Student/NopMinhChungThamGiaSK">Nộp minh chứng</a>
          </div>
        </div>


        <div>
          <button class="toggle" data-bs-toggle="collapse" data-bs-target="#grpDRL" aria-expanded="false">
            <span class="label"><i class="bi bi-trophy"></i> Điểm rèn luyện</span>
            <i class="bi bi-chevron-down chevron"></i>
          </button>
          <div id="grpDRL" class="collapse submenu">
            <a class="list-group-item" href="Student/XemDiemRL">Xem điểm</a>
            <a class="list-group-item" href="Student/TuDanhGiaRL">Tự đánh giá rèn luyện</a>
          </div>
        </div>

        <?php if($_SESSION['role'] == 1): ?>
        <div>
          <button class="toggle" data-bs-toggle="collapse" data-bs-target="#grpSystem" aria-expanded="false">
            <span class="label"><i class="bi bi-gear"></i> Ban cán sự</span>
            <i class="bi bi-chevron-down chevron"></i>
          </button>
          <div id="grpSystem" class="collapse submenu">
            <a class="list-group-item" href="BCS/DuyetMinhChung">Duyệt minh chứng</a>
            <a class="list-group-item" href="BCS/DuyetPhieuRL">Duyệt phiếu tự đánh giá RL</a>

          </div>
        </div>
        <?php endif ?>
        <?php elseif($_SESSION['role'] == 2): ?>
        <!-- Quản lý sự kiện (mục đơn, đang active) -->
        <a href="Admin/QLSuKien" class="list-group-item d-flex align-items-center gap-2">
          <i class="bi bi-calendar-event"></i> Quản lý sự kiện
        </a>

        <!-- Quản lý tài khoản (nhóm) -->
        <div>
          <button class="toggle" data-bs-toggle="collapse" data-bs-target="#grpAccounts" aria-expanded="false">
            <span class="label"><i class="bi bi-people-gear"></i> Quản lý tài khoản</span>
            <i class="bi bi-chevron-down chevron"></i>
          </button>
          <div id="grpAccounts" class="collapse submenu">
            <a class="list-group-item" href="#">Quản lý tài khoản sinh viên</a>
            <a class="list-group-item" href="#">Quản lý tài khoản quản trị</a>
          </div>
        </div>

        <!-- Quản lý điểm rèn luyện (nhóm) -->
        <div>
          <button class="toggle" data-bs-toggle="collapse" data-bs-target="#grpDRL" aria-expanded="false">
            <span class="label"><i class="bi bi-trophy"></i> Quản lý điểm rèn luyện</span>
            <i class="bi bi-chevron-down chevron"></i>
          </button>
          <div id="grpDRL" class="collapse submenu">
            <a class="list-group-item" href="#">Kỷ luật/Khen thưởng</a>
            <a class="list-group-item" href="#">Cấu hình form tự đánh giá</a>
            <a class="list-group-item" href="#">Xuất danh sách điểm</a>
          </div>
        </div>

        <!-- Cấu hình hệ thống (nhóm) -->
        <div>
          <button class="toggle" data-bs-toggle="collapse" data-bs-target="#grpSystem" aria-expanded="false">
            <span class="label"><i class="bi bi-gear"></i> Cấu hình hệ thống</span>
            <i class="bi bi-chevron-down chevron"></i>
          </button>
          <div id="grpSystem" class="collapse submenu">
            <a class="list-group-item" href="#">Học kỳ</a>
            <a class="list-group-item" href="#">Khoa</a>
            <a class="list-group-item" href="#">Lớp</a>
            <a class="list-group-item" href="#">Phòng</a>
          </div>
        </div>

        <?php endif ?>
      </div>
    </aside>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
