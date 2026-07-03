<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-white mb-0">Featured Products</h2>
        <p class="text-muted mb-0">Highlight specific products to show them in the featured sections on the homepage.</p>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-primary px-4 rounded-pill" data-bs-toggle="modal" data-bs-target="#addFeatureModal" style="background: linear-gradient(135deg, #CD9A48, #e8c547); border: none; font-weight: 700; box-shadow: 0 4px 15px rgba(205, 154, 72, 0.3);">
            + Add Featured Product
        </button>
        <a href="<?= BASE_URL ?>/index.php?page=admin_products" class="btn btn-outline-light px-4 rounded-pill" style="border-color: rgba(193, 154, 78, 0.5);">
            View All Products
        </a>
    </div>
</div>

<?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-warning border-0 rounded-3 mb-4" role="alert">
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
                                    <span class="badge" style="background: rgba(205, 154, 72, 0.15); color: #CD9A48; border: 1px solid rgba(205, 154, 72, 0.5); padding: 6px 12px;">🌟 Featured</span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="<?= BASE_URL ?>/index.php?page=feature_product&id=<?= $prod['id'] ?>" 
                                       class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold action-btn">
                                       ✕ Remove Feature
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($products)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <p style="font-size: 3rem; margin-bottom: 10px;">🌟</p>
                                    <p class="text-muted fs-5">You haven't featured any products yet.</p>
                                    <button type="button" class="btn btn-outline-warning mt-2 rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addFeatureModal">Select Products to Feature</button>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Adding Feature Products -->
<div class="modal fade" id="addFeatureModal" tabindex="-1" aria-labelledby="addFeatureModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content text-white" style="background: #111; border: 1px solid rgba(205, 154, 72, 0.3);">
      <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
        <h5 class="modal-title" id="addFeatureModalLabel" style="color: #CD9A48;">Select Products to Feature</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
          <div class="table-responsive">
              <table class="table table-hover table-dark mb-0 align-middle luxury-table" style="background: transparent;">
                  <thead style="background: rgba(193, 154, 78, 0.05);">
                      <tr>
                          <th class="ps-4 py-2 text-muted small">Image</th>
                          <th class="py-2 text-muted small">Article No.</th>
                          <th class="py-2 text-muted small">Name</th>
                          <th class="py-2 text-muted small text-end pe-4">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php foreach($available_products as $avail): ?>
                          <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                              <td class="ps-4 py-2">
                                  <?php $avImage = strtok($avail['image_url'], ','); ?>
                                  <img src="<?= BASE_URL ?>/<?= htmlspecialchars(trim($avImage)) ?>" alt="Product" style="width: 40px; height: 40px; object-fit: cover; border-radius: 6px; border: 1px solid rgba(193,154,78,0.2);">
                              </td>
                              <td class="py-2"><small class="text-muted"><?= htmlspecialchars($avail['article_number']) ?></small></td>
                              <td class="py-2"><?= htmlspecialchars($avail['name']) ?></td>
                              <td class="py-2 text-end pe-4">
                                  <a href="<?= BASE_URL ?>/index.php?page=feature_product&id=<?= $avail['id'] ?>" class="btn btn-sm btn-outline-info rounded-pill px-3">⭐ Add Feature</a>
                              </td>
                          </tr>
                      <?php endforeach; ?>
                      <?php if(empty($available_products)): ?>
                          <tr>
                              <td colspan="4" class="text-center py-4 text-muted">No products available to feature.</td>
                          </tr>
                      <?php endif; ?>
                  </tbody>
              </table>
          </div>
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
</style>
