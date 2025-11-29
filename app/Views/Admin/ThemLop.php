  <head>
    <link rel="stylesheet" href="assest/css/admin/themlop.css">
</head>
<div class="page-container">
  <div class="custom-card mb-5">
        <div class="card-toolbar mb-4">
            <div class="toolbar-title">
                <i class="bi bi-calendar-week me-2"></i>
                <span>
                    <?php 
                        if (isset($dataLop) && $dataLop != null) {
                            echo "SỬA LỚP";
                        } else {
                            echo "THÊM LỚP MỚI";
                        }
                    ?>
                </span>
            </div>
        </div>

        <form action="" class="grid grid-cols-1 md:grid-cols-2 gap-6" method="POST">
            <div class="input-form">
                <label class="block font-medium mb-2">Mã lớp</label>
                <input type="text" <?php echo isset($dataLop) ? 'readonly' : '' ?> name="MaLop" value="<?php echo isset($dataLop) ? $dataLop['MaLop'] : '' ?>" class="w-full  border rounded-lg" required>
            </div>
            <div class="input-form">
                <label class="block font-medium mb-2">Tên lớp</label>
                <input type="text" name="TenLop" value="<?php echo isset($dataLop) ? $dataLop['TenLop'] : '' ?>" class="w-full  border rounded-lg" required>
            </div>
            <div class="input-form">
                <label class="block font-medium mb-2">Chọn khoa</label>
                <select name="MaKhoa" id="selectKhoa" required>
                    <option selected disabled value="-1">=CHỌN KHOA=</option>   
                        <?php foreach($listKhoa as $khoa): ?>
                            <option value="<?php echo htmlspecialchars($khoa['MaKhoa']); ?>" <?php echo (isset($dataLop) && $dataLop['MaKhoa'] == $khoa['MaKhoa']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($khoa['TenKhoa']); ?></option>
                        <?php endforeach; ?>
                </select>
            </div>
            <div class="input-form">
                <label class="block font-medium mb-2">Chọn ngành:</label>
                <select name="MaNganh" id="selectNganh"  required>
                    <option selected disabled value="-1">=CHỌN NGÀNH=</option>   
                </select>
            </div>

            <div class="md:col-span-2 text-center mt-6">
                <button type="submit" class="btn btn-blue text-lg px-12 py-1"><?php echo isset($dataLop) ? "Cập nhật lớp" : "Thêm lớp" ?></button>
                <a href="Admin/CauHinh/Lop" class="btn btn-red text-lg px-12 py-1">HỦY</a>
            </div>
        </form>
    </div>
</div>
    <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const selectKhoa = document.getElementById("selectKhoa");
                        const selectNganh = document.getElementById("selectNganh");

                        const maKhoa = selectKhoa.value;              // giá trị khoa đang được chọn (nếu có)
                        const maNganhHienTai = selectNganh.getAttribute("data-selected"); 

                        if (!maKhoa || maKhoa === "0") return;


                        selectNganh.innerHTML = `<option disabled value="0">CHỌN NGÀNH  </option>`;

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

                    selectNganh.innerHTML = `<option disabled value="0">CHỌN NGÀNH</option>`;

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
