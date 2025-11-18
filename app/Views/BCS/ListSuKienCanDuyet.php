<head>
  <link rel="stylesheet" href="assest/css/bcs/listSuKienCanDuyet.css">
</head>
<div class="page-container">
        
        <h1 class="main-page-title">Duyệt minh chứng sự kiện</h1>

        <div class="custom-card mb-5">

            <div class="card-toolbar d-flex justify-content-between align-items-center mb-4">

                <div class="toolbar-title">
                    <i class="bi bi-grid-3x3-gap-fill me-2"></i>
                    <span>Danh sách sự kiện cần duyệt minh chứng</span>
                </div>

                <div class="search-wrapper position-relative">
                    <input type="text" class="form-control search-input" placeholder="Tìm kiếm ....">
                    <i class="bi bi-search search-icon"></i>
                </div>
            </div>
            <div class="warning-box">
                <i class="bi bi-exclamation-triangle-fill warning-icon"></i>
                <span class="warning-text">Thời gian nộp minh chứng và duyệt chỉ có hiệu lực từ khi sự kiện bắt đầu cho đến 7 ngày sau khi sự kiện kết thúc. <br> Ban cán sự duyệt minh chứng phảo trung thực, khách quan.</span>
            </div>
            <div class="custom-table">
                <div class="table-header">
                    <div class="col-cell c-code">Mã SK</div>
                    <div class="col-cell c-name">Tên sự kiện</div>
                    <div class="col-cell c-time">Thời gian diễn ra</div>
                    <div class="col-cell c-action">Chức năng</div>
                </div>
                
                <?php 
                    foreach($listSKMinhChung as $skmc)
                    {
                        echo '<div class="table-body">
                    <div class="table-row">
                        <div class="col-cell c-code">'.$skmc['MaSK'].'</div>
                        <div class="col-cell c-name">'.$skmc['TenSK'].'</div>
                        <div class="col-cell c-time">'.$skmc['ThoiGianBatDauSK'].' - '.$skmc['ThoiGianKetThucSK'].'</div>
                        <div class="col-cell c-action"><a href="BCS/DuyetMinhChung/DanhSachMinhChung?EventID='.$skmc['MaSK'].'">Xem danh sách minh chứng chờ duyệt</a></div>
                    </div>
                        </div>';

                    }

                ?>
                <!-- <div class="table-body">
                    <div class="table-row">
                        <div class="col-cell c-code">test</div>
                        <div class="col-cell c-name">test</div>
                        <div class="col-cell c-time">test</div>
                        <div class="col-cell c-action">test</div>
                    </div>
                   
                </div> -->
            </div>
        </div>


    </div>