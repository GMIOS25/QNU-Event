<head>
    <link rel="stylesheet" href="assest/css/admin/qlsukien.css">
</head>
<div class="page-container">
        <div class="event-manager-card">
            
            <div class="card-title">QUẢN LÝ SỰ KIỆN</div>

            <div class="toolbar d-flex justify-content-between align-items-center mb-4">
                <div class="toolbar-left d-flex align-items-center">
                    <i class="bi bi-grid-3x3-gap-fill me-2"></i>
                    <span>Danh sách sự kiện</span>
                </div>
                <div class="toolbar-right">
                    <a href="Admin/QLSuKien/ThemSuKien" class="btn btn-primary d-flex align-items-center">
                        <i class="bi bi-plus-circle me-2"></i>
                        <span>Thêm sự kiện</span>
                    </a>
                </div>
            </div>

            <div class="filter-bar d-flex align-items-center mb-3">
                <div class="filter-item d-flex align-items-center me-3">
                    <span class="me-2">Trạng thái:</span>
                    <select class="form-select custom-filter-select">
                        <option selected>Tất cả</option>
                        <option value="1">Sắp diễn ra</option>
                        <option value="2">Đang mở đăng ký</option>
                        <option value="3">Đã kết thúc</option>
                    </select>
                </div>
                <div class="filter-item d-flex align-items-center me-3">
                    <span class="me-2">Phòng:</span>
                    <select class="form-select custom-filter-select">
                        <option selected>Tất cả</option>
                        <option value="1">Nhà thi đấu</option>
                        <option value="2">Hội trường A</option>
                    </select>
                </div>
                <div class="search-bar ms-auto position-relative">
                    <input type="text" class="form-control custom-search" placeholder="Tìm kiếm ...">
                    <i class="bi bi-search search-icon"></i>
                </div>
            </div>

            <div class="event-table">
                <div class="event-table-header">
                    <div class="header-cell" style="flex-basis: 12%;">Mã sự kiện</div>
                    <div class="header-cell" style="flex-basis: 33%;">Tên sự kiện</div>
                    <div class="header-cell" style="flex-basis: 18%;">Trạng thái</div>
                    <div class="header-cell" style="flex-basis: 17%;">Phòng</div>
                    <div class="header-cell" style="flex-basis: 20%;">Chức năng</div>
                </div>
                
                <div class="event-table-body">
                    <div class="event-table-row">
                        <div class="data-cell" style="flex-basis: 12%;">SK0036</div>
                        <div class="data-cell" style="flex-basis: 33%;">Tham dự giải cầu lông QNU 2025</div>
                        <div class="data-cell" style="flex-basis: 18%;">Sắp diễn ra</div>
                        <div class="data-cell" style="flex-basis: 17%;">Nhà thi đấu</div>
                        <div class="data-cell" style="flex-basis: 20%;">
                            <button class="btn btn-detail">
                                <i class="bi bi-camera"></i>
                                <span>Quản lý chi tiết</span>
                            </button>
                        </div>
                    </div>
                    <div class="event-table-row">
                        <div class="data-cell" style="flex-basis: 12%;">SK0037</div>
                        <div class="data-cell" style="flex-basis: 33%;">ITQNU Challenge</div>
                        <div class="data-cell" style="flex-basis: 18%;">Đang mở đăng ký</div>
                        <div class="data-cell" style="flex-basis: 17%;">Nhà thi đấu</div>
                        <div class="data-cell" style="flex-basis: 20%;">
                            <button class="btn btn-detail">
                                <i class="bi bi-camera"></i>
                                <span>Quản lý chi tiết</span>
                            </button>
                        </div>
                    </div>
                    <div class="event-table-row">
                        <div class="data-cell" style="flex-basis: 12%;">SK0038</div>
                        <div class="data-cell" style="flex-basis: 33%;">Giải thể thao điện tử ITQNU</div>
                        <div class="data-cell" style="flex-basis: 18%;">Đang mở đăng ký</div>
                        <div class="data-cell" style="flex-basis: 17%;">Nhà thi đấu</div>
                        <div class="data-cell" style="flex-basis: 20%;">
                            <button class="btn btn-detail">
                                <i class="bi bi-camera"></i>
                                <span>Quản lý chi tiết</span>
                            </button>
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