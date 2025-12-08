let modalBtn = document.getElementById("btn-change-password");

if (modalBtn) {
  modalBtn.addEventListener("click", function() {
    let modal = document.getElementById("changePasswordModal");
    modal.style.display = "flex";
  })
}

if (modalCloseBtn) {
  modalCloseBtn.addEventListener("click", function() {
    let modal = document.getElementById("changePasswordModal");
    modal.style.display = "none";
  })
}
