<head>
    <link rel="stylesheet" href="assest/css/admin/themsinhvien.css">
</head>

<body>

    <div class="page-container">
        <h1 class="main-page-title"><?php echo (isset($studentData)) ? 'Sửa tài khoản sinh viên' : 'Thêm tài khoản sinh viên' ?></h1>

        <div class="custom-card">
            <div class="card-toolbar mb-4">
                <div class="toolbar-title">
                    <i class="bi bi-person-add me-2"></i>
                    <span><?php echo (isset($studentData)) ? 'Sửa tài khoản sinh viên' : 'Nhập thông tin sinh viên mới' ?></span>
                </div>
            </div>

            <form method="POST" action="">

                <div class="form-account-input">
                    <label class="block font-medium mb-2">MSSV <span class="text-danger">*</span></label>
                    <input type="text" name="MSSV" required <?php echo (isset($studentData)) ? 'readonly' : '' ?> placeholder="Nhập mã số sinh viên..." value="<?php echo (isset($studentData)) ? $studentData['MSSV'] : '' ?>">
                </div>

                <div class="form-group-row">
                    <div class="form-account-input">
                        <label class="block font-medium mb-2">Họ: <span class="text-danger">*</span></label>
                        <input type="text" name="Ho" required placeholder="Nhập họ..." value="<?php echo (isset($studentData)) ? $studentData['Ho'] : '' ?>">
                    </div>
                    <div class="form-account-input">
                        <label class="block font-medium mb-2">Tên:<span class="text-danger">*</span></label>
                        <input type="text" name="Ten" required placeholder="Nhập tên..." value="<?php echo (isset($studentData)) ? $studentData['Ten'] : '' ?>">
                    </div>
                </div>

                <div class="form-group-row">
                    <div class="form-account-input">
                        <label class="block font-medium mb-2">Khoa: <span class="text-danger">*</span></label>
                        <select name="KhoaID" id="SelectKhoa" class="form-select" data-selected="<?php echo (isset($studentData)) ? $studentData['MaKhoa'] : '' ?>">

                            <option value="0" selected disabled>=CHỌN KHOA=</option>
                            <?php foreach ($dataKhoa as $khoa) : ?>
                                <option value="<?= $khoa['MaKhoa'] ?>"><?= $khoa['TenKhoa'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-account-input">
                        <label class="block font-medium mb-2">Ngành: <span class="text-danger">*</span></label>
                        <select name="NganhID" id="SelectNganh" class="form-select" data-selected="<?php echo (isset($studentData)) ? $studentData['MaNganh'] : '' ?>">
                            <option value="0" selected disabled>=CHỌN NGÀNH=</option>
                        </select>
                    </div>
                    <div class="form-account-input">
                        <label class="block font-medium mb-2">Lớp: <span class="text-danger">*</span></label>
                        <select name="MaLop" id="SelectLop" class="form-select" data-selected="<?php echo (isset($studentData)) ? $studentData['MaLop'] : '' ?>">
                            <option value="0" selected disabled>=CHỌN LỚP=</option>
                        </select>
                    </div>
                </div>
                <?php if (!isset($studentData)): ?>
                    <div class="form-group-row">
                        <div class="form-account-input">
                            <label class="block font-medium mb-2"> Mật khẩu(nếu cài mật khẩu mặc định thì để trống): </label>
                            <input type="password" name="MatKhau" placeholder="Nhập mật khẩu..">
                        </div>
                        <div class="form-account-input">
                            <label class="block font-medium mb-2"> Xác nhận mật khẩu: </label>
                            <input type="password" name="XacNhanMatKhau" placeholder="Nhập lại mật khẩu..">
                        </div>
                    </div>
                
                <?php else: ?>
                    <a style="width: fit-content;" href="Admin/QuanLyTaiKhoanSV/ResetMatKhau?StudentID=<?php echo $studentData['MSSV'] ?>" class="btn btn-submit">Reset mật khẩu</a>
                <?php endif; ?>
                <div class="form-account-input">
                    <label class="block font-medium mb-2">Email: <span class="text-danger">*</span></label>
                    <input type="email" name="Email" required placeholder="Nhập email" value="<?php echo (isset($studentData)) ? $studentData['Email'] : '' ?>">
                </div>

                <div class="form-account-input d-flex align-items-center mb-3">
                    <input type="checkbox" name="isBanCanSu" value="1" id="isBanCanSu" class="me-2" <?php echo (isset($studentData) && $studentData['isBanCanSu'] == '1') ? 'checked' : '' ?>>
                    <label for="isBanCanSu" class="mb-0 cursor-pointer">Là Ban cán sự lớp</label>
                </div>

                <div class="form-group-bcs mb-4 <?php echo (isset($studentData) && $studentData['isBanCanSu'] == '1') ? 'bcs-show' : '' ?>">
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
                        <i class="bi bi-save2 me-2"></i>Lưu
                    </button>
                    <a href="Admin/QuanLyTaiKhoanSV" class="btn btn-cancel">Hủy bỏ</a>
                </div>

            </form>
        </div>
    </div>
    <script>
        document.getElementById('isBanCanSu').addEventListener('change', function() {
            var bcsSection = document.querySelector('.form-group-bcs');
            if (this.checked) {
                bcsSection.classList.add('bcs-show');
            } else {
                bcsSection.classList.remove('bcs-show');
            }
        });
        document.addEventListener("DOMContentLoaded", () => {
            const selectKhoa = document.getElementById("SelectKhoa");
            const selectNganh = document.getElementById("SelectNganh");
            const selectLop = document.getElementById("SelectLop");

            const savedKhoa = selectKhoa.dataset.selected;
            const savedNganh = selectNganh.dataset.selected;
            const savedLop = selectLop.dataset.selected;
            const savedLopQuanLy = <?php echo isset($listLopQuanLy) ? json_encode($listLopQuanLy) : '[]'; ?>;

            function loadNganh(khoaID) {
                selectNganh.innerHTML = `<option disabled value="0">=CHỌN NGÀNH=</option>`;
                if (!khoaID || khoaID === "0") return Promise.resolve();
                return fetch(`api/Admin/GetDSNganhTheoKhoa?KhoaID=${khoaID}`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(nganh => {
                            const op = document.createElement("option");
                            op.value = nganh.MaNganh;
                            op.textContent = nganh.TenNganh;
                            if (savedNganh && savedNganh == nganh.MaNganh) op.selected = true;
                            selectNganh.appendChild(op);
                        });
                    });
            }

            function loadLop(nganhID) {
                selectLop.innerHTML = `<option disabled value="0">=CHỌN LỚP=</option>`;
                if (!nganhID || nganhID === "0") return Promise.resolve();
                return fetch(`api/Admin/GetDSLopTheoNganh?NganhID=${nganhID}`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(lop => {
                            const op = document.createElement("option");
                            op.value = lop.MaLop;
                            op.textContent = lop.TenLop;
                            if (savedLop && savedLop == lop.MaLop) op.selected = true;
                            selectLop.appendChild(op);
                        });
                    });
            }

            function loadLopQuanLy(nganhID) {
                const wrapper = document.querySelector('.dept-item-wrapper');
                wrapper.innerHTML = "";
                if (!nganhID || nganhID === "0") return;
                return fetch(`api/Admin/GetDSLopTheoNganh?NganhID=${nganhID}`)
                    .then(res => res.json())
                    .then(data => {

                        data.forEach(lop => {
                            const item = document.createElement("label");
                            item.className = "dept-item";
                            const checked = savedLopQuanLy.includes(lop.MaLop) ? "checked" : "";
                            item.innerHTML = `
                        <input type="checkbox" name="listLopQuanLy[]" value="${lop.MaLop}" ${checked}>
                        <span>${lop.TenLop}</span>`;
                            wrapper.appendChild(item);
                        });
                    });
            }

            if (savedKhoa) selectKhoa.value = savedKhoa;

            loadNganh(savedKhoa)
                .then(() => loadLop(savedNganh))
                .then(() => loadLopQuanLy(savedNganh));

            selectKhoa.addEventListener("change", () => {

                // Load ngành xong rồi mới xuống .then()
                loadNganh(selectKhoa.value).then(() => {

                    // Lấy ngành đầu tiên (loại bỏ option disabled)
                    const firstNganh = selectNganh.querySelector("option");

                    if (firstNganh) {
                        // Auto select ngành đầu tiên
                        selectNganh.value = firstNganh.value;

                        // Rồi mới load lớp theo ngành này
                        loadLop(firstNganh.value);

                        // Và load lớp quản lý nếu cần
                        loadLopQuanLy(firstNganh.value);
                    } else {
                        // Nếu khoa này không có ngành nào luôn
                        selectLop.innerHTML = `<option value="0" disabled>=CHỌN LỚP=</option>`;
                        document.querySelector('.dept-item-wrapper').innerHTML = "";
                    }
                });

            });


            selectNganh.addEventListener("change", () => {
                loadLop(selectNganh.value);
                loadLopQuanLy(selectNganh.value);
            });
        });


       
        // auto selected
        selectKhoa = document.getElementById("SelectKhoa");
        document.querySelectorAll("#SelectKhoa option").forEach(op => {
            if (op.value == selectKhoa.dataset.selected) {
                op.selected = true;
            }
        });
    </script>
</body>

</html>
