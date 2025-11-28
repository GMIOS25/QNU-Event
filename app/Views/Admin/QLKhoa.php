<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="stylesheet" href="assest/css/admin/qlkhoa.css">
</head>
<body>

    <div class="page-container">
        
        <h1 class="main-page-title">QUẢN LÝ KHOA</h1>

        <div class="custom-card">
            
            <div class="toolbar-container mb-4">
                
                <div class="toolbar-left">
                    <div class="toolbar-title">
                        <i class="bi bi-building-fill me-2"></i> <span>Danh sách khoa</span>
                    </div>
                </div>

                <div class="toolbar-right d-flex align-items-center gap-3">
                    <a <?php echo isset($_GET['search']) ? '' : 'style="display:none;"'; ?> href="Admin/CauHinh/Khoa">Hủy tìm kiếm</a>
                    <form action="" method="GET" class="search-wrapper position-relative">
                        <input value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>" type="search" name="search" class="form-control search-input" placeholder="Tìm kiếm tên khoa...">
                        <i class="bi bi-search search-icon"></i>
                    </form>
                    
                    <a href="Admin/CauHinh/Khoa/ThemKhoa" class="btn btn-primary btn-add">
                        <i class="bi bi-plus-circle me-2"></i>
                        Thêm khoa
                    </a>
                </div>
            </div>

            <div class="custom-table">
                <div class="table-header">
                    <div class="col-cell c-code">Mã khoa</div>
                    <div class="col-cell c-name">Tên khoa</div>
                    <div class="col-cell c-action">Chức năng</div>
                </div>
                
                <div class="table-body">
                    <?php foreach($listKhoa as $khoa): ?>
                    <div class="table-row">
                        <div class="col-cell c-code"><?php echo htmlspecialchars($khoa['MaKhoa']); ?></div>
                        <div class="col-cell c-name"><?php echo htmlspecialchars($khoa['TenKhoa']); ?></div>
                        <div class="col-cell c-action">
                            <a href="Admin/CauHinh/Khoa/SuaKhoa?KhoaID=<?php echo htmlspecialchars($khoa['MaKhoa']); ?>" class="btn-icon btn-edit" title="Sửa"><i class="bi bi-pencil-square"></i>Sửa </a>
                            <a onclick="return confirm('Bạn chắc chắn muốn xóa khoa này, mọi dữ liệu liên quan cũng sẽ bị xóa?')" href="Admin/CauHinh/Khoa/XoaKhoa?KhoaID=<?php echo htmlspecialchars($khoa['MaKhoa']); ?>" class="btn-icon btn-delete"  title="Xóa"><i class="bi bi-trash"></i>Xóa</a>
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