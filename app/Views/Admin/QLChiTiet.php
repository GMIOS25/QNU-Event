<head>
    <link rel="stylesheet" href="assest/css/admin/qlchitietsk.css">
</head>
<div class="page-container">
        
        <div class="page-title">QUẢN LÝ SỰ KIỆN</div>

        <div class="event-manager-card mb-4">
            <div class="card-header-flex">
                <div class="card-header-title">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                    <span>Quản lý chi tiết</span>
                </div>
                <a href="Admin/QLSuKien" class="back-link">&gt; Quay lại</a>
            </div>

            <div class="card-body-detail">
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="info-item">
                            <i class="bi bi-calendar-check info-icon"></i>
                            <span class="info-label">Tên sự kiện: </span>
                            <span class="info-value"><?php echo $dataEvent['TenSK']?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <i class="bi bi-clock info-icon"></i>
                            <span class="info-label">Thời gian bắt đầu:</span>
                            <span class="info-value"><?php echo $dataEvent['ThoiGianBatDauSK']?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <i class="bi bi-clock-fill info-icon"></i>
                            <span class="info-label">Thời gian kết thúc:</span>
                            <span class="info-value"><?php echo $dataEvent['ThoiGianKetThucSK']?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <i class="bi bi-calendar-plus info-icon"></i>
                            <span class="info-label">Thời gian mở đăng ký:</span>
                            <span class="info-value"><?php echo $dataEvent['ThoiGianMoDK']?>5</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <i class="bi bi-calendar-x info-icon"></i>
                            <span class="info-label">Thời gian đóng đăng ký:</span>
                            <span class="info-value"><?php echo $dataEvent['ThoiGianDongDK']?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <i class="bi bi-geo-alt info-icon"></i>
                            <span class="info-label">Nơi tổ chức:</span>
                            <span class="info-value"><?php echo $dataEvent['NoiToChuc']?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <i class="bi bi-trophy info-icon"></i>
                            <span class="info-label">Số điểm rèn luyện:</span>
                            <span class="info-value"><?php echo $dataEvent['DiemCong']?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <i class="bi bi-people info-icon"></i>
                            <span class="info-label">Giới hạn số lượng đăng ký:</span>
                            <span class="info-value"><?php echo $dataEvent['GioiHanThamGia']?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <i class="bi bi-info-circle info-icon"></i>
                            <span class="info-label">Khoa tổ chức:</span>
                            <span class="info-value"><?php echo $tenKhoaToChuc?></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="info-item">
                            <i class="bi bi-diagram-3 info-icon"></i>
                            <span class="info-label">Sinh viên các khoa được phép tham gia:</span>
                            <span class="info-value">
                                <?php 
                                    foreach ($listKhoaThamGia as $nameKhoa)
                                    {
                                        echo $nameKhoa['TenKhoa'] . ';';
                                    }
                                
                                ?>


                            </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="info-item">
                            <i class="bi bi-card-text info-icon"></i>
                            <span class="info-label">Ghi chú:</span>
                            <span class="info-value"><?php echo $dataEvent['GhiChu']?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer-actions">
                <button class="btn btn-action-edit">
                    <i class="bi bi-pencil-square"></i>
                    <span>Sửa sự kiện</span>
                </button>
                <button class="btn btn-action-delete">
                    <i class="bi bi-trash"></i>
                    <span>Xóa sự kiện</span>
                </button>
            </div>
        </div>

        <div class="event-manager-card">
            <div class="card-header-flex">
                <div class="card-header-title">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                    <span>Quản lý sinh viên tham gia sự kiện:</span>
                </div>
                <button class="btn btn-primary btn-add-student">
                    <i class="bi bi-plus-circle me-2"></i>
                    <span>Thêm sinh viên</span>
                </button>
            </div>

            <div class="card-body-main">
                <div class="chart-section row align-items-center mb-4">
                    <div class="col-md-5 d-flex justify-content-center">
                        <div class="chart-container">
                            </div>
                    </div>
                    <div class="col-md-7">
                        <div class="legend-container">
                            <div class="legend-item">
                                <span class="legend-color-box" style="background-color: #e5e7eb;"></span>
                                <span>Chưa đăng ký</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color-box" style="background-color: #34d399;"></span>
                                <span>Đăng ký tham gia</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color-box" style="background-color: #0091ff;"></span>
                                <span>Đã tham gia</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-bar d-flex flex-wrap align-items-center mb-3">
                    <div class="filter-item me-3">
                        <span>Khoa:</span>
                        <select class="form-select custom-filter-select">
                            <option selected>Tất cả</option>
                        </select>
                    </div>
                    <div class="filter-item me-3">
                        <span>Lớp:</span>
                        <select class="form-select custom-filter-select">
                            <option selected>Tất cả</option>
                        </select>
                    </div>
                    <div class="filter-item me-3">
                        <span>Trạng thái:</span>
                        <select class="form-select custom-filter-select">
                            <option selected>Tất cả</option>
                        </select>
                    </div>
                    <button class="btn btn-primary btn-filter me-3">
                        <i class="bi bi-funnel"></i>
                        <span>Lọc</span>
                    </button>
                    
                    <div class="search-bar ms-auto d-flex">
                        <input type="text" class="form-control custom-search" placeholder="Nhập MSV, họ tên...">
                        <button class="btn btn-primary btn-search">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>

                <div class="event-table">
                    <div class="event-table-header">
                        <div class="header-cell" style="flex-basis: 5%;">STT</div>
                        <div class="header-cell" style="flex-basis: 15%;">MSV</div>
                        <div class="header-cell" style="flex-basis: 25%;">Họ tên</div>
                        <div class="header-cell" style="flex-basis: 25%;">Khoa</div>
                        <div class="header-cell" style="flex-basis: 15%;">Trạng thái</div>
                        <div class="header-cell" style="flex-basis: 15%;">Chức năng</div>
                    </div>
                    
                    <div class="event-table-body">
                        <div class="event-table-row">
                            <div class="data-cell" style="flex-basis: 5%;">01</div>
                            <div class="data-cell" style="flex-basis: 15%;">4651050044</div>
                            <div class="data-cell" style="flex-basis: 25%;">Nguyễn Khánh Dương</div>
                            <div class="data-cell" style="flex-basis: 25%;">Công nghệ thông tin</div>
                            <div class="data-cell" style="flex-basis: 15%;">Đã đăng ký</div>
                            <div class="data-cell" style="flex-basis: 15%;">
                                <span class="action-links">[<a href="#">Xem chi tiết</a>, <a href="#">Xóa</a>]</span>
                            </div>
                        </div>
                        <div class="event-table-row">
                            <div class="data-cell" style="flex-basis: 5%;">02</div>
                            <div class="data-cell" style="flex-basis: 15%;">4651050189</div>
                            <div class="data-cell" style="flex-basis: 25%;">Nguyễn Yến Nhi</div>
                            <div class="data-cell" style="flex-basis: 25%;">Công nghệ thông tin</div>
                            <div class="data-cell" style="flex-basis: 15%;">Đã đăng ký</div>
                            <div class="data-cell" style="flex-basis: 15%;">
                                <span class="action-links">[<a href="#">Xem chi tiết</a>, <a href="#">Xóa</a>]</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pagination-container d-flex justify-content-center mt-4">
                    <div class="pagination">
                        <div class="page-item disabled"><a class="page-link" href="#">&lt;</a></div>
                        <div class="page-item active"><a class="page-link" href="#">1</a></div>
                        <div class="page-item"><a class="page-link" href="#">2</a></div>
                        <div class="page-item"><a class="page-link" href="#">3</a></div>
                        <div class="page-item"><a class="page-link" href="#">4</a></div>
                        <div class="page-item"><a class="page-link" href="#">&gt;</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>