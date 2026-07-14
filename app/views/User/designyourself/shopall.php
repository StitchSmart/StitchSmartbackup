<?php
$allowedThemes = ['theme-default', 'theme-luxury'];
$requestedTheme = strtolower(trim((string) ($global_theme ?? 'theme-luxury')));
$validatedTheme = in_array($requestedTheme, $allowedThemes, true) ? $requestedTheme : 'theme-luxury';
$validatedPageTitle = htmlspecialchars($webname ?? 'Stitch Smart', ENT_QUOTES, 'UTF-8');
$validatedMetaDescription = htmlspecialchars($meta_description ?? 'Create premium apparel with smart styling controls.', ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="<?= $validatedMetaDescription ?>" />
  <title><?= $validatedPageTitle ?> - Shop All Customizer</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>/css/navbar.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>/css/footer.css?v=1.5" rel="stylesheet">
  <link href="<?= BASE_URL ?>/css/<?= htmlspecialchars($validatedTheme, ENT_QUOTES, 'UTF-8') ?>-frontend.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>/css/design.css?v=<?= time() ?>" rel="stylesheet">
  <style>
    .page.active {
      display: block;
      animation: editorEntrance 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    
    .stagger-card {
      opacity: 0;
      animation: premiumFadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    
    .generic-modal-content {
      animation: modalScaleUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @keyframes modalScaleUp {
      0% { opacity: 0; transform: scale(0.95) translateY(20px); }
      100% { opacity: 1; transform: scale(1) translateY(0); }
    }
    
    @keyframes premiumFadeUp {
      0% { opacity: 0; transform: translateY(24px) scale(0.98); }
      100% { opacity: 1; transform: translateY(0) scale(1); }
    }
  </style>
</head>
<body class="design-landing-body <?= htmlspecialchars($validatedTheme, ENT_QUOTES, 'UTF-8') ?>">

<?php $hide_announcement = true; $hide_chatbot = true; require_once BASE_PATH . '/app/views/User/header.php'; ?>

<main class="design-main-shell">
  <section id="shopall-customizer" class="page active design-selection-section" aria-label="Shop All Catalog" style="margin-top: 2rem;">
    <a href="<?= url('') ?>design" class="back-btn" style="text-decoration: none;">← Back to Design Studio</a>
    <div class="design-selection-header" style="margin-top: 1rem;">
      <div>
        <p class="section-kicker">Shop All Catalog</p>
        <h2>Customize Any Product</h2>
      </div>
      <p class="section-copy">Select any product from our entire catalog to customize its color and add your own logos.</p>
    </div>

    <div class="grid" id="shopall-grid">
      <?php if (!empty($paginatedProducts)): ?>
        <?php $delay = 0.1; foreach ($paginatedProducts as $prod): ?>
          <article class="design-card shopall-card stagger-card" style="animation-delay: <?= $delay ?>s;" tabindex="0" aria-label="<?= htmlspecialchars($prod['name'], ENT_QUOTES, 'UTF-8') ?>" onclick="openGenericCustomizer(<?= htmlspecialchars(json_encode($prod), ENT_QUOTES, 'UTF-8') ?>)">
            <div class="design-card-visual" style="position:relative; z-index:1; display:flex; justify-content:center; align-items:center; background: #fff; border-radius: 12px; padding: 20px;">
              <span class="card-shine"></span>
              <img src="<?= BASE_URL ?>/<?= htmlspecialchars($prod['image_url'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($prod['name'], ENT_QUOTES, 'UTF-8') ?>" style="max-width: 100%; max-height: 200px; object-fit: contain; position:relative; z-index:2; transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);">
            </div>
            <div class="card-copy">
              <p class="card-kicker"><?= htmlspecialchars($prod['article_number'] ?? 'Product', ENT_QUOTES, 'UTF-8') ?></p>
              <h3 class="card-title"><?= htmlspecialchars($prod['name'], ENT_QUOTES, 'UTF-8') ?></h3>
              <p class="card-desc">Rs. <?= number_format($prod['price'], 2) ?></p>
            </div>
            <div class="design-card-actions">
              <button class="design-card-cta" type="button">Customize</button>
            </div>
          </article>
        <?php $delay += 0.1; endforeach; ?>
      <?php else: ?>
        <p>No products found in the catalog.</p>
      <?php endif; ?>
    </div>

    <?php if (isset($totalPages) && $totalPages > 1): ?>
      <div class="pagination-container" style="display: flex; justify-content: center; gap: 10px; margin-top: 30px;">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <a href="<?= url('') ?>shopall_customizer&p=<?= $i ?>" 
             style="padding: 8px 16px; border-radius: 8px; text-decoration: none; <?= $i === $currentPage ? 'background: var(--accent-bronze, #ca9745); color: #000; font-weight: bold;' : 'background: #eee; color: #333;' ?>">
            <?= $i ?>
          </a>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  </section>

  <!-- Generic Customizer Modal -->
  <div id="generic-customizer-modal" class="modal-overlay" style="display: none;">
    <div class="generic-modal-content">
      <button class="close-modal-btn" onclick="closeGenericCustomizer()">&times;</button>
      <div class="generic-modal-layout">
        
        <!-- Preview Area -->
        <div class="generic-preview-area">
          <h2 id="gc-title">Product Name</h2>
          <div class="gc-image-container" id="gc-image-container" style="position: relative; overflow: hidden;">
            <img id="gc-product-image" src="" alt="Product" style="max-width: 100%; max-height: 400px; display: block; position: relative; z-index: 1;">
            <div id="liveTextOverlay" style="position: absolute; top: 40%; left: 50%; transform: translate(-50%, -50%); cursor: grab; user-select: none; font-size: 40px; color: #ffffff; font-family: 'Impact', sans-serif; white-space: nowrap; pointer-events: auto; z-index: 10; display: none;"></div>
            <img id="gc-logo-overlay" src="" alt="Logo" style="display:none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); cursor: grab; user-select: none; pointer-events: auto; z-index: 3;">
          </div>
        </div>

        <!-- Controls Area -->
        <div class="generic-controls-area">
          <h3>Customization Tools</h3>
          
          <div class="gc-control-group">
            <label style="color: var(--accent-bronze); font-weight: bold;">Custom Typography</label>
            <p style="font-size: 0.85rem; margin-bottom: 0.5rem; color: #666;">Type text and drag it on the image.</p>
            <input type="text" id="customTextInput" class="form-control mb-2" placeholder="Enter text here..." oninput="updateCustomText()">
            <select id="customTextFont" class="form-control mb-2" onchange="updateCustomText()">
                <option value="'Impact', sans-serif">Varsity / Block</option>
                <option value="'Brush Script MT', cursive">Vintage Script</option>
                <option value="'Courier New', Courier, monospace">Typewriter</option>
                <option value="'Arial Black', Gadget, sans-serif">Modern Bold</option>
            </select>
            <div style="display: flex; gap: 10px; align-items: center;">
                <input type="color" id="customTextColor" class="form-control form-control-color" value="#ffffff" oninput="updateCustomText()" style="width: 50px;">
                <input type="range" id="customTextSize" class="form-range" min="10" max="100" value="40" oninput="updateCustomText()" style="flex: 1;">
            </div>
          </div>
          
          <div class="gc-control-group">
            <label>2. Upload Logo</label>
            <input type="file" id="gc-logo-input" accept="image/png, image/jpeg" onchange="handleGenericLogoUpload(event)">
            <p class="gc-help-text">Max 2MB. Transparent PNG recommended.</p>
          </div>
          
          <div class="gc-control-group">
            <label>Logo Size</label>
            <input type="range" id="gc-logo-size" min="20" max="200" value="100" oninput="adjustGenericLogoSize(this.value)">
          </div>

          <div class="gc-control-group">
            <label>Your Name *</label>
            <input type="text" id="gc-user-name" placeholder="Enter your full name" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px;">
          </div>
          
          <div class="gc-control-group">
            <label>Your Email *</label>
            <input type="email" id="gc-user-email" placeholder="Enter your email address" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px;">
          </div>
          
          <div class="gc-control-group">
            <label>Your Mobile/WhatsApp</label>
            <input type="text" id="gc-user-mobile" placeholder="Enter your contact number" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px;">
          </div>

          <div class="gc-control-group">
            <label>Additional Notes *</label>
            <textarea id="gc-notes" rows="3" placeholder="Describe placement or other requests..."></textarea>
          </div>
          
          <button class="gc-submit-btn" onclick="submitGenericInquiry()">Send Inquiry</button>
        </div>

      </div>
    </div>
  </div>
</main>

<?php require_once BASE_PATH . '/app/views/User/footer.php'; ?>

<script>
  let currentGenericProduct = null;
  let genericLogoFile = null;

  function openGenericCustomizer(product) {
    currentGenericProduct = product;
    const imgUrl = '<?= BASE_URL ?>/' + product.image_url;
    document.getElementById('gc-title').innerText = product.name;
    document.getElementById('gc-product-image').src = imgUrl;
    
    // Reset typography
    document.getElementById('customTextInput').value = '';
    updateCustomText();
    
    document.getElementById('gc-logo-input').value = '';
    document.getElementById('gc-logo-overlay').style.display = 'none';
    document.getElementById('gc-logo-overlay').src = '';
    document.getElementById('gc-logo-size').value = 100;
    
    xOffset = 0; yOffset = 0; currentX = 0; currentY = 0;
    document.getElementById('liveTextOverlay').style.transform = 'translate(-50%, -50%)';
    logoXOffset = 0; logoYOffset = 0; logoCurrentX = 0; logoCurrentY = 0;
    document.getElementById('gc-logo-overlay').style.transform = 'translate(-50%, -50%)';

    document.getElementById('gc-notes').value = '';
    genericLogoFile = null;

    document.getElementById('generic-customizer-modal').style.display = 'flex';
  }

  function closeGenericCustomizer() {
    document.getElementById('generic-customizer-modal').style.display = 'none';
  }

  let isDraggingText = false;
  let currentX, currentY, initialX, initialY;
  let xOffset = 0, yOffset = 0;
  const dragItem = document.getElementById("liveTextOverlay");

  dragItem.addEventListener("mousedown", dragStart);
  document.addEventListener("mouseup", dragEnd);
  document.addEventListener("mousemove", drag);
  dragItem.addEventListener("touchstart", dragStart, {passive: false});
  document.addEventListener("touchend", dragEnd);
  document.addEventListener("touchmove", drag, {passive: false});

  function dragStart(e) {
      if (e.type === "touchstart") {
          initialX = e.touches[0].clientX - xOffset;
          initialY = e.touches[0].clientY - yOffset;
      } else {
          initialX = e.clientX - xOffset;
          initialY = e.clientY - yOffset;
      }
      if (e.target === dragItem) {
          isDraggingText = true;
          dragItem.style.cursor = 'grabbing';
      }
  }

  function dragEnd() {
      initialX = currentX;
      initialY = currentY;
      isDraggingText = false;
      dragItem.style.cursor = 'grab';
  }

  function drag(e) {
      if (isDraggingText) {
          e.preventDefault();
          if (e.type === "touchmove") {
              currentX = e.touches[0].clientX - initialX;
              currentY = e.touches[0].clientY - initialY;
          } else {
              currentX = e.clientX - initialX;
              currentY = e.clientY - initialY;
          }
          xOffset = currentX;
          yOffset = currentY;
          dragItem.style.transform = `translate(calc(-50% + ${currentX}px), calc(-50% + ${currentY}px))`;
      }
  }

  let isDraggingLogo = false;
  let logoCurrentX = 0, logoCurrentY = 0, logoInitialX = 0, logoInitialY = 0;
  let logoXOffset = 0, logoYOffset = 0;
  const logoDragItem = document.getElementById("gc-logo-overlay");

  logoDragItem.addEventListener("mousedown", logoDragStart);
  document.addEventListener("mouseup", logoDragEnd);
  document.addEventListener("mousemove", logoDrag);
  logoDragItem.addEventListener("touchstart", logoDragStart, {passive: false});
  document.addEventListener("touchend", logoDragEnd);
  document.addEventListener("touchmove", logoDrag, {passive: false});

  function logoDragStart(e) {
      if (e.type === "touchstart") {
          logoInitialX = e.touches[0].clientX - logoXOffset;
          logoInitialY = e.touches[0].clientY - logoYOffset;
      } else {
          logoInitialX = e.clientX - logoXOffset;
          logoInitialY = e.clientY - logoYOffset;
      }
      if (e.target === logoDragItem) {
          isDraggingLogo = true;
          logoDragItem.style.cursor = 'grabbing';
      }
  }

  function logoDragEnd() {
      logoInitialX = logoCurrentX;
      logoInitialY = logoCurrentY;
      isDraggingLogo = false;
      logoDragItem.style.cursor = 'grab';
  }

  function logoDrag(e) {
      if (isDraggingLogo) {
          e.preventDefault();
          if (e.type === "touchmove") {
              logoCurrentX = e.touches[0].clientX - logoInitialX;
              logoCurrentY = e.touches[0].clientY - logoInitialY;
          } else {
              logoCurrentX = e.clientX - logoInitialX;
              logoCurrentY = e.clientY - logoInitialY;
          }
          logoXOffset = logoCurrentX;
          logoYOffset = logoCurrentY;
          logoDragItem.style.transform = `translate(calc(-50% + ${logoCurrentX}px), calc(-50% + ${logoCurrentY}px))`;
      }
  }

  function updateCustomText() {
      const text = document.getElementById('customTextInput').value;
      const font = document.getElementById('customTextFont').value;
      const color = document.getElementById('customTextColor').value;
      const size = document.getElementById('customTextSize').value;
      
      dragItem.innerText = text;
      dragItem.style.fontFamily = font;
      dragItem.style.color = color;
      dragItem.style.fontSize = size + 'px';
      
      if(text.trim() !== '') {
          dragItem.style.display = 'block';
      } else {
          dragItem.style.display = 'none';
      }
  }

  function handleGenericLogoUpload(event) {
    const file = event.target.files[0];
    if (file) {
      genericLogoFile = file;
      const reader = new FileReader();
      reader.onload = function(e) {
        const logoImg = document.getElementById('gc-logo-overlay');
        logoImg.src = e.target.result;
        logoImg.style.display = 'block';
        adjustGenericLogoSize(document.getElementById('gc-logo-size').value);
      }
      reader.readAsDataURL(file);
    }
  }

  function adjustGenericLogoSize(val) {
    const logoImg = document.getElementById('gc-logo-overlay');
    logoImg.style.width = val + 'px';
  }

  function submitGenericInquiry() {
    if (!currentGenericProduct) return;
    
    const userName = document.getElementById('gc-user-name').value.trim();
    const userEmail = document.getElementById('gc-user-email').value.trim();
    const userMobile = document.getElementById('gc-user-mobile').value.trim();
    const notes = document.getElementById('gc-notes').value.trim();
    
    if (!userName || !userEmail || !notes) {
      alert("Please fill out your Name, Email, and Additional Notes.");
      return;
    }
    
    let typographyText = 'None';
    const textOverlay = document.getElementById('liveTextOverlay');
    if (textOverlay && textOverlay.innerText.trim() !== '') {
        typographyText = `Text: "${textOverlay.innerText.trim()}", Font: ${textOverlay.style.fontFamily}, Color: ${textOverlay.style.color}, Size: ${textOverlay.style.fontSize}`;
    }

    const bodyText = `
General
---
Message: Customization inquiry for ShopAll catalog product.
Product Name: ${currentGenericProduct.name}
Article Number: ${currentGenericProduct.article_number}

Finishing
---
Custom Typography: ${typographyText}
Notes: ${notes}
    `;

    const formData = new FormData();
    formData.append('name', userName);
    formData.append('email', userEmail);
    formData.append('mobile', userMobile);
    formData.append('whatsapp', userMobile);
    formData.append('subject', 'ShopAll Product Customization Inquiry - ' + currentGenericProduct.name);
    formData.append('body', bodyText);
    formData.append('message', notes);
    
    if (genericLogoFile) {
      formData.append('designImage', genericLogoFile);
    }

    const btn = document.querySelector('.gc-submit-btn');
    btn.innerText = 'Sending...';
    btn.disabled = true;

    fetch('<?= url('') ?>send_design_inquiry', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      btn.innerText = 'Send Inquiry';
      btn.disabled = false;
      if (data.success) {
        alert('Inquiry sent successfully!');
        closeGenericCustomizer();
      } else {
        alert('Error: ' + data.message);
      }
    })
    .catch(err => {
      btn.innerText = 'Send Inquiry';
      btn.disabled = false;
      alert('Failed to send inquiry.');
    });
  }
</script>
</body>
</html>
