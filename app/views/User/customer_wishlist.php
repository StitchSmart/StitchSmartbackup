<?php
// Customer Wishlist Page
if (session_status() === PHP_SESSION_NONE) session_start();
$wishlistEntries = $wishlistEntries ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist - <?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>css/navbar.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>css/footer.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/colors.css">
    <link href="<?= BASE_URL ?>css/single-product.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>css/<?= $global_theme ?? 'theme-luxury' ?>-frontend.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="theme-aware-body">
<?php include('header.php'); ?>
<div class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
        <h2 class="mb-0 text-center text-md-start">My Wishlist</h2>
    </div>
    <?php if (empty($wishlistEntries)): ?>
        <div class="alert alert-info text-center">You have no items in your wishlist yet.</div>
    <?php else: ?>
        <div class="row g-4 justify-content-center">
            <?php foreach ($wishlistEntries as $entry): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow wishlist-card">
                        <div class="wishlist-img-wrap" style="background:#f8f8f8;min-height:220px;display:flex;align-items:center;justify-content:center;">
                            <img src="<?= BASE_URL ?>/<?= htmlspecialchars($entry['image_url']) ?>" class="card-img-top p-3" alt="<?= htmlspecialchars($entry['product_name']) ?>" style="max-height:200px;max-width:100%;object-fit:contain;">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-1" style="font-size:1.1rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="<?= htmlspecialchars($entry['product_name']) ?>">
                                <?= htmlspecialchars($entry['product_name']) ?>
                            </h5>
                            <div class="text-muted mb-2" style="font-size:0.95rem;">Article: <?= htmlspecialchars($entry['article_number']) ?></div>
                            <div class="fw-bold mb-2" style="color:var(--accent-bronze,#ca9745);font-size:1.1rem;">Rs. <?= number_format($entry['price']) ?></div>
                            <div class="mt-auto d-flex justify-content-between align-items-center gap-2">
                                <a href="<?= url('product_show?id=' . $entry['product_id']) ?>" class="btn wishlist-view-btn btn-sm px-3">View</a>

                                <form method="post" action="<?= url('cart_add') ?>" style="display:inline;">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                    <input type="hidden" name="product_id" value="<?= (int)$entry['product_id'] ?>">
                                    <input type="hidden" name="qty" value="1">
                                    <input type="hidden" name="redirect_to" value="customer_wishlist">
                                    <button type="submit" class="btn wishlist-addcart-btn" title="Add to cart" aria-label="Add to cart">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </form>

                                <form method="post" action="<?= url('toggle_wishlist') ?>" style="display:inline;">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                    <input type="hidden" name="product_id" value="<?= (int)$entry['product_id'] ?>">
                                    <input type="hidden" name="redirect_to" value="customer_wishlist">
                                    <button type="submit" class="btn wishlist-remove-btn" title="Remove from wishlist" aria-label="Remove from wishlist">
                                        <i class="bi bi-heart-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php include('footer.php'); ?>
<style>
    .wishlist-card {
        transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
        border-radius: 18px;
        border: 1px solid rgba(202, 151, 69,0.18);
        background: rgba(10,10,10,0.72);
        overflow: hidden;
    }
    .wishlist-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(205,154,72,0.16);
        border-color: rgba(202, 151, 69,0.38);
    }
    .wishlist-img-wrap {
        border-top-left-radius: 18px;
        border-top-right-radius: 18px;
        overflow: hidden;
        background:
            radial-gradient(circle at center, rgba(255,255,255,0.20), rgba(255,255,255,0.08) 25%, rgba(0,0,0,0.14) 72%),
            linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.02));
    }
    .wishlist-view-btn {
        border-radius: 999px;
        border: 1px solid var(--accent-bronze, #ca9745);
        color: #ffffff !important;
        background: var(--accent-bronze, #ca9745);
        font-weight: 700;
        transition: all 0.2s ease;
    }
    .wishlist-view-btn:hover {
        background: #a87931 !important; /* Slightly darker bronze */
        border-color: #a87931 !important;
        color: #ffffff !important;
    }
    .wishlist-addcart-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        width: 2.2rem;
        height: 2.2rem;
        border: 1px solid rgba(202, 151, 69,0.4);
        background: rgba(202, 151, 69,0.12);
        color: #ffffff !important;
        padding: 0;
    }
    .wishlist-addcart-btn:hover {
        background: rgba(202, 151, 69,0.3);
        color: #ffffff !important;
        transform: scale(1.04);
    }
    .wishlist-addcart-btn .bi-cart-plus {
        font-size: 1.1rem;
    }
    .wishlist-remove-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        width: 2.2rem;
        height: 2.2rem;
        border: 1px solid rgba(255,255,255,0.18);
        background: rgba(255,255,255,0.08);
        color: #f8d7da !important;
        padding: 0;
    }
    .wishlist-remove-btn:hover {
        background: rgba(255,255,255,0.16);
        color: #ffffff !important;
        transform: scale(1.04);
    }
    .wishlist-remove-btn .bi-heart-fill {
        font-size: 1.1rem;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
