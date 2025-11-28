<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa tài khoản sinh viên</title>
    <link rel="stylesheet" href="/assets/css/global-style.css">
</head>
<body>
<div class="page-container">
    <h1 class="main-page-title">SỬA TÀI KHOẢN SINH VIÊN</h1>

    <div class="custom-card">
        <div class="card-toolbar d-flex justify-content-between align-items-center mb-4">
            <div class="toolbar-title">
                <i class="bi bi-person-gear me-2"></i>
                <span>Danh sách sinh viên</span>
            </div>
            <div class="search-wrapper position-relative">
                <input type="text" id="searchStudent" class="form-control search-input" placeholder="Tìm kiếm MSSV hoặc tên...">
                <i class="bi bi-search search-icon"></i>
            </div>
        </div>

        <div class="custom-table">
            <div class="table-header">
                <div class="col-cell">MSSV</div>
                <div class="col-cell">Họ</div>
                <div class="col-cell">Tên</div>
                <div class="col-cell">Email</div>
                <div class="col-cell">Mã lớp</div>
                <div class="col-cell">Hành động</div>
            </div>

            <div class="table-body" id="studentTable">
                <?php if (empty($students)): ?>
                    <div class="table-row text-center">
                        <div class="col-cell" style="grid-column: 1 / -1; padding: 50px;">
                            Không có dữ liệu sinh viên
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach($students as $student): ?>
                        <div class="table-row">
                            <form method="POST" action="/admin/update-student">
                                <div class="col-cell">
                                    <input type="text" name="MSSV" value="<?= htmlspecialchars($student['MSSV']) ?>" readonly style="background:#f1f5f9;">
                                </div>
                                <div class="col-cell"><input type="text" name="Ho" value="<?= htmlspecialchars($student['Ho']) ?>" required></div>
                                <div class="col-cell"><input type="text" name="Ten" value="<?= htmlspecialchars($student['Ten']) ?>" required></div>
                                <div class="col-cell"><input type="email" name="Email" value="<?= htmlspecialchars($student['Email']) ?>" required></div>
                                <div class="col-cell"><input type="text" name="MaLop" value="<?= htmlspecialchars($student['MaLop']) ?>" required></div>
                                <div class="col-cell">
                                    <button type="submit" class="btn btn-blue">Lưu</button>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('searchStudent').addEventListener('input', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#studentTable .table-row');
    rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});
</script>
</body>
</html>