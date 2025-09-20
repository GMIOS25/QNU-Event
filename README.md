# QNU-Event
A project in QNU
%% Sơ đồ Use Case - Hệ thống Quản lý Sự kiện QNU
%% Actors: Sinh viên, Ban cán sự, Admin, Dịch vụ Email (external)
usecaseDiagram
actor SV as "Sinh viên"
actor BCS as "Ban cán sự"
actor AD as "Admin"
actor EMAIL as "Dịch vụ Email (ngoại hệ thống)"

rectangle "Hệ thống QNU" {
  (Đăng ký sự kiện) as UC_DK
  (Hủy đăng ký) as UC_HUY
  (Xem lịch sự kiện) as UC_LICH
  (Tải minh chứng ảnh) as UC_MINHCHUNG
  (Xem điểm rèn luyện) as UC_XEMDR
  (Nhận thông báo) as UC_NOTI

  (Xác minh tham gia) as UC_XACMINH
  (Duyệt/Điều chỉnh tự đánh giá DR) as UC_DUYETDR

  (Quản lý sự kiện) as UC_QLEVENT
  (Quản lý phòng/khoa/lớp) as UC_QLDM
  (Quản lý tài khoản & phân quyền) as UC_QLTK
  (Tính điểm rèn luyện cuối kỳ) as UC_TINHDR
  (Kỷ luật sinh viên) as UC_KYL
  (Xuất báo cáo/bảng điểm) as UC_BC

  (Kiểm tra ràng buộc đăng ký) as UC_RULES
  (Gửi email nhắc lịch) as UC_MAIL

  UC_DK --> UC_RULES : <<include>>
  UC_NOTI --> UC_MAIL : <<include>>
  UC_TINHDR --> (Tổng hợp tham gia & tự đánh giá) : <<include>>
  UC_TINHDR --> (Áp dụng kỷ luật (nếu có)) : <<include>>
}

SV --> UC_DK
SV --> UC_HUY
SV --> UC_LICH
SV --> UC_MINHCHUNG
SV --> UC_XEMDR
SV --> UC_NOTI

BCS --> UC_XACMINH
BCS --> UC_DUYETDR
BCS --> UC_LICH   %% BCS cũng xem lịch/chi tiết

AD --> UC_QLEVENT
AD --> UC_QLDM
AD --> UC_QLTK
AD --> UC_TINHDR
AD --> UC_KYL
AD --> UC_BC

EMAIL <-- UC_MAIL
