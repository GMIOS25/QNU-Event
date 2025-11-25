<head>
    <link rel="stylesheet" href="assest/css/bcs/danhsachminhchung.css">
</head>
<div class="page-container">
        
        <h1 class="main-page-title">QUẢN LÝ MINH CHỨNG</h1>

        <?php if(isset($message)): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="custom-card">
            
            <div class="toolbar-container mb-4">
                
                <div class="toolbar-left d-flex align-items-center flex-wrap gap-4">
                    <div class="toolbar-title">
                        <i class="bi bi-grid-3x3-gap-fill me-2"></i>
                        <span>Danh sách minh chứng</span>
                    </div>
                    
                    <div class="filter-group d-flex align-items-center">
                        <span class="me-2 fw-medium text-secondary">Trạng thái:</span>
                        <select class="form-select custom-select-filter" id="statusFilter">
                            <option value="all" selected>Tất cả</option>
                            <option value="pending">Chưa duyệt</option>
                            <option value="approved">Đã duyệt</option>
                            <option value="rejected">Bị từ chối</option>
                        </select>
                    </div>
                </div>

                <div class="toolbar-right d-flex align-items-center gap-3">
                    <div class="search-wrapper position-relative">
                        <input type="text" class="form-control search-input" id="searchInput" placeholder="Tìm kiếm ....">
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
                    <?php 
                        if(isset($listMinhChung) && $listMinhChung != NULL)
                        {
                            $index = 0;
                            foreach($listMinhChung as $mc)
                            {
                                echo '<div class="table-row" data-status="pending">
                                <div class="col-cell c-stt">'.($index + 1).'</div>
                                <div class="col-cell c-msv">'.$mc['MSSV'].'</div>
                                <div class="col-cell c-name">'.$mc['Ho'].' '.$mc['Ten'].'</div>
                                <div class="col-cell c-status">'.$mc['Lop'].'</div>
                                <div class="col-cell c-img">
                                    <button class="btn btn-sm btn-info view-image-btn" data-img-url="'.$mc['FileMinhChung'].'">
                                        <i class="bi bi-eye me-1"></i>Xem ảnh
                                    </button>
                                </div>
                                <div class="col-cell c-action">
                                    <button class="btn-action btn-approve" data-mssv="'.$mc['MSSV'].'" data-eventid="'.$_GET['EventID'].'">
                                        <i class="bi bi-check-circle me-1"></i>Duyệt
                                    </button>
                                    <button class="btn-action btn-reject" data-mssv="'.$mc['MSSV'].'" data-eventid="'.$_GET['EventID'].'">
                                        <i class="bi bi-x-circle me-1"></i>Từ chối
                                    </button>
                                </div>
                                </div>';
                                $index++;
                            }
                        }
                        else
                        {
                            echo '<div class="table-row">
                                <div class="col-cell" style="grid-column: 1 / -1; text-align: center; padding: 2rem;">
                                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                                    <p style="margin-top: 1rem; color: #666;">Không có minh chứng nào chờ duyệt</p>
                                </div>
                            </div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for viewing image -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Minh chứng tham gia sự kiện</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Minh chứng" style="max-width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>

    <script>
        // View image in modal
        document.querySelectorAll('.view-image-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const imgUrl = this.getAttribute('data-img-url');
                document.getElementById('modalImage').src = imgUrl;
                const modal = new bootstrap.Modal(document.getElementById('imageModal'));
                modal.show();
            });
        });

        // Approve button
        document.querySelectorAll('.btn-approve').forEach(btn => {
            btn.addEventListener('click', function() {
                const mssv = this.getAttribute('data-mssv');
                const eventId = this.getAttribute('data-eventid');
                
                if(confirm('Bạn có chắc chắn muốn duyệt minh chứng này?')) {
                    window.location.href = 'BCS/DuyetMinhChung/Approve?MSSV=' + mssv + '&EventID=' + eventId;
                }
            });
        });

        // Reject button
        document.querySelectorAll('.btn-reject').forEach(btn => {
            btn.addEventListener('click', function() {
                const mssv = this.getAttribute('data-mssv');
                const eventId = this.getAttribute('data-eventid');
                
                if(confirm('Bạn có chắc chắn muốn từ chối minh chứng này?')) {
                    window.location.href = 'BCS/DuyetMinhChung/Reject?MSSV=' + mssv + '&EventID=' + eventId;
                }
            });
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('.table-body .table-row');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if(text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Status filter functionality (for future use when showing all statuses)
        document.getElementById('statusFilter').addEventListener('change', function() {
            const filterValue = this.value;
            const rows = document.querySelectorAll('.table-body .table-row');
            
            rows.forEach(row => {
                const status = row.getAttribute('data-status');
                if(filterValue === 'all' || status === filterValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>