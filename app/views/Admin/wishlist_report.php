<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-transparent border-0 py-4 px-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <p class="text-uppercase text-muted small fw-semibold mb-1">Wishlist Insights</p>
                <h2 class="h4 mb-0">Saved products by customers</h2>
            </div>
            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><?= (int)$totalWishlistItems ?> total saved items</span>
        </div>
    </div>

    <div class="card-body px-4 pb-4">
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="border rounded-4 p-3 bg-body-tertiary">
                    <div class="text-warning small fw-bold">Saved items</div>
                    <div class="h3 text-warning fw-bold mb-0 mt-2"><?= (int)$totalWishlistItems ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="border rounded-4 p-3 bg-body-tertiary">
                    <div class="text-warning small fw-bold">Unique customers</div>
                    <div class="h3 text-warning fw-bold mb-0 mt-2"><?= (int)$uniqueCustomers ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="border rounded-4 p-3 bg-body-tertiary">
                    <div class="text-warning small fw-bold">Top wishlisted products</div>
                    <div class="h3 text-warning fw-bold mb-0 mt-2"><?= count($topProducts) ?></div>
                </div>
            </div>
        </div>

        <div class="border rounded-4 overflow-hidden mb-4">
            <div class="p-3 border-bottom bg-body-tertiary">
                <h5 class="mb-0 text-warning fw-bold">Most saved products</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Article #</th>
                            <th>Saved count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($topProducts)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">No wishlisted products found yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($topProducts as $index => $product): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($product['product_name']) ?></td>
                                    <td><?= htmlspecialchars($product['article_number']) ?></td>
                                    <td><span class="badge bg-primary rounded-pill"><?= (int)$product['count'] ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="border rounded-4 overflow-hidden">
            <div class="p-3 border-bottom bg-body-tertiary">
                <h5 class="mb-0">Customer wishlist entries</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Product</th>
                            <th>Article #</th>
                            <th>Price</th>
                            <th>Saved At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($wishlistEntries)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No wishlist entries saved yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($wishlistEntries as $index => $entry): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($entry['customer_name']) ?></td>
                                    <td><?= htmlspecialchars($entry['customer_email']) ?></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <?php if (!empty($entry['image_url'])): ?>
                                                <img src="<?= BASE_URL ?>/<?= htmlspecialchars($entry['image_url']) ?>" alt="<?= htmlspecialchars($entry['product_name']) ?>" style="width:50px;height:50px;object-fit:cover;border-radius:8px;" />
                                            <?php endif; ?>
                                            <div>
                                                <div class="fw-semibold"><?= htmlspecialchars($entry['product_name']) ?></div>
                                                <div class="small text-muted">Stock: <?= (int)$entry['quantity'] ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($entry['article_number']) ?></td>
                                    <td>₹<?= number_format((float)$entry['price'], 2) ?></td>
                                    <td><?= htmlspecialchars($entry['created_at']) ?></td>
                                    <td>
                                        <a href="<?= BASE_URL ?>/index.php?page=send_customer_voucher&email=<?= urlencode($entry['customer_email']) ?>&name=<?= urlencode($entry['customer_name']) ?>&product=<?= urlencode($entry['product_name']) ?>&article=<?= urlencode($entry['article_number']) ?>" class="btn btn-sm btn-success d-inline-flex align-items-center gap-2" title="Send discount voucher email">
                                            <i class="bi bi-envelope-fill"></i> Send Mail
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
</div>
