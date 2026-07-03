<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-white mb-0" style="font-size: 2.2rem; font-weight: 900; letter-spacing: -0.5px;">
        📦 All Products Inventory
    </h2>
    <a href="<?= BASE_URL ?>/index.php?page=add_product" class="btn btn-primary px-4 rounded-pill" style="background: linear-gradient(135deg, #CD9A48, #e8c547); border: none; font-weight: 700; box-shadow: 0 4px 15px rgba(205, 154, 72, 0.3);">
        + Add New Product
    </a>
</div>

<?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert border-0 rounded-3 mb-4" role="alert" style="background: rgba(205, 154, 72, 0.15); color: #c19a4e; border-left: 4px solid #c19a4e !important;">
        <?= htmlspecialchars($_SESSION['flash']) ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<div class="row mt-4">
    <div class="col-12">
        <div class="luxury-table-wrapper rounded-4 overflow-hidden" style="background: var(--bg-card, #0a0a0a); border: 1px solid rgba(193, 154, 78, 0.15); box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
            <div class="table-responsive">
                <table class="table table-hover table-dark mb-0 align-middle luxury-table" style="background: transparent;">
                    <thead style="background: rgba(193, 154, 78, 0.05);">
                        <tr>
                            <th class="ps-4 py-3 text-muted small text-uppercase" style="width: 80px; letter-spacing: 1px;">PID</th>
                            <th class="py-3 text-muted small text-uppercase" style="letter-spacing: 1px;">Image</th>
                            <th class="py-3 text-muted small text-uppercase" style="letter-spacing: 1px;">Article No.</th>
                            <th class="py-3 text-muted small text-uppercase" style="letter-spacing: 1px;">Name</th>
                            <th class="py-3 text-muted small text-uppercase text-center" style="letter-spacing: 1px;">QTY</th>
                            <th class="py-3 text-muted small text-uppercase text-center" style="letter-spacing: 1px;">Status</th>
                            <th class="py-3 text-muted small text-uppercase text-end pe-4" style="letter-spacing: 1px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $prod): ?>
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); transition: background 0.3s ease;">
                                <td class="ps-4"><small class="text-muted">#<?= htmlspecialchars($prod['id']) ?></small></td>
                                <td>
                                    <?php $productImage = strtok($prod['image_url'], ','); ?>
                                    <div class="product-img-wrap" style="width: 60px; height: 60px; border-radius: 8px; overflow: hidden; border: 1px solid rgba(193, 154, 78, 0.3);">
                                        <img src="<?= BASE_URL ?>/<?= htmlspecialchars(trim($productImage)) ?>" alt="Product" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge" style="background: rgba(255,255,255,0.1); color: #e4d5b7; font-family: monospace; font-size: 0.85rem; padding: 6px 10px;">
                                        <?= htmlspecialchars($prod['article_number']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold" style="color: #f4e9d3; font-size: 1.05rem; letter-spacing: 0.5px;">
                                        <?= htmlspecialchars($prod['name']) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge rounded-pill <?= $prod['quantity'] > 10 ? 'bg-success bg-opacity-25 text-success' : ($prod['quantity'] > 0 ? 'bg-warning bg-opacity-25 text-warning' : 'bg-danger bg-opacity-25 text-danger') ?>" style="padding: 6px 12px; border: 1px solid currentColor;">
                                        <?= htmlspecialchars($prod['quantity']) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php 
                                    $isFeatured = (int) ($prod['featured'] ?? 0) === 1;
                                    $isOnSale = (int) ($prod['sale_discount_percent'] ?? 0) > 0;
                                    ?>
                                    <?php if ($isFeatured): ?>
                                        <span class="badge" style="background: rgba(205, 154, 72, 0.15); color: #CD9A48; border: 1px solid rgba(205, 154, 72, 0.5); padding: 6px 12px;">🌟 Featured</span>
                                    <?php elseif ($isOnSale): ?>
                                        <span class="badge bg-danger bg-opacity-25 text-danger" style="border: 1px solid currentColor; padding: 6px 12px;">🏷️ On Sale</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary bg-opacity-25 text-secondary" style="border: 1px solid currentColor; padding: 6px 12px;">Standard</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="<?= BASE_URL ?>/index.php?page=edit_product&id=<?= $prod['id'] ?>" 
                                           class="btn btn-sm btn-outline-warning rounded-pill px-3 fw-bold action-btn">
                                           ✏️ Edit
                                        </a>
                                        <a href="<?= BASE_URL ?>/index.php?page=delete_product&id=<?= $prod['id'] ?>" 
                                           class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold action-btn"
                                           onclick="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                                           🗑️ Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($products)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <p style="font-size: 3rem; margin-bottom: 10px;">📦</p>
                                    <p class="text-muted fs-5">No products found.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.luxury-table tbody tr:hover {
    background: rgba(193, 154, 78, 0.08) !important;
}

.action-btn {
    transition: all 0.3s ease;
    border-width: 2px;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

.feature-btn {
    font-size: 0.85rem;
    font-weight: 600;
    padding: 5px 12px;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.featured-active {
    background: rgba(205, 154, 72, 0.15);
    color: #CD9A48;
    border-color: rgba(205, 154, 72, 0.5);
}

.featured-active:hover {
    background: rgba(205, 154, 72, 0.25);
    color: #ffd700;
}

.featured-inactive {
    background: rgba(255, 255, 255, 0.05);
    color: #888;
    border-color: rgba(255, 255, 255, 0.1);
}

.featured-inactive:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #ccc;
}
</style>
