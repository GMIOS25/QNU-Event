<head>
    <link rel="stylesheet" href="assest/css/admin/themsukien.css">
</head>
<div class="event-manage-container">

  <h1 class="event-manage-title">QUẢN LÝ SỰ KIỆN</h1>

  <div class="event-manage-card">
    <!-- Header -->
    <div class="event-card-header">
      <div class="event-card-header-left">
        <span class="icon-circle">
          <i class="bi bi-plus-lg"></i>
        </span>
        <span>Thêm sự kiện</span>
      </div>
      <a href="#" class="event-back-link">&gt; Quay lại</a>
    </div>

    <!-- Form -->
    <form class="event-form" method="POST">
      <!-- Tên sự kiện -->
      <div class="event-form-group">
        <label for="event-name">Tên sự kiện:</label>
        <input type="text" name="txtTenSuKien" id="event-name" placeholder="Nhập tên sự kiện ..." required/>
      </div>

      <!-- Thời gian sự kiện -->
      <div class="event-form-row">
        <div class="event-form-group">
          <label for="start-time">Thời gian bắt đầu sự kiện:</label>
          <div class="input-with-icon">
            <input name = "txtThoiGianBatDauSK" type="datetime-local" id="start-time" required />
             
          </div>
        </div>

        <div class="event-form-group">
          <label for="end-time">Thời gian kết thúc sự kiện:</label>
          <div class="input-with-icon">
            <input name="txtThoiGianKetThucSK" type="datetime-local" id="end-time"  required/>
             
          </div>
        </div>
      </div>

      <!-- Thời gian đăng ký -->
      <div class="event-form-row">
        <div class="event-form-group">
          <label for="reg-open">Thời gian mở đăng ký:</label>
          <div class="input-with-icon">
            <input name="txtThoiGianMoDK" type="datetime-local" id="reg-open" required />
          </div>
        </div>

        <div class="event-form-group">
          <label for="reg-close">Thời gian đóng đăng ký:</label>
          <div class="input-with-icon">
            <input   name="txtThoiGianDongDK" type="datetime-local" id="reg-close" required />
             
          </div>
        </div>
      </div>

      <!-- Nơi tổ chức + Loại sự kiện -->
      <div class="event-form-row">
        <div class="event-form-group">
          <label for="room">Nơi tổ chức:</label>
            <input  name="txtNoiToChuc" type="text" id="event-place" placeholder="Nhập nơi tổ chức"  required/>
        </div>


      <!-- Giới hạn số lượng -->
      <div class="event-form-group">
        <label for="limit">Giới hạn số lượng sinh viên đăng ký:</label>
        <input
         name="txtGioiHanSLSV"
          type="number"
          id="limit"
          min="0"
          placeholder="Nhập số lượng (nhập 0 để không giới hạn) ..." required
        />
      </div>
</div>
      <div class="event-form-group">
        <label for="limit">Số điểm cộng:</label>
        <input
             name="txtDiemCong"
          type="number"
          id="limit"
          min="0"
          placeholder="Nhập số điểm " required
        />
      </div>
        
      <div class="event-form-group">
        <label for="txtKhoaToChuc">Chọn khoa tổ chức:</label>
        <select name="txtKhoaToChuc" id="cars" require>
            <!-- <option value="volvo">Volvo</option> -->
            <?php 
                foreach ($listKhoa as $row)
                {
                    echo '<option value="'.$row['MaKhoa'].'">'.$row['TenKhoa'].'</option>';
                }
            ?>
        </select>
      </div>

            <!-- Khoa tham gia -->
        <div class="event-form-group">
        <label>Cho phép những khoa sau tham gia sự kiện:</label>
        <div class="department-box">
            <label class="dept-item">
            <input type="checkbox" id="check-all-departments"/>
            <span>Chọn tất cả các khoa</span>
            </label>

            <!-- <label class="dept-item">
            <input
                type="checkbox"
                name="listkhoathamgia[]"
                value="SP"
                class="dept-checkbox"
            />
            <span>Khoa sư phạm</span>
            </label> -->    
            <?php 
                foreach ($listKhoa as $row)
                {
                    echo '<label class="dept-item">
                        <input
                            type="checkbox"
                            name="listkhoathamgia[]"
                            value="'.$row['MaKhoa'].'"
                            class="dept-checkbox"
                        />
                        <span>'.$row['TenKhoa'].'</span>
                        </label>';
                        
                }
            ?>
        </div>
        </div>

      <!-- Ghi chú -->
      <div class="event-form-group">
        <label for="note">Ghi chú nhắc nhở:</label>
        <textarea
          id="note"
          rows="3"
          placeholder="Nhập ghi chú ..."
        ></textarea>
      </div>
      <!-- Actions -->
      <div class="event-form-actions">
        <button type="submit" class="btn-event-primary">
          <i class="bi bi-plus-circle"></i>
          <span>Thêm sự kiện</span>
        </button>
        <button type="button" class="btn-event-danger">
          <i class="bi bi-trash3"></i>
          <span>Hủy</span>
        </button>
      </div>
    </form>
  </div>
</div>
<script>
    // Đợi cho tất cả HTML được tải xong
document.addEventListener("DOMContentLoaded", function () {
  // Lấy ô "Chọn tất cả"
  const checkAll = document.getElementById("check-all-departments");

  // Lấy TẤT CẢ các ô checkbox của khoa
  const deptCheckboxes = document.querySelectorAll(".dept-checkbox");

  // Thêm sự kiện 'click' cho nút "Chọn tất cả"
  checkAll.addEventListener("click", function () {
    // Lấy trạng thái (đã check hay chưa) của nút "Chọn tất cả"
    const isChecked = checkAll.checked;

    // Duyệt qua từng ô checkbox của khoa
    deptCheckboxes.forEach(function (checkbox) {
      // Gán trạng thái của chúng bằng trạng thái của nút "Chọn tất cả"
      checkbox.checked = isChecked;
    });
  });
});
</script>