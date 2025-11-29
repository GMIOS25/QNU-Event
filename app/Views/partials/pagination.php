<?php
/**
 * Pagination Component View
 * Component tái sử dụng để hiển thị pagination
 * 
 * Cách sử dụng:
 * $pagination = new PaginationHelper($totalItems, $currentPage, $itemsPerPage, $baseUrl, $_GET);
 * include __DIR__ . '/path/to/pagination.php';
 * 
 * Hoặc echo trực tiếp:
 * echo $pagination->render();
 */

if (!isset($pagination) || !($pagination instanceof PaginationHelper)) {
    return;
}

if ($pagination->getTotalPages() <= 1) {
    return;
}

$displayInfo = $pagination->getDisplayInfo();
?>

<div class="pagination-wrapper">
    <!-- Thông tin hiển thị -->
    <?php if ($displayInfo['total'] > 0): ?>
    <div class="pagination-info text-center mb-2 text-muted">
        <small>
            Hiển thị <strong><?php echo $displayInfo['from']; ?></strong> 
            đến <strong><?php echo $displayInfo['to']; ?></strong> 
            trong tổng số <strong><?php echo $displayInfo['total']; ?></strong> kết quả
        </small>
    </div>
    <?php endif; ?>
    
    <!-- Pagination controls -->
    <div class="pagination-container d-flex justify-content-center">
        <ul class="pagination">
            <!-- Previous Button -->
            <?php if ($pagination->hasPrevious()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo $pagination->buildUrl($pagination->getPreviousPage()); ?>" aria-label="Previous">
                        <span aria-hidden="true">&lt;</span>
                    </a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link" aria-label="Previous">
                        <span aria-hidden="true">&lt;</span>
                    </span>
                </li>
            <?php endif; ?>
            
            <?php
            $pageRange = $pagination->getPageRange();
            $showFirstEllipsis = !in_array(1, $pageRange);
            $showLastEllipsis = !in_array($pagination->getTotalPages(), $pageRange);
            ?>
            
            <!-- First page if not in range -->
            <?php if ($showFirstEllipsis): ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo $pagination->buildUrl(1); ?>">1</a>
                </li>
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            <?php endif; ?>
            
            <!-- Page numbers -->
            <?php foreach ($pageRange as $page): ?>
                <?php if ($page == $pagination->getCurrentPage()): ?>
                    <li class="page-item active" aria-current="page">
                        <span class="page-link"><?php echo $page; ?></span>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo $pagination->buildUrl($page); ?>"><?php echo $page; ?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
            
            <!-- Last page if not in range -->
            <?php if ($showLastEllipsis): ?>
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?php echo $pagination->buildUrl($pagination->getTotalPages()); ?>">
                        <?php echo $pagination->getTotalPages(); ?>
                    </a>
                </li>
            <?php endif; ?>
            
            <!-- Next Button -->
            <?php if ($pagination->hasNext()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo $pagination->buildUrl($pagination->getNextPage()); ?>" aria-label="Next">
                        <span aria-hidden="true">&gt;</span>
                    </a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link" aria-label="Next">
                        <span aria-hidden="true">&gt;</span>
                    </span>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
