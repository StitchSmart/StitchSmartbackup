<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us — <?= htmlspecialchars($webname ?? 'StitchSmart') ?></title>
<meta name="description" content="Get in touch with StitchSmart. We're here to help with orders, custom tailoring inquiries, and more.">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="<?= BASE_URL ?>/css/navbar.css" rel="stylesheet">
<link href="<?= BASE_URL ?>/css/footer.css" rel="stylesheet">
<link href="<?= BASE_URL ?>css/<?= $global_theme ?? 'theme-luxury' ?>-frontend.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
/* ════════════════════════════════════════
   CONTACT PAGE — PREMIUM DESIGN
════════════════════════════════════════ */

*, *::before, *::after { box-sizing: border-box; }

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #f7f4f0;
    color: #1a0f0a;
}

/* ── HERO ── */
.contact-hero {
    position: relative;
    min-height: 340px;
    background: linear-gradient(135deg, #fffcf7 0%, #fdf5e6 45%, #f9ebd0 100%);
    display: flex;
    align-items: center;
    overflow: hidden;
}
.contact-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 70% at 80% 50%, rgba(193,154,78,0.13) 0%, transparent 60%),
        radial-gradient(ellipse 40% 50% at 10% 80%, rgba(193,154,78,0.07) 0%, transparent 55%);
}
.hero-orb {
    position: absolute;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(193,154,78,0.18), transparent 70%);
    animation: orbFloat 7s ease-in-out infinite;
}
.hero-orb-1 { width: 420px; height: 420px; top: -100px; right: -80px; animation-delay: 0s; }
.hero-orb-2 { width: 260px; height: 260px; bottom: -80px; left: 5%; animation-delay: 3.5s; }
@keyframes orbFloat {
    0%, 100% { transform: translateY(0) scale(1); }
    50%       { transform: translateY(-18px) scale(1.04); }
}
.hero-content { position: relative; z-index: 2; }
.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(193,154,78,0.15);
    border: 1px solid rgba(193,154,78,0.35);
    color: #c19a4e;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 6px 16px;
    border-radius: 50px;
    margin-bottom: 20px;
}
.hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2.4rem, 5vw, 3.6rem);
    font-weight: 900;
    color: #1a0f0a !important;
    line-height: 1.1;
    margin-bottom: 16px;
}
.hero-title span { color: #c19a4e !important; }
.hero-subtitle {
    color: #4a4a4a !important;
    font-size: 1.05rem;
    font-weight: 400;
    max-width: 480px;
    line-height: 1.7;
}
.hero-divider {
    width: 60px;
    height: 3px;
    background: #c19a4e;
    border-radius: 2px;
    margin: 20px 0;
}

/* ── MAIN SECTION ── */
.contact-section {
    padding: 70px 0 90px;
}

/* ── INFO CARDS ── */
.info-card {
    background: #fff;
    border: 1px solid rgba(193,154,78,0.15);
    border-radius: 20px;
    padding: 28px 24px;
    display: flex;
    align-items: flex-start;
    gap: 18px;
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    cursor: default;
}
.info-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 40px rgba(193,154,78,0.12);
    border-color: rgba(193,154,78,0.35);
}
.info-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    background: linear-gradient(135deg, rgba(193,154,78,0.15), rgba(193,154,78,0.05));
    border: 1px solid rgba(193,154,78,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
    color: #c19a4e;
    flex-shrink: 0;
    transition: background 0.3s, transform 0.3s;
}
.info-card:hover .info-icon {
    background: linear-gradient(135deg, rgba(193,154,78,0.25), rgba(193,154,78,0.10));
    transform: scale(1.08);
}
.info-label {
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #c19a4e;
    margin-bottom: 4px;
}
.info-value {
    font-size: 0.95rem;
    font-weight: 600;
    color: #1a0f0a;
    line-height: 1.5;
}
.info-value a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s;
}
.info-value a:hover { color: #c19a4e; }

/* Social links */
.social-row {
    display: flex;
    gap: 10px;
    margin-top: 6px;
}
.social-btn {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: rgba(193,154,78,0.08);
    border: 1px solid rgba(193,154,78,0.2);
    color: #c19a4e;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    text-decoration: none;
    transition: background 0.2s, transform 0.2s, color 0.2s;
}
.social-btn:hover {
    background: #c19a4e;
    color: #fff;
    transform: translateY(-2px);
}

/* ── FORM CARD ── */
.form-card {
    background: #fff;
    border: 1px solid rgba(193,154,78,0.15);
    border-radius: 24px;
    padding: 44px 40px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.06);
    position: relative;
    overflow: hidden;
}
.form-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(90deg, #c19a4e, #e8c97a, #c19a4e);
    background-size: 200%;
    animation: shimmer 3s linear infinite;
}
@keyframes shimmer {
    0%   { background-position: 200% center; }
    100% { background-position: -200% center; }
}

.form-heading {
    font-family: 'Playfair Display', serif;
    font-size: 1.9rem;
    font-weight: 800;
    color: #1a0f0a;
    margin-bottom: 6px;
}
.form-subheading {
    color: #7a6b5d;
    font-size: 0.93rem;
    margin-bottom: 32px;
}

/* Input styling */
.form-floating label {
    color: #9a8a7a;
    font-size: 0.9rem;
    font-weight: 500;
}
.form-floating .form-control,
.form-floating .form-select {
    border: 1.5px solid rgba(193,154,78,0.2);
    border-radius: 12px;
    background: #fdfaf6;
    color: #1a0f0a;
    font-size: 0.95rem;
    font-weight: 500;
    transition: border-color 0.25s, box-shadow 0.25s, background 0.25s;
}
.form-floating .form-control:focus,
.form-floating .form-select:focus {
    border-color: #c19a4e;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(193,154,78,0.12);
    outline: none;
}
.form-floating textarea.form-control {
    min-height: 130px;
    resize: none;
}

/* subject tag pills */
.subject-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 24px; }
.subject-pill {
    padding: 7px 16px;
    border-radius: 50px;
    border: 1.5px solid rgba(193,154,78,0.3);
    background: transparent;
    color: #7a6b5d;
    font-size: 0.82rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}
.subject-pill:hover,
.subject-pill.active {
    background: #c19a4e;
    border-color: #c19a4e;
    color: #fff;
}
.subject-hidden { display: none; }

/* Submit btn */
.btn-contact-submit {
    background: linear-gradient(135deg, #c19a4e 0%, #a67c37 100%);
    border: none;
    border-radius: 12px;
    color: #fff;
    font-size: 1rem;
    font-weight: 700;
    padding: 14px 36px;
    width: 100%;
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
    overflow: hidden;
}
.btn-contact-submit::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,0);
    transition: background 0.2s;
}
.btn-contact-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 36px rgba(193,154,78,0.35);
}
.btn-contact-submit:hover::after { background: rgba(255,255,255,0.06); }
.btn-contact-submit:active { transform: translateY(0); }

/* Alert */
.alert-success-custom {
    background: linear-gradient(135deg, rgba(34,197,94,0.08), rgba(34,197,94,0.03));
    border: 1px solid rgba(34,197,94,0.25);
    border-radius: 12px;
    color: #166534;
    padding: 14px 18px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 24px;
}
.alert-danger-custom {
    background: linear-gradient(135deg, rgba(220,53,69,0.08), rgba(220,53,69,0.03));
    border: 1px solid rgba(220,53,69,0.25);
    border-radius: 12px;
    color: #842029;
    padding: 14px 18px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 24px;
}

/* ── MAP ── */
.map-wrap {
    margin-top: 70px;
    border-radius: 24px;
    overflow: hidden;
    border: 1px solid rgba(193,154,78,0.2);
    box-shadow: 0 20px 50px rgba(0,0,0,0.07);
    position: relative;
}
.map-header {
    background: linear-gradient(135deg, #1a0f0a, #2d1a10);
    padding: 22px 32px;
    display: flex;
    align-items: center;
    gap: 14px;
}
.map-header-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background: rgba(193,154,78,0.2);
    border: 1px solid rgba(193,154,78,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #c19a4e;
    font-size: 1.1rem;
}
.map-header h5 {
    font-family: 'Playfair Display', serif;
    color: #fff;
    font-weight: 700;
    margin: 0;
}
.map-header p { color: rgba(255,255,255,0.5); font-size: 0.82rem; margin: 0; }
.map-wrap iframe {
    width: 100%;
    height: 380px;
    border: none;
    display: block;
    filter: grayscale(15%);
}

/* ── RESPONSE TIME BANNER ── */
.response-banner {
    background: linear-gradient(135deg, #fffcf7, #f9ebd0);
    border-radius: 20px;
    padding: 28px 36px;
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 32px;
    border: 1px solid rgba(193,154,78,0.25);
}
.response-banner-icon {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    background: rgba(193,154,78,0.15);
    border: 1px solid rgba(193,154,78,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #c19a4e;
    font-size: 1.6rem;
    flex-shrink: 0;
}
.response-banner h6 { color: #1a0f0a !important; font-weight: 700; margin: 0 0 4px; font-size: 1rem; }
.response-banner p { color: #4a4a4a !important; font-size: 0.84rem; margin: 0; }

/* Char counter */
.char-counter {
    font-size: 0.75rem;
    color: #9a8a7a;
    text-align: right;
    margin-top: 4px;
}

/* ── RESPONSIVE ── */
@media (max-width: 991px) {
    .form-card { padding: 32px 24px; }
    .contact-hero { min-height: 260px; }
}
@media (max-width: 575px) {
    .form-card { padding: 24px 16px; }
    .response-banner { flex-direction: column; text-align: center; }
}
</style>
</head>
<body>
<?php include('header.php'); ?>

<!-- ═══════════════════════════════════
     HERO
═══════════════════════════════════ -->
<section class="contact-hero">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="container hero-content py-5">
        <div class="hero-badge">
            <i class="bi bi-envelope-heart-fill"></i>
            Get In Touch
        </div>
        <h1 class="hero-title">We'd Love to <span>Hear</span><br>From You</h1>
        <div class="hero-divider"></div>
        <p class="hero-subtitle">Whether it's a custom order, sizing question, or general inquiry — our team is ready to assist you every step of the way.</p>
    </div>
</section>

<!-- ═══════════════════════════════════
     MAIN CONTENT
═══════════════════════════════════ -->
<section class="contact-section">
    <div class="container">
        <div class="row g-5">

            <!-- ── LEFT: Info Cards ── -->
            <div class="col-lg-4">

                <!-- Response time banner -->
                <div class="response-banner">
                    <div class="response-banner-icon">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                    <div>
                        <h6>Fast Response</h6>
                        <p>We typically reply within 2–4 business hours during working days.</p>
                    </div>
                </div>

                <!-- Info cards stack -->
                <div class="d-flex flex-column gap-3">

                    <div class="info-card">
                        <div class="info-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <div class="info-label">Our Location</div>
                            <div class="info-value">Sialkot, Punjab<br>Pakistan</div>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <div class="info-label">Phone / WhatsApp</div>
                            <div class="info-value">
                                <a href="tel:03249670130">03249670130</a>
                            </div>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <div class="info-label">Email Address</div>
                            <div class="info-value">
                                <a href="mailto:<?= htmlspecialchars($webmail ?? 'stitchsmartofficial@gmail.com') ?>">
                                    <?= htmlspecialchars($webmail ?? 'stitchsmartofficial@gmail.com') ?>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon"><i class="bi bi-clock-fill"></i></div>
                        <div>
                            <div class="info-label">Working Hours</div>
                            <div class="info-value">Mon – Sat<br>9:00 AM – 6:00 PM (PKT)</div>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="info-card">
                        <div>
                            <div class="info-label">Follow Us</div>
                            <div class="social-row mt-2">
                                <?php if (!empty($facebook)): ?>
                                <a href="<?= htmlspecialchars($facebook) ?>" target="_blank" class="social-btn" title="Facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <?php endif; ?>
                                <?php if (!empty($instagram)): ?>
                                <a href="<?= htmlspecialchars($instagram) ?>" target="_blank" class="social-btn" title="Instagram">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <?php endif; ?>
                                <a href="https://wa.link/twb6nv" target="_blank" class="social-btn" title="WhatsApp">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ── RIGHT: Contact Form ── -->
            <div class="col-lg-8">
                <div class="form-card">
                    <h2 class="form-heading">Send Us a Message</h2>
                    <p class="form-subheading">Fill in the form below and we'll get back to you as soon as possible.</p>

                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert-success-custom">
                            <i class="bi bi-check-circle-fill fs-5"></i>
                            <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert-danger-custom">
                            <i class="bi bi-exclamation-circle-fill fs-5"></i>
                            <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>



                    <form id="contactForm" method="POST" action="<?= BASE_URL ?>/index.php?page=contact_send" novalidate>
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
                        <input type="hidden" name="subject" id="subjectHidden" value="General Inquiry" class="subject-hidden">

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" id="contactName" name="name" class="form-control" placeholder=" " required>
                                    <label for="contactName"><i class="bi bi-person me-1"></i>Full Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" id="contactEmail" name="email" class="form-control" placeholder=" " required>
                                    <label for="contactEmail"><i class="bi bi-envelope me-1"></i>Email Address</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="tel" id="contactPhone" name="phone" class="form-control" placeholder=" ">
                                <label for="contactPhone"><i class="bi bi-telephone me-1"></i>Phone Number <span style="opacity:.6">(optional)</span></label>
                            </div>
                        </div>

                        <div class="mb-1">
                            <div class="form-floating">
                                <textarea id="contactMessage" name="message" class="form-control" placeholder=" " required maxlength="1000"></textarea>
                                <label for="contactMessage"><i class="bi bi-chat-text me-1"></i>Your Message</label>
                            </div>
                            <div class="char-counter"><span id="charCount">0</span> / 1000</div>
                        </div>

                        <button type="submit" class="btn-contact-submit mt-4" id="submitBtn">
                            <i class="bi bi-send-fill me-2"></i>Send Message
                        </button>
                    </form>
                </div>
            </div>

        </div>



    </div>
</section>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Subject pill selection
document.querySelectorAll('.subject-pill').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.subject-pill').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('subjectHidden').value = this.dataset.subject;
    });
});

// Character counter
const msg = document.getElementById('contactMessage');
const counter = document.getElementById('charCount');
if (msg && counter) {
    msg.addEventListener('input', () => {
        counter.textContent = msg.value.length;
        counter.style.color = msg.value.length > 900 ? '#dc3545' : '#9a8a7a';
    });
}

// Submit loading state
const form = document.getElementById('contactForm');
const submitBtn = document.getElementById('submitBtn');
if (form && submitBtn) {
    form.addEventListener('submit', function() {
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Sending...';
        submitBtn.disabled = true;
    });
}
</script>
</body>
</html>
