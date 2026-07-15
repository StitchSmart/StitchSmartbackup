<!-- Luxury Executive Header Card -->
<div class="admin-header-card p-4 p-md-5 mb-4 rounded-4 position-relative overflow-hidden">
    <div class="position-absolute top-0 end-0 p-5 opacity-10 pointer-events-none d-none d-lg-block" style="transform: translate(15%, -15%);">
        <i class="bi bi-heart-fill text-warning" style="font-size: 15rem;"></i>
    </div>
    <div class="position-relative z-1 text-center text-md-start">
        <div>
            <h2 class="mb-2 fw-bolder" style="font-size: 2.4rem; letter-spacing: -0.5px;">Wishlist Intelligence</h2>
            <p class="mb-0 mt-2" style="max-width: 680px; font-size: 1.05rem; line-height: 1.5;">Monitor high-intent customer bookmarks across your tailoring collections. Identify trending bespoke items, track unique client interests, and trigger personalized discount voucher campaigns directly to potential buyers.</p>
        </div>
        <div class="mt-4 d-flex flex-wrap gap-3 align-items-center justify-content-center justify-content-md-start">
            <a href="<?= url('') ?>admin_products" class="btn px-4 py-3 rounded-pill d-flex align-items-center gap-2 shadow-sm" style="background: linear-gradient(135deg, #ca9745, #e8c547); color: #1a0f0a; border: none; font-weight: 800; font-size: 0.96rem; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 25px rgba(202, 151, 69, 0.6)';" onmouseout="this.style.transform='translateY(0)';">
                <i class="bi bi-box-seam-fill fs-5"></i> Products Inventory
            </a>
            <a href="<?= url('') ?>sales_report" class="btn px-4 py-3 rounded-pill d-flex align-items-center gap-2 shadow-sm" style="background: rgba(202, 151, 69, 0.18); color: #ca9745; border: 1px solid rgba(202, 151, 69, 0.5); font-weight: 700; font-size: 0.96rem; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.background='rgba(202, 151, 69, 0.3)'; this.style.color='#1a0f0a';" onmouseout="this.style.background='rgba(202, 151, 69, 0.18)'; this.style.color='#ca9745';">
                <i class="bi bi-graph-up-arrow fs-5"></i> Sales Analytics
            </a>
            <span class="badge rounded-pill px-4 py-3 d-flex align-items-center gap-2" style="background: rgba(0,0,0,0.3); color: #f5e4d0; border: 1px solid rgba(202, 151, 69, 0.4); font-size: 0.92rem;">
                <i class="bi bi-bookmark-heart-fill text-warning fs-5"></i> <?= (int)$totalWishlistItems ?> Active Bookmarks
            </span>
        </div>
    </div>
</div>

<div class="container-fluid mb-5">
    <!-- Stat Cards Row -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="p-4 rounded-4 shadow-sm border position-relative overflow-hidden h-100" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px); border-color: rgba(202, 151, 69, 0.4) !important;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="text-uppercase small fw-bolder" style="color: #1a0f0a; letter-spacing: 1px;">Total Bookmarked Items</span>
                        <h2 class="display-5 fw-bolder mt-2 mb-0" style="color: #ca9745; filter: drop-shadow(0 2px 4px rgba(202,151,69,0.2));"><?= (int)$totalWishlistItems ?></h2>
                    </div>
                    <div class="p-3 rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="background: rgba(202, 151, 69, 0.15); width: 56px; height: 56px;">
                        <i class="bi bi-heart-fill fs-4" style="color: #ca9745;"></i>
                    </div>
                </div>
                <div class="mt-3 small fw-semibold" style="color: #4a3b2c;"><i class="bi bi-arrow-up-right text-success fw-bold"></i> High-intent products saved by active clients</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 rounded-4 shadow-sm border position-relative overflow-hidden h-100" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px); border-color: rgba(202, 151, 69, 0.4) !important;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="text-uppercase small fw-bolder" style="color: #1a0f0a; letter-spacing: 1px;">Unique Prospective Buyers</span>
                        <h2 class="display-5 fw-bolder mt-2 mb-0" style="color: #ca9745; filter: drop-shadow(0 2px 4px rgba(202,151,69,0.2));"><?= (int)$uniqueCustomers ?></h2>
                    </div>
                    <div class="p-3 rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="background: rgba(202, 151, 69, 0.15); width: 56px; height: 56px;">
                        <i class="bi bi-people-fill fs-4" style="color: #ca9745;"></i>
                    </div>
                </div>
                <div class="mt-3 small fw-semibold" style="color: #4a3b2c;"><i class="bi bi-envelope-check text-warning fw-bold"></i> Ready for targeted email outreach</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 rounded-4 shadow-sm border position-relative overflow-hidden h-100" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px); border-color: rgba(202, 151, 69, 0.4) !important;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="text-uppercase small fw-bolder" style="color: #1a0f0a; letter-spacing: 1px;">Top Wishlisted Designs</span>
                        <h2 class="display-5 fw-bolder mt-2 mb-0" style="color: #ca9745; filter: drop-shadow(0 2px 4px rgba(202,151,69,0.2));"><?= count($topProducts) ?></h2>
                    </div>
                    <div class="p-3 rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="background: rgba(202, 151, 69, 0.15); width: 56px; height: 56px;">
                        <i class="bi bi-trophy-fill fs-4" style="color: #ca9745;"></i>
                    </div>
                </div>
                <div class="mt-3 small fw-semibold" style="color: #4a3b2c;"><i class="bi bi-fire text-danger fw-bold"></i> Currently trending in customer wishlists</div>
            </div>
        </div>
    </div>

    <!-- Top Wishlisted Products Section -->
    <div class="card border-0 rounded-4 shadow-sm mb-5 overflow-hidden">
        <div class="card-header py-4 px-4 border-bottom d-flex align-items-center justify-content-between">
            <h4 class="mb-0 fw-bold d-flex align-items-center gap-2">
                <i class="bi bi-star-fill text-warning"></i> Most Bookmarked Tailoring Items
            </h4>
            <span class="badge rounded-pill px-3 py-2" style="background: rgba(202, 151, 69, 0.2); color: #ca9745;">Ranked by Popularity</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: rgba(0,0,0,0.15);">
                    <tr>
                        <th class="py-3 px-4" style="width: 70px;">Rank</th>
                        <th class="py-3">Tailoring Product Name</th>
                        <th class="py-3">Article Number</th>
                        <th class="py-3 text-end px-4">Total Wishlist Bookmarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($topProducts)): ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                No wishlisted products recorded yet.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($topProducts as $index => $product): ?>
                            <tr>
                                <td class="px-4 fw-bold">
                                    <span class="badge rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: <?= $index === 0 ? 'linear-gradient(135deg, #ca9745, #f2c96d); color:#1a0f0a;' : 'rgba(202,151,69,0.15); color:#ca9745;' ?> font-weight:800;">
                                        <?= $index + 1 ?>
                                    </span>
                                </td>
                                <td class="fw-bold fs-6"><?= htmlspecialchars($product['product_name']) ?></td>
                                <td><span class="badge bg-secondary px-3 py-2 rounded-pill"><?= htmlspecialchars($product['article_number']) ?></span></td>
                                <td class="text-end px-4">
                                    <span class="badge rounded-pill px-3 py-2 fs-6" style="background: rgba(202, 151, 69, 0.25); color: #e8c547; border: 1px solid rgba(202, 151, 69, 0.4);">
                                        <i class="bi bi-heart-fill pe-1"></i> <?= (int)$product['count'] ?> Clients
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Full Wishlist Customer Entries Table -->
    <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
        <div class="card-header py-4 px-4 border-bottom d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h4 class="mb-1 fw-bold d-flex align-items-center gap-2">
                    <i class="bi bi-list-stars text-warning"></i> Live Customer Wishlist Directory & Conversion Console
                </h4>
                <p class="small text-muted mb-0">Review individual client bookmarks and instantly dispatch customized promotional voucher offers.</p>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: rgba(0,0,0,0.15);">
                    <tr>
                        <th class="py-3 px-4">#</th>
                        <th class="py-3">Client Information</th>
                        <th class="py-3">Bookmarked Item</th>
                        <th class="py-3">Article #</th>
                        <th class="py-3">Price</th>
                        <th class="py-3">Saved Timestamp</th>
                        <th class="py-3 text-end px-4">Conversion Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($wishlistEntries)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-heart-break fs-1 d-block mb-2"></i>
                                No customer wishlist bookmarks stored at this time.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($wishlistEntries as $index => $entry): ?>
                            <tr>
                                <td class="px-4 text-muted fw-bold"><?= $index + 1 ?></td>
                                <td>
                                    <div class="fw-bold fs-6"><?= htmlspecialchars($entry['customer_name']) ?></div>
                                    <div class="small text-muted d-flex align-items-center gap-1">
                                        <i class="bi bi-envelope"></i> <?= htmlspecialchars($entry['customer_email']) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <?php if (!empty($entry['image_url'])): ?>
                                            <img src="<?= BASE_URL ?>/<?= htmlspecialchars($entry['image_url']) ?>" alt="<?= htmlspecialchars($entry['product_name']) ?>" class="rounded-3 shadow-sm border" style="width: 55px; height: 55px; object-fit: cover;" />
                                        <?php else: ?>
                                            <div class="rounded-3 d-flex align-items-center justify-content-center bg-secondary text-white" style="width: 55px; height: 55px;">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <div class="fw-bold"><?= htmlspecialchars($entry['product_name']) ?></div>
                                            <div class="small text-warning fw-semibold"><i class="bi bi-box-seam pe-1"></i> Stock: <?= (int)$entry['quantity'] ?> units</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-dark border px-3 py-2 rounded-pill"><?= htmlspecialchars($entry['article_number']) ?></span></td>
                                <td class="fw-bold fs-6" style="color: #ca9745;">Rs. <?= number_format((float)$entry['price'], 2) ?></td>
                                <td class="small text-muted"><?= htmlspecialchars($entry['created_at']) ?></td>
                                <td class="text-end px-4">
                                    <a href="<?= url('') ?>send_customer_voucher&email=<?= urlencode($entry['customer_email']) ?>&name=<?= urlencode($entry['customer_name']) ?>&product=<?= urlencode($entry['product_name']) ?>&article=<?= urlencode($entry['article_number']) ?>" class="btn px-3 py-2 rounded-pill shadow-sm d-inline-flex align-items-center gap-2" style="background: linear-gradient(135deg, #ca9745, #e8c547); color: #1a0f0a; border: none; font-weight: 700; font-size: 0.88rem; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 6px 16px rgba(202, 151, 69, 0.6)';" onmouseout="this.style.transform='scale(1)';">
                                        <i class="bi bi-gift-fill"></i> Send Voucher Mail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
