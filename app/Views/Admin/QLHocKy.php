
<head>
    <link rel="stylesheet" href="assest/css/admin/qlhocky.css">
</head>
<body>
<div class="page-container">
    <h1 class="main-page-title">QUẢN LÝ HỌC KỲ</h1>

 

    <div class="custom-card">
        <div class="card-toolbar d-flex justify-content-between align-items-center mb-4">
            <div class="toolbar-title no-icon">
                <span>Danh sách học kỳ</span>
            </div>
        <a href="Admin/CauHinh/HocKy/ThemHocKy" class="btn btn-blue text-lg px-12 py-2">THÊM HỌC KỲ</a>
        </div>

        <div class="custom-table">
            <div class="table-header">
                <div class="col-cell">Mã HK</div>
                <div class="col-cell">Tên HK</div>
                <div class="col-cell">Thời gian bắt đầu</div>
                <div class="col-cell">Thời gian kết thúc</div>
                <div class="col-cell">Hành động</div>
            </div>

            <div class="table-body" id="semesterTable">
                <?php if (empty($semestersList)): ?>
                    <div class="table-row text-center">
                        <div class="col-cell" >
                            Không có học kỳ nào
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach($semestersList as $semester): ?>
                        <div class="table-row">
                            <div class="col-cell"><?= htmlspecialchars($semester['MaHK']) ?></div>
                            <div class="col-cell"><?= htmlspecialchars($semester['TenHK']) ?></div>
                            <div class="col-cell"><?= date('d/m/Y ', strtotime($semester['ThoiGianBatDau'])) ?></div>
                            <div class="col-cell"><?= date('d/m/Y', strtotime($semester['ThoiGianKetThuc'])) ?></div>
                            <div class="col-cell">
                                <?php if(date('Y-m-d H:i:s') <= $semester['ThoiGianKetThuc'] ): ?>
                                <a href="Admin/CauHinh/HocKy/SuaHocKy?TermID=<?= $semester['MaHK'] ?>" class="btn btn-blue btn-sm">Sửa</a>
                                <?php endif; ?>
                                <?php if(date('Y-m-d H:i:s') >= $semester['ThoiGianBatDau'] && date('Y-m-d H:i:s') <= $semester['ThoiGianKetThuc'] ): ?>
                                <a href="Admin/CauHinh/HocKy/KetThucHocKy?TermID=<?= $semester['MaHK'] ?>" onclick="return confirm('Bạn chắc chắn muốn kết thúc học kỳ này?')" class="btn btn-red btn-sm">Kết thúc học kỳ</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


</body>
</html>