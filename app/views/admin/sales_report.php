<style>
.report-card {
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    background: rgba(202, 151, 69, 0.06) !important;
    border: 1px solid rgba(202, 151, 69, 0.3) !important;
    border-radius: 20px;
}
.report-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 16px 36px rgba(202, 151, 69, 0.25) !important;
    border-color: rgba(202, 151, 69, 0.8) !important;
    background: rgba(202, 151, 69, 0.1) !important;
}
</style>

<!-- Luxury Executive Hero Card -->
<div class="admin-feature-hero p-4 p-md-5 mb-4 rounded-4 position-relative overflow-hidden">
    <div class="position-absolute top-0 end-0 opacity-10 pointer-events-none d-none d-lg-block" style="transform: translate(10%, -10%);">
        <i class="bi bi-file-earmark-bar-graph-fill text-warning" style="font-size: 15rem;"></i>
    </div>
    <div class="position-absolute bottom-0 start-0 opacity-5 pointer-events-none d-none d-lg-block" style="transform: translate(-20%, 30%);">
        <i class="bi bi-graph-up-arrow text-warning" style="font-size: 10rem;"></i>
    </div>
    <div class="position-relative z-1 text-center text-md-start">
        <div class="mb-3">
            <span class="badge rounded-pill px-3 py-2 mb-2" style="background: rgba(202, 151, 69, 0.25); color: #e8c547; border: 1px solid rgba(202,151,69,0.5); font-size: 0.78rem; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 700;">
                <i class="bi bi-lightning-charge-fill pe-1"></i> Live Analytics
            </span>
        </div>
        <h2 class="mb-2 fw-bolder" style="font-size: 2.4rem; letter-spacing: -0.5px;">
            Sales Analytics
            <span style="background: linear-gradient(135deg, #ca9745, #e8c547); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">& REPORTS</span>
        </h2>
        <p class="mb-0 mt-2" style="max-width: 680px; font-size: 1.05rem; line-height: 1.5; opacity: 0.85;">Generate formal executive PDF financial summaries across customized timeframes. Track revenue performance, audit order volume, and monitor customer retention alerts to trigger re-engagement campaigns.</p>
        <div class="mt-4 d-flex flex-wrap gap-3 align-items-center justify-content-center justify-content-md-start">
            <a href="<?= url('') ?>manage_orders" class="btn px-4 py-3 rounded-pill d-flex align-items-center gap-2 shadow-sm" style="background: linear-gradient(135deg, #ca9745, #e8c547); color: #1a0f0a; border: none; font-weight: 800; font-size: 0.96rem; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 25px rgba(202, 151, 69, 0.6)';" onmouseout="this.style.transform='translateY(0)';">
                <i class="bi bi-clipboard-check-fill fs-5"></i> Manage Orders
            </a>
            <a href="<?= url('') ?>return_report" class="btn px-4 py-3 rounded-pill d-flex align-items-center gap-2 shadow-sm" style="background: rgba(202, 151, 69, 0.18); color: #ca9745; border: 1px solid rgba(202, 151, 69, 0.5); font-weight: 700; font-size: 0.96rem; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.background='rgba(202, 151, 69, 0.3)'; this.style.color='#1a0f0a';" onmouseout="this.style.background='rgba(202, 151, 69, 0.18)'; this.style.color='#ca9745';">
                <i class="bi bi-arrow-return-left fs-5"></i> Return Requests
            </a>
            <a href="<?= url('') ?>wishlist_report" class="btn px-4 py-3 rounded-pill d-flex align-items-center gap-2 shadow-sm" style="background: rgba(202, 151, 69, 0.18); color: #ca9745; border: 1px solid rgba(202, 151, 69, 0.5); font-weight: 700; font-size: 0.96rem; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.background='rgba(202, 151, 69, 0.3)'; this.style.color='#1a0f0a';" onmouseout="this.style.background='rgba(202, 151, 69, 0.18)'; this.style.color='#ca9745';">
                <i class="bi bi-heart-fill fs-5"></i> Wishlist Analytics
            </a>
        </div>
    </div>
</div>

<div class="mb-4">
    <div class="card border-0 rounded-4 shadow-sm p-4 p-md-5">
        <div class="d-flex align-items-center gap-3 mb-2 pb-3 border-bottom">
            <i class="bi bi-file-earmark-pdf-fill text-warning fs-4"></i>
            <div>
                <h4 class="fw-bold mb-0">Financial PDF Summary Generator</h4>
                <p class="text-muted small mb-0">Select your desired fiscal interval to instantly compile comprehensive revenue, order volume, and item performance metrics into a formal audit PDF.</p>
            </div>
        </div>
        
        <div class="row g-4 justify-content-center mt-1">
            <!-- 7 Days -->
            <div class="col-md-4">
                <div class="report-card h-100 text-center p-4 p-lg-5 d-flex flex-column justify-content-between shadow-sm">
                    <div>
                        <div class="p-4 rounded-circle d-inline-flex align-items-center justify-content-center mb-4 shadow-sm" style="background: rgba(202, 151, 69, 0.15); width: 85px; height: 85px;">
                            <i class="bi bi-calendar-week-fill fs-1" style="color: #ca9745;"></i>
                        </div>
                        <h4 class="fw-bold mb-2">Last 7 Days</h4>
                        <div style="height: 2px; background: rgba(202, 151, 69, 0.4); width: 50px; margin: 12px auto;"></div>
                        <p class="small text-muted mb-4">Immediate weekly performance overview, short-term order momentum, and recent tailoring revenue trends.</p>
                    </div>
                    <a href="<?= url('') ?>download_report&period=7days" target="_blank" class="btn py-3 px-4 rounded-pill shadow-sm fw-bold d-flex align-items-center justify-content-center gap-2" style="background: linear-gradient(135deg, #ca9745, #e8c547); color: #1a0f0a; border: none;">
                        <i class="bi bi-download fs-5"></i> Download Weekly PDF
                    </a>
                </div>
            </div>

            <!-- 1 Month -->
            <div class="col-md-4">
                <div class="report-card h-100 text-center p-4 p-lg-5 d-flex flex-column justify-content-between shadow-sm position-relative">
                    <span class="position-absolute top-0 end-0 mt-3 me-3 badge rounded-pill px-3 py-1" style="background: #ca9745; color: #1a0f0a; font-size: 0.72rem; font-weight: 800;">MOST POPULAR</span>
                    <div>
                        <div class="p-4 rounded-circle d-inline-flex align-items-center justify-content-center mb-4 shadow-sm" style="background: rgba(202, 151, 69, 0.2); width: 85px; height: 85px;">
                            <i class="bi bi-calendar-month-fill fs-1" style="color: #e8c547;"></i>
                        </div>
                        <h4 class="fw-bold mb-2">Last 30 Days</h4>
                        <div style="height: 2px; background: rgba(202, 151, 69, 0.4); width: 50px; margin: 12px auto;"></div>
                        <p class="small text-muted mb-4">Detailed monthly financial statement, category-wise revenue distribution, and customer acquisition metrics.</p>
                    </div>
                    <a href="<?= url('') ?>download_report&period=1month" target="_blank" class="btn py-3 px-4 rounded-pill shadow-sm fw-bold d-flex align-items-center justify-content-center gap-2" style="background: linear-gradient(135deg, #ca9745, #e8c547); color: #1a0f0a; border: none;">
                        <i class="bi bi-download fs-5"></i> Download Monthly PDF
                    </a>
                </div>
            </div>

            <!-- 6 Months -->
            <div class="col-md-4">
                <div class="report-card h-100 text-center p-4 p-lg-5 d-flex flex-column justify-content-between shadow-sm">
                    <div>
                        <div class="p-4 rounded-circle d-inline-flex align-items-center justify-content-center mb-4 shadow-sm" style="background: rgba(202, 151, 69, 0.15); width: 85px; height: 85px;">
                            <i class="bi bi-calendar-range-fill fs-1" style="color: #ca9745;"></i>
                        </div>
                        <h4 class="fw-bold mb-2">Last 6 Months</h4>
                        <div style="height: 2px; background: rgba(202, 151, 69, 0.4); width: 50px; margin: 12px auto;"></div>
                        <p class="small text-muted mb-4">Comprehensive half-year executive audit, long-term seasonal growth trajectory, and bespoke tailoring profitability.</p>
                    </div>
                    <a href="<?= url('') ?>download_report&period=6month" target="_blank" class="btn py-3 px-4 rounded-pill shadow-sm fw-bold d-flex align-items-center justify-content-center gap-2" style="background: linear-gradient(135deg, #ca9745, #e8c547); color: #1a0f0a; border: none;">
                        <i class="bi bi-download fs-5"></i> Download Half-Year PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inactive Customers Retention Console -->
<div class="card border-0 rounded-4 shadow-sm overflow-hidden">
    <div class="card-header py-4 px-4 border-bottom d-flex align-items-center justify-content-between flex-wrap gap-3" style="background: linear-gradient(135deg, rgba(202, 151, 69, 0.12), rgba(202, 151, 69, 0.04)); border-color: rgba(202, 151, 69, 0.3) !important;">
        <div>
            <h4 class="mb-1 fw-bold d-flex align-items-center gap-2">
                <i class="bi bi-bell-fill text-warning"></i> Customer Retention Engine: Inactive Clients
            </h4>
            <p class="small text-muted mb-0">Clients who previously ordered but have not completed a purchase within the past 7 days. Trigger re-engagement incentives.</p>
        </div>
        <span class="badge rounded-pill px-3 py-2" style="background: rgba(202, 151, 69, 0.15); color: #ca9745; border: 1px solid rgba(202,151,69,0.5); font-weight: 800;"><?= count($inactiveCustomers ?? []) ?> Clients Inactive (&gt;7 Days)</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr style="border-bottom: 2px solid rgba(202, 151, 69, 0.4); font-size: 0.85rem; letter-spacing: 1px; text-transform: uppercase; color: #ca9745;">
                    <th class="py-3 px-4">Client Information</th>
                    <th class="py-3">Contact Channels</th>
                    <th class="py-3">Most Recent Purchase</th>
                    <th class="py-3 text-end px-4">Retention Outreach</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($inactiveCustomers)): ?>
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="py-3">
                                <i class="bi bi-award fs-1 d-block mb-2" style="color: #198754;"></i>
                                <h6 class="fw-bold">Exceptional Retention!</h6>
                                <p class="text-muted mb-0">All existing customers have placed orders within the last 7 days.</p>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach($inactiveCustomers as $customer): ?>
                        <tr style="border-bottom: 1px solid rgba(202,151,69,0.1);">
                            <td class="px-4 fw-bold py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px; font-size: 0.9rem; background: rgba(202,151,69,0.2); color: #ca9745; flex-shrink: 0;">
                                        <?= strtoupper(substr($customer['customer_name'] ?? 'U', 0, 1)) ?>
                                    </div>
                                    <?= htmlspecialchars($customer['customer_name'] ?? 'Valued Customer') ?>
                                </div>
                            </td>
                            <td class="py-3">
                                <div class="fw-semibold d-flex align-items-center gap-1">
                                    <i class="bi bi-envelope text-warning"></i> <?= htmlspecialchars($customer['email']) ?>
                                </div>
                                <div class="small text-muted d-flex align-items-center gap-1 mt-1">
                                    <i class="bi bi-telephone"></i> <?= htmlspecialchars($customer['phone'] ?? 'No phone listed') ?>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="badge rounded-pill px-3 py-2 font-monospace" style="background: rgba(202, 151, 69, 0.15); color: #ca9745; border: 1px solid rgba(202, 151, 69, 0.5); font-size: 0.85rem; font-weight: 700;">
                                    <?= date('M d, Y', strtotime($customer['last_order_date'])) ?>
                                </span>
                            </td>
                            <td class="text-end px-4 py-3">
                                <a href="<?= url('') ?>send_retention_email&email=<?= urlencode($customer['email']) ?>&name=<?= urlencode($customer['customer_name']) ?>" class="btn px-4 py-2 rounded-pill shadow-sm d-inline-flex align-items-center gap-2" style="background: linear-gradient(135deg, #ca9745, #e8c547); color: #1a0f0a; font-weight: 700; font-size: 0.88rem; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 6px 16px rgba(202, 151, 69, 0.5)';" onmouseout="this.style.transform='scale(1)';">
                                    <i class="bi bi-gift-fill"></i> Send Retention Offer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
