<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?=$webname ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="<?= BASE_URL ?>/css/navbar.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>/css/footer.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>/css/style.css?v=<?= time() ?>" rel="stylesheet">
  <link href="<?= BASE_URL ?>/css/<?= $global_theme ?? 'theme-luxury' ?>-frontend.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>/css/luxury_theme.css?v=<?= time() ?>" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
/* =====================================================
   HOME PAGE FEATURES STRIP - SLEEK, COMPACT & LUXURY
===================================================== */
@keyframes iconBounce {
    0%, 100% { transform: scale(1); }
    50%      { transform: scale(1.15) rotate(5deg); }
}

.features-strip {
    background: <?= (($global_theme ?? 'theme-luxury') === 'theme-luxury') ? '#141414' : '#faf7f2' ?> !important;
    border-top: 1px solid <?= (($global_theme ?? 'theme-luxury') === 'theme-luxury') ? 'rgba(202, 151, 69,0.25)' : 'rgba(202, 151, 69,0.2)' ?>;
    border-bottom: 1px solid <?= (($global_theme ?? 'theme-luxury') === 'theme-luxury') ? 'rgba(202, 151, 69,0.25)' : 'rgba(202, 151, 69,0.2)' ?>;
    padding: 22px 0 !important; /* Very short and compact */
}

.feature-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 4px 8px;
    border-radius: 12px;
    transition: all 0.3s cubic-bezier(0.16,1,0.3,1);
}

.feature-box:hover {
    transform: translateY(-5px);
}

.feature-circle {
    width: 78px !important;
    height: 78px !important;
    border-radius: 50% !important;
    border: 2px solid #ca9745 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    background: <?= (($global_theme ?? 'theme-luxury') === 'theme-luxury') ? '#1e1e1e' : '#ffffff' ?> !important;
    margin: 0 auto 18px auto !important;
    box-shadow: 0 4px 15px rgba(205,154,72,0.15) !important;
    transition: all 0.35s cubic-bezier(0.16,1,0.3,1) !important;
}

.feature-box:hover .feature-circle {
    background: #ca9745 !important;
    border-color: #ca9745 !important;
    box-shadow: 0 10px 25px rgba(205,154,72,0.4) !important;
    transform: scale(1.08) !important;
}

.feature-circle i {
    font-size: 1.35rem !important;
    line-height: 1 !important;
    margin: 0 !important;
    padding: 0 !important;
    color: <?= (($global_theme ?? 'theme-luxury') === 'theme-luxury') ? '#ca9745' : '#ca9745' ?> !important;
    transition: all 0.35s ease !important;
}

.feature-box:hover .feature-circle i {
    color: #ffffff !important;
    animation: iconBounce 0.5s ease !important;
}

.feature-box:hover .feature-circle i {
    color: #ffffff !important;
    animation: iconBounce 0.5s ease;
}

.feature-title {
    font-size: 0.84rem;
    font-weight: 800;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: <?= (($global_theme ?? 'theme-luxury') === 'theme-luxury') ? '#f4e9d3' : '#241812' ?>;
    margin-bottom: 2px;
    transition: color 0.3s ease;
}

.feature-box:hover .feature-title {
    color: #ca9745;
}

.feature-desc {
    font-size: 0.75rem;
    color: <?= (($global_theme ?? 'theme-luxury') === 'theme-luxury') ? '#ca9745' : '#7a5c38' ?>;
    margin-bottom: 0;
    line-height: 1.3;
}

/* =====================================================
   GLOBAL CARD & PRICE ALIGNMENT SYSTEM FOR HOME PAGE
===================================================== */
.prod-card, .featured-card {
    display: flex !important;
    flex-direction: column !important;
    height: 100% !important;
    width: 100% !important;
    flex: 1 1 100% !important;
}
.circle-icon-btn, .btn.circle-icon-btn {
    width: 44px !important;
    height: 44px !important;
    min-width: 44px !important;
    max-width: 44px !important;
    min-height: 44px !important;
    max-height: 44px !important;
    border-radius: 50% !important;
    padding: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    flex-shrink: 0 !important;
}
.prod-img, .card-top {
    height: 260px !important;
    overflow: hidden !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}
.prod-info, .card-bottom {
    display: flex !important;
    flex-direction: column !important;
    flex-grow: 1 !important;
    justify-content: space-between !important;
    padding: 16px !important;
    text-align: center !important;
}
.prod-info h3, .card-bottom .desc {
    height: 44px !important;
    display: -webkit-box !important;
    -webkit-line-clamp: 2 !important;
    -webkit-box-orient: vertical !important;
    overflow: hidden !important;
    line-height: 1.4 !important;
    margin-bottom: 10px !important;
    font-weight: 700 !important;
}
.price-box, .price-row {
    display: flex !important;
    flex-direction: column !important;
    justify-content: center !important;
    align-items: center !important;
    gap: 4px !important;
    height: 56px !important;
    margin-bottom: 12px !important;
    width: 100% !important;
}
.price-top-line {
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    gap: 8px !important;
    width: 100% !important;
}
.prod-price2, .current-price, .old-price, .badge {
    white-space: nowrap !important;
}
.prod-price2, .current-price {
    font-size: 1.18rem !important;
    font-weight: 800 !important;
    line-height: 1.2 !important;
}
</style>
</head>
<body>
<?php include('header.php'); ?>

<!-- Banner Carousel (At the top) -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="false">
    <div class="carousel-indicators">
        <?php foreach($banners as $i => $row): ?>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $i ?>" class="<?= ($i == 0) ? 'active' : '' ?>"></button>
        <?php endforeach; ?>
    </div>

    <div class="carousel-inner">
        <?php foreach($banners as $i => $row): ?>
            <div class="carousel-item <?= ($i == 0) ? 'active' : '' ?>" style="background-image: url('<?= BASE_URL . '/' . $row['image_url']; ?>'); background-size: cover; background-position: center; height: 500px;">
                <div class="overlay" style="background: rgba(0, 0, 0, 0.2); position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></div>
            </div>
        <?php $i++; endforeach; ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
<!-- Luxury Hero Section -->
<section class="luxury-hero">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Side: Content -->
            <div class="col-lg-6">
                <div class="hero-left-content animate-fade-up">
                    <span class="badge mb-3 premium-badge" style="padding: 8px 15px; border-radius: 50px; font-weight: 700;">Premium Collection</span>
                    <h1 style="color: #ca9745 !important;">Shop Smarter,<br>Live Better.</h1>
                    <p>Discover curated premium products handpicked for quality and style. From fashion to electronics — we bring the best to your doorstep.</p>
                    <div class="hero-btns">
                        <a href="<?= url('allproducts') ?>" class="btn-luxury-primary">Browse Collection</a>
                        <a href="<?= url('our-story') ?>" class="btn-luxury-primary">Our Story</a>
                    </div>
                </div>
            </div>
            
            <!-- Right Side: Category Grid -->
            <div class="col-lg-6">
                <div class="hero-right-grid">
                    <?php 
                    $hero_cats = array_slice($categories, 0, 4);
                    foreach($hero_cats as $h_cat): 
                    ?>
                        <a href="<?= url('allproducts?category_id=' . $h_cat['c_id']); ?>" class="luxury-hero-card">
                            <div class="icon-box">
                                <?php $cat_img = !empty($h_cat['c_image']) ? $h_cat['c_image'] : '/pictures/category/default.png'; ?>
                                <img src="<?= BASE_URL ?><?= htmlspecialchars($cat_img); ?>" alt="<?= htmlspecialchars($h_cat['c_name'] ?? ''); ?>">
                            </div>
                            <div class="card-content">
                                <h3><?= htmlspecialchars($h_cat['c_name'] ?? ''); ?></h3>
                                <?php 
                                $minP = isset($h_cat['min_price']) ? (float)$h_cat['min_price'] : 0;
                                ?>
                                <?php if ($minP > 0): ?>
                                <p>From Rs. <?= number_format($minP); ?></p>
                                <?php else: ?>
                                <p>Shop Now</p>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Featured Products Section -->
<section class="featured-section">
    <div class="container">
        <div class="featured-header">
            <div>
                <h2>Featured <span>Products</span></h2>
            </div>
            <a href="<?= url('featured_products') ?>" class="view-all-link">VIEW ALL →</a>
        </div>

        <div class="row g-4">
            <?php 
            $counter = 0;
            foreach($featuredProducts as $product): 
                if($counter >= 4) break;
            ?>
            <div class="col-lg-3 col-md-6 d-flex">
                <div class="featured-card">
                    <div class="card-top">
                        <?php $productImage = strtok($product['image_url'], ','); ?>
                        <img src="<?= BASE_URL ?>/<?= htmlspecialchars(trim($productImage)); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
                    </div>
                    <div class="card-bottom">
                         <?php if(!empty($product['category_name']) || !empty($product['category'])): ?>
                        <span class="category-pill"><?= htmlspecialchars($product['category_name'] ?? $product['category']); ?></span>
                        <?php endif; ?>                        
                        <p class="desc"><?= htmlspecialchars(substr($product['description'], 0, 40)); ?>...</p>
                        <div class="price-row">
                            <span class="current-price">Rs. <?= htmlspecialchars($product['price']); ?></span>
                        </div>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <form method="POST" action="<?= url('cart_add'); ?>" class="m-0">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <input type="hidden" name="qty" value="1">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" name="redirect_to" value="home">
                                <button type="submit" class="btn circle-icon-btn" title="Add to cart">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </form>
                            <form method="POST" action="<?= url('wishlist_toggle'); ?>" class="m-0">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <input type="hidden" name="redirect_to" value="home">
                                <button type="submit" class="btn circle-icon-btn" title="Wishlist">
                                    <i class="bi <?= in_array($product['id'], $wishlistedProductIds ?? []) ? 'bi-heart-fill text-danger' : 'bi-heart' ?>"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php $counter++; endforeach; ?>
        </div>
    </div>
</section>


<!--Sale Section-->
<section class="sale-section py-5">
  <div class="container">
    <div class="featured-header">
        <div>
            <h2>Sale <span>Products</span></h2>
        </div>
        <a href="<?= url('sale') ?>" class="view-all-link">VIEW ALL →</a>
    </div>
    <div class="row py-4 g-4 d-flex justify-content-center">
        <?php foreach($products as $product): ?>
            <?php $discountAmount = isset($product['sale_discount_percent']) ? (int)$product['sale_discount_percent'] : 0; ?>
            <?php if ($discountAmount <= 0) continue; ?> <!-- Skip non-sale products -->

            <div class="col-md-3 col-sm-6 d-flex">
                <div class="prod-card shadow-sm rounded">
                    <div class="prod-img position-relative">
                        <?php $productImage = strtok($product['image_url'], ','); ?>
                        <a href="<?= url('product_show?id=' . $product['id']); ?>" class="text-decoration-none text-dark">
                            <img src="<?= BASE_URL ?>/<?= htmlspecialchars(trim($productImage)); ?>" 
                                 alt="<?= htmlspecialchars($product['name']); ?>" class="img-fluid rounded">
                        </a>
                        <?php if(!empty($product['badge'])): ?>
                            <span class="badge bg-danger position-absolute top-0 start-0 m-2"><?= htmlspecialchars($product['badge']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="prod-info p-2 text-center">
                        <a href="<?= url('product_show?id=' . $product['id']); ?>" class="text-decoration-none text-dark">
                            <h3 class="h6"><?= htmlspecialchars($product['name']); ?></h3>
                        </a>
                        <div class="price-box mt-1">
                        <?php if(isset($product['sale_discount_percent']) && (int)$product['sale_discount_percent'] > 0): ?>
                            <?php 
                                $discount = (int)$product['sale_discount_percent'];
                                $oldPrice = (float)$product['price'];
                                $newPrice = $oldPrice * (1 - $discount / 100);
                            ?>
                            <div class="price-top-line">
                                <span class="old-price text-muted text-decoration-line-through">Rs. <?= number_format($oldPrice, 2); ?></span>
                                <span class="badge bg-danger">-<?= $discount ?>%</span>
                            </div>
                            <span class="prod-price2 fw-bold luxury-price">Rs. <?= number_format($newPrice, 2); ?></span>
                        <?php else: ?>
                            <span class="prod-price2 fw-bold luxury-price">Rs. <?= htmlspecialchars($product['price']); ?></span>
                        <?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <form method="POST" action="<?= url('cart_add'); ?>" class="m-0">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <input type="hidden" name="qty" value="1">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" name="redirect_to" value="sale">
                                <button type="submit" class="btn circle-icon-btn" title="Add to cart">
                                    <i class="bi bi-cart-plus-fill"></i>
                                </button>
                            </form>
                            <form method="POST" action="<?= url('wishlist_toggle'); ?>" class="m-0">
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

        
    </div>
    </section>





<!-- Features Strip (above footer) -->
<section class="features-strip">
  <div class="container">
    <div class="row text-center g-4 justify-content-center">

      <!-- Feature 1 -->
      <div class="col-6 col-md-3">
        <div class="feature-box">
          <div class="feature-circle">
            <i class="bi bi-truck"></i>
          </div>
          <h4 class="feature-title">FREE SHIPPING</h4>
          <p class="feature-desc">On all orders over Rs. 7,500.00</p>
        </div>
      </div>

      <!-- Feature 2 -->
      <div class="col-6 col-md-3">
        <div class="feature-box">
          <div class="feature-circle">
            <i class="bi bi-arrow-repeat"></i>
          </div>
          <h4 class="feature-title">FREE RETURNS</h4>
          <p class="feature-desc">Returns are free within 9 days</p>
        </div>
      </div>

      <!-- Feature 3 -->
      <div class="col-6 col-md-3">
        <div class="feature-box">
          <div class="feature-circle">
            <i class="bi bi-shield-check"></i>
          </div>
          <h4 class="feature-title">100% PAYMENT SECURE</h4>
          <p class="feature-desc">Your payments are safe with us</p>
        </div>
      </div>

      <!-- Feature 4 -->
      <div class="col-6 col-md-3">
        <div class="feature-box">
          <div class="feature-circle">
            <i class="bi bi-headset"></i>
          </div>
          <h4 class="feature-title">SUPPORT 24/7</h4>
          <p class="feature-desc">Contact us 24 hours a day</p>
        </div>
      </div>

    </div>
  </div>
</section>

<?php include('footer.php'); ?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>