<head>
    <link rel="stylesheet" href="assest/css/student/dangkysukien.css">
</head>
<div class="event-register-page">

  <!-- SECTION: Sự kiện đang mở đăng ký -->
  <section class="section-card">
    <div class="section-card-header">
      <h2 class="section-card-title">Danh sách sự kiện đang mở đăng ký</h2>
    </div>

    <div class="section-card-body">
      <table class="event-table open-event-table">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên sự kiện</th>
            <th>Thời gian</th>
            <th>Phòng</th>
            <th>Chức năng</th>
          </tr>
        </thead>
        <tbody>
          <!-- Ví dụ mẫu, sau này thay bằng dữ liệu PHP -->
          <tr>
            <td>1</td>
            <td>Hội thảo Định hướng Nghề nghiệp cho Sinh viên QNU</td>
            <td>20/11/2025 08:00 - 10:00</td>
            <td>A1.101</td>
            <td>
              <a href="#" class="btn-link btn-register">Đăng ký</a>
              <a href="#" class="btn-link btn-detail">Xem chi tiết</a>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Talkshow Kỹ năng Thuyết trình</td>
            <td>22/11/2025 14:00 - 16:00</td>
            <td>B2.202</td>
            <td>
              <a href="#" class="btn-link btn-register">Đăng ký</a>
              <a href="#" class="btn-link btn-detail">Xem chi tiết</a>
            </td>
          </tr>
          <!-- /Hết ví dụ -->
        </tbody>
      </table>
    </div>
  </section>

  <!-- SECTION: Sự kiện đã đăng ký -->
  <section class="section-card">
    <div class="section-card-header">
      <h2 class="section-card-title">Sự kiện đã đăng ký</h2>
    </div>

    <div class="section-card-body">
      <table class="event-table registered-event-table">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên sự kiện</th>
            <th>Thời gian</th>
            <th>Phòng</th>
            <th>Chức năng</th>
          </tr>
        </thead>
        <tbody>
          <!-- Ví dụ mẫu: những sự kiện SV đã đăng ký -->
          <tr>
            <td>1</td>
            <td>Hội thảo Định hướng Nghề nghiệp cho Sinh viên QNU</td>
            <td>20/11/2025 08:00 - 10:00</td>
            <td>A1.101</td>
            <td>
              <a href="#" class="btn-link btn-cancel">Hủy đăng ký</a>
            </td>
          </tr>
          <!-- Sau này nếu không có sự kiện, có thể echo 1 dòng "Bạn chưa đăng ký sự kiện nào" -->
        </tbody>
      </table>
    </div>
  </section>

</div>
