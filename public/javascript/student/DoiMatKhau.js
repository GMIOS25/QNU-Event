/**
 * DoiMatKhau.js - Xử lý chức năng đổi mật khẩu cho sinh viên
 */

document.addEventListener('DOMContentLoaded', function() {
    const btnChangePassword = document.getElementById('btn-change-password');
    const changePasswordModal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
    const changePasswordForm = document.getElementById('changePasswordForm');
    const submitBtn = document.getElementById('submitChangePassword');
    const submitSpinner = document.getElementById('submitSpinner');
    
    const currentPasswordInput = document.getElementById('currentPassword');
    const newPasswordInput = document.getElementById('newPassword');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    
    const errorMessage = document.getElementById('errorMessage');
    const successMessage = document.getElementById('successMessage');

    // Mở modal khi click nút "Thay đổi mật khẩu"
    if (btnChangePassword) {
        btnChangePassword.addEventListener('click', function() {
            // Reset form và messages khi mở modal
            changePasswordForm.reset();
            clearMessages();
            clearValidationErrors();
            changePasswordModal.show();
        });
    }

    // Xử lý submit form
    if (submitBtn) {
        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Clear previous messages
            clearMessages();
            clearValidationErrors();
            
            // Validate form
            if (!validateForm()) {
                return;
            }
            
            // Disable button và hiển thị spinner
            submitBtn.disabled = true;
            submitSpinner.classList.remove('d-none');
            
            // Lấy dữ liệu từ form
            const formData = new FormData();
            formData.append('currentPassword', currentPasswordInput.value);
            formData.append('newPassword', newPasswordInput.value);
            formData.append('confirmPassword', confirmPasswordInput.value);
            
            // Gửi request đến backend
            fetch('Student/ThongTinCaNhan/DoiMatKhau', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                submitBtn.disabled = false;
                submitSpinner.classList.add('d-none');
                
                if (data.success) {
                    // Hiển thị thông báo thành công
                    showSuccess(data.message || 'Đổi mật khẩu thành công!');
                    
                    // Reset form
                    changePasswordForm.reset();
                    
                    // Đóng modal sau 2 giây
                    setTimeout(() => {
                        changePasswordModal.hide();
                        clearMessages();
                    }, 2000);
                } else {
                    // Hiển thị thông báo lỗi
                    showError(data.message || 'Có lỗi xảy ra, vui lòng thử lại!');
                    
                    // Nếu có lỗi cụ thể cho từng field
                    if (data.errors) {
                        if (data.errors.currentPassword) {
                            showFieldError('currentPassword', data.errors.currentPassword);
                        }
                        if (data.errors.newPassword) {
                            showFieldError('newPassword', data.errors.newPassword);
                        }
                        if (data.errors.confirmPassword) {
                            showFieldError('confirmPassword', data.errors.confirmPassword);
                        }
                    }
                }
            })
            .catch(error => {
                submitBtn.disabled = false;
                submitSpinner.classList.add('d-none');
                showError('Có lỗi xảy ra khi kết nối với server. Vui lòng thử lại!');
                console.error('Error:', error);
            });
        });
    }

    /**
     * Validate form phía client
     */
    function validateForm() {
        let isValid = true;
        
        // Kiểm tra mật khẩu cũ
        if (!currentPasswordInput.value.trim()) {
            showFieldError('currentPassword', 'Vui lòng nhập mật khẩu cũ');
            isValid = false;
        }
        
        // Kiểm tra mật khẩu mới
        if (!newPasswordInput.value.trim()) {
            showFieldError('newPassword', 'Vui lòng nhập mật khẩu mới');
            isValid = false;
        } else if (newPasswordInput.value.length < 6) {
            showFieldError('newPassword', 'Mật khẩu mới phải có ít nhất 6 ký tự');
            isValid = false;
        }
        
        // Kiểm tra xác nhận mật khẩu
        if (!confirmPasswordInput.value.trim()) {
            showFieldError('confirmPassword', 'Vui lòng xác nhận mật khẩu mới');
            isValid = false;
        } else if (newPasswordInput.value !== confirmPasswordInput.value) {
            showFieldError('confirmPassword', 'Mật khẩu xác nhận không khớp');
            isValid = false;
        }
        
        // Kiểm tra mật khẩu mới khác mật khẩu cũ
        if (currentPasswordInput.value && newPasswordInput.value && 
            currentPasswordInput.value === newPasswordInput.value) {
            showFieldError('newPassword', 'Mật khẩu mới phải khác mật khẩu cũ');
            isValid = false;
        }
        
        return isValid;
    }

    /**
     * Hiển thị lỗi cho một field cụ thể
     */
    function showFieldError(fieldId, message) {
        const input = document.getElementById(fieldId);
        const errorDiv = document.getElementById(fieldId + 'Error');
        
        if (input) {
            input.classList.add('is-invalid');
        }
        
        if (errorDiv) {
            errorDiv.textContent = message;
        }
    }

    /**
     * Xóa các lỗi validation
     */
    function clearValidationErrors() {
        const inputs = [currentPasswordInput, newPasswordInput, confirmPasswordInput];
        inputs.forEach(input => {
            if (input) {
                input.classList.remove('is-invalid');
            }
        });
        
        const errorDivs = ['currentPasswordError', 'newPasswordError', 'confirmPasswordError'];
        errorDivs.forEach(id => {
            const div = document.getElementById(id);
            if (div) {
                div.textContent = '';
            }
        });
    }

    /**
     * Hiển thị thông báo lỗi
     */
    function showError(message) {
        errorMessage.textContent = message;
        errorMessage.classList.remove('d-none');
        successMessage.classList.add('d-none');
    }

    /**
     * Hiển thị thông báo thành công
     */
    function showSuccess(message) {
        successMessage.textContent = message;
        successMessage.classList.remove('d-none');
        errorMessage.classList.add('d-none');
    }

    /**
     * Xóa tất cả thông báo
     */
    function clearMessages() {
        errorMessage.classList.add('d-none');
        successMessage.classList.add('d-none');
        errorMessage.textContent = '';
        successMessage.textContent = '';
    }
});
