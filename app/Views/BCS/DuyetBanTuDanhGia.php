<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duyệt bản tự đánh giá rèn luyện</title>
    <link rel="stylesheet" href="/assets/css/global-style.css">
</head>
<body>
<div class="page-container">
    <h1 class="main-page-title">DUYỆT BẢN TỰ ĐÁNH GIÁ RÈN LUYỆN</h1>

    <div class="custom-card">
        <div class="card-toolbar d-flex justify-content-between align-items-center mb-4">
            <div class="toolbar-title">
                <i class="bi bi-file-earmark-check-fill me-2"></i>
                <span>Danh sách phiếu cần duyệt</span>
            </div>
            <div class="search-wrapper position-relative">
                <input type="text" id="searchEval" class="form-control search-input" placeholder="Tìm kiếm MSSV hoặc nội dung...">
                <i class="bi bi-search search-icon"></i>
            </div>
        </div>

        <div class="custom-table">
            <div class="table-header">
                <div class="col-cell">Mã phiếu</div>
                <div class="col-cell">MSSV</div>
                <div class="col-cell">Thời gian nộp</div>
                <div class="col-cell">Dữ liệu JSON</div>
                <div class="col-cell">Trạng thái</div>
                <div class="col-cell">Hành động</div>
            </div>

            <div class="table-body" id="evalTable">
                <?php if (empty($evaluations)) : ?>
                    <div class="table-row text-center">
                        <div class="col-cell" style="grid-column: 1 / -1; padding: 50px;">
                            Không có phiếu nào cần duyệt
                        </div>
                    </div>
                <?php else : ?>
                    <?php foreach($evaluations as $eval): ?>
                        <div class="table-row">
                            <div class="col-cell"><?= htmlspecialchars($eval['MaDot']) ?></div>
                            <div class="col-cell"><?= htmlspecialchars($eval['MSSV']) ?></div>
                            <div class="col-cell"><?= date('d/m/Y H:i', strtotime($eval['ThoiGianNop'])) ?></div>
                            <div class="col-cell"><pre><?= htmlspecialchars($eval['JSON_Data']) ?></pre></div>
                            <div class="col-cell">
                                <span class="badge bg-<?= $eval['TrangThai'] == 'Đã duyệt' ? 'green' : 'gray' ?>">
                                    <?= htmlspecialchars($eval['TrangThai']) ?>
                                </span>
                            </div>
                            <div class="col-cell">
                                <?php if ($eval['TrangThai'] == 'Chờ duyệt'): ?>
                                    <form method="POST" action="/bcs/duyet-phieu" style="display:inline;">
                                        <input type="hidden" name="MaDot" value="<?= $eval['MaDot'] ?>">
                                        <input type="hidden" name="MSSV" value="<?= $eval['MSSV'] ?>">
                                        <button type="submit" name="approve" class="btn btn-blue">Duyệt</button>
                                        <button type="submit" name="reject" class="btn-red">Từ chối</button>
                                    </form>
                                <?php else: ?>
                                    <span>Đã xử lý</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
// Tìm kiếm realtime
document.getElementById('searchEval').addEventListener('input', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#evalTable .table-row');
    rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});
</script>
</body>
</html>