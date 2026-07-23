<?php
$currentPage = $_GET['page'] ?? 'admin';
?>
<div class="col-xl-3 col-sm-4 mb-4">
    <div class="admin-sidebar-card p-4 rounded-4 position-sticky" style="top: 95px;">
        
        <div class="px-3 py-2 mb-3 border-bottom d-flex align-items-center justify-content-between" style="border-color: rgba(202, 151, 69, 0.25) !important;">
            <span class="text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 2px; color: #ca9745;"><i class="bi bi-grid-fill pe-2"></i>Navigation Menu</span>
            <span class="badge rounded-pill bg-dark border border-secondary text-light" style="font-size: 0.65rem;">v2.5</span>
        </div>

        <div class="d-flex flex-column gap-1">
            <a href="<?php echo url('homepage') ?>" class="admin-nav-item <?= ($currentPage === 'homepage' || $currentPage === 'admin_homepage') ? 'active' : '' ?>">
                <i class="bi bi-house-door-fill fs-5"></i>
                <span>Store Homepage</span>
            </a>

            <a href="<?php echo url('admin') ?>" class="admin-nav-item <?= ($currentPage === 'admin') ? 'active' : '' ?>">
                <i class="bi bi-speedometer2 fs-5"></i>
                <span>Executive Dashboard</span>
            </a>

            <div class="my-2 border-top" style="border-color: rgba(255,255,255,0.08) !important;"></div>
            <div class="px-3 py-1 text-uppercase fw-bold" style="font-size: 0.68rem; letter-spacing: 1.5px; color: #887868;">Catalog & Products</div>

            <a href="<?php echo url('admin_products') ?>" class="admin-nav-item <?= in_array($currentPage, ['admin_products', 'add_product', 'edit_product']) ? 'active' : '' ?>">
                <i class="bi bi-box-seam-fill fs-5"></i>
                <span>All Products</span>
            </a>

            <a href="<?php echo url('admin_sale_products') ?>" class="admin-nav-item <?= ($currentPage === 'admin_sale_products') ? 'active' : '' ?>">
                <i class="bi bi-tag-fill fs-5 text-success"></i>
                <span>Sale Products</span>
            </a>

            <a href="<?php echo url('admin_feature_products') ?>" class="admin-nav-item <?= ($currentPage === 'admin_feature_products') ? 'active' : '' ?>">
                <i class="bi bi-star-fill fs-5 text-warning"></i>
                <span>Featured Products</span>
            </a>

            <a href="<?php echo url('admin_categories') ?>" class="admin-nav-item <?= in_array($currentPage, ['admin_categories', 'add_category', 'edit_category']) ? 'active' : '' ?>">
                <i class="bi bi-tags-fill fs-5"></i>
                <span>Manage Categories</span>
            </a>

            <div class="my-2 border-top" style="border-color: rgba(255,255,255,0.08) !important;"></div>
            <div class="px-3 py-1 text-uppercase fw-bold" style="font-size: 0.68rem; letter-spacing: 1.5px; color: #887868;">Orders & Reports</div>

            <a href="<?php echo url('manage_orders') ?>" class="admin-nav-item <?= ($currentPage === 'manage_orders') ? 'active' : '' ?>">
                <i class="bi bi-cart-check-fill fs-5 text-info"></i>
                <span>View Customer Orders</span>
            </a>

            <a href="<?php echo url('sales_report') ?>" class="admin-nav-item <?= ($currentPage === 'sales_report') ? 'active' : '' ?>">
                <i class="bi bi-graph-up-arrow fs-5"></i>
                <span>Sales Analytics</span>
            </a>

            <a href="<?php echo url('wishlist_report') ?>" class="admin-nav-item <?= ($currentPage === 'wishlist_report') ? 'active' : '' ?>">
                <i class="bi bi-heart-fill fs-5 text-danger"></i>
                <span>Wishlist Insights</span>
            </a>

            <a href="<?php echo url('return_report') ?>" class="admin-nav-item <?= ($currentPage === 'return_report') ? 'active' : '' ?>">
                <i class="bi bi-arrow-repeat fs-5"></i>
                <span>Returns Report</span>
            </a>

            <a href="<?php echo url('admin_warranties') ?>" class="admin-nav-item <?= in_array($currentPage, ['admin_warranties', 'admin_warranty_claims']) ? 'active' : '' ?>">
                <i class="bi bi-shield-check fs-5 text-warning"></i>
                <span>Warranties & Claims</span>
            </a>

            <a href="<?php echo url('return_trash') ?>" class="admin-nav-item <?= ($currentPage === 'return_trash') ? 'active' : '' ?>">
                <i class="bi bi-trash3-fill fs-5"></i>
                <span>Return Trash Bin</span>
            </a>

            <div class="my-2 border-top" style="border-color: rgba(255,255,255,0.08) !important;"></div>
            <div class="px-3 py-1 text-uppercase fw-bold" style="font-size: 0.68rem; letter-spacing: 1.5px; color: #887868;">Content & System</div>

            <a href="<?php echo url('pages') ?>" class="admin-nav-item <?= in_array($currentPage, ['pages', 'add_page', 'edit_page']) ? 'active' : '' ?>">
                <i class="bi bi-file-earmark-text-fill fs-5"></i>
                <span>CMS Pages</span>
            </a>

            <a href="<?php echo url('admin_logout') ?>" class="admin-nav-item mt-2" style="background: rgba(220, 53, 69, 0.15) !important; border: 1px solid rgba(220, 53, 69, 0.4) !important; color: #ff6b6b !important;" onmouseover="this.style.background='#dc3545 !important'; this.style.color='#fff !important';" onmouseout="this.style.background='rgba(220, 53, 69, 0.15) !important'; this.style.color='#ff6b6b !important';">
                <i class="bi bi-box-arrow-left fs-5"></i>
                <span>Logout Session</span>
            </a>
        </div>
    </div>
</div>

<style>
.admin-nav-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 18px;
    border-radius: 12px;
    text-decoration: none;
    color: #e0d5c8;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s cubic-bezier(0.16,1,0.3,1);
    border: 1px solid transparent;
}
.admin-nav-item:hover {
    background: rgba(202, 151, 69, 0.15);
    color: #ca9745;
    transform: translateX(5px);
    border-color: rgba(202, 151, 69, 0.3);
}
.admin-nav-item.active {
    background: linear-gradient(135deg, #ca9745 0%, #e8c547 100%) !important;
    color: #1a0f0a !important;
    font-weight: 800;
    box-shadow: 0 4px 15px rgba(202, 151, 69, 0.45);
    border-color: #ca9745 !important;
}
.admin-nav-item.active i {
    color: #1a0f0a !important;
}
</style>
