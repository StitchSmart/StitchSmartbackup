<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-12">
            <h2>Return Requests Report</h2>
            <p>All processed returns, including restocked and damaged items.</p>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Order</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Status</th>
                    <th>Damage Note</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($returns)): ?>
                    <tr><td colspan="9" class="text-center">No return requests yet.</td></tr>
                <?php else: ?>
                    <?php foreach($returns as $return): ?>
                        <tr>
                            <td><?= (int)$return['id'] ?></td>
                            <td>#<?= (int)$return['order_id'] ?> (<?= htmlspecialchars($return['order_status'] ?? '') ?>)</td>
                            <td><?= htmlspecialchars($return['customer_name'] ?? '') ?></td>
                            <td><?= htmlspecialchars($return['product_name'] ?? 'Unknown') ?></td>
                            <td><?= (int)$return['quantity'] ?></td>
                            <td>
                                <?php if ($return['status'] === 'pending'): ?>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                <?php elseif ($return['status'] === 'restocked'): ?>
                                    <span class="badge bg-success">Restocked</span>
                                <?php elseif ($return['status'] === 'trashed'): ?>
                                    <span class="badge bg-danger">Trashed</span>
                                <?php elseif ($return['status'] === 'rejected'): ?>
                                    <span class="badge bg-secondary">Rejected</span>
                                <?php else: ?>
                                    <span class="badge bg-info"><?= htmlspecialchars($return['status']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?= nl2br(htmlspecialchars($return['damage_note'])) ?></td>
                            <td><?= htmlspecialchars($return['created_at']) ?></td>
                            <td>
                                <?php if ($return['status'] === 'pending'): ?>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?= BASE_URL ?>index.php?page=update_return_status&id=<?= $return['id'] ?>&action=restock" class="btn btn-success" onclick="return confirm('Approve this return and RESTOCK the item?');" title="Approve & Restock">Restock</a>
                                        <a href="<?= BASE_URL ?>index.php?page=update_return_status&id=<?= $return['id'] ?>&action=trash" class="btn btn-warning text-dark" onclick="return confirm('Approve this return and TRASH the item?');" title="Approve & Trash">Trash</a>
                                        <a href="<?= BASE_URL ?>index.php?page=update_return_status&id=<?= $return['id'] ?>&action=reject" class="btn btn-danger" onclick="return confirm('REJECT this return request?');" title="Reject Request">Reject</a>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted">Processed</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
