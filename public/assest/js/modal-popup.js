document.addEventListener('DOMContentLoaded', function() {
    const changePasswordBtn = document.getElementById('btn-change-password');
    const modal = document.getElementById('changePasswordModal');
    const cancelBtn = document.getElementById('btn-cancel');
    const confirmBtn = document.getElementById('btn-confirm');

    // Open modal
    if (changePasswordBtn && modal) {
        changePasswordBtn.addEventListener('click', function() {
            modal.classList.add('show');
        });
    }

    // Close modal ONLY when clicking Cancel button
    if (cancelBtn && modal) {
        cancelBtn.addEventListener('click', function() {
            modal.classList.remove('show');
        });
    }

    // Prevent closing when clicking overlay (optional, but good for "modal" behavior requested)
    // The user specifically said: "Muốn tắt popup thì nhấn nút huỷ không được nhấn vào bất kì nơi nào để tắt."
    // So we do NOT add an event listener to the overlay to close it.
    
    // Optional: Confirm button logic placeholder
    if (confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            // Logic for password change would go here
            console.log('Confirm password change');
        });
    }
});
