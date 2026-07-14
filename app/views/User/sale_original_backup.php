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
 .sale-hero{
    background: linear-gradient(135deg, #1a0f0a 0%, #2d1a12 100%);
    color:#fff;
    min-height:320px;
    display:flex;
    align-items:center;
}

.sale-hero h1{
    font-size:4rem;
    font-weight:800;
    line-height:1;
    color: #ca9745 !important;
}

.sale-hero p{
    font-size:1.1rem;
    opacity:0.95;
}

.sale-strip{
    background: linear-gradient(135deg, #ca9745 0%, #ca9745 100%);
    color:#1a0f0a;
    font-weight:700;
    text-align:center;
    padding:10px;
    letter-spacing:0.5px;
}
.page2 {
    background-color: var(--bg-dark, #000);
}
.product-card {
    background: #faf7f2;
    border: 1px solid #e8e0d5;
    border-radius: 16px;
    overflow: hidden;
    transition: 0.3s ease;
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
}

.product-img {
    height: 280px;
    overflow: hidden;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-info {
    padding: 20px;
    text-align: center;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: space-between;
}

.product-title {
    font-size: 16px;
    font-weight: 700;
    color: #241812 !important;
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
    background-color: #ca9745;
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
    background-color: #ca9745;
    transform: scale(1.05);
}

/* Pagination */
.custom-pagination .page-link {
    background-color: transparent;
    border: 1px solid rgba(202, 151, 69, 0.4);
    color: #fff;
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
    FEATURED SALE ITEMS ΓÇó SHOP NOW
</div>
<div class="main">
    
    <div class="page2">
<!--Best Sellers-->
<section class="py-3 ">
  <div class="container py-5">
    <h2 class="text-center text-white mb-5">Sale Collection</h2>
   <div class="row g-4">

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

                    <a href="<?= url('') ?>product_show&id=<?= $product['id']; ?>" class="text-decoration-none">
                        <div class="product-img">
                            <?php $productImage = strtok($product['image_url'], ','); ?>
                            <img src="<?= BASE_URL ?>/<?= htmlspecialchars(trim($productImage)); ?>"
                                 alt="<?= htmlspecialchars($product['name']); ?>">
                        </div>
                    </a>

                    <div class="product-info">
                        <a href="<?= url('') ?>product_show&id=<?= $product['id']; ?>" class="text-decoration-none">
                            <div class="product-title">
                                <?= htmlspecialchars($product['name']); ?>
                            </div>
                        </a>

                        <div class="price-row">
                            <span class="old-price">Rs. <?= number_format($oldPrice, 2); ?></span>
                            <span class="new-price">Rs. <?= number_format($newPrice, 2); ?></span>
                            <span class="inline-discount-badge">-<?= $discount ?>%</span>
                        </div>

                        <div class="d-flex gap-3 justify-content-center mt-auto">
                            <form method="POST" action="<?= url('') ?>cart_add" class="m-0">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <input type="hidden" name="qty" value="1">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                <input type="hidden" name="redirect_to" value="?page=sale">
                                <button type="submit" class="btn circle-icon-btn" title="Add to cart">
                                    <i class="bi bi-cart-plus-fill"></i>
                                </button>
                            </form>
                            <form method="POST" action="<?= url('') ?>wishlist_toggle" class="m-0">
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
