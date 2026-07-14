<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order Success - <?= $webname ?? 'Stitch Smart' ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="<?= BASE_URL ?>/css/navbar.css" rel="stylesheet">
<link href="<?= BASE_URL ?>/css/footer.css" rel="stylesheet">
<link href="<?= BASE_URL ?>/css/style.css" rel="stylesheet">
<link href="<?= BASE_URL ?>/css/<?= $global_theme ?? 'theme-luxury' ?>-frontend.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
<style>
body {
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.order-success-section {
  padding: 80px 20px;
  min-height: 70vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.success-card {
  background: var(--bg-card, #0a0a0a);
  padding: 50px 40px;
  max-width: 650px;
  width: 100%;
  text-align: center;
  border-radius: 16px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.2);
  border: 1px solid rgba(202, 151, 69, 0.2);
}

.success-icon {
  font-size: 70px;
  color: var(--accent-bronze, #ca9745);
  margin-bottom: 25px;
}

.success-card h2 {
  font-family: 'Playfair Display', serif;
  font-size: 32px;
  font-weight: 700;
  margin-bottom: 15px;
  color: var(--text-main, #ffffff);
}

.order-id {
  font-size: 20px;
  color: var(--accent-bronze, #ca9745);
  margin-bottom: 25px;
}

.thank-you {
  color: rgba(255,255,255,0.8);
  font-size: 16px;
  margin-bottom: 40px;
  line-height: 1.6;
}

.success-actions .btn {
  margin: 5px;
  padding: 14px 35px;
  font-size: 16px;
  font-weight: 600;
  border-radius: 12px;
  text-decoration: none;
  transition: 0.3s ease;
}

.success-actions .btn-primary {
  background: linear-gradient(135deg, #ca9745 0%, #ca9745 100%);
  color: #1a0f0a;
  border: none;
}

.success-actions .btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(202, 151, 69, 0.3);
}

.trust-badges {
  display: flex;
  justify-content: center;
  gap: 25px;
  margin-top: 40px;
  flex-wrap: wrap;
}

.trust-badges .badge {
  display: flex;
  align-items: center;
  gap: 8px;
  color: var(--text-muted, #a0a0a0);
  font-size: 14px;
  font-weight: 500;
}

.trust-badges .badge i {
  color: var(--accent-bronze, #ca9745);
  font-size: 18px;
}

/* Fallbacks for non-luxury theme */
:root.theme-default .success-card {
    background: #ffffff;
    border: 1px solid #e0e0e0;
}
:root.theme-default .success-card h2 {
    color: #333333;
}
:root.theme-default .thank-you {
    color: #666666;
}
</style>
</head>
<body class="theme-aware-body">
<?php include('header.php'); ?>

<section class="order-success-section">
  <div class="container d-flex justify-content-center">
    <div class="success-card">
      <div class="success-icon">
        <i class="fas fa-check-circle"></i>
      </div>
      <h2>🎉 Order Placed Successfully!</h2>
      <p class="order-id">Your Order ID: <strong>#<?= htmlspecialchars($order_id ?? ''); ?></strong></p>
      <p class="thank-you">Thank you for shopping with us! Your premium items are being processed and you will receive a confirmation email shortly.</p>

      <div class="success-actions">
        <a href="<?= url('') ?>home" class="btn btn-primary">Continue Shopping</a>
      </div>

      <div class="trust-badges">
        <div class="badge"><i class="fas fa-shipping-fast"></i> Free Shipping</div>
        <div class="badge"><i class="fas fa-undo"></i> 30-Day Returns</div>
        <div class="badge"><i class="fas fa-lock"></i> Secure Payment</div>
      </div>
    </div>
  </div>
</section>

<?php include('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
