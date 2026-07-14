<!-- Keyframes for Admin Sale Products Hero & Animations -->
<style>
@keyframes adminSaleFadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes adminSaleShimmer {
    0%   { background-position: 0% center; }
    100% { background-position: 200% center; }
}
.admin-sale-hero {
    background: linear-gradient(135deg, rgba(26, 15, 10, 0.88) 0%, rgba(14, 8, 5, 0.94) 100%),
                url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&q=80&w=1400') center/cover no-repeat;
    border: 1px solid rgba(202, 151, 69, 0.45);
    box-shadow: 0 15px 35px rgba(0,0,0,0.45);
    animation: adminSaleFadeIn 0.7s cubic-bezier(.16,1,.3,1) both;
}
.admin-sale-hero h2 span {
    display: block;
    background: linear-gradient(to right, #ca9745, #f9ebb3, #ca9745);
    background-size: 200% auto;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: adminSaleShimmer 4s linear infinite;
}
.admin-sale-strip {
    background: linear-gradient(90deg, #ca9745 0%, #ca9745 33%, #ca9745 66%, #f2c96d 100%);
    background-size: 200% auto;
    color: #1a0f0a !important;
    font-weight: 800;
    text-align: center;
    padding: 10px;
    letter-spacing: 1.5px;
    font-size: 0.85rem;
    animation: adminSaleShimmer 3s linear infinite;
    border-radius: 50px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.25);
}
</style>

<!-- Luxury Executive Hero Card with Photo & Animation -->
<div class="admin-sale-hero p-4 p-md-5 mb-4 rounded-4 position-relative overflow-hidden">
    <div class="position-absolute top-0 end-0 p-5 opacity-10 pointer-events-none d-none d-lg-block" style="transform: translate(10%, -10%);">
        <i class="bi bi-tag-fill text-warning" style="font-size: 15rem;"></i>
    </div>
    <div class="position-relative z-1 text-center text-md-start">
        <h2 class="mb-2 fw-bolder" style="font-size: 2.4rem; letter-spacing: -0.5px;">
            Sale Products
            <span>& DYNAMIC PRICING</span>
        </h2>
        <p class="mb-0 mt-2" style="max-width: 680px; font-size: 1.05rem; line-height: 1.5;">Mark garments for exclusive seasonal discounts and preview live promotional pricing. All items marked as sale update automatically across the storefront showcase.</p>
        <div class="mt-4 d-flex flex-wrap gap-3 align-items-center justify-content-center justify-content-md-start">
            <a href="<?= url('') ?>admin_products" class="btn px-4 py-3 rounded-pill d-flex align-items-center gap-2 shadow-sm" style="background: linear-gradient(135deg, #ca9745, #e8c547); color: #1a0f0a; border: none; font-weight: 800; font-size: 0.96rem; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 25px rgba(202, 151, 69, 0.6)';" onmouseout="this.style.transform='translateY(0)';">
                <i class="bi bi-box-seam-fill fs-5"></i> All Catalog Products
            </a>
            <a href="<?= url('') ?>add_product" class="btn px-4 py-3 rounded-pill d-flex align-items-center gap-2 shadow-sm" style="background: rgba(202, 151, 69, 0.18); color: #ca9745; border: 1px solid rgba(202, 151, 69, 0.5); font-weight: 700; font-size: 0.96rem; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.background='rgba(202, 151, 69, 0.3)'; this.style.color='#1a0f0a';" onmouseout="this.style.background='rgba(202, 151, 69, 0.18)'; this.style.color='#ca9745';">
                <i class="bi bi-plus-circle-fill fs-5"></i> Add New Product
            </a>
        </div>
    </div>
</div>

<div class="admin-sale-strip mb-4">
    🔥 SEASONAL CLEARANCE & EXECUTIVE OFFERS • AUTOMATIC DISCOUNT CALCULATIONS 🔥
</div>

<?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-warning border-0 rounded-3 mb-4" role="alert">
        <?= htmlspecialchars($_SESSION['flash']) ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<div class="row mb-4">
    <div class="col-12">
        <div class="card p-4 rounded-4 shadow-sm">
            <div class="row align-items-center gy-3">
                <div class="col-md-6">
                    <h5 class="mb-1 fw-bold" style="font-size: 1.3rem;">Sale Discount Preview</h5>
                    <p class="mb-0 text-muted" style="font-size: 1.05rem; font-weight: 500; line-height: 1.4;">Enter a discount percentage and the sale prices update for all sale items below.</p>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-dark text-white fw-bold border-secondary">%</span>
                        <?php $lastDiscount = isset($_GET['last_discount']) ? (int)$_GET['last_discount'] : 20; ?>
                        <input id="sale-discount" type="number" min="0" max="100" step="1" value="<?= $lastDiscount ?>" class="form-control fw-bold text-center" placeholder="Enter discount percentage" style="font-size: 1.1rem; border-color: rgba(202, 151, 69, 0.5);">
                    </div>
                </div>
                <div class="col-md-3 text-md-end">
                    <button id="apply-sale-discount" type="button" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm" style="background: linear-gradient(135deg, #ca9745, #e8c547); border: none; color: #1a0f0a;">Preview Sale</button>
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
                        <form action="<?= url('') ?>toggle_sale_product" method="post" class="d-inline sale-toggle-form">
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
