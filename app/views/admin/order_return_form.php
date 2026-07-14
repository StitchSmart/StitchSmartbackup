<div class="container-fluid py-4">
    <div class="card p-4 p-md-5 mx-auto rounded-4 shadow-lg border-0 mb-5" style="max-width: 1100px; background: #ffffff; border: 1px solid rgba(202, 151, 69, 0.35) !important;">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h3 class="fw-bolder mb-0" style="color: #1a0f0a; font-size: 1.85rem;">Return Processing: Order #<?= (int)$order['id'] ?></h3>
            </div>
            <a href="<?= url('') ?>manage_orders" class="btn px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2" style="background: rgba(202, 151, 69, 0.12); color: #ca9745; border: 1px solid rgba(202, 151, 69, 0.4); font-weight: 700; font-size: 0.9rem; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.background='rgba(202, 151, 69, 0.25)'; this.style.color='#1a0f0a';" onmouseout="this.style.background='rgba(202, 151, 69, 0.12)'; this.style.color='#ca9745';">
                <i class="bi bi-arrow-left pe-1"></i> Back to Orders Management
            </a>
        </div>
        <h4 class="fw-bold mb-4 pb-2 border-bottom d-flex align-items-center gap-2">
            <i class="bi bi-clipboard2-check-fill text-warning"></i> Authorize Item Return & Damage Assessment
        </h4>
        <form action="<?= url('') ?>process_return" method="post">
            <input type="hidden" name="order_id" value="<?= (int)$order['id'] ?>">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background: rgba(0,0,0,0.15);">
                        <tr>
                            <th class="py-3 px-4">Garment Product Name</th>
                            <th class="py-3 text-center">Purchased Qty</th>
                            <th class="py-3 text-center" style="width: 160px;">Return Qty</th>
                            <th class="py-3 text-center" style="width: 130px;">Damaged?</th>
                            <th class="py-3 px-4">QC Inspection / Damage Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($items)): ?>
                            <tr><td colspan="5" class="text-center py-5 text-muted">No items recorded on this order invoice.</td></tr>
                        <?php else: ?>
                            <?php foreach($items as $index => $item): ?>
                                <tr>
                                    <td class="px-4 fw-bold fs-6" style="color: #ca9745;">
                                        <i class="bi bi-box-seam pe-2"></i><?= htmlspecialchars($item['product_name'] ?? 'Unknown Garment') ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary px-3 py-2 rounded-pill"><?= (int)$item['quantity'] ?> Units</span>
                                    </td>
                                    <td class="text-center">
                                        <input type="hidden" name="return_item_id[]" value="<?= (int)$item['id'] ?>">
                                        <input type="number" name="return_quantity[]" class="form-control text-center fw-bold px-2 py-1 mx-auto" style="max-width: 100px; border-color: rgba(202,151,69,0.5);" min="0" max="<?= (int)$item['quantity'] ?>" value="0">
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" name="damage[<?= $index ?>]" value="1" style="width: 24px; height: 24px; cursor: pointer;">
                                        </div>
                                    </td>
                                    <td class="px-4">
                                        <input type="text" name="damage_note[]" class="form-control px-3 py-2" placeholder="Describe fabric wear, tear, or sizing issue (optional)...">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end align-items-center gap-3 mt-5 pt-3 border-top w-100">
                <a href="<?= url('') ?>manage_orders" class="btn px-4 py-3 rounded-pill border" style="font-weight: 600;">Cancel</a>
                <button type="submit" class="btn px-5 py-3 rounded-pill shadow-lg d-flex align-items-center gap-2" style="background: linear-gradient(135deg, #ca9745, #e8c547); color: #1a0f0a; border: none; font-weight: 800; font-size: 1.02rem; animation: adminPulseGlow 2.5s ease infinite; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 28px rgba(202, 151, 69, 0.7)';" onmouseout="this.style.transform='translateY(0)';">
                    <i class="bi bi-check-circle-fill fs-5"></i> Authorize & Submit Return Ledger
                </button>
            </div>
        </form>
    </div>

    <?php if(!empty($returns)): ?>
        <div class="card border-0 rounded-4 shadow-sm overflow-hidden mx-auto" style="max-width: 1100px;">
            <div class="card-header py-4 px-4 border-bottom d-flex align-items-center justify-content-between">
                <h4 class="mb-0 fw-bold d-flex align-items-center gap-2">
                    <i class="bi bi-clock-history text-warning"></i> Previous Return Activity History for Order #<?= (int)$order['id'] ?>
                </h4>
                <span class="badge rounded-pill px-3 py-2" style="background: rgba(202, 151, 69, 0.2); color: #ca9745;">Audit Ledger</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background: rgba(0,0,0,0.15);">
                        <tr>
                            <th class="py-3 px-4">Log ID</th>
                            <th class="py-3">Garment Product</th>
                            <th class="py-3 text-center">Returned Qty</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">QC Damage Notes</th>
                            <th class="py-3 text-end px-4">Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($returns as $return): ?>
                            <tr>
                                <td class="px-4 fw-bold text-muted">#<?= (int)$return['id'] ?></td>
                                <td class="fw-bold fs-6"><?= htmlspecialchars($return['product_name'] ?? 'Unknown Garment') ?></td>
                                <td class="text-center"><span class="badge bg-secondary rounded-pill px-3 py-1"><?= (int)$return['quantity'] ?> Units</span></td>
                                <td><span class="badge bg-dark border px-3 py-2 rounded-pill"><?= htmlspecialchars(ucwords($return['status'])) ?></span></td>
                                <td style="max-width: 250px; font-style: italic;"><?= !empty($return['damage_note']) ? '"'.nl2br(htmlspecialchars($return['damage_note'])).'"' : '—' ?></td>
                                <td class="text-end px-4 small text-muted"><?= htmlspecialchars($return['created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>
