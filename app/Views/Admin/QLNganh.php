<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="stylesheet" href="assest/css/admin/qlnganh.css">
</head>
<body>

    <div class="page-container">
        
        <h1 class="main-page-title">QUẢN LÝ NGÀNH</h1>

        <div class="custom-card">
            
            <div class="toolbar-container mb-4">
                
                <div class="toolbar-left">
                    <div class="toolbar-title">
                        <i class="bi bi-building-fill me-2"></i> <span>Danh sách ngành</span>
                    </div>
                </div>
                
                <div class="toolbar-right d-flex align-items-center gap-3">
                    <a <?php echo isset($_GET['search']) ? '' : 'style="display:none;"'; ?> href="Admin/CauHinh/Nganh">Hủy tìm kiếm</a>
                    <form action="" method="GET" class="search-wrapper position-relative">
                        <input type="search" name="search" class="form-control search-input" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>" placeholder="Tìm kiếm ngành...">
                        <i class="bi bi-search search-icon"></i>
                    </form>
                    
                    <a href="Admin/CauHinh/Nganh/ThemNganh" class="btn btn-primary btn-add">
                        <i class="bi bi-plus-circle me-2"></i>
                        Thêm ngành học
                    </a>
                </div>
            </div>
            <div class="select-box-container">
                    <label for="luaChon" class="form-label">Lọc ngành theo khoa:</label>
                    <select class="form-select" onchange="window.location.href = 'Admin/CauHinh/Nganh?KhoaID='+ this.value" id="luaChon" aria-label="Ví dụ chọn đáp án">
                        <option value="0">TẤT CẢ</option>
                        <?php foreach($listKhoa as $khoa): ?>
                            <option <?php echo (isset($_GET['KhoaID']) && $_GET['KhoaID'] == $khoa['MaKhoa']) ? 'selected' : ''; ?> value="<?php echo htmlspecialchars($khoa['MaKhoa']); ?>"><?php echo htmlspecialchars($khoa['TenKhoa']); ?></option>
                        <?php endforeach; ?>
                    </select>   
            </div>
            <div class="custom-table">
                <div class="table-header">
                    <div class="col-cell c-code">Mã ngành</div>
                    <div class="col-cell c-name">Tên ngành</div>
                    <div class="col-cell c-name-khoa">Tên khoa</div>
                    <div class="col-cell c-action">Chức năng</div>
                </div>
                
                <div class="table-body">
                    <?php foreach($listNganh as $nganh): ?>
                    <div class="table-row">
                        <div class="col-cell c-code"><?php echo htmlspecialchars($nganh['MaNganh']); ?></div>
                        <div class="col-cell c-name"><?php echo htmlspecialchars($nganh['TenNganh']); ?></div>
                        <div class="col-cell c-name-khoa"><?php echo htmlspecialchars($nganh['TenKhoa']); ?></div>
                        <div class="col-cell c-action">
                            <a href="Admin/CauHinh/Nganh/SuaNganh?NganhID=<?php echo htmlspecialchars($nganh['MaNganh']); ?>" class="btn-icon btn-edit" title="Sửa"><i class="bi bi-pencil-square"></i>Sửa </a>
                            <a onclick="return confirm('Bạn chắc chắn muốn xóa ngành này, mọi dữ liệu liên quan cũng sẽ bị xóa?')" href="Admin/CauHinh/Nganh/XoaNganh?NganhID=<?php echo htmlspecialchars($nganh['MaNganh']); ?>" class="btn-icon btn-delete"  title="Xóa"><i class="bi bi-trash"></i>Xóa</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                </div>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                <!-- <nav>
                    <ul class="pagination">
                        <li class="page-item disabled"><a class="page-link" href="#">&lt;</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">&gt;</a></li>
                    </ul>
                </nav> -->
            </div>

        </div>
    </div>

</body>
</html>