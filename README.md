# QNU-Event

Ứng dụng web PHP quản lý sự kiện và điểm rèn luyện cho sinh viên Trường Đại học Quy Nhơn. Hệ thống hỗ trợ ba vai trò (sinh viên, ban cán sự, quản trị viên) với các luồng đăng ký sự kiện, nộp minh chứng, duyệt minh chứng, tự đánh giá và cấu hình học kỳ.

## Chức năng chính
- **Sinh viên**: đăng nhập bằng MSSV hoặc email, đăng ký/hủy đăng ký sự kiện, xem lịch sự kiện được mở, nộp tệp minh chứng tham gia, xem điểm rèn luyện và thực hiện tự đánh giá theo đợt.【F:public/index.php†L37-L88】
- **Ban cán sự**: duyệt hoặc từ chối minh chứng tham gia sự kiện, xem danh sách minh chứng theo sự kiện và duyệt phiếu tự đánh giá điểm rèn luyện của lớp phụ trách.【F:public/index.php†L89-L111】
- **Quản trị viên**: quản lý sự kiện (thêm, sửa, tìm kiếm, phân trang, trạng thái), cấu hình học kỳ (tạo, sửa, kết thúc), và điều hướng hệ thống cho toàn bộ người dùng đã đăng nhập.【F:public/index.php†L112-L150】

## Kiến trúc mã nguồn
- `public/index.php`: điểm vào duy nhất, định tuyến yêu cầu tới các controller và kiểm tra phiên đăng nhập.
- `app/Controllers`: xử lý nghiệp vụ cho từng vai trò (`authController.php`, `studentController.php`, `bcsController.php`, `adminController.php`, `baseController.php`).
- `app/Models`: thao tác cơ sở dữ liệu (vd. `User.php` cho xác thực, `Event.php`, `Term.php`, ...).【F:app/Models/User.php†L1-L86】
- `app/Views`: template giao diện cho từng màn hình đăng nhập, quản lý và duyệt.
- `app/Configs/database.php`: cấu hình kết nối MySQL; chỉnh sửa để trỏ tới máy chủ của bạn.【F:app/Configs/database.php†L1-L31】

## Cài đặt nhanh
1. **Yêu cầu**: PHP 8.3+ và MySQL/MariaDB.
2. **Tạo cơ sở dữ liệu**: tạo database `qnuevent` rồi import dữ liệu mẫu từ `dbexport.sql` (chứa sẵn tài khoản và dữ liệu thử nghiệm). Dùng `qnuevent.sql` nếu bạn chỉ cần schema trống.【F:dbexport.sql†L1-L67】【F:qnuevent.sql†L1-L64】
3. **Cấu hình kết nối**: cập nhật `servername`, `username`, `password`, `dbname` trong `app/Configs/database.php` cho phù hợp môi trường của bạn.【F:app/Configs/database.php†L1-L31】
4. **Khởi động ứng dụng**: từ thư mục gốc, chạy `php -S localhost:8000 -t public` và truy cập `http://localhost:8000/Auth/Login` để đăng nhập.

## Tài khoản mẫu
- **Quản trị viên**: AdminID hoặc email `admin` / mật khẩu `admin` (có sẵn trong bản dump `dbexport.sql`).【F:dbexport.sql†L18-L46】
- **Sinh viên**: `sv` / mật khẩu `sv` (MSSV), hoặc `4651050044` / mật khẩu `18072005` cho tài khoản có MSSV thật trong dữ liệu mẫu.【F:dbexport.sql†L389-L404】
- **Ban cán sự**: `bcs` / mật khẩu `bcs` (gắn cờ ban cán sự để có quyền duyệt minh chứng).【F:dbexport.sql†L389-L404】

## Lưu ý triển khai
- Ứng dụng sử dụng session PHP để duy trì đăng nhập; đảm bảo bật session và thiết lập `BASE_PATH` đúng khi triển khai trên máy chủ web khác built-in server.
- Mọi request đều qua `public/index.php`; hãy cấu hình DocumentRoot trỏ vào thư mục `public` nếu dùng Apache/Nginx.
