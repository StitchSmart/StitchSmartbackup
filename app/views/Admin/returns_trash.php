<!-- Luxury Executive Header Card -->
<div class="admin-header-card p-4 p-md-5 mb-4 rounded-4 position-relative overflow-hidden">
    <div class="position-absolute top-0 end-0 p-5 opacity-10 pointer-events-none d-none d-lg-block" style="transform: translate(15%, -15%);">
        <i class="bi bi-trash3-fill text-warning" style="font-size: 15rem;"></i>
    </div>
    <div class="position-relative z-1 text-center text-md-start">
        <div>
            <h2 class="mb-2 fw-bolder" style="font-size: 2.4rem; letter-spacing: -0.5px;">Quarantined Trash Archive</h2>
            <p class="mb-0 mt-2" style="max-width: 680px; font-size: 1.05rem; line-height: 1.5;">Permanent ledger of returned bespoke items that did not pass rigorous quality control inspection. These articles are marked as damaged, decommissioned from live stock, and logged for financial write-off analysis.</p>
        </div>
        <div class="mt-4 d-flex flex-wrap gap-3 align-items-center justify-content-center justify-content-md-start">
            <a href="<?= url('') ?>return_report" class="btn px-4 py-3 rounded-pill d-flex align-items-center gap-2 shadow-sm" style="background: linear-gradient(135deg, #ca9745, #e8c547); color: #1a0f0a; border: none; font-weight: 800; font-size: 0.96rem; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 25px rgba(202, 151, 69, 0.6)';" onmouseout="this.style.transform='translateY(0)';">
                <i class="bi bi-arrow-left-circle-fill fs-5"></i> Return Requests Pipeline
            </a>
            <a href="<?= url('') ?>admin_products" class="btn px-4 py-3 rounded-pill d-flex align-items-center gap-2 shadow-sm" style="background: rgba(202, 151, 69, 0.18); color: #ca9745; border: 1px solid rgba(202, 151, 69, 0.5); font-weight: 700; font-size: 0.96rem; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.background='rgba(202, 151, 69, 0.3)'; this.style.color='#1a0f0a';" onmouseout="this.style.background='rgba(202, 151, 69, 0.18)'; this.style.color='#ca9745';">
                <i class="bi bi-box-seam-fill fs-5"></i> Products Inventory
            </a>
            <span class="badge rounded-pill px-4 py-3 d-flex align-items-center gap-2" style="background: rgba(220, 53, 69, 0.18); color: #ff8787; border: 1px solid rgba(220,53,69,0.4); font-size: 0.92rem;">
                <i class="bi bi-shield-exclamation fs-5"></i> <?= count($returns ?? []) ?> Decommissioned Articles
            </span>
        </div>
    </div>
</div>

<div class="container-fluid mb-5">
    <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
        <div class="card-header py-4 px-4 border-bottom d-flex align-items-center justify-content-between flex-wrap gap-3">
            <h4 class="mb-0 fw-bold d-flex align-items-center gap-2">
                <i class="bi bi-trash-fill text-danger"></i> Decommissioned Garment Ledger
            </h4>
            <span class="badge rounded-pill px-3 py-2" style="background: rgba(220, 53, 69, 0.2); color: #ff8787;">QC Audit Trail</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: rgba(0,0,0,0.15);">
                    <tr>
                        <th class="py-3 px-4">Log ID</th>
                        <th class="py-3">Associated Order</th>
                        <th class="py-3">Customer Information</th>
                        <th class="py-3">Decommissioned Garment</th>
                        <th class="py-3 text-center">Qty Trashed</th>
                        <th class="py-3">QC Inspector Damage Notes</th>
                        <th class="py-3 text-end px-4">Quarantine Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($returns)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-shield-check fs-1 d-block mb-2 text-success"></i>
                                No damaged items recorded in the quarantined trash archive. Pristine craftsmanship!
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($returns as $return): ?>
                            <tr>
                                <td class="px-4 fw-bold text-muted">#<?= (int)$return['id'] ?></td>
                                <td>
                                    <span class="badge bg-dark border px-3 py-2 rounded-pill fs-6">Order #<?= (int)$return['order_id'] ?></span>
                                    <div class="small text-muted mt-1">(<?= htmlspecialchars($return['order_status'] ?? 'Completed') ?>)</div>
                                </td>
                                <td class="fw-bold fs-6"><?= htmlspecialchars($return['customer_name'] ?? 'Guest Client') ?></td>
                                <td>
                                    <div class="fw-bold text-danger d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <?= htmlspecialchars($return['product_name'] ?? 'Unknown Garment') ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger rounded-pill px-3 py-2"><?= (int)$return['quantity'] ?> Units</span>
                                </td>
                                <td style="max-width: 320px;">
                                    <?php if(!empty($return['damage_note'])): ?>
                                        <div class="p-3 rounded-3 small border" style="background: rgba(220, 53, 69, 0.08); border-color: rgba(220,53,69,0.3) !important; color: inherit; font-style: italic;">
                                            <i class="bi bi-quote pe-1"></i><?= nl2br(htmlspecialchars($return['damage_note'])) ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted small">— Unspecified damage note —</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end px-4 small text-muted"><?= htmlspecialchars($return['created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
