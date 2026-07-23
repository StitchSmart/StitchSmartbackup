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
    <title>StitchSmart - My Warranty Cards</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/<?= htmlspecialchars($themeFile); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
    /* Glassmorphism Design for Warranty Cards */
    .warranty-page {
        background: #0f0f0f;
        min-height: 100vh;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #fff;
        padding-bottom: 50px;
    }
    .w-header {
        padding: 40px 0;
        text-align: center;
        background: linear-gradient(180deg, #1a1a1a 0%, #0f0f0f 100%);
        border-bottom: 1px solid rgba(202, 151, 69, 0.2);
    }
    .w-header h1 {
        font-family: 'Playfair Display', serif;
        color: #ca9745;
        font-size: 2.5rem;
        margin-bottom: 10px;
    }
    .warranty-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .warranty-card::before {
        content: '';
        position: absolute;
        top: -50%; left: -50%; width: 200%; height: 200%;
        background: radial-gradient(circle, rgba(202, 151, 69, 0.1) 0%, transparent 60%);
        opacity: 0;
        transition: opacity 0.5s ease;
    }
    .warranty-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
        border-color: rgba(202, 151, 69, 0.4);
    }
    .warranty-card:hover::before { opacity: 1; }
    
    .w-code {
        font-family: monospace;
        font-size: 1.2rem;
        color: #ca9745;
        letter-spacing: 2px;
        margin-bottom: 15px;
    }
    .w-status {
        position: absolute;
        top: 25px; right: 25px;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: bold;
        text-transform: uppercase;
    }
    .status-active { background: rgba(40, 167, 69, 0.2); color: #28a745; border: 1px solid #28a745; }
    .status-expired { background: rgba(220, 53, 69, 0.2); color: #dc3545; border: 1px solid #dc3545; }
    
    .btn-claim {
        background: linear-gradient(135deg, #ca9745, #e8c547);
        color: #1a0f0a;
        border: none;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 30px;
        transition: all 0.3s ease;
    }
    .btn-claim:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(202, 151, 69, 0.4);
    }
    </style>
</head>
<body>
<div class="warranty-page">
    <div class="w-header">
        <div class="container">
            <a href="<?= url('home') ?>" class="text-muted text-decoration-none mb-3 d-inline-block"><i class="bi bi-arrow-left"></i> Back to Home</a>
            <h1>My Digital Warranty Cards</h1>
            <p class="text-muted">Premium protection for your custom tailored garments.</p>
        </div>
    </div>

    <div class="container mt-5">
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success bg-dark text-success border-success">
                <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($warranties)): ?>
            <div class="text-center py-5">
                <i class="bi bi-shield-x display-1 text-muted"></i>
                <h3 class="mt-3">No Warranty Cards Found</h3>
                <p class="text-muted">You do not have any active warranty cards at the moment.</p>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($warranties as $w): ?>
                    <div class="col-md-6">
                        <div class="warranty-card">
                            <span class="w-status <?= strtolower($w['status']) === 'active' ? 'status-active' : 'status-expired' ?>">
                                <?= htmlspecialchars($w['status']) ?>
                            </span>
                            <div class="w-code"><i class="bi bi-qr-code"></i> <?= htmlspecialchars($w['code']) ?></div>
                            <h4 class="mb-3">Order #<?= htmlspecialchars($w['order_id']) ?></h4>
                            
                            <div class="mb-3">
                                <small class="text-muted d-block">Valid Until</small>
                                <strong><?= date('M d, Y', strtotime($w['expires_at'])) ?></strong>
                            </div>
                            
                            <div class="mb-4">
                                <small class="text-muted d-block">Coverage</small>
                                <span class="text-light"><?= htmlspecialchars($w['terms']) ?></span>
                            </div>

                            <?php if (strtolower($w['status']) === 'active'): ?>
                                <button class="btn btn-claim" data-bs-toggle="modal" data-bs-target="#claimModal<?= $w['id'] ?>">
                                    <i class="bi bi-tools"></i> Claim Warranty
                                </button>
                            <?php endif; ?>
                        </div>

                        <!-- Claim Modal -->
                        <div class="modal fade" id="claimModal<?= $w['id'] ?>" tabindex="-1" data-bs-theme="dark">
                          <div class="modal-dialog">
                            <div class="modal-content bg-dark text-light border-secondary">
                              <div class="modal-header border-secondary">
                                <h5 class="modal-title text-warning">Claim Warranty: <?= $w['code'] ?></h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                              </div>
                              <form action="<?= url('submit_warranty_claim') ?>" method="POST" enctype="multipart/form-data">
                                  <div class="modal-body">
                                      <input type="hidden" name="warranty_id" value="<?= $w['id'] ?>">
                                      <div class="mb-3">
                                          <label>Describe the Issue</label>
                                          <textarea name="description" class="form-control bg-dark text-light border-secondary" rows="3" required placeholder="E.g. stitching opened on the left sleeve..."></textarea>
                                      </div>
                                      <div class="mb-3">
                                          <label>Upload Image (Optional)</label>
                                          <input type="file" name="claim_image" class="form-control bg-dark text-light border-secondary" accept="image/*">
                                      </div>
                                  </div>
                                  <div class="modal-footer border-secondary">
                                      <button type="submit" class="btn btn-warning w-100 fw-bold">Submit Claim Request</button>
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
            <h3 class="mt-5 mb-4 text-warning" style="font-family: 'Playfair Display', serif;">My Claims History</h3>
            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle">
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
                                <td>#<?= $c['id'] ?></td>
                                <td><span class="badge bg-secondary"><?= htmlspecialchars($c['code']) ?></span></td>
                                <td>
                                    <?php 
                                        $bg = 'bg-secondary';
                                        if($c['status']=='Approved') $bg='bg-success';
                                        if($c['status']=='Rejected') $bg='bg-danger';
                                        if($c['status']=='Pending') $bg='bg-warning text-dark';
                                    ?>
                                    <span class="badge <?= $bg ?>"><?= $c['status'] ?></span>
                                </td>
                                <td><?= date('M d, Y', strtotime($c['created_at'])) ?></td>
                                <td><?= htmlspecialchars($c['admin_notes'] ?? '-') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
