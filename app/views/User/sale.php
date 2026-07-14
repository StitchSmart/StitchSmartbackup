<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sales| <?= APP_NAME ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="<?= BASE_URL ?>css/navbar.css">
<link rel="stylesheet" href="<?= BASE_URL ?>css/colors.css">
<link rel="stylesheet" href="<?= BASE_URL ?>css/footer.css">
<link href="<?= BASE_URL ?>/css/style.css" rel="stylesheet">
<link rel="stylesheet" href="<?= BASE_URL ?>css/cat-product.css">
<link href="<?= BASE_URL ?>css/<?= $global_theme ?? 'theme-luxury' ?>-frontend.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
/* ---- Keyframes ---- */
@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-22px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(22px); }
    to   { opacity: 1; transform: translateY(0); }
}
@keyframes scaleIn {
    from { opacity: 0; transform: scale(0.93); }
    to   { opacity: 1; transform: scale(1); }
}
@keyframes shimmerStrip {
    0%   { background-position: 0% center; }
    100% { background-position: 200% center; }
}
@keyframes pulseGlow {
    0%,100% { box-shadow: 0 0 0 0 rgba(202, 151, 69,0.45); }
    50%      { box-shadow: 0 0 0 8px rgba(202, 151, 69,0); }
}
@keyframes slideBar {
    from { width: 0; opacity: 0; }
    to   { width: 70px; opacity: 1; }
}
@keyframes glowPulse {
    0%   { text-shadow: 0 0 10px rgba(202, 151, 69,0.3); }
    100% { text-shadow: 0 0 28px rgba(202, 151, 69,0.85), 0 0 50px rgba(202, 151, 69,0.3); }
}

/* ---- HERO — background image ---- */
.sale-hero {
    background: linear-gradient(135deg, rgba(26,15,10,0.85) 0%, rgba(45,26,18,0.85) 100%),
                url('https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?auto=format&fit=crop&q=80&w=1200') center/cover no-repeat;
    color: #fff;
    min-height: 220px;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    border-bottom: 2px solid #ca9745;
}
.sale-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: radial-gradient(circle, rgba(202, 151, 69,0.2) 0%, transparent 60%);
    animation: glowPulse 4s infinite alternate;
    pointer-events: none;
}

/* hero text */
.sale-hero-inner {
    position: relative;
    z-index: 2;
    animation: fadeInDown 0.8s cubic-bezier(.16,1,.3,1) both;
}
.sale-hero-badge {
    display: inline-block;
    background: rgba(202, 151, 69,0.18);
    border: 1px solid rgba(202, 151, 69,0.5);
    color: #f2c96d !important;
    font-size: 0.72rem;
    font-weight: 800;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    padding: 5px 16px;
    border-radius: 50px;
    margin-bottom: 14px;
}
.sale-hero h1 {
    font-size: 3rem !important;
    font-weight: 900 !important;
    line-height: 1.15 !important;
    color: #fff !important;
    -webkit-text-fill-color: #fff !important;
    background: none !important;
    text-shadow: 0 2px 18px rgba(0,0,0,0.55) !important;
    margin-bottom: 4px !important;
    animation: fadeInDown 0.8s ease 0.1s both !important;
}
.sale-hero h1 span {
    display: block;
    background: linear-gradient(to right, #ca9745, #f9ebb3, #ca9745) !important;
    background-size: 200% auto !important;
    -webkit-background-clip: text !important;
    -webkit-text-fill-color: transparent !important;
    animation: shimmerStrip 4s linear infinite !important;
}
.sale-hero-bar {
    display: block;
    height: 3px;
    background: linear-gradient(90deg, #ca9745, #f2c96d);
    border-radius: 4px;
    margin: 10px auto 14px;
    animation: slideBar 0.9s ease 0.4s both;
    width: 70px;
}
.sale-hero p {
    font-size: 1rem !important;
    color: rgba(255,255,255,0.80) !important;
    -webkit-text-fill-color: rgba(255,255,255,0.80) !important;
    font-weight: 400 !important;
    text-shadow: 0 1px 6px rgba(0,0,0,0.5) !important;
    animation: fadeInUp 0.8s ease 0.3s both !important;
}

/* ---- SHIMMER STRIP ---- */
.sale-strip {
    background: linear-gradient(90deg, #ca9745 0%, #ca9745 33%, #ca9745 66%, #f2c96d 100%);
    background-size: 200% auto;
    color: #1a0f0a !important;
    font-weight: 800;
    text-align: center;
    padding: 10px;
    letter-spacing: 1.5px;
    font-size: 0.9rem;
    animation: shimmerStrip 3s linear infinite;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    position: relative;
    z-index: 10;
}

/* ---- PAGE BG ---- */
.page2 {
    background: <?= (($global_theme ?? 'theme-luxury') === 'theme-luxury')
        ? 'linear-gradient(to bottom, #111, #1a1a1a)'
        : 'linear-gradient(to bottom, #faf8f5, #f0ebe3)'
    ?> !important;
    padding-bottom: 50px;
}

/* ---- SECTION TITLE ---- */
.sale-title {
    font-family: 'Playfair Display', serif !important;
    font-size: 3rem !important;
    color: #ca9745 !important;
    -webkit-text-fill-color: #ca9745 !important;
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
    display: inline-block;
    background: none !important;
    animation: glowPulse 2s infinite alternate;
}

/* ---- PRODUCT CARDS ---- */
.product-card {
    background: #ffffff !important;
    border: 1px solid rgba(202, 151, 69,0.3) !important;
    border-radius: 12px !important;
    overflow: hidden;
    transition: transform 0.35s cubic-bezier(.16,1,.3,1), box-shadow 0.35s ease, border-color 0.3s ease;
    position: relative;
    height: 100% !important;
    width: 100% !important;
    flex: 1 1 100% !important;
    display: flex;
    flex-direction: column;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;
    animation: scaleIn 0.5s ease both;
}

/* Stagger delays */
.col-md-6:nth-child(1)  .product-card { animation-delay: 0.05s; }
.col-md-6:nth-child(2)  .product-card { animation-delay: 0.10s; }
.col-md-6:nth-child(3)  .product-card { animation-delay: 0.15s; }
.col-md-6:nth-child(4)  .product-card { animation-delay: 0.20s; }
.col-md-6:nth-child(5)  .product-card { animation-delay: 0.25s; }
.col-md-6:nth-child(6)  .product-card { animation-delay: 0.30s; }
.col-md-6:nth-child(7)  .product-card { animation-delay: 0.35s; }
.col-md-6:nth-child(8)  .product-card { animation-delay: 0.40s; }
.col-md-6:nth-child(9)  .product-card { animation-delay: 0.45s; }
.col-md-6:nth-child(10) .product-card { animation-delay: 0.50s; }
.col-md-6:nth-child(11) .product-card { animation-delay: 0.55s; }
.col-md-6:nth-child(12) .product-card { animation-delay: 0.60s; }

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(202, 151, 69,0.15) !important;
    border-color: rgba(202, 151, 69,0.55) !important;
}

.product-img {
    height: 280px;
    overflow: hidden;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}
.product-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s cubic-bezier(.16,1,.3,1);
}
.product-card:hover .product-img img {
    transform: scale(1.06);
}

.product-info {
    padding: 20px;
    text-align: center;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: space-between;
    background: #ffffff !important;
}

.product-title {
    font-size: 15px;
    font-weight: 700;
    color: #241812 !important;
    margin-bottom: 10px;
    /* Fixed exact height so all cards align across 1 or 2 lines */
    height: 44px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.45;
}

.price-row {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 4px;
    height: 58px;
    margin-bottom: 16px;
    width: 100%;
}
.price-top-line {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    width: 100%;
}
.new-price {
    font-size: 19px;
    font-weight: 800;
    color: #241812 !important;
    white-space: nowrap !important;
    line-height: 1.2;
}

/* ---- DARK THEME: card info black — AFTER general rules so they win ---- */
<?php if ((($global_theme ?? 'theme-luxury') === 'theme-luxury')): ?>
.product-card {
    background: #1a1a1a !important;
}
.product-img {
    background: #222 !important;
}
.product-info {
    background: #1a1a1a !important;
}
.product-title {
    color: #f4e9d3 !important;
}
.new-price {
    color: #f4e9d3 !important;
}
<?php endif; ?>
.old-price {
    color: #aaa !important;
    text-decoration: line-through;
    font-size: 14px;
    font-weight: 500;
    white-space: nowrap !important;
}
.inline-discount-badge {
    background: linear-gradient(135deg, #d32f2f, #b71c1c);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 4px;
    white-space: nowrap !important;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 6px rgba(211,47,47,0.25);
}

.circle-icon-btn,
.btn.circle-icon-btn {
    width: 44px !important;
    height: 44px !important;
    min-width: 44px !important;
    max-width: 44px !important;
    min-height: 44px !important;
    max-height: 44px !important;
    border-radius: 50% !important;
    padding: 0 !important;
    background-color: #ca9745 !important;
    color: #111 !important;
    display: inline-flex !important;
    justify-content: center !important;
    align-items: center !important;
    border: none !important;
    transition: 0.3s;
    font-size: 16px;
    flex-shrink: 0 !important;
    animation: pulseGlow 2.5s ease infinite;
}
.circle-icon-btn i { color: #111 !important; }
.circle-icon-btn:hover {
    background-color: #ca9745;
    transform: scale(1.08);
    animation: none;
}

/* ---- PAGINATION ---- */
.custom-pagination .page-link {
    background-color: transparent;
    border: 1px solid rgba(202, 151, 69,0.4);
    color: <?= (($global_theme ?? 'theme-luxury') === 'theme-luxury') ? '#fff' : '#555' ?>;
    border-radius: 8px;
    margin: 0 4px;
    min-width: 42px;
    text-align: center;
    transition: 0.2s;
}
.custom-pagination .page-link:hover {
    background-color: rgba(202, 151, 69,0.1);
    color: #ca9745;
}
.custom-pagination .page-item.active .page-link {
    background-color: #ca9745;
    border-color: #ca9745;
    color: #111;
    font-weight: 700;
}
.custom-pagination .page-item.disabled .page-link {
    color: <?= (($global_theme ?? 'theme-luxury') === 'theme-luxury') ? '#555' : '#bbb' ?>;
    border-color: <?= (($global_theme ?? 'theme-luxury') === 'theme-luxury') ? '#333' : '#ddd' ?>;
    background: transparent;
    opacity: 0.45;
    pointer-events: none;
    cursor: default;
}
</style>

<body>
</head>

<body>
 <?php include('header.php'); ?>

<!-- HERO -->
<section class="sale-hero">
    <div class="container text-center">
        <div class="sale-hero-inner">
            <h1>
                UP TO 80% OFF
                <span>SALE COLLECTION</span>
            </h1>
            <p>Featured pieces selected for the season</p>
            <div class="sale-hero-badge mt-3">
                <i class="bi bi-lightning-fill me-1"></i> Limited Time Offer
            </div>
        </div>
    </div>
</section>

<!-- STRIP -->
<div class="sale-strip">
    FEATURED SALE ITEMS • SHOP NOW
</div>

<div class="main">
    <div class="page2">
<!--Best Sellers-->
<section class="py-3">
  <div class="container py-5 text-center">
    <h2 class="sale-title">Sale Collection</h2>
   <div class="row g-4 text-start">

<?php foreach($products as $product): ?>
  <?php
      $price = (float)$product['price'];
      $oldPrice = $price;
      $discount = max(0, (int) ($product['sale_discount_percent'] ?? 0));
      if ($discount <= 0) {
          continue;
      }
      $newPrice = $price * (1 - ($discount / 100));
  ?>
       <div class="col-md-6 col-lg-3 mb-4 d-flex">
                <div class="product-card">

                    <a href="<?= url('product_show?id=' . $product['id']); ?>" class="text-decoration-none">
                        <div class="product-img">
                            <?php $productImage = strtok($product['image_url'], ','); ?>
                            <img src="<?= BASE_URL ?>/<?= htmlspecialchars(trim($productImage)); ?>"
                                 alt="<?= htmlspecialchars($product['name']); ?>">
                        </div>
                    </a>

                    <div class="product-info">
                        <a href="<?= url('product_show?id=' . $product['id']); ?>" class="text-decoration-none">
                            <div class="product-title">
                                <?= htmlspecialchars($product['name']); ?>
                            </div>
                        </a>

                        <div class="price-row">
                            <div class="price-top-line">
                                <span class="old-price">Rs. <?= number_format($oldPrice, 2); ?></span>
                                <span class="inline-discount-badge">-<?= $discount ?>%</span>
                            </div>
                            <span class="new-price">Rs. <?= number_format($newPrice, 2); ?></span>
                        </div>

                        <div class="d-flex gap-3 justify-content-center mt-auto">
                            <form method="POST" action="<?= url('cart_add') ?>" class="m-0">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <input type="hidden" name="qty" value="1">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" name="redirect_to" value="sale">
                                <button type="submit" class="btn circle-icon-btn" title="Add to cart">
                                    <i class="bi bi-cart-plus-fill"></i>
                                </button>
                            </form>
                            <form method="POST" action="<?= url('wishlist_toggle') ?>" class="m-0">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <input type="hidden" name="redirect_to" value="sale">
                                <button type="submit" class="btn circle-icon-btn" title="Wishlist">
                                    <i class="bi <?= in_array($product['id'], $wishlistedProductIds ?? []) ? 'bi-heart-fill text-danger' : 'bi-heart' ?>"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        <?php endforeach; ?>

        </div>

        <?php if ($totalPages > 1): ?>
        <nav aria-label="Page navigation">
            <ul class="pagination custom-pagination justify-content-center mt-5">
                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link px-3" href="<?= url('sale?p=' . ($page - 1)) ?>" aria-label="Previous">
                        Previous
                    </a>
                </li>
                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                        <a class="page-link" href="<?= url('sale?p=' . $i) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                    <a class="page-link px-3" href="<?= url('sale?p=' . ($page + 1)) ?>" aria-label="Next">
                        Next
                    </a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>

    </div>
</section>
</div>
</div>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Scroll reveal
const obs = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) e.target.style.animationPlayState = 'running';
    });
}, { threshold: 0.08 });

document.querySelectorAll('.product-card').forEach(c => {
    c.style.animationPlayState = 'paused';
    obs.observe(c);
});
</script>
</body>
</html>
