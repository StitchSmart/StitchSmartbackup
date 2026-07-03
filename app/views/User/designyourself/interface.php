<?php
$allowedThemes = ['theme-default', 'theme-luxury'];
$requestedTheme = strtolower(trim((string) ($global_theme ?? 'theme-luxury')));
$validatedTheme = in_array($requestedTheme, $allowedThemes, true) ? $requestedTheme : 'theme-luxury';
$themeValidationMessage = $validatedTheme !== $requestedTheme
    ? 'Invalid theme setting detected. The page has been safely reset to the luxury layout.'
    : 'Theme settings are valid and the responsive design layer is active.';
$themeModeLabel = $validatedTheme === 'theme-luxury' ? 'Luxury mode' : 'Classic mode';
$validatedPageTitle = htmlspecialchars($webname ?? 'Stitch Smart', ENT_QUOTES, 'UTF-8');
$validatedMetaDescription = htmlspecialchars($meta_description ?? 'Create premium apparel with smart styling controls.', ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="<?= $validatedMetaDescription ?>" />
  <title><?= $validatedPageTitle ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="<?= BASE_URL ?>/css/navbar.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>/css/footer.css?v=1.5" rel="stylesheet">
  <link href="<?= BASE_URL ?>/css/<?= htmlspecialchars($validatedTheme, ENT_QUOTES, 'UTF-8') ?>-frontend.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>/css/design.css?v=<?= time() ?>" rel="stylesheet">
</head>
<body class="design-landing-body <?= htmlspecialchars($validatedTheme, ENT_QUOTES, 'UTF-8') ?>">

<?php $hide_announcement = true; $hide_chatbot = true; require_once BASE_PATH . '/app/views/User/header.php'; ?>

<main class="design-main-shell design-main-shell--specific">
  <section class="design-hero-panel" aria-label="Design studio overview">
    <div class="design-hero-copy">
      <div class="eyebrow-row">
        <span class="hero-eyebrow">Design Studio</span>
        <span class="hero-status-badge"><?= htmlspecialchars($themeModeLabel, ENT_QUOTES, 'UTF-8') ?></span>
      </div>

      <h1>Create premium apparel that feels custom-built.</h1>
      <p class="design-hero-copy-text">
        Pick a product, preview it in a 3D stage, and move into the editor with a responsive layout that stays clean across desktop, tablet, and mobile.
      </p>

      <div class="design-hero-highlights" aria-label="studio features">
        <span class="highlight-pill"><i class="bi bi-box-seam"></i> 3D product preview</span>
        <span class="highlight-pill"><i class="bi bi-phone"></i> responsive layout</span>
        <span class="highlight-pill"><i class="bi bi-shield-check"></i> safe theme validation</span>
      </div>

      <div class="design-hero-actions">
        <a href="#home" class="hero-cta primary">Start customizing</a>
        <a href="<?= BASE_URL ?>/index.php?page=products" class="hero-cta secondary">Browse collection</a>
      </div>
    </div>

    <div class="design-stage-panel" aria-label="3D preview stage">
      <div class="stage-glow orb-one"></div>
      <div class="stage-glow orb-two"></div>
      <div class="design-stage-card">
        <div class="stage-header-row">
          <span class="stage-live-dot"></span>
          <span class="stage-live-text">Live preview</span>
        </div>

        <div class="stage-figure" aria-hidden="true">
          <div class="stage-shirt"></div>
          <div class="stage-sleeve stage-sleeve-left"></div>
          <div class="stage-sleeve stage-sleeve-right"></div>
          <div class="stage-neck"></div>
          <div class="stage-pants"></div>
        </div>

        <div class="stage-info-grid">
          <div class="stage-stat-card">
            <span class="stage-stat-label">Theme</span>
            <strong class="stage-stat-value"><?= htmlspecialchars(ucfirst(str_replace('theme-', '', $validatedTheme)), ENT_QUOTES, 'UTF-8') ?></strong>
          </div>
          <div class="stage-stat-card">
            <span class="stage-stat-label">Layout</span>
            <strong class="stage-stat-value">Responsive</strong>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="theme-validation-banner" role="status" aria-live="polite">
    <div class="status-highlight">
      <span class="status-dot"></span>
      <span class="status-text"><?= htmlspecialchars($themeModeLabel, ENT_QUOTES, 'UTF-8') ?></span>
    </div>
    <p><?= htmlspecialchars($themeValidationMessage, ENT_QUOTES, 'UTF-8') ?></p>
  </section>

  <section id="home" class="page active design-selection-section" aria-label="custom clothing selection">
    <div class="design-selection-header">
      <div>
        <p class="section-kicker">Select a product</p>
        <h2>What would you like to design?</h2>
      </div>
      <p class="section-copy">Every card is responsive, theme-aware, and animated for a premium storefront feel.</p>
    </div>

    <div class="grid" id="clothing-grid"></div>
  </section>

  <div id="hoodie" class="page">
    <div class="design-page-card">
      <button class="back-btn" onclick="navigateTo('')">← Back to selection</button>
      <div class="design-page-copy">
        <h1>Design Your Custom Hoodie</h1>
        <p class="design-page-text">Fit, fabric, color, labels, sunfade, distressing, and quantity controls stay aligned with your active storefront theme.</p>
      </div>

      <iframe
        src="<?= BASE_URL; ?>/index.php?page=hoodie"
        title="Custom hoodie editor"
        allowfullscreen
        scrolling="no"
      ></iframe>
    </div>
  </div>

  <div id="crewneck" class="page">
    <div class="design-page-card">
      <button class="back-btn" onclick="navigateTo('')">← Back to selection</button>
      <div class="design-page-copy">
        <h1>Design Your Custom Crewneck Sweatshirt</h1>
        <p class="design-page-text">Preview the feel of premium stitch work with responsive controls and clear mobile behavior.</p>
      </div>

      <iframe
        src="<?= BASE_URL; ?>/index.php?page=crewneck"
        title="Custom crewneck editor"
        allowfullscreen
        scrolling="no"
      ></iframe>
    </div>
  </div>

  <div id="sweatpants" class="page">
    <div class="design-page-card">
      <button class="back-btn" onclick="navigateTo('')">← Back to selection</button>
      <div class="design-page-copy">
        <h1>Design Your Custom Sweatpants</h1>
        <p class="design-page-text">Straight leg, baggy fit, pockets, labels, and distressing stay easy to navigate on smaller screens.</p>
      </div>

      <iframe
        src="<?= BASE_URL; ?>/index.php?page=sweatpant"
        title="Custom sweatpants editor"
        allowfullscreen
        scrolling="no"
      ></iframe>
    </div>
  </div>

  <div id="shorts" class="page">
    <div class="design-page-card">
      <button class="back-btn" onclick="navigateTo('')">← Back to selection</button>
      <div class="design-page-copy">
        <h1>Design Your Custom Shorts</h1>
        <p class="design-page-text">Length, fit, pockets, elastic, and custom print options remain visible with scaled controls on mobile.</p>
      </div>

      <iframe
        src="<?= BASE_URL; ?>/index.php?page=shorts"
        title="Custom shorts editor"
        allowfullscreen
        scrolling="no"
      ></iframe>
    </div>
  </div>



</main>

<script>
  function adjustActiveIframeHeight() {
    const activePage = document.querySelector('.page.active');
    if (!activePage) return;
    const iframe = activePage.querySelector('iframe');
    if (!iframe) return;
    try {
      if (iframe.contentWindow && iframe.contentWindow.document.body) {
        const body = iframe.contentWindow.document.body;
        const calculatedHeight = Math.max(body.offsetHeight, body.scrollHeight);
        if (calculatedHeight > 100) {
          iframe.style.height = (calculatedHeight + 30) + 'px';
        }
      }
    } catch (e) {
      // Catch cross-origin errors if any
    }
  }

  function navigateTo(pageId) {
    document.querySelectorAll('.page').forEach(page => {
      page.classList.remove('active');
    });

    if (pageId) {
      document.getElementById(pageId).classList.add('active');
      document.querySelector('.design-main-shell')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
      // Trigger a quick resize check
      setTimeout(adjustActiveIframeHeight, 100);
      setTimeout(adjustActiveIframeHeight, 300);
    } else {
      document.getElementById('home').classList.add('active');
    }
  }

  // Setup event listeners for iframe load and periodic check to auto-height the active editor
  window.addEventListener('load', () => {
    document.querySelectorAll('iframe').forEach(iframe => {
      iframe.addEventListener('load', () => {
        adjustActiveIframeHeight();
      });
    });
    // Continually monitor since steps hide/show dynamic elements and sizes change
    setInterval(adjustActiveIframeHeight, 200);
  });

  document.addEventListener('DOMContentLoaded', () => {
    const grid = document.getElementById('clothing-grid');
    const currentTheme = <?= json_encode($validatedTheme, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
    const items = [
      { id: 'hoodie', title: 'Hoodie', kicker: 'Core drop', img: '<?= BASE_URL ?>/pictures/design/empty_hoodie.png', desc: 'Premium hoodies with placement-ready custom artwork.' },
      { id: 'crewneck', title: 'Crewneck Sweatshirt', kicker: 'Warm layers', img: '<?= BASE_URL ?>/pictures/design/empty_crewneck.png', desc: 'Cozy crewnecks with premium color and finish control.' },
      { id: 'sweatpants', title: 'Sweatpants', kicker: 'Relaxed fit', img: '<?= BASE_URL ?>/pictures/design/empty_pants.png', desc: 'Joggers and lounge sets with easy sizing adjustments.' },
      { id: 'shorts', title: 'Shorts', kicker: 'Active look', img: '<?= BASE_URL ?>/pictures/design/empty_shorts.png', desc: 'Custom length, fit, and pocket styling ready to preview.' }
    ];

    items.forEach(item => {
      const card = document.createElement('article');
      card.className = 'design-card';
      card.setAttribute('tabindex', '0');
      card.setAttribute('aria-label', item.title);

      let filterStr = 'filter: drop-shadow(0 12px 24px rgba(0,0,0,0.14));';
      if (currentTheme === 'theme-luxury') {
        filterStr = 'filter: invert(1) drop-shadow(0 12px 24px rgba(255,255,255,0.12));';
      }

      card.innerHTML = `
        <div class="design-card-visual" style="position:relative; z-index:1; display:flex; justify-content:center; align-items:center;">
          <span class="card-shine"></span>
          <img src="${item.img}" alt="${item.title}" style="${filterStr}; position:relative; z-index:2;">
        </div>
        <div class="card-copy">
          <p class="card-kicker">${item.kicker}</p>
          <h3 class="card-title">${item.title}</h3>
          <p class="card-desc">${item.desc}</p>
        </div>
        <div class="design-card-actions">
          <button class="design-card-cta" type="button">Open editor</button>
        </div>
      `;

      const ctaButton = card.querySelector('.design-card-cta');
      ctaButton.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        navigateTo(item.id);
      });

      card.addEventListener('click', () => {
        navigateTo(item.id);
      });
      card.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' || event.key === ' ') {
          event.preventDefault();
          navigateTo(item.id);
        }
      });

      card.addEventListener('mousemove', (event) => {
        const bounds = card.getBoundingClientRect();
        const centerX = bounds.left + bounds.width / 2;
        const centerY = bounds.top + bounds.height / 2;
        const rotateY = ((event.clientX - centerX) / bounds.width) * 10;
        const rotateX = ((event.clientY - centerY) / bounds.height) * -10;
        card.style.transform = `perspective(1200px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
      });

      card.addEventListener('mouseleave', () => {
        card.style.transform = 'perspective(1200px) rotateX(0deg) rotateY(0deg) translateY(0px)';
      });

      grid.appendChild(card);
    });
  });


</script>
</body>
</html>