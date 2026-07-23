<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 fw-bold" style="font-family: 'Playfair Display', serif;">Warranty Cards Management</h1>
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
                            <label class="form-label fw-bold text-secondary text-xs text-uppercase">User ID</label>
                            <input type="number" name="user_id" class="form-control form-control-solid bg-light" placeholder="(Optional)">
                            <small class="text-muted" style="font-size: 0.75rem;">Leave blank for guests</small>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold text-secondary text-xs text-uppercase">Duration</label>
                            <select name="duration_days" class="form-select form-control-solid bg-light border-0 shadow-none" required>
                                <option value="7">7 Days (Fitting & Alteration)</option>
                                <option value="30">30 Days (Stitching Warranty)</option>
                                <option value="90">90 Days (Fabric Warranty)</option>
                                <option value="365">1 Year (Premium Full Coverage)</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold text-secondary text-xs text-uppercase">Terms & Coverage</label>
                            <textarea name="terms" class="form-control bg-light" rows="3" required placeholder="Describe what is covered under this warranty..."></textarea>
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
