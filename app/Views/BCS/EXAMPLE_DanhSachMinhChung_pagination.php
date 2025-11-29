<!-- 
    Example: Cập nhật DanhSachMinhChung.php - Thêm pagination
    
    Sau phần kết thúc table (sau dòng 99), thêm đoạn code sau:
-->

            </div> <!-- Kết thúc custom-table -->

            <!-- Thêm pagination -->
            <?php 
            if(isset($pagination)) {
                include __DIR__ . "/../partials/pagination.php";
            }
            ?>

        </div> <!-- Kết thúc custom-card -->
    </div> <!-- Kết thúc page-container -->

<!-- 
    Hoặc nếu muốn sử dụng render() method:
-->
            </div> <!-- Kết thúc custom-table -->

            <!-- Thêm pagination -->
            <?php 
            if(isset($pagination)) {
                echo $pagination->render();
            }
            ?>

        </div> <!-- Kết thúc custom-card -->
