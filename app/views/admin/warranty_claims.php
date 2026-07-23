<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Warranty Claims</h1>
</div>

<?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Claim ID</th>
                        <th>Warranty Code</th>
                        <th>Customer</th>
                        <th>Issue Description</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($claims)): ?>
                        <tr><td colspan="8" class="text-center">No warranty claims found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($claims as $c): ?>
                            <tr>
                                <td><?= $c['id'] ?></td>
                                <td><span class="badge bg-secondary"><?= htmlspecialchars($c['code']) ?></span></td>
                                <td><?= htmlspecialchars($c['customer_name'] ?? 'User ID: ' . $c['user_id']) ?></td>
                                <td><?= htmlspecialchars($c['issue_description']) ?></td>
                                <td>
                                    <?php if ($c['image_url']): ?>
                                        <a href="<?= BASE_URL . $c['image_url'] ?>" target="_blank">View Image</a>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php 
                                        $badge = 'bg-warning text-dark';
                                        if ($c['status'] == 'Approved') $badge = 'bg-success';
                                        if ($c['status'] == 'Rejected') $badge = 'bg-danger';
                                        if ($c['status'] == 'Resolved') $badge = 'bg-primary';
                                    ?>
                                    <span class="badge <?= $badge ?>"><?= $c['status'] ?></span>
                                </td>
                                <td><?= date('M d, Y', strtotime($c['created_at'])) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#updateClaimModal<?= $c['id'] ?>">Update</button>
                                </td>
                            </tr>

                            <!-- Update Modal -->
                            <div class="modal fade" id="updateClaimModal<?= $c['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Claim #<?= $c['id'] ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="<?= url('admin_update_claim') ?>" method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" name="claim_id" value="<?= $c['id'] ?>">
                                                <div class="mb-3">
                                                    <label class="form-label">Status</label>
                                                    <select name="status" class="form-select">
                                                        <option value="Pending" <?= $c['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                                        <option value="Approved" <?= $c['status'] == 'Approved' ? 'selected' : '' ?>>Approved</option>
                                                        <option value="Rejected" <?= $c['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                                                        <option value="Resolved" <?= $c['status'] == 'Resolved' ? 'selected' : '' ?>>Resolved</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Admin Notes (visible to customer)</label>
                                                    <textarea name="admin_notes" class="form-control" rows="3"><?= htmlspecialchars($c['admin_notes'] ?? '') ?></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
