<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 mb-2 text-gray-800 fw-bold" style="font-family: 'Playfair Display', serif;">Warranty Management</h1>
        <ul class="nav nav-pills border-0">
            <li class="nav-item">
                <a class="nav-link active rounded-pill px-4 shadow-sm" href="<?= url('admin_warranties') ?>">Issued Warranties</a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill px-4 text-muted" href="<?= url('admin_warranty_claims') ?>">Pending Claims</a>
            </li>
        </ul>
    </div>
    <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#createWarrantyModal" style="border-radius: 50px; padding: 8px 20px;">
        <i class="bi bi-shield-plus me-2"></i> Issue New Warranty
    </button>
</div>

<?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 border-start border-5 border-success shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2 text-success"></i>
        <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger alert-dismissible fade show border-0 border-start border-5 border-danger shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2 text-danger"></i>
        <?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
    <div class="card-header bg-white py-3" style="border-bottom: 1px solid #f0f0f0;">
        <h6 class="m-0 font-weight-bold text-primary">All Issued Warranties</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="dataTable" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Code</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Order Ref</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Customer</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Status</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Duration</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Expires</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($warranties)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-shield-x display-4 text-muted d-block mb-3"></i>
                                <span class="text-muted">No warranty cards issued yet.</span>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($warranties as $w): ?>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border-radius: 8px;">
                                            <i class="bi bi-qr-code text-primary"></i>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm font-monospace fw-bold text-primary"><?= htmlspecialchars($w['code']) ?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-xs font-weight-bold">#<?= $w['order_id'] ?></span>
                                    <br>
                                    <small class="text-muted"><?= htmlspecialchars($w['invoice_no'] ?? '-') ?></small>
                                </td>
                                <td>
                                    <span class="text-sm font-weight-bold text-dark"><?= htmlspecialchars($w['customer_name'] ?? 'Guest User') ?></span>
                                </td>
                                <td>
                                    <?php 
                                        $badge = 'bg-success';
                                        if ($w['status'] == 'Expired') $badge = 'bg-danger';
                                        if ($w['status'] == 'Revoked') $badge = 'bg-secondary';
                                    ?>
                                    <span class="badge rounded-pill <?= $badge ?> px-3 py-2 text-xs"><?= $w['status'] ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1"><i class="bi bi-clock-history me-1"></i><?= $w['duration_days'] ?> Days</span>
                                </td>
                                <td>
                                    <span class="text-secondary text-xs font-weight-bold"><?= date('d M, Y', strtotime($w['expires_at'])) ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Warranty Modal -->
<div class="modal fade" id="createWarrantyModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
            <div class="modal-header bg-primary text-white" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h5 class="modal-title fw-bold"><i class="bi bi-shield-check me-2"></i> Issue New Warranty</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= url('admin_create_warranty') ?>" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary text-xs text-uppercase">Order ID</label>
                            <input type="number" name="order_id" class="form-control form-control-solid bg-light" required placeholder="e.g. 1042">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-secondary text-xs text-uppercase">Duration</label>
                            <select name="duration_days" id="durationSelect" class="form-select form-control-solid bg-light border-0 shadow-none" required>
                                <option value="7">7 Days (Fitting & Alteration)</option>
                                <option value="30">30 Days (Stitching Warranty)</option>
                                <option value="90">90 Days (Fabric Warranty)</option>
                                <option value="365">1 Year (Premium Full Coverage)</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label fw-bold text-secondary text-xs text-uppercase m-0">Terms & Coverage</label>
                                <button type="button" id="btnGenerateAI" class="btn btn-sm btn-outline-primary py-0 px-2" style="font-size: 0.75rem; border-radius: 5px;">
                                    <i class="bi bi-magic me-1"></i> Generate with AI
                                </button>
                            </div>
                            <textarea name="terms" id="termsBox" class="form-control bg-light" rows="3" required placeholder="Describe what is covered under this warranty..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light" style="border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 50px; padding: 6px 20px;">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="border-radius: 50px; padding: 6px 20px;"><i class="bi bi-check2-circle me-1"></i> Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('btnGenerateAI').addEventListener('click', function() {
    const duration = document.getElementById('durationSelect').value;
    const box = document.getElementById('termsBox');
    
    // Simulate AI generation with preset professional templates based on duration
    let template = "";
    if (duration === "7") {
        template = "This 7-day warranty covers minor fitting adjustments and alteration issues arising post-delivery. Valid only if the garment has not been excessively worn or washed.";
    } else if (duration === "30") {
        template = "Our 30-day Stitching Warranty ensures your custom garment holds its integrity. We cover popped seams, loose buttons, and zipper malfunctions at no extra cost.";
    } else if (duration === "90") {
        template = "90-Day Extended Warranty: Covers structural stitching integrity, minor fabric pilling on premium blends, and zipper/button replacements. Does not cover accidental tears or chemical damage.";
    } else {
        template = "1-Year Premium Coverage: Comprehensive protection against stitching failure, fabric color bleeding under normal wash conditions, and structural wear. Enjoy complete peace of mind.";
    }
    
    // Typewriter effect for AI feel
    box.value = "";
    let i = 0;
    this.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Generating...';
    this.disabled = true;
    
    const interval = setInterval(() => {
        box.value += template.charAt(i);
        i++;
        if (i >= template.length) {
            clearInterval(interval);
            this.innerHTML = '<i class="bi bi-magic me-1"></i> Generated';
            this.classList.replace('btn-outline-primary', 'btn-success');
            setTimeout(() => {
                this.innerHTML = '<i class="bi bi-magic me-1"></i> Generate with AI';
                this.classList.replace('btn-success', 'btn-outline-primary');
                this.disabled = false;
            }, 2000);
        }
    }, 15);
});
</script>
