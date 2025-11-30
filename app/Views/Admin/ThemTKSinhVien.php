
<head>
    <link rel="stylesheet" href="assest/css/admin/themsinhvien.css">
</head>
<body>

<div class="page-container">
    <h1 class="main-page-title">THÊM TÀI KHOẢN SINH VIÊN</h1>

    <div class="custom-card">
        <div class="card-toolbar mb-4">
            <div class="toolbar-title">
                <i class="bi bi-person-add me-2"></i>
                <span>Nhập thông tin sinh viên mới</span>
            </div>
        </div>

        <form method="POST" action="">
            
            <div class="form-account-input">
                <label class="block font-medium mb-2">MSSV <span class="text-danger">*</span></label>
                <input type="text" name="MSSV" required placeholder="Nhập mã số sinh viên...">
            </div>

            <div class="form-group-row">
                <div class="form-account-input">
                    <label class="block font-medium mb-2">Họ: <span class="text-danger">*</span></label>
                    <input type="text" name="Ho" required placeholder="Nhập họ...">
                </div>
                <div class="form-account-input">
                    <label class="block font-medium mb-2">Tên:<span class="text-danger">*</span></label>
                    <input type="text" name="Ten" required placeholder="Nhập tên...">
                </div>
            </div>

            <div class="form-group-row">
                <div class="form-account-input">
                    <label class="block font-medium mb-2">Khoa: <span class="text-danger">*</span></label>
                    <select name="KhoaID" id="SelectKhoa" class="form-select">
                        <option value="0" selected disabled>=CHỌN KHOA=</option>
                        <?php foreach ($dataKhoa as $khoa) : ?>
                            <option value="<?= $khoa['MaKhoa'] ?>"><?= $khoa['TenKhoa'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-account-input">
                    <label class="block font-medium mb-2">Ngành: <span class="text-danger">*</span></label>
                    <select name="NganhID" id="SelectNganh" class="form-select">
                        <option value="0" selected disabled>=CHỌN NGÀNH=</option>
                    </select>
                </div>
                <div class="form-account-input">
                    <label class="block font-medium mb-2">Lớp: <span class="text-danger">*</span></label>
                    <select name="MaLop" id="SelectLop" class="form-select">
                        <option value="0" selected disabled>=CHỌN LỚP=</option>
                    </select>
                </div>
            </div>
            <div class="form-group-row">    
                <div class="form-account-input">
                    <label class="block font-medium mb-2"> Mật khẩu(nếu cài mật khẩu mặc định thì để trống): </label>
                    <input type="password" name="MatKhau"   placeholder="Nhập mật khẩu..">
                </div>
                <div class="form-account-input">
                    <label class="block font-medium mb-2"> Xác nhận mật khẩu: </label>
                    <input type="password" name="XacNhanMatKhau" placeholder="Nhập lại mật khẩu..">
                </div>
            </div>
            <div class="form-account-input">
                <label class="block font-medium mb-2">Email: <span class="text-danger">*</span></label>
                <input type="email" name="Email" required placeholder="Nhập email">
            </div>

            <div class="form-account-input d-flex align-items-center mb-3">
                <input type="checkbox" name="isBanCanSu" value="1" id="isBanCanSu" class="me-2">
                <label for="isBanCanSu" class="mb-0 cursor-pointer">Là Ban cán sự lớp</label>
            </div>

            <div class="form-group-bcs mb-4">
                <label class="block font-medium mb-2">Lớp quản lý:</label>
                <div class="dept-item-wrapper">
                    <!-- <label class="dept-item">
                        <input type="checkbox" name="listLopQuanLy[]">
                        <span>CNTT 46A</span>
                        
                    </label> -->
                    </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-submit">
                    <i class="bi bi-save2 me-2"></i>Thêm sinh viên
                </button>
                <a href="Admin/QuanLyTaiKhoanSV" class="btn btn-cancel">Hủy bỏ</a>
            </div>

        </form>
    </div>
</div>
<script>
    document.getElementById('isBanCanSu').addEventListener('change', function() {
        var bcsSection = document.querySelector('.form-group-bcs');
        if(this.checked) {
            bcsSection.classList.add('bcs-show');
        } else {
            bcsSection.classList.remove('bcs-show');
        }
    });
            document.addEventListener("DOMContentLoaded", function() {
            const selectKhoa = document.getElementById("SelectKhoa");
            const selectNganh = document.getElementById("SelectNganh");
            const selectLop = document.getElementById("SelectLop");
            const maKhoa = selectKhoa.value; // giá trị khoa đang được chọn (nếu có)
            const maNganhHienTai = selectNganh.getAttribute("data-selected");
            const maLopHienTai = selectLop.getAttribute("data-selected");
            if (!maKhoa || maKhoa === "0") return;


            selectNganh.innerHTML = `<option value="0">=CHỌN NGÀNH=</option>`;

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
            fetch(`api/Admin/GetDSLopTheoNganh?NganhID=${maNganhHienTai}`)
                .then(response => response.json())
                .then(data => {
                    const lopSelect = document.querySelector('#SelectLop');
                    lopSelect.innerHTML = '<option selected value="0">=CHỌN LỚP=</option>';
                    data.forEach(lop => {
                        const option = document.createElement('option');
                        option.value = lop.MaLop;
                        option.textContent = lop.TenLop;
                        lopSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Lỗi khi lấy danh sách lớp:', error));
        });
        document.querySelector('#SelectKhoa').addEventListener('change', function() {
            const khoaID = this.value;
            fetch(`api/Admin/GetDSNganhTheoKhoa?KhoaID=${khoaID}`)
                .then(response => response.json())
                .then(data => {
                    const nganhSelect = document.querySelector('#SelectNganh');
                    nganhSelect.innerHTML = '<option selected value="0">=CHỌN NGÀNH=</option>';
                    const lopSelect = document.querySelector('#SelectLop');
                    lopSelect.innerHTML = '<option selected value="0">=CHỌN LỚP=</option>';
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
                    lopSelect.innerHTML = '<option selected value="0">=CHỌN LỚP=</option>';
                    data.forEach(lop => {
                        const option = document.createElement('option');
                        option.value = lop.MaLop;
                        option.textContent = lop.TenLop;
                        lopSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Lỗi khi lấy danh sách lớp:', error));
        });
document.querySelector('#SelectNganh').addEventListener('change', function () {

    const nganhID = this.value;
    const wrapper = document.querySelector('.dept-item-wrapper');

    // Clear trước
    wrapper.innerHTML = "";

    if (nganhID === "0") return;

    fetch(`api/Admin/GetDSLopTheoNganh?NganhID=${nganhID}`)
        .then(res => res.json())
        .then(data => {
            if (!data || data.length === 0) {
                wrapper.innerHTML = `<p>Không có lớp nào.</p>`;
                return;
            }

            data.forEach(lop => {
                // Tạo label .dept-item
                const item = document.createElement("label");
                item.className = "dept-item";

                item.innerHTML = `
                    <input type="checkbox" name="listLopQuanLy[]" value="${lop.MaLop}">
                    <span>${lop.TenLop}</span>
                `;

                wrapper.appendChild(item);
            });
        })
        .catch(err => {
            console.error("Lỗi:", err);
            wrapper.innerHTML = `<p style="color:red;">Tải dữ liệu lỗi.</p>`;
        });
});


                    
</script>
</body>
</html>