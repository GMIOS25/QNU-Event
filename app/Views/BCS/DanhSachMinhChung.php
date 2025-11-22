<head>
    <link rel="stylesheet" href="assest/css/bcs/danhsachminhchung.css">
</head>
<div class="page-container">
        
        <h1 class="main-page-title">QUẢN LÝ MINH CHỨNG</h1>

        <div class="custom-card">
            
            <div class="toolbar-container mb-4">
                
                <div class="toolbar-left d-flex align-items-center flex-wrap gap-4">
                    <div class="toolbar-title">
                        <i class="bi bi-grid-3x3-gap-fill me-2"></i>
                        <span>Danh sách minh chứng</span>
                    </div>
                    
                    <div class="filter-group d-flex align-items-center">
                        <span class="me-2 fw-medium text-secondary">Trạng thái:</span>
                        <select class="form-select custom-select-filter">
                            <option selected>Tất cả</option>
                            <option value="1">Chưa duyệt</option>
                            <option value="2">Đã duyệt</option>
                            <option value="3">Bị từ chối</option>
                        </select>
                    </div>
                </div>

                <div class="toolbar-right d-flex align-items-center gap-3">
                    <div class="search-wrapper position-relative">
                        <input type="text" class="form-control search-input" placeholder="Tìm kiếm ....">
                        <i class="bi bi-search search-icon"></i>
                    </div>
                    <button class="btn btn-primary btn-export">
                        <i class="bi bi-download me-2"></i>
                        Xuất file
                    </button>
                </div>
            </div>

            <div class="custom-table">
                <div class="table-header">
                    <div class="col-cell c-stt">STT</div>
                    <div class="col-cell c-msv">MSV</div>
                    <div class="col-cell c-name">Họ & Tên</div>
                    <div class="col-cell c-status">Lớp</div>
                    <div class="col-cell c-img">Ảnh minh chứng</div>
                    <div class="col-cell c-action">Thao tác</div>
                </div>
                
                <div class="table-body">
                    <!-- <div class="table-row">
                        <div class="col-cell c-stt">01</div>
                        <div class="col-cell c-msv">465050122</div>
                        <div class="col-cell c-name">Võ Nguyễn An Nhiên</div>
                        <div class="col-cell c-img">
                            <button class="btn-upload">
                                <i class="bi bi-camera me-1"></i> Upload
                            </button>
                        </div>
                        <div class="col-cell c-status">Chưa duyệt</div>
                        <div class="col-cell c-action">
                            <button class="btn-action btn-approve">Duyệt</button>
                            <button class="btn-action btn-reject">Từ chối</button>
                        </div>
                    </div> -->
                    
                    <?php 
                        foreach($listMinhChung as  $mc)
                        {
                            echo '<div class="table-row">
                            <div class="col-cell c-stt">'.($index + 1).'</div>
                            <div class="col-cell c-msv">'.$mc['MSSV'].'</div>
                            <div class="col-cell c-name">'.$mc['Ho'].' '.$mc['Ten'].'</div>
                            <div class="col-cell c-status">'.$mc['Lop'].'</div>
                            <div class="col-cell c-img">
                                <a href="'.$mc['FileMinhChung'].'" target="_blank">Xem ảnh</a>
                            </div>
                            <div class="col-cell c-action">
                                <button class="btn-action btn-approve">Duyệt</button>
                                <button class="btn-action btn-reject">Từ chối</button>
                            </div>
                            </div>';
                        }   
                    ?>

                </div>
            </div>
        </div>
    </div>