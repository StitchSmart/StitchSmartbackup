<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Warranty Cards Management</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createWarrantyModal">
        <i class="bi bi-plus-circle"></i> Issue New Warranty
    </button>
</div>

<?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Order # / Invoice</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Expires At</th>
                        <th>Duration (Days)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($warranties)): ?>
                        <tr><td colspan="7" class="text-center">No warranty cards issued yet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($warranties as $w): ?>
                            <tr>
                                <td><?= $w['id'] ?></td>
                                <td><strong><?= htmlspecialchars($w['code']) ?></strong></td>
                                <td><?= $w['order_id'] ?> (<?= htmlspecialchars($w['invoice_no'] ?? '-') ?>)</td>
                                <td><?= htmlspecialchars($w['customer_name'] ?? 'Guest/Unknown') ?></td>
                                <td>
                                    <?php 
                                        $badge = 'bg-success';
                                        if ($w['status'] == 'Expired') $badge = 'bg-danger';
                                        if ($w['status'] == 'Revoked') $badge = 'bg-secondary';
                                    ?>
                                    <span class="badge <?= $badge ?>"><?= $w['status'] ?></span>
                                </td>
                                <td><?= date('M d, Y', strtotime($w['expires_at'])) ?></td>
                                <td><?= $w['duration_days'] ?></td>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Issue New Warranty</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= url('admin_create_warranty') ?>" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Order ID</label>
                        <input type="number" name="order_id" class="form-control" required placeholder="Enter Order ID">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">User ID (Optional)</label>
                        <input type="number" name="user_id" class="form-control" placeholder="Leave blank if guest">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duration (Days)</label>
                        <select name="duration_days" class="form-select" required>
                            <option value="7">7 Days (e.g. Fitting)</option>
                            <option value="30">30 Days (e.g. Stitching)</option>
                            <option value="90">90 Days</option>
                            <option value="365">1 Year</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Terms & Coverage</label>
                        <textarea name="terms" class="form-control" rows="3" required placeholder="e.g. Free alteration for fitting issues."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate Warranty</button>
                </div>
            </form>
        </div>
    </div>
</div>
