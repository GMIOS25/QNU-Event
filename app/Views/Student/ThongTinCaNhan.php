<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assest/css/Student/ThongTinCaNhan.css">
</head>

<body>
    <div class="container">
        <div class="information-student">
            <h1 class="title">Thông tin cá nhân</h1>

            <div class="wrap-text">
                <label for="masv">Mã sinh viên</label>
                <input disabled type="text" name="masv" id="masv">
            </div>

            <div class="wrap-text">
                <label for="hoten">Họ và tên</label>
                <input type="text" name="hoten" id="hoten">
            </div>

            <div class="wrap-text">
                <label for="lop">Lớp</label>
                <input type="text" name="lop" id="lop">
            </div>

            <div class="wrap-text">
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
            </div>

            <div class="wrap-text wrap-checkbox">
                <label for="bcs">Ban cán sự</label>
                <input type="checkbox" name="bcs" id="bcs">
            </div>

            <div class="wrap-button">
                <button type="button" class="btn btn-primary" id="btn-change-password">
                    Thay đổi mật khẩu
                </button>
            </div>
        </div>
    </div>

    <!-- POPUP ĐỔI MẬT KHẨU -->
    <div class="modal" id="changePasswordModal">
        <div class="modal-overlay"></div>
        <div class="modal-dialog">
            <h2>Thay đổi mật khẩu</h2>

            <div class="modal-body">
                <div class="form-group">
                    <label for="oldPassword">Mật khẩu cũ</label>
                    <input type="password" id="oldPassword" placeholder="Nhập mật khẩu cũ">
                </div>

                <div class="form-group">
                    <label for="newPassword">Mật khẩu mới</label>
                    <input type="password" id="newPassword" placeholder="Nhập mật khẩu mới">
                </div>

                <div class="form-group">
                    <label for="confirmPassword">Nhập lại mật khẩu mới</label>
                    <input type="password" id="confirmPassword" placeholder="Nhập lại mật khẩu mới">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btn-cancel">
                    Huỷ
                </button>
                <button type="button" class="btn btn-primary" id="btn-confirm">
                    Xác nhận
                </button>
            </div>
        </div>
    </div>

    <script>
        const btnOpen = document.getElementById('btn-change-password');
        const modal = document.getElementById('changePasswordModal');
        const btnCancel = document.getElementById('btn-cancel');
        const btnConfirm = document.getElementById('btn-confirm');
        const overlay = document.querySelector('#changePasswordModal .modal-overlay');

        function openModal() {
            modal.classList.add('show');
        }

        function closeModal() {
            modal.classList.remove('show');
        }

        btnOpen.addEventListener('click', openModal);
        btnCancel.addEventListener('click', closeModal);
        overlay.addEventListener('click', closeModal);

        // Sau này bạn xử lý validate / gọi API đổi mật khẩu trong btnConfirm
        btnConfirm.addEventListener('click', function () {
            // TODO: xử lý đổi mật khẩu
            alert('Xử lý đổi mật khẩu ở đây');
            closeModal();
        });
    </script>
</body>
