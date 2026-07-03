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

</head>
<style>
 .featured-hero{
    background: linear-gradient(135deg, #1a0f0a 0%, #2d1a12 100%);
    color:#fff;
    min-height:320px;
    display:flex;
    align-items:center;
}

.featured-hero h1{
    font-size:4rem;
    font-weight:800;
    line-height:1;
    color: #c19a4e !important;
}

.featured-hero p{
    font-size:1.1rem;
    opacity:0.95;
}

.featured-strip{
    background: linear-gradient(135deg, #c19a4e 0%, #a67c37 100%);
    color:#1a0f0a;
    font-weight:700;
    text-align:center;
    padding:10px;
    letter-spacing:0.5px;
}
.page2 {
    background-color: var(--bg-dark, #000);
}
.product-card{
    background:#fff;
    border-radius:14px;
    overflow:hidden;
    transition:0.3s ease;
    position:relative;
    height:100%;
}

.product-card:hover{
    transform:translateY(-7px);
    box-shadow:0 12px 24px rgba(0,0,0,0.08);
}

.featured-badge-tag{
    position:absolute;
    top:12px;
    left:12px;
    background:#c19a4e;
    color:#fff;
    font-size:12px;
    padding:5px 10px;
    border-radius:20px;
    z-index:2;
}

.product-img{
    height:260px;
    overflow:hidden;
}

.product-img img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.product-info{
    padding:16px;
    text-align:center;
}

.product-title{
    font-size:15px;
    font-weight:600;
    min-height:42px;
}

.featured-price{
    font-size:18px;
    font-weight:700;
    color:#c19a4e;
}

.btn-view{
    background: linear-gradient(135deg, #c19a4e 0%, #a67c37 100%);
    color:#1a0f0a;
    border:none;
    padding:10px 14px;
    border-radius:8px;
    width:100%;
    font-weight:700;
    margin-top:12px;
    transition:0.3s;
}

.btn-view:hover{
    background:#1a0f0a;
    color:#c19a4e;
}

.pagination .page-link{
    color:#c19a4e;
    background: transparent;
    border-color: rgba(193,154,78,0.3);
}

.pagination .active .page-link{
    background: linear-gradient(135deg, #c19a4e 0%, #a67c37 100%);
    border-color:#c19a4e;
    color: #1a0f0a;
}
</style>

<body>


</head>

<body>
 <?php include('header.php'); ?>
<section class="featured-hero">
    <div class="container text-center">
        <p class="mb-2 text-uppercase">Handpicked For You</p>
        <h1>FEATURED PRODUCTS</h1>
        <p class="mt-3">Our curated selection of premium products</p>
    </div>
</section>

<div class="featured-strip">
    FEATURED COLLECTION • SHOP THE BEST
</div>
<div class="main">
    
    <div class="page2">
<!--Featured Products-->
<section class="py-3 ">
  <div class="container bg-light py-5">
    <h2 class="text-center">Featured Products</h2>
   <div class="row py-5">

<?php if(empty($products)): ?>
    <div class="col-12 text-center py-5">
        <h4 class="text-muted">No featured products available at the moment.</h4>
        <p class="text-muted">Check back soon for our curated collection!</p>
        <a href="<?= BASE_URL; ?>/index.php?page=allproducts" class="btn btn-view mt-3" style="width:auto; display:inline-block;">Browse All Products</a>
    </div>
<?php else: ?>

<?php foreach($products as $product): ?>
       <div class="col-md-6 col-lg-3">
                <div class="product-card">

                    <span class="featured-badge-tag"><i class="bi bi-star-fill"></i> Featured</span>

                    <a href="<?= BASE_URL; ?>index.php?page=product_show&id=<?= $product['id']; ?>" class="text-decoration-none text-dark">
                        <div class="product-img">
                            <?php $productImage = strtok($product['image_url'], ','); ?>
                            <img src="<?= BASE_URL ?>/<?= htmlspecialchars(trim($productImage)); ?>"
                                 alt="<?= htmlspecialchars($product['name']); ?>">
                        </div>
                    </a>

                        <div class="product-info">
                            <a href="<?= BASE_URL; ?>index.php?page=product_show&id=<?= $product['id']; ?>" class="text-decoration-none text-dark">
                                <div class="product-title">
                                    <?= htmlspecialchars($product['name']); ?>
                                </div>
                            </a>

                            <div class="mt-2">
                                <span class="featured-price">$<?= number_format((float)$product['price'], 2); ?></span>
                            </div>

                            <div class="d-flex gap-2 justify-content-center mt-3">
                                <form method="POST" action="<?= BASE_URL; ?>index.php?page=cart_add" class="m-0">
                                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                    <input type="hidden" name="qty" value="1">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                    <input type="hidden" name="redirect_to" value="?page=featured_products">
                                    <button type="submit" class="btn circle-icon-btn" title="Add to cart">
                                        <i class="bi bi-cart-plus-fill"></i>
                                    </button>
                                </form>
                                <form method="POST" action="<?= BASE_URL; ?>index.php?page=wishlist_toggle" class="m-0">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                    <input type="hidden" name="redirect_to" value="?page=featured_products">
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
        <?php if($totalPages > 1): ?>
        <div class="d-flex justify-content-center mt-5">
            <nav>
                <ul class="pagination">

                    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=featured_products&p=<?= $page - 1 ?>">
                            Previous
                        </a>
                    </li>

                    <?php for($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=featured_products&p=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=featured_products&p=<?= $page + 1 ?>">
                            Next
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
        <?php endif; ?>

    </div>
</section>

</div>


<?php include('footer.php'); ?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
