<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Featured Products | <?= APP_NAME ?></title>

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
/* ---- Keyframes (Matches sale.php exactly) ---- */
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
    0%,100% { box-shadow: 0 0 0 0 rgba(202, 151, 69, 0.45); }
    50%     { box-shadow: 0 0 0 8px rgba(202, 151, 69, 0); }
}
@keyframes slideBar {
    from { width: 0; opacity: 0; }
    to   { width: 70px; opacity: 1; }
}
@keyframes glowPulse {
    0%   { text-shadow: 0 0 10px rgba(202, 151, 69, 0.3); }
    100% { text-shadow: 0 0 28px rgba(202, 151, 69, 0.85), 0 0 50px rgba(202, 151, 69, 0.3); }
}

/* ---- HERO — background image (Matches sale.php) ---- */
.featured-hero {
    background: linear-gradient(135deg, rgba(26,15,10,0.85) 0%, rgba(45,26,18,0.85) 100%),
                url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?auto=format&fit=crop&q=80&w=1400') center/cover no-repeat;
    color: #fff;
    min-height: 280px;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    border-bottom: 2px solid #ca9745;
}
.featured-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: radial-gradient(circle, rgba(202, 151, 69, 0.22) 0%, transparent 65%);
    animation: glowPulse 4s infinite alternate;
    pointer-events: none;
}

/* hero text */
.featured-hero-inner {
    position: relative;
    z-index: 2;
    animation: fadeInDown 0.8s cubic-bezier(.16,1,.3,1) both;
}
.featured-hero-badge {
    display: inline-block;
    background: rgba(202, 151, 69, 0.18);
    border: 1px solid rgba(202, 151, 69, 0.5);
    color: #f2c96d !important;
    font-size: 0.72rem;
    font-weight: 800;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    padding: 5px 16px;
    border-radius: 50px;
    margin-bottom: 14px;
}
.featured-hero h1 {
    font-size: 3.2rem !important;
    font-weight: 900 !important;
    line-height: 1.15 !important;
    color: #fff !important;
    -webkit-text-fill-color: #fff !important;
    background: none !important;
    text-shadow: 0 2px 18px rgba(0,0,0,0.55) !important;
    margin-bottom: 4px !important;
    animation: fadeInDown 0.8s ease 0.1s both !important;
}
.featured-hero h1 span {
    display: block;
    background: linear-gradient(to right, #ca9745, #f9ebb3, #ca9745) !important;
    background-size: 200% auto !important;
    -webkit-background-clip: text !important;
    -webkit-text-fill-color: transparent !important;
    animation: shimmerStrip 4s linear infinite !important;
}
.featured-hero-bar {
    display: block;
    height: 3px;
    background: linear-gradient(90deg, #ca9745, #f2c96d);
    border-radius: 4px;
    margin: 10px auto 14px;
    animation: slideBar 0.9s ease 0.4s both;
    width: 70px;
}
.featured-hero p {
    font-size: 1.05rem !important;
    color: rgba(255,255,255,0.85) !important;
    -webkit-text-fill-color: rgba(255,255,255,0.85) !important;
    font-weight: 400 !important;
    text-shadow: 0 1px 6px rgba(0,0,0,0.5) !important;
    animation: fadeInUp 0.8s ease 0.3s both !important;
}

/* ---- SHIMMER STRIP ---- */
.featured-strip {
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
.featured-title {
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
    border: 1px solid rgba(202, 151, 69, 0.3) !important;
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
    box-shadow: 0 15px 35px rgba(202, 151, 69, 0.15) !important;
    border-color: rgba(202, 151, 69, 0.55) !important;
}

.featured-badge-tag {
    position: absolute;
    top: 12px;
    left: 12px;
    background: linear-gradient(135deg, #ca9745, #f2c96d);
    color: #1a0f0a !important;
    font-size: 11px;
    font-weight: 800;
    padding: 4px 12px;
    border-radius: 20px;
    z-index: 2;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    text-transform: uppercase;
    letter-spacing: 0.5px;
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
    height: 44px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.45;
}

.featured-price {
    font-size: 19px;
    font-weight: 800;
    color: #ca9745 !important;
    white-space: nowrap !important;
    line-height: 1.2;
    margin-bottom: 14px;
    display: block;
}

/* ---- DARK THEME ---- */
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
<?php endif; ?>

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
    border: 1px solid rgba(202, 151, 69, 0.4);
    color: <?= (($global_theme ?? 'theme-luxury') === 'theme-luxury') ? '#fff' : '#555' ?>;
    border-radius: 8px;
    margin: 0 4px;
    min-width: 42px;
    text-align: center;
    transition: 0.2s;
}
.custom-pagination .page-link:hover {
    background-color: rgba(202, 151, 69, 0.1);
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
</head>
<body>
<?php include('header.php'); ?>

<!-- HERO with Background Picture and Animation -->
<section class="featured-hero">
    <div class="container text-center">
        <div class="featured-hero-inner">
            <div class="featured-hero-badge">
                <i class="bi bi-star-fill me-1"></i> Exclusive Selection
            </div>
            <h1>
                HANDPICKED FOR YOU
                <span>FEATURED COLLECTION</span>
            </h1>
            <span class="featured-hero-bar"></span>
            <p>Explore our most distinguished, signature tailoring creations</p>
        </div>
    </div>
</section>

<!-- STRIP with Gold Shimmer Animation -->
<div class="featured-strip">
    ✨ EXCLUSIVE HANDPICKED COLLECTION • PREMIUM CRAFTSMANSHIP ✨
</div>

<div class="main">
    <div class="page2">
        <section class="py-3">
            <div class="container py-5 text-center">
                <h2 class="featured-title">Featured Collection</h2>
                <div class="row g-4 text-start">
                <?php if(empty($products)): ?>
                    <div class="col-12 text-center py-5">
                        <div class="p-5 rounded-4" style="background: <?= (($global_theme ?? 'theme-luxury') === 'theme-luxury') ? 'rgba(26, 15, 10, 0.6)' : '#ffffff' ?>; border: 1px solid rgba(202, 151, 69, 0.3); max-width: 600px; margin: 0 auto;">
                            <i class="bi bi-star text-warning" style="font-size: 3.5rem;"></i>
                            <h4 class="mt-3 fw-bold" style="color: <?= (($global_theme ?? 'theme-luxury') === 'theme-luxury') ? '#fff' : '#1a0f0a' ?>;">No Featured Products Yet</h4>
                            <p class="text-muted">Check back soon for our curated collection of elite designs!</p>
                            <a href="<?= url('allproducts') ?>" class="btn btn-primary rounded-pill px-4 py-2 mt-3" style="background: #ca9745; border: none; color: #111; font-weight: 800;">Browse All Products</a>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach($products as $product): ?>
                    <div class="col-md-6 col-lg-3 mb-4 d-flex">
                        <div class="product-card">
                            <span class="featured-badge-tag"><i class="bi bi-star-fill"></i> Featured</span>
                            <a href="<?= url('product_show?id=' . $product['id']); ?>" class="text-decoration-none">
                                <div class="product-img">
                                    <?php $productImage = strtok($product['image_url'], ','); ?>
                                    <img src="<?= BASE_URL ?>/<?= htmlspecialchars(trim($productImage)); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
                                </div>
                            </a>
                            <div class="product-info">
                                <a href="<?= url('product_show?id=' . $product['id']); ?>" class="text-decoration-none">
                                    <div class="product-title"><?= htmlspecialchars($product['name']); ?></div>
                                </a>
                                <span class="featured-price">Rs. <?= number_format((float)$product['price'], 2); ?></span>
                                <div class="d-flex gap-3 justify-content-center mt-auto">
                                    <form method="POST" action="<?= url('cart_add') ?>" class="m-0">
                                        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                        <input type="hidden" name="qty" value="1">
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                        <input type="hidden" name="redirect_to" value="featured_products">
                                        <button type="submit" class="btn circle-icon-btn" title="Add to cart">
                                            <i class="bi bi-cart-plus-fill"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="<?= url('wishlist_toggle') ?>" class="m-0">
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                        <input type="hidden" name="redirect_to" value="featured_products">
                                        <button type="submit" class="btn circle-icon-btn" title="Wishlist">
                                            <i class="bi <?= in_array($product['id'], $wishlistedProductIds ?? []) ? 'bi-heart-fill text-danger' : 'bi-heart' ?>"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>

                <!-- PAGINATION -->
                <?php if(($totalPages ?? 1) > 1): ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination custom-pagination justify-content-center mt-5">
                        <li class="page-item <?= (($page ?? 1) <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link px-3" href="<?= url('featured_products?p=' . (($page ?? 1) - 1)) ?>" aria-label="Previous">Previous</a>
                        </a>
                        </li>
                        <?php for($i = 1; $i <= ($totalPages ?? 1); $i++): ?>
                            <li class="page-item <?= (($page ?? 1) == $i) ? 'active' : '' ?>">
                                <a class="page-link" href="<?= url('featured_products?p=' . $i) ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= (($page ?? 1) >= ($totalPages ?? 1)) ? 'disabled' : '' ?>">
                            <a class="page-link px-3" href="<?= url('featured_products?p=' . (($page ?? 1) + 1)) ?>" aria-label="Next">Next</a>
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
// Scroll reveal matching sale.php exactly
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
