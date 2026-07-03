<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-white mb-0">Sale Products</h2>
        <p class="text-muted mb-0">Mark products as sale items and preview sale pricing automatically.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= BASE_URL ?>/index.php?page=admin_products" class="btn btn-primary px-4 rounded-pill">
            View Products
        </a>
    </div>
</div>

<?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-warning border-0 rounded-3 mb-4" role="alert">
        <?= htmlspecialchars($_SESSION['flash']) ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<div class="row mb-4">
    <div class="col-12">
        <div class="p-4 rounded-4 bg-light bg-opacity-10 border border-secondary border-opacity-10">
            <div class="row align-items-center gy-3">
                <div class="col-md-6">
                    <h5 class="mb-1 text-white">Sale Discount Preview</h5>
                    <p class="text-muted mb-0">Enter a discount percentage and the sale prices update for all sale items below.</p>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-dark text-white">%</span>
                        <?php $lastDiscount = isset($_GET['last_discount']) ? (int)$_GET['last_discount'] : 20; ?>
                        <input id="sale-discount" type="number" min="0" max="100" step="1" value="<?= $lastDiscount ?>" class="form-control" placeholder="Enter discount percentage">
                    </div>
                </div>
                <div class="col-md-3 text-md-end">
                    <button id="apply-sale-discount" type="button" class="btn btn-outline-primary rounded-pill px-4">Preview Sale</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="table-responsive">
        <table class="table text-center align-middle">
            <thead>
                <tr>
                    <th>PID</th>
                    <th>Article No.</th>
                    <th>Name</th>
                    <th>Product Image</th>
                    <th>QTY</th>
                    <th>Price</th>
                    <th>Sale Price</th>
                    <th>Sale Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $prod): ?>
                <?php $saleDiscount = (int) ($prod['sale_discount_percent'] ?? 0); ?>
                <tr data-original-price="<?= htmlspecialchars((string)$prod['price']) ?>" data-db-discount="<?= $saleDiscount ?>">
                    <td><?= htmlspecialchars($prod['id']) ?></td>
                    <td><?= htmlspecialchars($prod['article_number']) ?></td>
                    <td><?= htmlspecialchars($prod['name']) ?></td>
                    <td>
                        <?php $productImage = strtok($prod['image_url'], ','); ?>
                        <img src="<?= BASE_URL ?>/<?= htmlspecialchars(trim($productImage)) ?>" width="70">
                    </td>
                    <td><?= htmlspecialchars($prod['quantity']) ?></td>
                    <td class="original-price-cell">$<?= number_format($prod['price'], 2) ?></td>
                    <td class="sale-price-cell" data-original-price="<?= htmlspecialchars((string)$prod['price']) ?>">
                        <?php if ($saleDiscount > 0): ?>
                            <span class="text-success fw-bold">$<?= number_format($prod['price'] * (1 - ($saleDiscount / 100)), 2) ?></span>
                            <small class="text-muted">(<?= $saleDiscount ?>%)</small>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($saleDiscount > 0): ?>
                            <span class="badge bg-success">On Sale</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Not on Sale</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <form action="<?= BASE_URL ?>/index.php?page=toggle_sale_product" method="post" class="d-inline sale-toggle-form">
                            <input type="hidden" name="id" value="<?= $prod['id'] ?>">
                            <input type="hidden" name="sale_action" value="<?= $saleDiscount > 0 ? 'remove' : 'add' ?>">
                            <input type="hidden" name="discount" class="sale-discount-input" value="<?= $saleDiscount > 0 ? $saleDiscount : 20 ?>">
                            <input type="hidden" name="redirect_to" value="admin_sale_products">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
                            <button type="submit" class="btn btn-sm <?= $saleDiscount > 0 ? 'btn-warning' : 'btn-info' ?> rounded-pill">
                                <?= $saleDiscount > 0 ? '✕ Remove Sale' : '⭐ Add Sale' ?>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    const discountInput = document.getElementById('sale-discount');
    const applyDiscountButton = document.getElementById('apply-sale-discount');

    if (discountInput) {
        const savedDiscount = localStorage.getItem('stitchsmart_sale_discount');
        const urlParams = new URLSearchParams(window.location.search);
        if (savedDiscount !== null && !urlParams.has('last_discount')) {
            discountInput.value = savedDiscount;
        }
    }

    const syncDiscountInputs = () => {
        let typedDiscount = parseFloat(discountInput.value);
        if (!Number.isFinite(typedDiscount)) {
            typedDiscount = 0; 
        }
        const discount = Math.min(Math.max(typedDiscount, 0), 100);
        
        if (discount > 0) {
            localStorage.setItem('stitchsmart_sale_discount', discount);
        }

        document.querySelectorAll('.sale-discount-input').forEach(hiddenInput => {
            hiddenInput.value = String(discount);
        });

        return discount;
    };

    const updateSalePreview = () => {
        try {
            const discount = syncDiscountInputs();

            document.querySelectorAll('tbody tr').forEach(row => {
                const saleStatus = row.querySelector('.badge');
                const salePriceCell = row.querySelector('.sale-price-cell');
                if (!salePriceCell) return;
                const price = parseFloat(row.dataset.originalPrice || salePriceCell.dataset.originalPrice || 0) || 0;

                const dbDiscount = parseInt(row.dataset.dbDiscount || 0);

                if (saleStatus && saleStatus.textContent.trim() === 'Not on Sale') {
                    if (discount > 0) {
                        const salePrice = price * (1 - discount / 100);
                        salePriceCell.innerHTML = `<span class="text-primary">Preview: $${salePrice.toFixed(2)}</span>`;
                    } else {
                        salePriceCell.innerHTML = `$${price.toFixed(2)}`;
                    }
                } else if (saleStatus && saleStatus.textContent.trim() === 'On Sale') {
                    const form = row.querySelector('.sale-toggle-form');
                    if (form) {
                        const actionInput = form.querySelector('input[name="sale_action"]');
                        const btn = form.querySelector('button[type="submit"]');

                        if (discount !== dbDiscount && discount > 0) {
                            const salePrice = price * (1 - discount / 100);
                            salePriceCell.innerHTML = `<span class="text-warning">Update to: $${salePrice.toFixed(2)}</span>`;
                            actionInput.value = 'add';
                            btn.className = 'btn btn-sm btn-primary rounded-pill';
                            btn.innerHTML = '🔄 Update Sale';
                        } else {
                            const salePrice = price * (1 - dbDiscount / 100);
                            salePriceCell.innerHTML = `<span class="text-success fw-bold">$${salePrice.toFixed(2)}</span> <small class="text-muted">(${dbDiscount}%)</small>`;
                            actionInput.value = 'remove';
                            btn.className = 'btn btn-sm btn-warning rounded-pill';
                            btn.innerHTML = '✕ Remove Sale';
                        }
                    }
                }
            });
        } catch (error) {
            console.error("Preview error: ", error);
        }
    };

    if (discountInput && applyDiscountButton) {
        applyDiscountButton.addEventListener('click', (e) => {
            e.preventDefault();
            updateSalePreview();
        });
        discountInput.addEventListener('input', updateSalePreview);

        document.querySelectorAll('.sale-toggle-form').forEach(form => {
            form.addEventListener('submit', () => {
                syncDiscountInputs();
            });
        });

        updateSalePreview();
    }
</script>
