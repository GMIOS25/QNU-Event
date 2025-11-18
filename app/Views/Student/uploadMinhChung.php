<header>
    <link rel="stylesheet" href="assest/css/student/uploadminhchung.css">
</header>
<div class="upload-card">
        <div class="upload-header">
            <h3>Nộp Minh Chứng Sự Kiện</h3>
            <p>Vui lòng tải lên ảnh minh chứng tham gia</p>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="ma_sk" value="<?php echo isset($maSK) ? $maSK : ''; ?>">

            <label for="file-upload" class="upload-area">
                <div class="upload-icon">📂</div>
                <span class="upload-text">Nhấn vào đây để chọn ảnh</span>
                <span class="upload-hint">(JPG, PNG - Tối đa 1 ảnh)</span>
            </label>
            
            <input id="file-upload" class="file-input" type="file" name="minhchung_img" accept="image/*" required onchange="previewImage(event)">

            <div id="preview-box" class="preview-container">
                <p style="font-size: 0.8rem; color: #666; margin-bottom: 5px;">Ảnh đã chọn:</p>
                <img id="img-preview" class="preview-image" src="" alt="Preview">
            </div>

            <button type="submit" class="btn-confirm">Xác nhận nộp</button>
            <button type="button" onclick="window.location.href = 'Student/NopMinhChungThamGiaSK'" class="btn-cancel">Hủy</button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const previewBox = document.getElementById('preview-box');
            const output = document.getElementById('img-preview');
            
            reader.onload = function() {
                output.src = reader.result;
                previewBox.style.display = 'block';
            }
            
            if(event.target.files[0]){
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>