

<div class="table-responsive mt-3">

<table class="table text-center">

<thead>
<tr>
    <th>Order ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Total</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

<?php foreach($orders as $order): ?>

<tr>
    <td><?= $order['id'] ?></td>
    <td><?= htmlspecialchars($order['customer_name']) ?></td>
    <td><?= htmlspecialchars($order['phone']) ?></td>
    <td><?= $order['total'] ?></td>
    <td><?= $order['status'] ?></td>

    <td>
        <?php 
        $currentStatus = trim($order['status'] ?? 'Pending');
        $isDelivered = strcasecmp($currentStatus, 'Delivered') === 0;
        $isCancelled = strcasecmp($currentStatus, 'Cancelled') === 0;
        ?>

        <?php if(!$isDelivered && !$isCancelled): ?>
            
            <?php if($currentStatus === 'Pending'): ?>
                <a href="<?= BASE_URL ?>/index.php?page=mark_processing&id=<?= $order['id'] ?>" class="btn btn-warning btn-sm mt-1">Mark Processing</a>
            
            <?php elseif($currentStatus === 'Processing'): ?>
                <?php if(empty($order['tracking_id'])): ?>
                    <button type="button" class="btn btn-primary btn-sm toggle-dispatch mt-1" data-order-id="<?= $order['id'] ?>">Dispatch</button>
                <?php endif; ?>
            
            <?php elseif($currentStatus === 'Dispatched'): ?>
                <a href="<?= BASE_URL ?>/index.php?page=mark_in_transit&id=<?= $order['id'] ?>" class="btn btn-info btn-sm mt-1 text-white">Mark In Transit</a>
            
            <?php elseif($currentStatus === 'In Transit'): ?>
                <a href="<?= BASE_URL ?>/index.php?page=mark_out_for_delivery&id=<?= $order['id'] ?>" class="btn btn-primary btn-sm mt-1">Out for Delivery</a>
            
            <?php elseif($currentStatus === 'Out for Delivery'): ?>
                <a href="<?= BASE_URL ?>/index.php?page=mark_delivered&id=<?= $order['id'] ?>" class="btn btn-success btn-sm mt-1">Mark Delivered</a>
            
            <?php else: ?>
                <!-- Catch all just in case -->
                <a href="<?= BASE_URL ?>/index.php?page=mark_processing&id=<?= $order['id'] ?>" class="btn btn-warning btn-sm mt-1">Reset to Processing</a>
            <?php endif; ?>

            <?php if($currentStatus === 'Processing' || !empty($order['tracking_id'])): ?>
                <?php if(!empty($order['tracking_id'])): ?>
                    <div class="mt-1"><span class="badge bg-info text-dark">Tracking: <?= htmlspecialchars($order['tracking_id']); ?></span></div>
                    <button type="button" class="btn btn-outline-primary btn-sm toggle-dispatch mt-1" data-order-id="<?= $order['id'] ?>">Update Tracking</button>
                <?php endif; ?>
                <div class="dispatch-form d-none mt-2" id="dispatch-form-<?= $order['id'] ?>">
                    <form action="<?= BASE_URL ?>/index.php?page=save_tracking" method="post" class="d-flex flex-column gap-2">
                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
                        <input type="text" name="tracking_id" class="form-control form-control-sm" placeholder="Enter tracking ID" value="<?= htmlspecialchars($order['tracking_id'] ?? '') ?>" required>
                        <button type="submit" class="btn btn-success btn-sm w-100">Save & Dispatch</button>
                    </form>
                </div>
            <?php endif; ?>

            <div class="mt-2">
                <a href="<?= BASE_URL ?>/index.php?page=mark_cancelled&id=<?= $order['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Cancel this order? This cannot be undone.')">Cancel Order</a>
            </div>

        <?php endif; ?>

        <?php if($isDelivered || $isCancelled): ?>
            <span class="text-muted small">Processed</span>
            <div class="mt-2">
                <a href="<?= BASE_URL ?>/index.php?page=delete_order&id=<?= $order['id'] ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Permanently delete this order from records?')">Delete Record</a>
            </div>
        <?php endif; ?>
    </td>
</tr>

<?php endforeach; ?>

</tbody>
</table>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-dispatch').forEach(function(button) {
            button.addEventListener('click', function() {
                var orderId = this.getAttribute('data-order-id');
                var form = document.getElementById('dispatch-form-' + orderId);
                if (form) {
                    form.classList.toggle('d-none');
                }
            });
        });
    });
</script>
