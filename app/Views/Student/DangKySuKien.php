<head>
  <link rel="stylesheet" href="assest/css/student/dangkysukien.css">
</head>
<div class="page-container">
        
        <h1 class="main-page-title">ĐĂNG KÝ THAM GIA SỰ KIỆN</h1>

        <div class="custom-card mb-5">
            <div class="card-toolbar d-flex justify-content-between align-items-center mb-4">
                <div class="toolbar-title">
                    <i class="bi bi-grid-3x3-gap-fill me-2"></i>
                    <span>Đăng ký sự kiện</span>
                </div>
                <div class="search-wrapper position-relative">
                    <input type="text" class="form-control search-input" placeholder="Tìm kiếm ....">
                    <i class="bi bi-search search-icon"></i>
                </div>
            </div>
            <div class="warning-box">
                <i class="bi bi-exclamation-triangle-fill warning-icon"></i>
                <span class="warning-text">Sinh viên chịu tránh nhiệm với sự kiện mình đăng ký</span>
            </div>
            <div class="custom-table">
                <div class="table-header">
                    <div class="col-cell c-code">Mã SK</div>
                    <div class="col-cell c-name">Tên sự kiện</div>
                    <div class="col-cell c-time">Thời gian sự kiện</div>
                    <div class="col-cell c-time">Nơi tổ chức</div>
                    <div class="col-cell c-qty">Số lượng đăng ký</div>
                    <div class="col-cell c-action">Chức năng</div>
                </div>

                <div  class="table-body">
                    <!-- <div class="table-row">
                        <div class="col-cell c-code">4651050044</div>
                        <div class="col-cell c-name">Nguyễn Khánh Dương</div>
                        <div class="col-cell c-time">CNTT</div>
                        <div class="col-cell c-time">CNTT K46D</div>
                        <div class="col-cell c-qty">6/50</div>
                        <div class="col-cell c-action text-action-register">[Đăng ký]</div>
                    </div> -->
                    <?php 
                      foreach($listEvent as $event)
                      {
                          echo '
                              <div class="table-row">
                                <div class="col-cell c-code">'.$event['MaSK'].'</div>
                                <div class="col-cell c-name">'.$event['TenSK'].'</div>
                                <div class="col-cell c-time">'.$event['ThoiGianBatDauSK'].'-'.$event['ThoiGianKetThucSK'].'</div>
                                <div class="col-cell c-time">'.$event['NoiToChuc'].'</div>
                                <div class="col-cell c-qty">'.$event['SoLuongDK'].'</div>
                                <div class="col-cell c-action text-action-register"><a  onclick="return confirm(`Bạn chắc đăng ký sự kiện '.$event['TenSK'].'`);"  href="Student/DangKySuKien/DangKy?EventID='.$event['MaSK'].'">[Đăng ký]</a></div>
                            </div>
                          ';
                      }
                    ?>
                </div>
            </div>
        </div>

        <div class="custom-card">
            <div class="card-toolbar d-flex justify-content-between align-items-center mb-4">
                <div class="toolbar-title no-icon">
                    <span>Danh sách sự kiện đã đăng ký</span>
                </div>
                <div class="search-wrapper position-relative">
                    <input type="text" class="form-control search-input" placeholder="Tìm kiếm ....">
                    <i class="bi bi-search search-icon"></i>
                </div>
            </div>

            <div class="custom-table">
                <div class="table-header">
                    <div class="col-cell c-code">Mã SK</div>
                    <div class="col-cell c-name">Tên sự kiện</div>
                    <div class="col-cell c-time">Thời gian sự kiện</div>
                    <div class="col-cell c-time">Nơi tổ chức</div>
                    <div class="col-cell c-qty">Ghi chú</div>
                    <div class="col-cell c-action">Chức năng</div>
                </div>

                <div class="table-body">

                <?php foreach ($eventDaDKList as $event): ?>
                    <div class="table-row">
                        <div class="col-cell c-code"><?= $event['MaSK'] ?></div>
                        <div class="col-cell c-name"><?= $event['TenSK'] ?></div>
                        <div class="col-cell c-time"><?= $event['ThoiGianBatDauSK'] ?> - <?= $event['ThoiGianKetThucSK'] ?></div>
                        <div class="col-cell c-time"><?= $event['NoiToChuc'] ?></div>
                        <div class="col-cell c-qty"><?= $event['GhiChu'] ?></div>
                        <div class="col-cell c-action text-action-register">
                            <?php if(strtotime($event['ThoiGianDongDK']) > time()):  ?>
                            <a onclick="return confirm('Bạn chắc hủy đăng ký sự kiện <?= $event['TenSK'] ?>?');"
                            href="Student/DangKySuKien/HuyDangKy?EventID=<?= $event['MaSK'] ?>">
                            [Hủy đăng ký]
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                </div>
            </div>
        </div>

    </div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInputs = document.querySelectorAll(".search-input");

        searchInputs.forEach(input => {
            input.addEventListener("input", function () {
                const keyword = this.value.toLowerCase().trim();

                // card chứa ô search hiện tại
                const card = this.closest(".custom-card");
                if (!card) return;

                const rows = card.querySelectorAll(".table-body .table-row");

                rows.forEach(row => {
                    const rowText = row.innerText.toLowerCase();

                    row.style.display = rowText.includes(keyword) ? "" : "none";
                });
            });
        });
    });
</script>