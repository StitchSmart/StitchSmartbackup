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

</head>
<style>
 .sale-hero {
    background: linear-gradient(135deg, rgba(26, 15, 10, 0.85) 0%, rgba(45, 26, 18, 0.85) 100%), url('https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?auto=format&fit=crop&q=80&w=1200') center/cover;
    color: #fff;
    min-height: 220px;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    border-bottom: 2px solid #c19a4e;
}

.sale-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: radial-gradient(circle, rgba(193, 154, 78, 0.2) 0%, transparent 60%);
    animation: pulseGlow 4s infinite alternate;
}

@keyframes pulseGlow {
    0% { transform: scale(0.9); opacity: 0.6; }
    100% { transform: scale(1.2); opacity: 1; }
}

.sale-hero h1 {
    font-size: 3rem;
    font-weight: 900;
    line-height: 1.2;
    background: linear-gradient(to right, #c19a4e, #f9ebb3, #c19a4e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0px 4px 20px rgba(193, 154, 78, 0.4);
    animation: slideDown 0.8s cubic-bezier(0.25, 0.8, 0.25, 1);
    position: relative;
    z-index: 1;
}

@keyframes slideDown {
    from { transform: translateY(-30px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.sale-hero p {
    font-size: 1.2rem;
    color: #ffd700 !important; /* bright gold/yellow */
    font-weight: 600;
    opacity: 1;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-shadow: 0 2px 4px rgba(0,0,0,0.8);
    animation: zoomInText 1.5s ease-out forwards;
    position: relative;
    z-index: 1;
    display: inline-block;
}

@keyframes zoomInText {
    0% { transform: scale(0.8); opacity: 0; }
    50% { opacity: 1; }
    100% { transform: scale(1); opacity: 1; }
}

.sale-strip {
    background: linear-gradient(90deg, #c19a4e 0%, #e5c57b 50%, #c19a4e 100%);
    background-size: 200% auto;
    color: #1a0f0a;
    font-weight: 800;
    text-align: center;
    padding: 10px;
    letter-spacing: 1.5px;
    font-size: 0.9rem;
    animation: shimmerStrip 3s linear infinite;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    position: relative;
    z-index: 10;
}

@keyframes shimmerStrip {
    0% { background-position: 0% center; }
    100% { background-position: 200% center; }
}
.page2 {
    background: linear-gradient(to bottom, #111, #1a1a1a) !important;
    padding-bottom: 50px;
}
.sale-title {
    font-family: 'Playfair Display', serif !important;
    font-size: 3rem !important;
    color: #c19a4e !important;
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
    display: inline-block;
    background: none !important;
    -webkit-text-fill-color: initial !important;
    animation: pulseGlowText 2s infinite alternate;
}
.sale-title::after {
    content: none !important;
}

@keyframes pulseGlowText {
    0% { text-shadow: 0 0 10px rgba(193, 154, 78, 0.2); }
    100% { text-shadow: 0 0 25px rgba(193, 154, 78, 0.8); }
}

.product-card {
    background: #ffffff !important;
    border: 1px solid rgba(193, 154, 78, 0.3) !important;
    border-radius: 12px !important;
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2) !important;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(193, 154, 78, 0.15);
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
    transition: transform 0.5s ease;
}

.product-card:hover .product-img img {
    transform: scale(1.05);
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
    font-size: 16px;
    font-weight: 700;
    color: #333333 !important;
    margin-bottom: 12px;
}

.price-row {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
}

.new-price {
    font-size: 18px;
    font-weight: 800;
    color: #241812 !important;
}

.old-price {
    color: #aaa !important;
    text-decoration: line-through;
    font-size: 14px;
}

.inline-discount-badge {
    background-color: #d32f2f;
    color: #fff;
    font-size: 12px;
    font-weight: 600;
    padding: 2px 8px;
    border-radius: 4px;
}

.circle-icon-btn {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background-color: #c19a4e;
    color: #111;
    display: flex;
    justify-content: center;
    align-items: center;
    border: none;
    transition: 0.3s;
    font-size: 16px;
}
.circle-icon-btn i {
    color: #111 !important;
}
.circle-icon-btn:hover {
    background-color: #e5c57b;
    transform: scale(1.05);
}

/* Pagination */
.custom-pagination .page-link {
    background-color: transparent;
    border: 1px solid rgba(193, 154, 78, 0.4);
    color: #fff;
    border-radius: 8px;
    margin: 0 4px;
    min-width: 42px;
    text-align: center;
    transition: 0.2s;
}
.custom-pagination .page-link:hover {
    background-color: rgba(193, 154, 78, 0.1);
    color: #c19a4e;
}
.custom-pagination .page-item.active .page-link {
    background-color: #c19a4e;
    border-color: #c19a4e;
    color: #111;
    font-weight: 700;
}
.custom-pagination .page-item.disabled .page-link {
    color: #666;
    border-color: #333;
    background: transparent;
}
</style>

<body>


</head>

<body>
 <?php include('header.php'); ?>
<section class="sale-hero">
    <div class="container text-center">
        <p class="mb-2 text-uppercase">Limited Time Offer</p>
        <h1>UP TO 80% OFF</h1>
        <p class="mt-3">Featured pieces selected for the season</p>
    </div>
</section>

<div class="sale-strip">
    FEATURED SALE ITEMS • SHOP NOW
</div>
<div class="main">
    
    <div class="page2">
<!--Best Sellers-->
<section class="py-3 ">
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
       <div class="col-md-6 col-lg-3 mb-4">
                <div class="product-card">

                    <a href="<?= BASE_URL; ?>index.php?page=product_show&id=<?= $product['id']; ?>" class="text-decoration-none">
                        <div class="product-img">
                            <?php $productImage = strtok($product['image_url'], ','); ?>
                            <img src="<?= BASE_URL ?>/<?= htmlspecialchars(trim($productImage)); ?>"
                                 alt="<?= htmlspecialchars($product['name']); ?>">
                        </div>
                    </a>

                    <div class="product-info">
                        <a href="<?= BASE_URL; ?>index.php?page=product_show&id=<?= $product['id']; ?>" class="text-decoration-none">
                            <div class="product-title">
                                <?= htmlspecialchars($product['name']); ?>
                            </div>
                        </a>

                        <div class="price-row">
                            <span class="old-price">$<?= number_format($oldPrice, 2); ?></span>
                            <span class="new-price">$<?= number_format($newPrice, 2); ?></span>
                            <span class="inline-discount-badge">-<?= $discount ?>%</span>
                        </div>

                        <div class="d-flex gap-3 justify-content-center mt-auto">
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

        <?php if ($totalPages > 1): ?>
        <nav aria-label="Page navigation">
            <ul class="pagination custom-pagination justify-content-center mt-5">
                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link px-3" href="?page=sale&p=<?= $page - 1 ?>" aria-label="Previous">
                        Previous
                    </a>
                </li>
                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=sale&p=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                    <a class="page-link px-3" href="?page=sale&p=<?= $page + 1 ?>" aria-label="Next">
                        Next
                    </a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>

    </div>
</section>

</div>


<?php include('footer.php'); ?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
