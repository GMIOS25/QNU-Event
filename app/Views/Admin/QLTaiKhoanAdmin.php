<!DOCTYPE html>
<html lang="vi">

<head>
    <link rel="stylesheet" href="assest/css/admin/qltaikhoan.css">
</head>

<body>

    <div class="page-container">

        <h1 class="main-page-title">QUẢN LÝ TÀI KHOẢN ADMIN</h1>

        <div class="custom-card">

            <div class="toolbar-container mb-4">

                <div class="toolbar-left">
                    <div class="toolbar-title">
                        <i class="bi bi-building-fill me-2"></i> <span>Danh sách tài khoản admin</span>
                    </div>
                </div>

                <div class="toolbar-right d-flex align-items-center gap-3">
                    <a <?php echo isset($_GET['search']) ? '' : 'style="display:none;"'; ?> href="Admin/QuanLyTaiKhoanAdmin">Hủy tìm kiếm</a>
                    <form action="" method="GET" class="search-wrapper position-relative">
                        <input type="search" name="search" class="form-control search-input" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>" placeholder="Tìm kiếm admin...">
                        <i class="bi bi-search search-icon"></i>
                    </form>

                    <a href="Admin/QuanLyTaiKhoanAdmin/ThemAdmin" class="btn btn-primary btn-add">
                        <i class="bi bi-plus-circle me-2"></i>
                        Thêm tài khoản amdin
                    </a>
                </div>
            </div>

            <div class="custom-table">
                <div class="table-header">
                    <div class="col-cell c-code">Mã tài khoản</div>
                    <div class="col-cell c-ho">Họ</div>
                    <div class="col-cell c-ten">Tên</div>
                    <div class="col-cell c-lop">Lớp</div>
                    <div class="col-cell c-action">Chức năng</div>
                </div>

                <div class="table-body">
                    <?php foreach ($listAdmin as $admin): ?>
                        <div class="table-row">
                            <div class="col-cell c-code"><?php echo htmlspecialchars($admin['AdminID']); ?></div>
                            <div class="col-cell c-ho"><?php echo htmlspecialchars($admin['Ho']); ?></div>
                            <div class="col-cell c-ten"><?php echo htmlspecialchars($admin['Ten']); ?></div>
                            <div class="col-cell c-lop"><?php echo htmlspecialchars($admin['Email']); ?></div>
    
                            <div class="col-cell c-action">
                                <a href="Admin/QuanLyTaiKhoanAdmin/SuaAdmin?AdminID=<?php echo $admin['AdminID'] ?>" class="btn-icon btn-edit" title="Sửa"><i class="bi bi-pencil-square"></i>Sửa </a>
                                <?php if($admin['AdminID'] != $_SESSION['UID']):  ?>
                                <a onclick="return confirm('Bạn chắc chắn muốn xóa ADMIN này, mọi dữ liệu liên quan cũng sẽ bị xóa?')" href="Admin/QuanLyTaiKhoanAdmin/XoaAdmin?AdminID=<?php echo $admin['AdminID'] ?>" class="btn-icon btn-delete" title="Xóa"><i class="bi bi-trash"></i>Xóa</a>
                                <?php endif ?>
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