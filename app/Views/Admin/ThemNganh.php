  <head>
    <link rel="stylesheet" href="assest/css/admin/themnganh.css">
</head>
<div class="page-container">
  <div class="custom-card mb-5">
        <div class="card-toolbar mb-4">
            <div class="toolbar-title">
                <i class="bi bi-calendar-week me-2"></i>
                <span>
                    <?php 
                        if (isset($dataNganh) && $dataNganh != null) {
                            echo "SỬA NGÀNH";
                        } else {
                            echo "THÊM NGÀNH MỚI";
                        }
                    ?>
                </span>
            </div>
        </div>

        <form action="" class="grid grid-cols-1 md:grid-cols-2 gap-6" method="POST">
            <div class="input-form">
                <label class="block font-medium mb-2">Mã ngành</label>
                <input type="text" <?php echo isset($dataNganh) ? 'readonly' : '' ?> name="MaNganh" value="<?php echo isset($dataNganh) ? $dataNganh['MaNganh'] : '' ?>" class="w-full  border rounded-lg" required>
            </div>
            <div class="input-form">
                <label class="block font-medium mb-2">Chọn khoa</label>
                <select name="MaKhoa">
                    <option selected disabled value="-1">=CHỌN KHOA=</option>   
                        <?php foreach($listKhoa as $khoa): ?>
                            <option value="<?php echo htmlspecialchars($khoa['MaKhoa']); ?>" <?php echo (isset($dataNganh) && $dataNganh['MaKhoa'] == $khoa['MaKhoa']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($khoa['TenKhoa']); ?></option>
                        <?php endforeach; ?>
                </select>
            </div>
            <div class="input-form">
                <label class="block font-medium mb-2">Tên ngành</label>
                <input type="text" name="TenNganh" value="<?php echo isset($dataNganh) ? $dataNganh['TenNganh'] : '' ?>" class="w-full  border rounded-lg" required>
            </div>

            <div class="md:col-span-2 text-center mt-6">
                <button type="submit" class="btn btn-blue text-lg px-12 py-1"><?php echo isset($dataNganh) ? "Cập nhật ngành" : "Thêm ngành" ?></button>
                <a href="Admin/CauHinh/Nganh" class="btn btn-red text-lg px-12 py-1">HỦY</a>
            </div>
        </form>
    </div>
</div>
