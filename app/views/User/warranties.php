<?php
$hide_header = true;
$hide_footer = true;
$hide_chatbot = true;
include(__DIR__ . '/header.php');

$theme = $global_theme ?? 'theme-default';
$themeFile = ($theme === 'theme-luxury') ? 'theme-luxury-frontend.css' : 'theme-default-frontend.css';
?>
<!DOCTYPE html>
<html lang="en" class="<?= htmlspecialchars($theme); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StitchSmart - Digital Warranty Cards</title>
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
   WARRANTY DASHBOARD – PREMIUM DESIGN (THEME-PROOF)
   ============================================================ */

/* ── DEFAULT (LIGHT) THEME ───────────────────────────────── */
.w-page {
    --w-bg:            #F8F4EE;
    --w-header-bg:     #FFFDFC;
    --w-border:        rgba(92,60,38,0.14);
    --w-card-bg:       linear-gradient(145deg, #FFFFFF, #Fdfbf8);
    --w-text-h:        #24150F;
    --w-text-body:     #5C4335;
    --w-text-muted:    #9C8575;
    --w-accent:        #ca9745;
    --w-accent-dark:   #9e702c;
    --w-accent-soft:   rgba(205,154,72,0.12);
    --w-shadow-sm:     0 4px 15px rgba(36,21,15,0.06);
    --w-shadow-lg:     0 15px 35px rgba(202,151,69,0.15);
    --w-pill-bg:       #F5F0E8;
    --w-glass-border:  rgba(255,255,255,0.6);
}

/* ── LUXURY (DARK) THEME ─────────────────────────────────── */
:root.theme-luxury .w-page {
    --w-bg:            #050505;
    --w-header-bg:     #0A0A0A;
    --w-border:        rgba(202, 151, 69,0.18);
    --w-card-bg:       linear-gradient(145deg, #161616, #0D0D0D);
    --w-text-h:        #F4E9D3;
    --w-text-body:     rgba(244,233,211,0.85);
    --w-text-muted:    rgba(244,233,211,0.48);
    --w-accent:        #ca9745;
    --w-accent-dark:   #e8c547;
    --w-accent-soft:   rgba(202, 151, 69,0.14);
    --w-shadow-sm:     0 4px 15px rgba(0,0,0,0.5);
    --w-shadow-lg:     0 15px 35px rgba(202,151,69,0.08);
    --w-pill-bg:       rgba(255,255,255,0.05);
    --w-glass-border:  rgba(255,255,255,0.05);
}

/* ── BASE ────────────────────────────────────────────────── */
.w-page {
    background: var(--w-bg) !important;
    min-height: 100vh !important;
    font-family: 'Plus Jakarta Sans', 'Inter', sans-serif !important;
    padding-bottom: 3rem !important;
    color: var(--w-text-body) !important;
}

/* ── HEADER ─────────────────────────────────────────── */
.w-page .w-header {
    background: var(--w-header-bg) !important;
    border-bottom: 1px solid var(--w-border) !important;
    padding: 30px 0 !important;
    margin-bottom: 30px !important;
}
.w-page .w-breadcrumb {
    display: flex !important;
    align-items: center !important;
    gap: 7px !important;
    font-size: 0.85rem !important;
    color: var(--w-text-muted) !important;
    margin-bottom: 15px !important;
    text-decoration: none !important;
    transition: color 0.3s !important;
}
.w-page .w-breadcrumb:hover { color: var(--w-accent) !important; }

.w-page .w-header-title {
    font-family: 'Playfair Display', serif !important;
    font-size: 2.2rem !important;
    font-weight: 800 !important;
    color: var(--w-text-h) !important;
    margin-bottom: 5px !important;
}
.w-page .w-header-sub {
    font-size: 1rem !important;
    color: var(--w-text-muted) !important;
    margin: 0 !important;
}

/* ── WARRANTY CARDS (PREMIUM ID CARD LOOK) ──────────────── */
.w-card-wrapper {
    perspective: 1000px;
    margin-bottom: 30px;
}
.w-card {
    background: var(--w-card-bg) !important;
    border: 1px solid var(--w-glass-border) !important;
    border-radius: 20px !important;
    padding: 30px !important;
    position: relative !important;
    overflow: hidden !important;
    box-shadow: var(--w-shadow-sm) !important;
    transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.5s ease !important;
    min-height: 250px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.w-card::before {
    content: '\F52A'; /* Shield Check Icon */
    font-family: 'bootstrap-icons' !important;
    position: absolute !important;
    top: -20px !important; right: -20px !important;
    font-size: 150px !important;
    color: var(--w-accent) !important;
    opacity: 0.04 !important;
    transform: rotate(-15deg) !important;
    pointer-events: none !important;
    transition: transform 0.8s ease, opacity 0.8s ease !important;
}
.w-card-wrapper:hover .w-card {
    transform: translateY(-8px) scale(1.02) !important;
    box-shadow: var(--w-shadow-lg) !important;
    border-color: var(--w-accent) !important;
}
.w-card-wrapper:hover .w-card::before {
    transform: rotate(0deg) scale(1.1) !important;
    opacity: 0.08 !important;
}

.w-card-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
}

.w-code {
    font-family: 'Courier New', Courier, monospace !important;
    font-size: 1.3rem !important;
    font-weight: 800 !important;
    color: var(--w-accent) !important;
    letter-spacing: 2px !important;
    display: flex;
    align-items: center;
    gap: 8px;
}

.w-status {
    padding: 6px 14px !important;
    border-radius: 50px !important;
    font-size: 0.75rem !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em !important;
}
.w-status-active { color: #065F46 !important; background: #D1FAE5 !important; border: 1px solid #A7F3D0 !important; }
.w-status-expired { color: #991B1B !important; background: #FEE2E2 !important; border: 1px solid #FECACA !important; }

:root.theme-luxury .w-status-active { color: #34D399 !important; background: rgba(52,211,153,0.12) !important; border: 1px solid rgba(52,211,153,0.28) !important; }
:root.theme-luxury .w-status-expired { color: #F87171 !important; background: rgba(248,113,113,0.12) !important; border: 1px solid rgba(248,113,113,0.28) !important; }

.w-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 20px;
}
.w-detail-box p {
    font-size: 0.8rem;
    color: var(--w-text-muted);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 2px;
}
.w-detail-box h5 {
    font-size: 1.1rem;
    color: var(--w-text-h);
    font-weight: 700;
    margin: 0;
}

.w-terms {
    font-size: 0.85rem;
    line-height: 1.5;
    color: var(--w-text-body);
    padding: 12px;
    background: var(--w-pill-bg);
    border-radius: 10px;
    border-left: 3px solid var(--w-accent);
}

.w-btn-claim {
    background: var(--w-accent) !important;
    color: #FFF !important;
    border: none !important;
    font-weight: 600 !important;
    padding: 10px 24px !important;
    border-radius: 50px !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 8px !important;
    transition: all 0.3s ease !important;
    margin-top: 15px;
}
:root.theme-luxury .w-btn-claim { color: #000 !important; }
.w-btn-claim:hover {
    background: var(--w-accent-dark) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 5px 15px var(--w-accent-soft) !important;
}

/* ── CLAIMS TABLE ────────────────────────────────────────── */
.w-table-card {
    background: var(--w-header-bg) !important;
    border: 1px solid var(--w-border) !important;
    border-radius: 16px !important;
    overflow: hidden !important;
    box-shadow: var(--w-shadow-sm) !important;
}
.w-table {
    margin-bottom: 0 !important;
    color: var(--w-text-body) !important;
}
.w-table th {
    background: var(--w-pill-bg) !important;
    color: var(--w-text-h) !important;
    font-weight: 700 !important;
    font-size: 0.85rem !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em !important;
    border-bottom: 2px solid var(--w-border) !important;
    padding: 16px 20px !important;
}
.w-table td {
    padding: 16px 20px !important;
    vertical-align: middle !important;
    border-bottom: 1px solid var(--w-border) !important;
    font-size: 0.95rem !important;
}
.w-table tbody tr { transition: background 0.2s !important; }
.w-table tbody tr:hover { background: var(--w-accent-soft) !important; }

/* ── MODALS ──────────────────────────────────────────────── */
.w-modal .modal-content {
    background: var(--w-header-bg) !important;
    border: 1px solid var(--w-border) !important;
    border-radius: 16px !important;
    color: var(--w-text-body) !important;
}
.w-modal .modal-header {
    border-bottom: 1px solid var(--w-border) !important;
}
.w-modal .modal-title {
    color: var(--w-text-h) !important;
    font-family: 'Playfair Display', serif !important;
    font-weight: 700 !important;
}
.w-modal .form-control {
    background: var(--w-pill-bg) !important;
    border: 1px solid var(--w-border) !important;
    color: var(--w-text-body) !important;
    border-radius: 8px !important;
}
.w-modal .form-control:focus {
    box-shadow: 0 0 0 3px var(--w-accent-soft) !important;
    border-color: var(--w-accent) !important;
}

/* Animations */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.anim-up { animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
.delay-1 { animation-delay: 0.1s; }
.delay-2 { animation-delay: 0.2s; }
.delay-3 { animation-delay: 0.3s; }
</style>
</head>
<body>
<div class="w-page">
    
    <div class="w-header">
        <div class="container">
            <a href="<?= url('customer_orders') ?>" class="w-breadcrumb">
                <i class="bi bi-arrow-left"></i> Back to Orders
            </a>
            <h1 class="w-header-title">Digital Warranty Cards</h1>
            <p class="w-header-sub">Premium after-sales protection for your custom garments.</p>
        </div>
    </div>

    <div class="container">
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success d-flex align-items-center mb-4 anim-up" style="background: #D1FAE5; border: 1px solid #A7F3D0; color: #065F46; border-radius: 12px;">
                <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                <div><?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger d-flex align-items-center mb-4 anim-up" style="background: #FEE2E2; border: 1px solid #FECACA; color: #991B1B; border-radius: 12px;">
                <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                <div><?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?></div>
            </div>
        <?php endif; ?>

        <?php if (empty($warranties)): ?>
            <div class="text-center py-5 anim-up delay-1">
                <i class="bi bi-shield-x display-1 mb-3" style="color: var(--w-border);"></i>
                <h3 style="color: var(--w-text-h); font-weight: 700;">No Warranty Cards Found</h3>
                <p style="color: var(--w-text-muted);">You do not have any active warranty cards at the moment.</p>
                <a href="<?= url('allproducts') ?>" class="w-btn-claim mt-3">Start Shopping</a>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($warranties as $index => $w): ?>
                    <div class="col-lg-6 anim-up" style="animation-delay: <?= 0.1 * ($index + 1) ?>s;">
                        <div class="w-card-wrapper">
                            <div class="w-card">
                                <div class="w-card-top">
                                    <div class="w-code"><i class="bi bi-qr-code"></i> <?= htmlspecialchars($w['code']) ?></div>
                                    <span class="w-status <?= strtolower($w['status']) === 'active' ? 'w-status-active' : 'w-status-expired' ?>">
                                        <?= htmlspecialchars($w['status']) ?>
                                    </span>
                                </div>
                                
                                <div class="w-details">
                                    <div class="w-detail-box">
                                        <p>Order Reference</p>
                                        <h5>#<?= htmlspecialchars($w['order_id']) ?></h5>
                                    </div>
                                    <div class="w-detail-box">
                                        <p>Valid Until</p>
                                        <h5><?= date('M d, Y', strtotime($w['expires_at'])) ?></h5>
                                    </div>
                                </div>
                                
                                <div class="w-terms">
                                    <strong>Coverage:</strong> <?= htmlspecialchars($w['terms']) ?>
                                </div>

                                <?php if (strtolower($w['status']) === 'active'): ?>
                                    <div>
                                        <button class="w-btn-claim" data-bs-toggle="modal" data-bs-target="#claimModal<?= $w['id'] ?>">
                                            <i class="bi bi-tools"></i> Claim Warranty
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Claim Modal -->
                        <div class="modal fade w-modal" id="claimModal<?= $w['id'] ?>" tabindex="-1">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Claim Warranty: <?= $w['code'] ?></h5>
                                <button type="button" class="btn-close <?php if($theme === 'theme-luxury') echo 'btn-close-white'; ?>" data-bs-dismiss="modal"></button>
                              </div>
                              <form action="<?= url('submit_warranty_claim') ?>" method="POST" enctype="multipart/form-data">
                                  <!-- CRITICAL: CSRF Token -->
                                  <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                                  <div class="modal-body">
                                      <input type="hidden" name="warranty_id" value="<?= $w['id'] ?>">
                                      <div class="mb-3">
                                          <label class="form-label" style="font-weight: 600;">Describe the Issue</label>
                                          <textarea name="description" class="form-control" rows="3" required placeholder="E.g. stitching opened on the left sleeve..."></textarea>
                                      </div>
                                      <div class="mb-3">
                                          <label class="form-label" style="font-weight: 600;">Upload Image (Optional)</label>
                                          <input type="file" name="claim_image" class="form-control" accept="image/*">
                                      </div>
                                  </div>
                                  <div class="modal-footer" style="border-top: 1px solid var(--w-border);">
                                      <button type="submit" class="w-btn-claim w-100 justify-content-center m-0">Submit Claim Request</button>
                                  </div>
                              </form>
                            </div>
                          </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($claims)): ?>
            <div class="anim-up delay-3 mt-5">
                <h3 style="font-family: 'Playfair Display', serif; font-weight: 800; color: var(--w-text-h); margin-bottom: 20px;">My Claims History</h3>
                <div class="w-table-card">
                    <div class="table-responsive">
                        <table class="table w-table">
                            <thead>
                                <tr>
                                    <th>Claim ID</th>
                                    <th>Warranty Code</th>
                                    <th>Status</th>
                                    <th>Submitted On</th>
                                    <th>Admin Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($claims as $c): ?>
                                    <tr>
                                        <td><strong>#<?= $c['id'] ?></strong></td>
                                        <td>
                                            <span style="background: var(--w-pill-bg); padding: 4px 10px; border-radius: 6px; font-family: monospace; font-weight: bold; border: 1px solid var(--w-border);">
                                                <?= htmlspecialchars($c['code']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php 
                                                $bg = 'background: #FEF3C7; color: #92400E; border: 1px solid #FDE68A;';
                                                if($c['status']=='Approved') $bg='background: #D1FAE5; color: #065F46; border: 1px solid #A7F3D0;';
                                                if($c['status']=='Rejected') $bg='background: #FEE2E2; color: #991B1B; border: 1px solid #FECACA;';
                                                if($theme === 'theme-luxury') {
                                                    $bg = 'background: rgba(252,211,77,0.12); color: #FCD34D; border: 1px solid rgba(252,211,77,0.28);';
                                                    if($c['status']=='Approved') $bg='background: rgba(52,211,153,0.12); color: #34D399; border: 1px solid rgba(52,211,153,0.28);';
                                                    if($c['status']=='Rejected') $bg='background: rgba(248,113,113,0.12); color: #F87171; border: 1px solid rgba(248,113,113,0.28);';
                                                }
                                            ?>
                                            <span style="<?= $bg ?> padding: 4px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">
                                                <?= $c['status'] ?>
                                            </span>
                                        </td>
                                        <td><?= date('M d, Y', strtotime($c['created_at'])) ?></td>
                                        <td>
                                            <?php if(empty($c['admin_notes'])): ?>
                                                <em style="color: var(--w-text-muted);">Pending Review</em>
                                            <?php else: ?>
                                                <?= htmlspecialchars($c['admin_notes']) ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
