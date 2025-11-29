<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="stylesheet" href="assest/css/admin/qltaikhoan.css">
</head>
<body>

    <div class="page-container">
        
        <h1 class="main-page-title">QUẢN LÝ SINH VIÊN</h1>

        <div class="custom-card">
            
            <div class="toolbar-container mb-4">
                
                <div class="toolbar-left">
                    <div class="toolbar-title">
                        <i class="bi bi-building-fill me-2"></i> <span>Danh sách tài khoản sinh viên</span>
                    </div>
                </div>
                
                <div class="toolbar-right d-flex align-items-center gap-3">
                    <a <?php echo isset($_GET['search']) ? '' : 'style="display:none;"'; ?> href="Admin/CauHinh/Nganh">Hủy tìm kiếm</a>
                    <form action="" method="GET" class="search-wrapper position-relative">
                        <input type="search" name="search" class="form-control search-input" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>" placeholder="Tìm kiếm sinh viên...">
                        <i class="bi bi-search search-icon"></i>
                    </form>
                    
                    <a href="Admin/CauHinh/QuanLyTaiKhoanSV/ThemSinhVien" class="btn btn-primary btn-add">
                        <i class="bi bi-plus-circle me-2"></i>
                        Thêm sinh viên
                    </a>
                </div>
            </div>
        <div class="info-box">
                <i class="bi bi-exclamation-triangle-fill info-icon"></i>
                <span class="info-text">
                 Vì lượng dữ liệu lớn, dữ liệu chỉ được hiển thị khi tiến hành lọc dữ liệu
                </span>
        </div>
            <label for="" class="form-label">Lọc sinh viên</label>
            <form method="GET" action="" class="select-box-group">
                <div class="select-box-container">
                    <label for="SelectKhoa" class="form-label">Khoa:</label>
                    <select class="form-select" name="KhoaID" id="SelectKhoa" onchange="" aria-label="Ví dụ chọn đáp án">
                        <option selected disabled value="0">TẤT CẢ</option>
                        <?php foreach($listKhoa as $khoa): ?>
                            <option <?php echo (isset($_GET['KhoaID']) && $_GET['KhoaID'] == $khoa['MaKhoa']) ? 'selected' : ''; ?> value="<?php echo htmlspecialchars($khoa['MaKhoa']); ?>"><?php echo htmlspecialchars($khoa['TenKhoa']); ?></option>
                        <?php endforeach; ?>
                    </select> 
                </div>
                  
                <div class="select-box-container">
                    <label for="SelectNganh" class="form-label">Ngành:</label>
                    <select class="form-select" name="NganhID" id="SelectNganh" onchange="" aria-label="Ví dụ chọn đáp án">
                        <option selected  value="0">TẤT CẢ</option>

                </select>   
                </div>
                <div class="select-box-container">
                    <label for="SelectLop" class="form-label">Lớp:</label>
                    <select class="form-select" name="LopID" id="SelectLop" onchange="" aria-label="Ví dụ chọn đáp án">
                        <option selected value="0">TẤT CẢ</option>
                </select>   
                </div>
                <button type="submit" class="btn btn-primary">Lọc dữ liệu</button>
            </form>
            <div class="custom-table">
                <div class="table-header">
                    <div class="col-cell c-code">Mã sinh viên</div>
                    <div class="col-cell c-ho">Họ</div>
                    <div class="col-cell c-ten">Tên</div>
                    <div class="col-cell c-lop">Lớp</div>
                    <div class="col-cell c-role">Vai trò</div>
                    <div class="col-cell c-action">Chức năng</div>
                </div>
                
                <div class="table-body">
                    <?php foreach($listSV as $sv): ?>
                        <div class="table-row">
                        <div class="col-cell c-code"><?php echo htmlspecialchars($sv['MSSV']); ?></div>
                        <div class="col-cell c-ho"><?php echo htmlspecialchars($sv['Ho']); ?></div>
                        <div class="col-cell c-ten"><?php echo htmlspecialchars($sv['Ten']); ?></div>
                        <div class="col-cell c-lop"><?php echo htmlspecialchars($sv['TenLop']); ?></div>
                        <div class="col-cell c-role"><?php echo ($sv['VaiTro']=='1')?'Ban cán sự':'Sinh viên'; ?></div>
                        <div class="col-cell c-action">
                            <a href="" class="btn-icon btn-edit" title="Sửa"><i class="bi bi-pencil-square"></i>Sửa </a>
                            <a onclick="return confirm('Bạn chắc chắn muốn xóa sinh viên này, mọi dữ liệu liên quan cũng sẽ bị xóa?')" href="" class="btn-icon btn-delete"  title="Xóa"><i class="bi bi-trash"></i>Xóa</a>
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
<script>
    document.querySelector('#SelectKhoa').addEventListener('change', function() {
        const khoaID = this.value;
        fetch(`api/Admin/GetDSNganhTheoKhoa?KhoaID=${khoaID}`)
            .then(response => response.json())
            .then(data => {
                const nganhSelect = document.querySelector('#SelectNganh');
                nganhSelect.innerHTML = '<option selected value="0">TẤT CẢ</option>';
                const lopSelect = document.querySelector('#SelectLop');
                lopSelect.innerHTML = '<option selected value="0">TẤT CẢ</option>';
                data.forEach(nganh => {
                    const option = document.createElement('option');
                    option.value = nganh.MaNganh;
                    option.textContent = nganh.TenNganh;
                    nganhSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Lỗi khi lấy danh sách ngành:', error));
    });

    document.querySelector('#SelectNganh').addEventListener('change', function() {
        const nganhID = this.value;
        fetch(`api/Admin/GetDSLopTheoNganh?NganhID=${nganhID}`)
            .then(response => response.json())
            .then(data => {
                const lopSelect = document.querySelector('#SelectLop');
                lopSelect.innerHTML = '<option selected value="0">TẤT CẢ</option>';
                data.forEach(lop => {
                    const option = document.createElement('option');
                    option.value = lop.MaLop;
                    option.textContent = lop.TenLop;
                    lopSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Lỗi khi lấy danh sách lớp:', error));
    });
</script>
</body>
</html>