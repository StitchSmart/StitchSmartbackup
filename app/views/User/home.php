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
                    <h1 style="color: #c19a4e !important;">Shop Smarter,<br>Live Better.</h1>
                    <p>Discover curated premium products handpicked for quality and style. From fashion to electronics — we bring the best to your doorstep.</p>
                    <div class="hero-btns">
                        <a href="<?= BASE_URL; ?>/index.php?page=allproducts" class="btn-luxury-primary">Browse Collection</a>
                        <a href="<?= BASE_URL; ?>/index.php?page=page&slug=our-story" class="btn-luxury-primary">Our Story</a>
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
                        <a href="<?= BASE_URL; ?>/index.php?page=products&category_id=<?= $h_cat['c_id']; ?>" class="luxury-hero-card">
                            <div class="icon-box">
                                <?php $cat_img = !empty($h_cat['c_image']) ? $h_cat['c_image'] : '/pictures/category/default.png'; ?>
                                <img src="<?= BASE_URL ?><?= htmlspecialchars($cat_img); ?>" alt="<?= htmlspecialchars($h_cat['c_name'] ?? ''); ?>">
                            </div>
                            <div class="card-content">
                                <h3><?= htmlspecialchars($h_cat['c_name'] ?? ''); ?></h3>
                                <p>From $<?= rand(49, 199); ?></p>
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
            <a href="<?= BASE_URL; ?>/index.php?page=featured_products" class="view-all-link">VIEW ALL →</a>
        </div>

        <div class="row g-4">
            <?php 
            $counter = 0;
            foreach($featuredProducts as $product): 
                if($counter >= 4) break;
            ?>
            <div class="col-lg-3 col-md-6">
                <div class="featured-card">
                    <div class="card-top">
                        <?php $productImage = strtok($product['image_url'], ','); ?>
                        <img src="<?= BASE_URL ?>/<?= htmlspecialchars(trim($productImage)); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
                    </div>
                    <div class="card-bottom">
 <?php if(!empty($product['category_name']) || !empty($product['category'])): ?>
<span class="category-pill"><?= htmlspecialchars($product['category_name'] ?? $product['category']); ?></span>
<?php endif; ?>                        <p class="desc"><?= htmlspecialchars(substr($product['description'], 0, 40)); ?>...</p>
                        <div class="price-row">
                            <span class="current-price">$<?= htmlspecialchars($product['price']); ?></span>
                        </div>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <form method="POST" action="<?= BASE_URL; ?>index.php?page=cart_add" class="m-0">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <input type="hidden" name="qty" value="1">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" name="redirect_to" value="?page=home">
                                <button type="submit" class="btn circle-icon-btn" title="Add to cart">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </form>
                            <form method="POST" action="<?= BASE_URL; ?>index.php?page=wishlist_toggle" class="m-0">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <input type="hidden" name="redirect_to" value="?page=home">
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
        <a href="<?= BASE_URL; ?>/index.php?page=sale" class="view-all-link">VIEW ALL →</a>
    </div>
    <div class="row py-4 g-4 d-flex justify-content-center">
        <?php foreach($products as $product): ?>
            <?php $discountAmount = isset($product['sale_discount_percent']) ? (int)$product['sale_discount_percent'] : 0; ?>
            <?php if ($discountAmount <= 0) continue; ?> <!-- Skip non-sale products -->

            <div class="col-md-3 col-sm-6">
                <div class="prod-card shadow-sm rounded">
                    <div class="prod-img position-relative">
                        <?php $productImage = strtok($product['image_url'], ','); ?>
                        <a href="<?= BASE_URL; ?>index.php?page=product_show&id=<?= $product['id']; ?>" class="text-decoration-none text-dark">
                            <img src="<?= BASE_URL ?>/<?= htmlspecialchars(trim($productImage)); ?>" 
                                 alt="<?= htmlspecialchars($product['name']); ?>" class="img-fluid rounded">
                        </a>
                        <?php if(!empty($product['badge'])): ?>
                            <span class="badge bg-danger position-absolute top-0 start-0 m-2"><?= htmlspecialchars($product['badge']); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="prod-info p-2 text-center">
                        <a href="<?= BASE_URL; ?>index.php?page=product_show&id=<?= $product['id']; ?>" class="text-decoration-none text-dark">
                            <h3 class="h6"><?= htmlspecialchars($product['name']); ?></h3>
                        </a>
                        <div class="price-box mt-1">
                        <?php if(isset($product['sale_discount_percent']) && (int)$product['sale_discount_percent'] > 0): ?>
                            <?php 
                                $discount = (int)$product['sale_discount_percent'];
                                $oldPrice = (float)$product['price'];
                                $newPrice = $oldPrice * (1 - $discount / 100);
                            ?>
                            <span class="old-price text-muted text-decoration-line-through me-2">$<?= number_format($oldPrice, 2); ?></span>
                            <span class="prod-price2 fw-bold luxury-price">$<?= number_format($newPrice, 2); ?></span>
                            <span class="badge bg-danger ms-2">-<?= $discount ?>%</span>
                        <?php else: ?>
                            <span class="prod-price2 fw-bold luxury-price">$<?= htmlspecialchars($product['price']); ?></span>
                        <?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <form method="POST" action="<?= BASE_URL; ?>index.php?page=cart_add" class="m-0">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <input type="hidden" name="qty" value="1">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" name="redirect_to" value="?page=sale">
                                <button type="submit" class="btn circle-icon-btn" title="Add to cart">
                                    <i class="bi bi-cart-plus-fill"></i>
                                </button>
                            </form>
                            <form method="POST" action="<?= BASE_URL; ?>index.php?page=wishlist_toggle" class="m-0">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <input type="hidden" name="redirect_to" value="?page=sale">
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
<section class="features-strip py-5">
  <div class="container">
    <div class="row text-center g-4">

      <!-- Feature 1 -->
      <div class="col-6 col-md-3">
        <div class="d-flex flex-column align-items-center">
          <i class="bi bi-scooter display-5 mb-2 feature-icon"></i>
          <p class="mb-0 fw-semibold">Curb-side pickup</p>
        </div>
      </div>

      <!-- Feature 2 -->
      <div class="col-6 col-md-3">
        <div class="d-flex flex-column align-items-center">
          <i class="bi bi-box-seam display-5 mb-2 feature-icon"></i>
          <p class="mb-0 fw-semibold">Free shipping on orders over $50</p>
        </div>
      </div>

      <!-- Feature 3 -->
      <div class="col-6 col-md-3">
        <div class="d-flex flex-column align-items-center">
          <i class="bi bi-percent display-5 mb-2 feature-icon"></i>
          <p class="mb-0 fw-semibold">Low prices guaranteed</p>
        </div>
      </div>

      <!-- Feature 4 -->
      <div class="col-6 col-md-3">
        <div class="d-flex flex-column align-items-center">
          <i class="bi bi-clock display-5 mb-2 feature-icon"></i>
          <p class="mb-0 fw-semibold">Available to you 24/7</p>
        </div>
      </div>

    </div>
  </div>
</section>

<?php include('footer.php'); ?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>