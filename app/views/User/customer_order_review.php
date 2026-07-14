<?php
$hide_header = true;
$hide_footer = true;
$hide_chatbot = true;
include('header.php');

$theme = $global_theme ?? 'theme-default';
$themeFile = ($theme === 'theme-luxury') ? 'theme-luxury-frontend.css' : 'theme-default-frontend.css';
?>
<!DOCTYPE html>
<html lang="en" class="<?= htmlspecialchars($theme); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StitchSmart - Rate &amp; Review</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/<?= htmlspecialchars($themeFile); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        try {
            var t = '<?= htmlspecialchars($theme); ?>';
            document.documentElement.classList.add(t);
        } catch(e) {}
    </script>

<style>
/* ============================================================
   RATE & REVIEW – ULTRA-PREMIUM REDESIGN (BOTH THEMES)
   ============================================================ */

/* ── CSS VARIABLES ───────────────────────────────────────── */
.rv-page {
    --rv-bg:            #F2EDE4;
    --rv-header-bg:     #FFFCF8;
    --rv-card-bg:       #FFFFFF;
    --rv-card-bg2:      #FDFAF5;
    --rv-border:        rgba(92,60,38,0.13);
    --rv-text-h:        #1C0F08;
    --rv-text-body:     #5C4335;
    --rv-text-muted:    #9C8575;
    --rv-accent:        #C9913E;
    --rv-accent-dk:     #9A6C20;
    --rv-accent-grad:   linear-gradient(135deg,#C9913E 0%,#9A6C20 100%);
    --rv-accent-soft:   rgba(201,145,62,0.13);
    --rv-accent-glow:   rgba(201,145,62,0.30);
    --rv-star-empty:    #D6CCC4;
    --rv-star-filled:   #F59E0B;
    --rv-star-glow:     rgba(245,158,11,0.50);
    --rv-input-bg:      #F7F2EA;
    --rv-input-border:  rgba(92,60,38,0.18);
    --rv-shadow-sm:     0 2px 14px rgba(36,21,15,0.08);
    --rv-shadow-md:     0 12px 40px rgba(36,21,15,0.13);
    --rv-shadow-lg:     0 24px 64px rgba(36,21,15,0.18);
    --rv-success-bg:    rgba(16,185,129,0.10);
    --rv-success-bdr:   rgba(16,185,129,0.22);
    --rv-success-txt:   #059669;
    --rv-error-bg:      rgba(239,68,68,0.10);
    --rv-error-bdr:     rgba(239,68,68,0.22);
    --rv-error-txt:     #DC2626;
}

/* ── LUXURY DARK OVERRIDE ────────────────────────────────── */
:root.theme-luxury .rv-page {
    --rv-bg:            #060606;
    --rv-header-bg:     #0C0C0C;
    --rv-card-bg:       #111111;
    --rv-card-bg2:      #161616;
    --rv-border:        rgba(202, 151, 69,0.16);
    --rv-text-h:        #F4E9D3;
    --rv-text-body:     rgba(244,233,211,0.82);
    --rv-text-muted:    rgba(244,233,211,0.44);
    --rv-accent:        #ca9745;
    --rv-accent-dk:     #8A6421;
    --rv-accent-grad:   linear-gradient(135deg,#ca9745 0%,#8A6421 100%);
    --rv-accent-soft:   rgba(202, 151, 69,0.13);
    --rv-accent-glow:   rgba(202, 151, 69,0.28);
    --rv-star-empty:    rgba(255,255,255,0.18);
    --rv-star-filled:   #FBBF24;
    --rv-star-glow:     rgba(251,191,36,0.50);
    --rv-input-bg:      rgba(255,255,255,0.04);
    --rv-input-border:  rgba(202, 151, 69,0.20);
    --rv-shadow-sm:     0 2px 16px rgba(0,0,0,0.45);
    --rv-shadow-md:     0 12px 42px rgba(0,0,0,0.60);
    --rv-shadow-lg:     0 24px 66px rgba(0,0,0,0.70);
    --rv-success-bg:    rgba(16,185,129,0.10);
    --rv-success-bdr:   rgba(16,185,129,0.20);
    --rv-success-txt:   #34D399;
    --rv-error-bg:      rgba(239,68,68,0.10);
    --rv-error-bdr:     rgba(239,68,68,0.20);
    --rv-error-txt:     #F87171;
}

/* ── BASE ────────────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; }
.rv-page {
    background: var(--rv-bg) !important;
    min-height: 100vh !important;
    font-family: 'Plus Jakarta Sans', 'Inter', sans-serif !important;
    padding-bottom: 5rem !important;
    position: relative !important;
    overflow-x: hidden !important;
}

/* Decorative background orbs */
.rv-page::before,
.rv-page::after {
    content: '' !important;
    position: fixed !important;
    border-radius: 50% !important;
    pointer-events: none !important;
    z-index: 0 !important;
    filter: blur(80px) !important;
    opacity: 0.35 !important;
}
.rv-page::before {
    width: 500px !important; height: 500px !important;
    top: -120px !important; right: -100px !important;
    background: radial-gradient(circle, rgba(201,145,62,0.18), transparent 70%) !important;
}
.rv-page::after {
    width: 400px !important; height: 400px !important;
    bottom: 5% !important; left: -80px !important;
    background: radial-gradient(circle, rgba(201,145,62,0.12), transparent 70%) !important;
}
:root.theme-luxury .rv-page::before { opacity: 0.5 !important; }
:root.theme-luxury .rv-page::after  { opacity: 0.4 !important; }

/* ── PAGE HEADER ─────────────────────────────────────────── */
.rv-page .rv-header {
    position: relative !important;
    z-index: 10 !important;
    background: var(--rv-header-bg) !important;
    border-bottom: 1px solid var(--rv-border) !important;
    padding: 0 !important;
    margin-bottom: 48px !important;
    overflow: hidden !important;
}
.rv-page .rv-header::before {
    content: '' !important;
    position: absolute !important;
    inset: 0 !important;
    background: linear-gradient(135deg, var(--rv-accent-soft) 0%, transparent 60%) !important;
    pointer-events: none !important;
}
.rv-page .rv-header-inner {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    flex-wrap: wrap !important;
    gap: 16px !important;
    padding: 28px 0 22px !important;
    position: relative !important;
    z-index: 1 !important;
}
.rv-page .rv-header-left { display: flex !important; align-items: center !important; gap: 18px !important; }
.rv-page .rv-header-icon {
    width: 56px !important; height: 56px !important;
    border-radius: 18px !important;
    background: var(--rv-accent-grad) !important;
    display: grid !important; place-items: center !important;
    box-shadow: 0 8px 24px var(--rv-accent-glow) !important;
    flex-shrink: 0 !important;
}
.rv-page .rv-header-icon i { font-size: 1.5rem !important; color: #fff !important; }
.rv-page .rv-header-title {
    font-family: 'Playfair Display', serif !important;
    font-size: 1.9rem !important;
    font-weight: 900 !important;
    color: var(--rv-text-h) !important;
    margin: 0 0 4px !important;
    line-height: 1.1 !important;
}
.rv-page .rv-header-sub {
    font-size: 0.875rem !important;
    color: var(--rv-text-muted) !important;
    margin: 0 !important;
    font-weight: 400 !important;
}

/* Back button */
.rv-page .rv-back-btn {
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
    padding: 10px 20px !important;
    border-radius: 50px !important;
    font-size: 0.875rem !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    background: var(--rv-accent-soft) !important;
    border: 1px solid var(--rv-border) !important;
    color: var(--rv-text-body) !important;
    transition: all 0.25s ease !important;
    white-space: nowrap !important;
}
.rv-page .rv-back-btn:hover {
    border-color: var(--rv-accent) !important;
    color: var(--rv-accent) !important;
    transform: translateX(-3px) !important;
    box-shadow: 0 4px 16px var(--rv-accent-glow) !important;
}
.rv-page .rv-back-btn i { font-size: 0.875rem !important; }

/* ── WRAPPER ──────────────────────────────────────────────── */
.rv-page .rv-wrapper {
    max-width: 680px !important;
    margin: 0 auto !important;
    position: relative !important;
    z-index: 5 !important;
}

/* ── ALERTS ───────────────────────────────────────────────── */
.rv-page .rv-alert {
    padding: 14px 18px !important;
    border-radius: 14px !important;
    margin-bottom: 20px !important;
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    font-weight: 600 !important;
    font-size: 0.9rem !important;
    animation: rv-slide-in 0.4s ease both !important;
}
.rv-alert-success {
    background: var(--rv-success-bg) !important;
    border: 1px solid var(--rv-success-bdr) !important;
    color: var(--rv-success-txt) !important;
}
.rv-alert-error {
    background: var(--rv-error-bg) !important;
    border: 1px solid var(--rv-error-bdr) !important;
    color: var(--rv-error-txt) !important;
}
.rv-page .rv-alert i { font-size: 1.1rem !important; flex-shrink: 0 !important; }

/* ── REVIEW CARD ─────────────────────────────────────────── */
.rv-page .rv-card {
    background: var(--rv-card-bg) !important;
    border: 1px solid var(--rv-border) !important;
    border-radius: 28px !important;
    overflow: hidden !important;
    box-shadow: var(--rv-shadow-md) !important;
    margin-bottom: 28px !important;
    animation: rv-rise 0.65s cubic-bezier(0.16, 1, 0.3, 1) both !important;
    transition: box-shadow 0.3s ease, border-color 0.3s ease !important;
}
.rv-page .rv-card:hover {
    box-shadow: var(--rv-shadow-lg) !important;
    border-color: rgba(202, 151, 69,0.35) !important;
}

/* Product strip header */
.rv-page .rv-prod-strip {
    display: flex !important;
    align-items: center !important;
    gap: 18px !important;
    padding: 22px 26px !important;
    background: linear-gradient(135deg, var(--rv-accent-soft) 0%, var(--rv-card-bg2) 100%) !important;
    border-bottom: 1px solid var(--rv-border) !important;
    position: relative !important;
    overflow: hidden !important;
}
.rv-page .rv-prod-strip::after {
    content: '"' !important;
    position: absolute !important;
    right: 20px !important;
    top: -10px !important;
    font-size: 7rem !important;
    font-family: 'Playfair Display', serif !important;
    color: var(--rv-accent) !important;
    opacity: 0.06 !important;
    line-height: 1 !important;
    pointer-events: none !important;
}
.rv-page .rv-prod-img-wrap {
    flex-shrink: 0 !important;
    width: 78px !important; height: 78px !important;
    border-radius: 16px !important;
    overflow: hidden !important;
    border: 2px solid var(--rv-accent-soft) !important;
    box-shadow: 0 6px 20px rgba(0,0,0,0.12) !important;
    background: var(--rv-input-bg) !important;
    display: grid !important;
    place-items: center !important;
}
.rv-page .rv-prod-img-wrap img {
    width: 100% !important; height: 100% !important;
    object-fit: cover !important;
    display: block !important;
}
.rv-page .rv-prod-img-wrap i { font-size: 2rem !important; color: var(--rv-text-muted) !important; opacity: 0.5 !important; }
.rv-page .rv-prod-name {
    font-size: 1.1rem !important;
    font-weight: 700 !important;
    color: var(--rv-text-h) !important;
    margin: 0 0 6px !important;
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    line-height: 1.3 !important;
}
.rv-page .rv-prod-meta {
    font-size: 0.82rem !important;
    color: var(--rv-text-muted) !important;
    margin: 0 !important;
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    flex-wrap: wrap !important;
}
.rv-page .rv-prod-meta span {
    display: inline-flex !important;
    align-items: center !important;
    gap: 4px !important;
}
.rv-page .rv-prod-meta .rv-dot {
    width: 3px !important; height: 3px !important;
    border-radius: 50% !important;
    background: var(--rv-text-muted) !important;
    display: inline-block !important;
}

/* Already reviewed badge */
.rv-page .rv-reviewed-badge {
    display: flex !important;
    align-items: center !important;
    gap: 14px !important;
    padding: 20px 26px !important;
    background: var(--rv-success-bg) !important;
    border-top: 1px solid var(--rv-success-bdr) !important;
}
.rv-page .rv-reviewed-badge-icon {
    width: 44px !important; height: 44px !important;
    border-radius: 50% !important;
    background: rgba(16,185,129,0.15) !important;
    display: grid !important; place-items: center !important;
    flex-shrink: 0 !important;
}
:root.theme-luxury .rv-page .rv-reviewed-badge-icon { background: rgba(52,211,153,0.12) !important; }
.rv-page .rv-reviewed-badge-icon i { font-size: 1.3rem !important; color: var(--rv-success-txt) !important; }
.rv-page .rv-reviewed-badge-text {
    font-size: 0.9rem !important;
    font-weight: 600 !important;
    color: var(--rv-success-txt) !important;
    margin: 0 !important;
}
.rv-page .rv-reviewed-badge-sub {
    font-size: 0.8rem !important;
    color: var(--rv-text-muted) !important;
    margin: 2px 0 0 !important;
    font-weight: 400 !important;
}

/* ── FORM BODY ───────────────────────────────────────────── */
.rv-page .rv-form-body {
    padding: 28px 30px 30px !important;
    display: flex !important;
    flex-direction: column !important;
    gap: 24px !important;
}

/* Section label */
.rv-page .rv-sec-label {
    font-size: 0.78rem !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.10em !important;
    color: var(--rv-text-muted) !important;
    margin-bottom: 10px !important;
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
}
.rv-page .rv-sec-label::before {
    content: '' !important;
    width: 16px !important; height: 2px !important;
    border-radius: 2px !important;
    background: var(--rv-accent-grad) !important;
    display: block !important;
}

/* ── STAR RATING ─────────────────────────────────────────── */
.rv-page .rv-stars-section {}
.rv-page .rv-stars-row {
    display: flex !important;
    align-items: center !important;
    gap: 0 !important;
    background: var(--rv-input-bg) !important;
    border: 1px solid var(--rv-input-border) !important;
    border-radius: 20px !important;
    padding: 16px 22px !important;
    justify-content: space-between !important;
    flex-wrap: wrap !important;
    gap: 12px !important;
    transition: border-color 0.3s !important;
}
.rv-page .rv-stars-row:focus-within { border-color: var(--rv-accent) !important; }

.rv-page .rv-stars-wrap {
    display: flex !important;
    flex-direction: row-reverse !important;
    gap: 4px !important;
    align-items: center !important;
}
.rv-page .rv-stars-wrap input[type="radio"] { display: none !important; }
.rv-page .rv-stars-wrap label {
    font-size: 2.6rem !important;
    color: var(--rv-star-empty) !important;
    cursor: pointer !important;
    transition: color 0.18s ease, transform 0.18s ease, filter 0.18s ease !important;
    line-height: 1 !important;
    display: block !important;
}
.rv-page .rv-stars-wrap label:hover,
.rv-page .rv-stars-wrap label:hover ~ label,
.rv-page .rv-stars-wrap input:checked ~ label {
    color: var(--rv-star-filled) !important;
    transform: scale(1.18) !important;
    filter: drop-shadow(0 0 8px var(--rv-star-glow)) !important;
}

/* Emoji feedback */
.rv-page .rv-rating-feedback {
    font-size: 0.88rem !important;
    font-weight: 700 !important;
    color: var(--rv-text-muted) !important;
    min-width: 110px !important;
    text-align: right !important;
    transition: color 0.3s !important;
    display: flex !important;
    align-items: center !important;
    gap: 6px !important;
    justify-content: flex-end !important;
}
.rv-page .rv-feedback-emoji {
    font-size: 1.5rem !important;
    display: inline-block !important;
    transition: transform 0.3s ease !important;
}

/* Rating hint dots */
.rv-page .rv-rating-hints {
    display: flex !important;
    justify-content: space-between !important;
    padding: 0 4px !important;
    margin-top: 6px !important;
}
.rv-page .rv-rating-hints span {
    font-size: 0.72rem !important;
    color: var(--rv-text-muted) !important;
    font-weight: 500 !important;
}

/* ── TEXTAREA ────────────────────────────────────────────── */
.rv-page .rv-textarea-wrap { position: relative !important; }
.rv-page .rv-textarea {
    width: 100% !important;
    background: var(--rv-input-bg) !important;
    border: 1px solid var(--rv-input-border) !important;
    border-radius: 18px !important;
    padding: 18px 20px 40px !important;
    color: var(--rv-text-body) !important;
    font-family: 'Plus Jakarta Sans', inherit !important;
    font-size: 0.925rem !important;
    resize: none !important;
    min-height: 130px !important;
    transition: border-color 0.25s ease, box-shadow 0.25s ease !important;
    display: block !important;
    line-height: 1.7 !important;
}
.rv-page .rv-textarea:focus {
    outline: none !important;
    border-color: var(--rv-accent) !important;
    box-shadow: 0 0 0 4px var(--rv-accent-soft) !important;
}
.rv-page .rv-textarea::placeholder {
    color: var(--rv-text-muted) !important;
    opacity: 0.7 !important;
    font-weight: 400 !important;
}
.rv-page .rv-char-count {
    position: absolute !important;
    bottom: 12px !important;
    right: 16px !important;
    font-size: 0.75rem !important;
    color: var(--rv-text-muted) !important;
    font-weight: 500 !important;
    pointer-events: none !important;
    transition: color 0.2s !important;
}
.rv-page .rv-char-count.rv-char-warn { color: #F59E0B !important; }
.rv-page .rv-char-count.rv-char-max  { color: #EF4444 !important; }

/* ── SUBMIT BUTTON ───────────────────────────────────────── */
.rv-page .rv-submit-btn {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 10px !important;
    width: 100% !important;
    padding: 16px 28px !important;
    border-radius: 18px !important;
    font-size: 1rem !important;
    font-weight: 700 !important;
    border: none !important;
    cursor: pointer !important;
    background: var(--rv-accent-grad) !important;
    color: #fff !important;
    box-shadow: 0 6px 24px var(--rv-accent-glow) !important;
    transition: transform 0.25s ease, box-shadow 0.25s ease !important;
    letter-spacing: 0.01em !important;
    position: relative !important;
    overflow: hidden !important;
}
.rv-page .rv-submit-btn::before {
    content: '' !important;
    position: absolute !important;
    inset: 0 !important;
    background: linear-gradient(135deg, rgba(255,255,255,0.14) 0%, transparent 60%) !important;
    pointer-events: none !important;
}
.rv-page .rv-submit-btn:hover {
    transform: translateY(-3px) !important;
    box-shadow: 0 12px 36px var(--rv-accent-glow) !important;
}
.rv-page .rv-submit-btn:active { transform: translateY(0) !important; }
.rv-page .rv-submit-btn i { font-size: 1.1rem !important; }

/* ── EMPTY STATE ─────────────────────────────────────────── */
.rv-page .rv-empty {
    text-align: center !important;
    padding: 70px 36px !important;
    background: var(--rv-card-bg) !important;
    border: 1px dashed var(--rv-border) !important;
    border-radius: 28px !important;
    box-shadow: var(--rv-shadow-sm) !important;
}
.rv-page .rv-empty i {
    font-size: 3.5rem !important;
    color: var(--rv-accent) !important;
    opacity: 0.45 !important;
    display: block !important;
    margin-bottom: 18px !important;
}
.rv-page .rv-empty h3 {
    font-family: 'Playfair Display', serif !important;
    font-size: 1.6rem !important;
    font-weight: 900 !important;
    color: var(--rv-text-h) !important;
    margin-bottom: 10px !important;
}
.rv-page .rv-empty p {
    color: var(--rv-text-muted) !important;
    font-size: 0.95rem !important;
    margin-bottom: 24px !important;
    line-height: 1.7 !important;
}

/* ── ANIMATIONS ──────────────────────────────────────────── */
@keyframes rv-rise {
    from { opacity: 0; transform: translateY(24px) scale(0.98); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}
@keyframes rv-slide-in {
    from { opacity: 0; transform: translateX(-14px); }
    to   { opacity: 1; transform: translateX(0); }
}
@keyframes rv-pop {
    0%   { transform: scale(1); }
    40%  { transform: scale(1.25); }
    100% { transform: scale(1.15); }
}

/* ── RESPONSIVE ──────────────────────────────────────────── */
@media (max-width: 768px) {
    .rv-page .rv-header-title { font-size: 1.6rem !important; }
    .rv-page .rv-form-body { padding: 22px 18px 24px !important; gap: 20px !important; }
    .rv-page .rv-prod-strip { padding: 18px 18px !important; }
    .rv-page .rv-stars-wrap label { font-size: 2.2rem !important; }
    .rv-page .rv-rating-feedback { min-width: auto !important; }
    .rv-page .rv-stars-row { padding: 14px 16px !important; }
}
</style>

<div class="rv-page">

    <!-- PAGE HEADER -->
    <div class="rv-header">
        <div class="container">
            <div class="rv-header-inner">
                <div class="rv-header-left">
                    <div class="rv-header-icon">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div>
                        <h1 class="rv-header-title">Share Your Experience</h1>
                        <p class="rv-header-sub">Order #<?= htmlspecialchars($order['id']); ?> &nbsp;·&nbsp; Your feedback means the world to us</p>
                    </div>
                </div>
                <a href="<?= url('') ?>customer_orders" class="rv-back-btn">
                    <i class="bi bi-arrow-left"></i> Back to Orders
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="rv-wrapper">

            <!-- Global Alerts -->
            <?php if (isset($_SESSION['review_success'])): ?>
                <div class="rv-alert rv-alert-success">
                    <i class="bi bi-check-circle-fill"></i>
                    <?= htmlspecialchars($_SESSION['review_success']); ?>
                </div>
                <?php unset($_SESSION['review_success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['review_error'])): ?>
                <div class="rv-alert rv-alert-error">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <?= htmlspecialchars($_SESSION['review_error']); ?>
                </div>
                <?php unset($_SESSION['review_error']); ?>
            <?php endif; ?>

            <?php if (empty($items)): ?>
                <div class="rv-empty">
                    <i class="bi bi-box-seam"></i>
                    <h3>No Items Found</h3>
                    <p>There are no products in this order to review.</p>
                    <a href="<?= url('') ?>customer_orders" class="rv-back-btn">
                        <i class="bi bi-arrow-left"></i> Back to Orders
                    </a>
                </div>

            <?php else: ?>

                <?php
                $delay = 0;
                foreach ($items as $idx => $item):
                    $hasReview = $this->productModel->userHasReviewedProduct($userId, $item['product_id']);
                    $delay += 0.1;
                    $productImage = strtok($item['product_image'] ?? '', ',');
                    $imgSrc = $productImage ? BASE_URL . '/' . htmlspecialchars(trim($productImage)) : '';
                    $uid = 'prod_' . $item['product_id'] . '_' . $idx;
                ?>
                <div class="rv-card" style="animation-delay: <?= $delay ?>s !important;">

                    <!-- Product Header Strip -->
                    <div class="rv-prod-strip">
                        <div class="rv-prod-img-wrap">
                            <?php if ($imgSrc): ?>
                                <img src="<?= $imgSrc ?>" alt="Product" onerror="this.parentElement.innerHTML='<i class=\'bi bi-image\'></i>'">
                            <?php else: ?>
                                <i class="bi bi-scissors"></i>
                            <?php endif; ?>
                        </div>
                        <div>
                            <p class="rv-prod-name"><?= htmlspecialchars($item['product_name'] ?? 'Premium Item'); ?></p>
                            <p class="rv-prod-meta">
                                <span><i class="bi bi-upc" style="color:var(--rv-accent)"></i> #<?= htmlspecialchars($item['product_id'] ?? 'N/A'); ?></span>
                                <span class="rv-dot"></span>
                                <span><i class="bi bi-bag" style="color:var(--rv-accent)"></i> Qty: <?= htmlspecialchars($item['quantity'] ?? '1'); ?></span>
                            </p>
                        </div>
                    </div>

                    <?php if ($hasReview): ?>
                        <!-- Already Reviewed -->
                        <div class="rv-reviewed-badge">
                            <div class="rv-reviewed-badge-icon">
                                <i class="bi bi-patch-check-fill"></i>
                            </div>
                            <div>
                                <p class="rv-reviewed-badge-text">Review Submitted!</p>
                                <p class="rv-reviewed-badge-sub">You've already reviewed this product. Thank you for your feedback.</p>
                            </div>
                        </div>

                    <?php else: ?>
                        <!-- Review Form -->
                        <div class="rv-form-body">
                            <form method="POST" action="<?= url('') ?>save_review" id="form_<?= $uid ?>">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? ''); ?>">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['product_id']); ?>">
                                <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id']); ?>">

                                <!-- Star Rating -->
                                <div class="rv-stars-section mb-4">
                                    <div class="rv-sec-label">Your Rating</div>
                                    <div class="rv-stars-row" id="starsrow_<?= $uid ?>">
                                        <div class="rv-stars-wrap">
                                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                                <input type="radio" name="rating" value="<?= $i; ?>"
                                                       id="<?= $uid ?>_r<?= $i ?>"
                                                       data-uid="<?= $uid ?>"
                                                       data-val="<?= $i ?>" required>
                                                <label for="<?= $uid ?>_r<?= $i ?>" title="<?= $i ?> star<?= $i > 1 ? 's' : '' ?>">★</label>
                                            <?php endfor; ?>
                                        </div>
                                        <div class="rv-rating-feedback" id="fb_<?= $uid ?>">
                                            <span class="rv-feedback-emoji" id="emo_<?= $uid ?>">☆</span>
                                            <span id="fbtxt_<?= $uid ?>">Tap a star</span>
                                        </div>
                                    </div>
                                    <div class="rv-rating-hints">
                                        <span>Poor</span>
                                        <span>Average</span>
                                        <span>Excellent</span>
                                    </div>
                                </div>

                                <!-- Review Text -->
                                <div class="mb-4">
                                    <div class="rv-sec-label">Your Review</div>
                                    <div class="rv-textarea-wrap">
                                        <textarea
                                            name="review_text"
                                            class="rv-textarea"
                                            id="ta_<?= $uid ?>"
                                            placeholder="Tell us what you loved — the quality, fit, stitching, and overall experience..."
                                            maxlength="600"
                                            required></textarea>
                                        <span class="rv-char-count" id="cc_<?= $uid ?>">0 / 600</span>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <button type="submit" class="rv-submit-btn">
                                    <i class="bi bi-send-fill"></i>
                                    Submit Review
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>

                </div>
                <?php endforeach; ?>

            <?php endif; ?>

        </div><!-- /rv-wrapper -->
    </div><!-- /container -->
</div><!-- /rv-page -->

<script>
(function() {
    const feedbackMap = {
        1: { emoji: '😞', text: 'Poor' },
        2: { emoji: '😕', text: 'Fair' },
        3: { emoji: '🙂', text: 'Good' },
        4: { emoji: '😊', text: 'Great' },
        5: { emoji: '🤩', text: 'Excellent!' }
    };

    document.querySelectorAll('.rv-stars-wrap input[type="radio"]').forEach(function(input) {
        input.addEventListener('change', function() {
            const uid  = this.dataset.uid;
            const val  = parseInt(this.dataset.val, 10);
            const info = feedbackMap[val] || {};
            const emo  = document.getElementById('emo_' + uid);
            const txt  = document.getElementById('fbtxt_' + uid);
            if (emo) {
                emo.textContent = info.emoji || '★';
                emo.style.animation = 'none';
                void emo.offsetWidth;
                emo.style.animation = 'rv-pop 0.35s ease both';
            }
            if (txt) {
                txt.textContent = info.text || '';
                txt.style.color = 'var(--rv-accent)';
            }
        });
    });

    document.querySelectorAll('.rv-textarea').forEach(function(ta) {
        const id   = ta.id.replace('ta_', '');
        const cc   = document.getElementById('cc_' + id);
        if (!cc) return;
        ta.addEventListener('input', function() {
            const len = this.value.length;
            const max = parseInt(this.maxLength, 10) || 600;
            cc.textContent = len + ' / ' + max;
            cc.classList.remove('rv-char-warn','rv-char-max');
            if      (len >= max)       cc.classList.add('rv-char-max');
            else if (len >= max * 0.8) cc.classList.add('rv-char-warn');
        });
    });
})();
</script>

<?php include('footer.php'); ?>
</body>
</html>
