<?php
$meta_description = trim($meta_description ?? 'StitchSmart - Tailoring quality products with fast shipping.');
$webmail = trim($webmail ?? 'info@stitchsmart.com');
$webcontact = trim($webcontact ?? 'StitchSmart');
$facebook = trim($facebook ?? '');
$instagram = trim($instagram ?? '');
$pinterest = trim($pinterest ?? '');
$linkdin = trim($linkdin ?? '');
$footer_categories = isset($categories) && is_array($categories) ? $categories : [];
if (!empty($hide_footer)) {
    return;
}
?>

<?php if (($global_theme ?? '') === 'theme-luxury'): ?>
<style>
  /* Luxury theme footer styles (kept inline intentionally for luxury visual polish) */
  footer.footer {
      position: relative;
      overflow: hidden;
    }
    /* Theme-specific decoration: luxury theme will use the rich gradient, default theme will use light background */
    :root.theme-luxury footer.footer {
      background: radial-gradient(circle at top right, rgba(202, 151, 69, 0.08), transparent 38%),
            linear-gradient(180deg, #050505 0%, #090909 55%, #0e0e0e 100%) !important;
      color: #e2e8f0 !important;
    }
    :root.theme-default footer.footer {
      background: linear-gradient(180deg,#ffffff 0%, #f7f9fb 100%);
      color: #24303b !important;
    }
  /* ... rest of luxury styles unchanged ... */
  footer.footer::before { content: ''; position: absolute; top: -40px; right: -40px; width: 220px; height: 220px; background: rgba(202, 151, 69, 0.08); border-radius: 50%; filter: blur(32px); pointer-events: none; }
  footer.footer::after { content: ''; position: absolute; left: -80px; bottom: -60px; width: 260px; height: 260px; background: rgba(255, 255, 255, 0.04); border-radius: 50%; filter: blur(34px); pointer-events: none; }
  footer.footer .site-footer { background: transparent !important; border-top: 1px solid rgba(255, 255, 255, 0.06) !important; padding: 60px 0 35px; }
  footer.footer .footer-col { position: relative; z-index: 1; margin-bottom: 30px; }
  footer.footer .footer-col h6 { color: #d3a15b !important; letter-spacing: 0.14em; text-transform: uppercase; font-size: 0.95rem; margin-bottom: 1.25rem; position: relative; }
  footer.footer .footer-col h6::after { content: ''; position: absolute; bottom: -14px; left: 0; width: 45px; height: 3px; background: linear-gradient(90deg, rgba(202, 151, 69,1), rgba(255,224,133,0.3)); border-radius: 99px; }
  footer.footer .footer-col p, footer.footer .footer-col address, footer.footer .footer-col ul li a, footer.footer .social-icons a, footer.footer .footer-bottom p { color: rgba(226, 232, 240, 0.92) !important; transition: color 0.25s ease, transform 0.25s ease; }
  footer.footer .footer-desc { font-size: 0.95rem; line-height: 1.8; margin-bottom: 22px; max-width: 320px; }
  footer.footer .footer-col p a, footer.footer .footer-col ul li a { color: rgba(226, 232, 240, 0.92) !important; }
  footer.footer .footer-col ul { padding: 0; list-style: none; }
  footer.footer .footer-col ul li { margin-bottom: 14px; transition: transform 0.25s ease; }
  footer.footer .footer-col ul li a { display: inline-flex; align-items: center; gap: 0.5rem; color: rgba(226, 232, 240, 0.92) !important; font-size: 0.95rem; }
  footer.footer .footer-col ul li a:hover { color: #f5d585 !important; transform: translateX(6px); }
  footer.footer .footer-col ul li a::before { content: '•'; margin-right: 0.55rem; color: #d3a15b; opacity: 0.8; }
  footer.footer .social-icons { display: flex; gap: 12px; margin-top: 18px; }
  footer.footer .social-icons a { width: 38px; height: 38px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid rgba(202, 151, 69, 0.24); border-radius: 50%; color: #e2e8f0 !important; transition: all 0.3s ease; background: rgba(255,255,255,0.02); }
  footer.footer .social-icons a:hover { color: #111 !important; background: #d3a15b; border-color: transparent; transform: translateY(-2px); }
  footer.footer .footer-bottom { padding: 18px 0 28px; border-top: 1px solid rgba(255, 255, 255, 0.05); text-align: center; position: relative; z-index: 1; }
  footer.footer .footer-bottom p { margin: 0; font-size: 0.92rem; color: rgba(226, 232, 240, 0.72) !important; }
  footer.footer .footer-col .help-banner, footer.footer .footer-col .btn-help { display: none; }

  footer.footer .footer-desc { font-size: 0.95rem; line-height: 1.8; margin-bottom: 22px; max-width: 320px; animation: glowText 7s ease-in-out infinite; }
  @keyframes floatSlow { 0%, 100% { transform: translateY(0) scale(1); } 50% { transform: translateY(-12px) scale(1.04); } }
  @keyframes glowText { 0%, 100% { color: rgba(226, 232, 240, 0.92); text-shadow: none; } 50% { color: #f5df9d; text-shadow: 0 0 18px rgba(255, 212, 129, 0.5); } }
  @keyframes slideUpFade { from { transform: translateY(12px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
  @media (max-width: 991px) { footer.footer .footer-col { margin-bottom: 28px; } }
  @media (max-width: 576px) { footer.footer .site-footer { padding: 40px 0 25px; } footer.footer::before, footer.footer::after { display: none; } }
</style>
<?php endif; ?>

<style>
  /* Beautifully Refined Newsletter Section for both default and luxury modes */
  .newsletter-promo {
      position: relative;
      overflow: hidden;
      border-radius: 36px;
      padding: 64px 40px;
      margin: 40px 0 50px;
      transition: all 0.4s ease;
  }
  
  /* Light Theme (Classic Mode) Newsletter Styles */
  :root.theme-default .newsletter-promo {
      background: linear-gradient(135deg, #F9F5F0 0%, #EFE5D9 100%);
      border: 1px solid rgba(205, 154, 72, 0.18);
      color: #3D241C;
      box-shadow: 
          0 20px 50px rgba(92, 67, 53, 0.04),
          inset 0 1px 0 rgba(255, 255, 255, 0.7);
  }
  :root.theme-default .newsletter-promo h2 {
      background: linear-gradient(135deg, #3d241c 20%, #ca9745 100%);
      -webkit-background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
  }
  :root.theme-default .newsletter-promo p {
      color: #5C4335;
  }
  :root.theme-default .newsletter-promo .newsletter-note {
      color: rgba(92, 67, 53, 0.7);
  }
  :root.theme-default .newsletter-promo .newsletter-cta input {
      background: #ffffff !important;
      border: 1.5px solid rgba(205, 154, 72, 0.25) !important;
      color: #3D241C !important;
  }
  :root.theme-default .newsletter-promo .newsletter-cta input:focus {
      border-color: #ca9745 !important;
      box-shadow: 0 0 0 4px rgba(205, 154, 72, 0.12) !important;
  }
  :root.theme-default .newsletter-promo .newsletter-cta button {
      background: linear-gradient(135deg, #ca9745, #ca9745) !important;
      color: #ffffff !important;
      box-shadow: 0 10px 24px rgba(205, 154, 72, 0.2) !important;
  }
  :root.theme-default .newsletter-promo .newsletter-cta button:hover {
      background: linear-gradient(135deg, #ca9745, #9c712e) !important;
      box-shadow: 0 12px 30px rgba(205, 154, 72, 0.35) !important;
  }

  /* Dark Theme (Luxury Mode) Newsletter Styles */
  :root.theme-luxury .newsletter-promo {
      background: linear-gradient(135deg, rgba(22, 19, 16, 0.95) 0%, rgba(10, 8, 7, 0.95) 100%);
      border: 1px solid rgba(202, 151, 69, 0.22);
      color: #f4e9d3;
      box-shadow: 
          0 30px 70px rgba(0, 0, 0, 0.5),
          inset 0 1px 0 rgba(255, 255, 255, 0.05);
  }
  :root.theme-luxury .newsletter-promo h2 {
      background: linear-gradient(135deg, #ffffff 30%, #ca9745 100%);
      -webkit-background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
      text-shadow: 0 2px 15px rgba(202, 151, 69, 0.15);
  }
  :root.theme-luxury .newsletter-promo p {
      color: rgba(244, 233, 211, 0.85);
  }
  :root.theme-luxury .newsletter-promo .newsletter-note {
      color: rgba(244, 233, 211, 0.6);
  }
  :root.theme-luxury .newsletter-promo .newsletter-cta input {
      background: rgba(255, 255, 255, 0.03) !important;
      border: 1.5px solid rgba(202, 151, 69, 0.25) !important;
      color: #ffffff !important;
  }
  :root.theme-luxury .newsletter-promo .newsletter-cta input:focus {
      border-color: #ca9745 !important;
      box-shadow: 0 0 0 4px rgba(202, 151, 69, 0.15) !important;
  }
  :root.theme-luxury .newsletter-promo .newsletter-cta button {
      background: linear-gradient(135deg, #ca9745, #a37f3b) !important;
      color: #1a0f0a !important;
      box-shadow: 0 10px 24px rgba(202, 151, 69, 0.25) !important;
  }
  :root.theme-luxury .newsletter-promo .newsletter-cta button:hover {
      background: linear-gradient(135deg, #d8ad5a, #bfa04a) !important;
      box-shadow: 0 12px 30px rgba(202, 151, 69, 0.4) !important;
  }

  /* Decorative backdrop glowing circles */
  .newsletter-promo::before, .newsletter-promo::after {
      content: '';
      position: absolute;
      border-radius: 50%;
      opacity: 0.18;
      pointer-events: none;
      animation: floatSlow 12s ease-in-out infinite;
  }
  .newsletter-promo::before {
      width: 200px;
      height: 200px;
      top: -85px;
      right: -50px;
      background: radial-gradient(circle, var(--accent-bronze, #ca9745) 0%, transparent 80%);
  }
  .newsletter-promo::after {
      width: 280px;
      height: 280px;
      bottom: -110px;
      left: -80px;
      background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 80%);
      animation-duration: 16s;
  }

  .newsletter-promo h2 {
      font-size: 2.5rem;
      font-weight: 800;
      margin-bottom: 0.75rem;
      letter-spacing: -0.01em;
      text-transform: uppercase;
      font-family: 'Outfit', 'Playfair Display', serif;
  }
  .newsletter-promo p {
      max-width: 720px;
      margin: 0 auto 1.8rem;
      line-height: 1.7;
      font-size: 1.08rem;
  }
  .newsletter-promo .newsletter-cta {
      display: flex;
      gap: 0.85rem;
      flex-wrap: nowrap;
      justify-content: center;
      align-items: center;
      margin-top: 10px;
  }
  .newsletter-promo .newsletter-cta input {
      flex: 0 1 480px;
      min-width: 260px;
      border-radius: 16px;
      padding: 15px 22px;
      outline: none;
      font-size: 0.98rem;
      transition: all 0.3s ease;
  }
  .newsletter-promo .newsletter-cta button {
      border-radius: 16px;
      border: none;
      font-weight: 800;
      padding: 15px 32px;
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      min-height: 48px;
      cursor: pointer;
      font-size: 0.98rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
  }
  .newsletter-promo .newsletter-cta button:hover {
      transform: translateY(-2px);
  }
  .newsletter-promo .newsletter-note {
      font-size: 0.88rem;
      margin-top: 1.1rem;
      letter-spacing: 0.2px;
  }
  .newsletter-promo .newsletter-message {
      margin-bottom: 1.5rem;
  }

  @keyframes floatSlow { 0%, 100% { transform: translateY(0) scale(1); } 50% { transform: translateY(-15px) scale(1.03); } }

  @media (max-width: 768px) {
    .newsletter-promo { padding: 44px 24px; border-radius: 24px; }
    .newsletter-promo .newsletter-cta { flex-direction: column; gap: 12px; }
    .newsletter-promo .newsletter-cta input { width: 100%; flex: 1 1 auto; min-width: unset; padding: 13px 18px; }
    .newsletter-promo .newsletter-cta button { width: 100%; padding: 13px 20px; }
    .newsletter-promo h2 { font-size: 1.85rem; }
    .newsletter-promo p { font-size: 0.98rem; margin-bottom: 1.3rem; }
  }
</style>

<div class="newsletter-promo">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-9 text-center">
        <h2>Newsletter</h2>
        <p>Subscribe now for new product drops, launch alerts, and special vouchers sent directly to your inbox.</p>

        <?php if (!empty($_SESSION['newsletter_status'])): ?>
          <div class="alert alert-<?= htmlspecialchars($_SESSION['newsletter_status']['type']); ?> newsletter-message" role="alert">
            <?= htmlspecialchars($_SESSION['newsletter_status']['message']); ?>
          </div>
          <?php unset($_SESSION['newsletter_status']); ?>
        <?php endif; ?>

        <form class="newsletter-cta" method="POST" action="<?= url('subscribe_newsletter'); ?>">
          <input type="hidden" name="redirect" value="<?= htmlspecialchars($_SERVER['REQUEST_URI'] ?? url('home')); ?>">
          <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">
          <input type="email" name="email" placeholder="Enter your email address" required>
          <button type="submit">Subscribe Now</button>
        </form>
        <p class="newsletter-note">No spam. Only product previews, new arrivals, and exclusive discount alerts.</p>
      </div>
    </div>
  </div>
</div>

<footer class="footer">
  <!-- ── Top section: 4 columns ── -->
  <div class="site-footer">
    <div class="container">
      <div class="row">

        <!-- Store Location -->
        <div class="col-12 col-sm-6 col-md-3 footer-col">
          <h6>Store Details</h6>
          <p class="footer-desc"><?= htmlspecialchars($meta_description); ?></p>
          <p>
            <?= htmlspecialchars($webcontact); ?>
          </p>
          <div class="social-icons">
            <?php if (!empty($facebook)): ?>
              <a href="<?= htmlspecialchars($facebook); ?>" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <?php endif; ?>
            <?php if (!empty($instagram)): ?>
              <a href="<?= htmlspecialchars($instagram); ?>" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <?php endif; ?>
            <a href="https://wa.link/twb6nv" target="_blank" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>

          </div>
        </div>

        <!-- Shop -->
        <div class="col-12 col-sm-6 col-md-2 footer-col">
          <h6>Shop</h6>
          <ul>
            <?php if (!empty($footer_categories)): ?>
              <?php foreach ($footer_categories as $cat): ?>
                <li><a href="<?= url('allproducts?category_id=' . $cat['c_id']); ?>"><?= htmlspecialchars($cat['c_name']); ?></a></li>
              <?php endforeach; ?>
            <?php else: ?>
              <li><a href="<?= url('allproducts'); ?>">Shop All</a></li>
            <?php endif; ?>
          </ul>
        </div>

        <!-- Customer Support -->
        <div class="col-12 col-md-5 footer-col mt-3 mt-md-0">
          <h6>Customer Support</h6>
          <ul class="footer-double-col">
            <li><a href="<?= url('contact') ?>">Contact Us</a></li>
            <?php $whatsapp_phone = preg_replace('/[^0-9]/', '', $webcontact); ?>
            <li><a href="https://wa.me/<?= $whatsapp_phone ?>" target="_blank" class="text-success"><i class="bi bi-whatsapp"></i> Help desk</a></li>
            <?php 
            require_once BASE_PATH.'/app/models/pages.php';
            $db = (new Database())->connect();
            $pModel = new Page($db);
            $footer_pages = $pModel->getAllPages();
            foreach($footer_pages as $fp): 
                // Skip policy-related pages, the merged help desk, and the legacy duplicate ourstory to avoid duplication in Customer Support
                $skip_slugs = ['shipping-and-delivery', 'return-and-refunds', 'terms-and-condition', 'how-to-order', 'help-desk', 'ourstory'];
                if (in_array($fp['slug'], $skip_slugs)) {
                    continue;
                }
            ?>
                <li><a href="<?= url($fp['slug']) ?>"><?= htmlspecialchars($fp['title']) ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- Policy -->
        <div class="col-12 col-sm-6 col-md-2 footer-col mt-3 mt-md-0">
          <h6>Policy</h6>
          <ul>
            <li><a href="<?= url('shipping-and-delivery') ?>">Shipping &amp; Returns</a></li>
            <li><a href="<?= url('terms-and-condition') ?>">Terms &amp; Conditions</a></li>
            <li><a href="<?= url('how-to-order') ?>">FAQ</a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>

  <!-- ── Bottom section: payment methods ── -->
  <div class="footer-bottom">
    <div class="container">
      <p>&copy; <?= date('Y') ?> StitchSmart. Crafted with luxury, comfort, and premium attention to detail.</p>
    </div>
  </div>
</footer>

<?php if (empty($hide_chatbot)): ?>
<link rel="stylesheet" href="<?= BASE_URL ?>css/chatbot.css?v=<?= time() ?>">
<script src="<?= BASE_URL ?>js/chatbot.js?v=<?= time() ?>"></script>
<?php endif; ?>