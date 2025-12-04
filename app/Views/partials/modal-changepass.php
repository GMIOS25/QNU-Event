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
    <script src="assest/js/modal-popup.js"></script>