<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm tài khoản sinh viên</title>
    <link rel="stylesheet" href="/assets/css/admin/themsinhvien.css">
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

        <form method="POST" action="/admin/add-student" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-medium mb-2">MSSV</label>
                <input type="text" name="MSSV" class="w-full p-4 border rounded-lg" required>
            </div>
            <div>
                <label class="block font-medium mb-2">Họ</label>
                <input type="text" name="Ho" class="w-full p-4 border rounded-lg" required>
            </div>
            <div>
                <label class="block font-medium mb-2">Tên</label>
                <input type="text" name="Ten" class="w-full p-4 border rounded-lg" required>
            </div>
            <div>
                <label class="block font-medium mb-2">Email</label>
                <input type="email" name="Email" class="w-full p-4 border rounded-lg" required>
            </div>
            <div>
                <label class="block font-medium mb-2">Mật khẩu</label>
                <input type="password" name="Password" class="w-full p-4 border rounded-lg" required>
            </div>
            <div>
                <label class="block font-medium mb-2">Mã lớp</label>
                <input type="text" name="MaLop" class="w-full p-4 border rounded-lg" required>
            </div>
            <div class="md:col-span-2 text-center mt-6">
                <button type="submit" class="btn btn-blue text-lg px-12 py-4">THÊM SINH VIÊN</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>