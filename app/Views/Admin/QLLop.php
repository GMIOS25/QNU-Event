<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="stylesheet" href="assest/css/admin/qllop.css">
</head>
<body>

    <div class="page-container">
        
        <h1 class="main-page-title">QUẢN LÝ LỚP</h1>

        <div class="custom-card">
            
            <div class="toolbar-container mb-4">
                
                <div class="toolbar-left">
                    <div class="toolbar-title">
                        <i class="bi bi-building-fill me-2"></i> <span>Danh sách lớp sinh viên</span>
                    </div>
                </div>
                
                <div class="toolbar-right d-flex align-items-center gap-3">
                    <a <?php echo isset($_GET['search']) ? '' : 'style="display:none;"'; ?> href="Admin/CauHinh/Lop">Hủy tìm kiếm</a>
                    <form action="" method="GET" class="search-wrapper position-relative">
                        <input type="search" name="search" class="form-control search-input" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>" placeholder="Tìm kiếm ngành...">
                        <i class="bi bi-search search-icon"></i>
                    </form>
                    
                    <a href="Admin/CauHinh/Lop/ThemLop" class="btn btn-primary btn-add">
                        <i class="bi bi-plus-circle me-2"></i>
                        Thêm lớp sinh viên
                    </a>
                </div>
            </div>
            <form class="group-select-filter">
                <div class="select-box-container">
                        <label for="luaChon" x class="form-label">Lọc lớp theo khoa:</label>
                        <select class="form-select" name="KhoaID" onchange="" id="selectKhoa" aria-label="Ví dụ chọn đáp án">
                            <option value="0" disabled selected>TẤT CẢ</option>
                            <?php foreach($listKhoa as $khoa): ?>
                                <option <?php echo (isset($_GET['KhoaID']) && $_GET['KhoaID'] == $khoa['MaKhoa']) ? 'selected' : ''; ?> value="<?php echo htmlspecialchars($khoa['MaKhoa']); ?>"><?php echo htmlspecialchars($khoa['TenKhoa']); ?></option>
                            <?php endforeach; ?>
                        </select>   
                </div>
                <div class="select-box-container">
                        <label for="luaChon" class="form-label">Lọc lớp theo ngành:</label>
                        <select class="form-select"   id="selectNganh" name="NganhID"
                                data-selected="<?php echo $_GET['NganhID'] ?? '0'; ?>">
                            <option value="0">TẤT CẢ</option>
                        </select>

                </div>
                <button type="submit" class="btn btn-primary">Lọc dữ liệu</button>
            </form>

        <div class="info-box">
                <i class="bi bi-exclamation-triangle-fill info-icon"></i>
                <span class="info-text">
                 Vì lượng dữ liệu lớn, dữ liệu chỉ được hiển thị khi tiến hành lọc dữ liệu
                </span>
        </div>
            <div class="custom-table">
                <div class="table-header">
                    <div class="col-cell c-code">Mã lớp</div>
                    <div class="col-cell c-name">Tên lớp</div>
                    <div class="col-cell c-name-khoa">Tên ngành</div>
                    <div class="col-cell c-action">Chức năng</div>
                </div>
                
                <div class="table-body">
                    <?php foreach($listLop as $lop): ?>
                    <div class="table-row">
                        <div class="col-cell c-code"><?php echo htmlspecialchars($lop['MaLop']); ?></div>
                        <div class="col-cell c-name"><?php echo htmlspecialchars($lop['TenLop']); ?></div>
                        <div class="col-cell c-name-khoa"><?php echo htmlspecialchars($lop['TenNganh']); ?></div>
                        <div class="col-cell c-action">
                            <a href="Admin/CauHinh/Lop/SuaLop?LopID=<?php echo htmlspecialchars($lop['MaLop']); ?>" class="btn-icon btn-edit" title="Sửa"><i class="bi bi-pencil-square"></i>Sửa </a>
                            <a onclick="return confirm('Bạn chắc chắn muốn xóa lớp này, mọi dữ liệu liên quan cũng sẽ bị xóa?')" href="Admin/CauHinh/Lop/XoaLop?LopID=<?php echo htmlspecialchars($lop['MaLop']); ?>" class="btn-icon btn-delete"  title="Xóa"><i class="bi bi-trash"></i>Xóa</a>
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
            <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const selectKhoa = document.getElementById("selectKhoa");
                        const selectNganh = document.getElementById("selectNganh");

                        const maKhoa = selectKhoa.value;              // giá trị khoa đang được chọn (nếu có)
                        const maNganhHienTai = selectNganh.getAttribute("data-selected"); 

                        if (!maKhoa || maKhoa === "0") return;


                        selectNganh.innerHTML = `<option value="0">TẤT CẢ</option>`;

                        fetch(`api/Admin/GetDSNganhTheoKhoa?KhoaID=${maKhoa}`)
                            .then(res => res.json())
                            .then(data => {
                                data.forEach(nganh => {
                                    const op = document.createElement("option");
                                    op.value = nganh.MaNganh;
                                    op.textContent = nganh.TenNganh;

                                    // chọn đúng ngành hiện tại nếu có
                                    if (maNganhHienTai && maNganhHienTai == nganh.MaNganh) {
                                        op.selected = true;
                                    }

                                    selectNganh.appendChild(op);
                                });
                            })
                            .catch(err => console.log(err));
                    });
                                    document.getElementById("selectKhoa").addEventListener("change", function () {
                    const maKhoa = this.value;
                    const selectNganh = document.getElementById("selectNganh");

                    selectNganh.innerHTML = `<option value="0">TẤT CẢ</option>`;

                    if (maKhoa === "0") return;

                    fetch(`api/Admin/GetDSNganhTheoKhoa?KhoaID=${maKhoa}`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(nganh => {
                                const op = document.createElement("option");
                                op.value = nganh.MaNganh;
                                op.textContent = nganh.TenNganh;
                                selectNganh.appendChild(op);
                            });
                        })
                        .catch(err => console.log(err));
                });

</script>