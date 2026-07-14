<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Executive Sales Audit - <?= ucfirst($period) ?> | Stitch Smart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    <style>
        body {
            background: #fdfaf6;
            font-family: 'Outfit', sans-serif;
            color: #1a0f0a;
            padding: 40px;
        }
        .report-header {
            border-bottom: 3px solid #ca9745;
            padding-bottom: 25px;
            margin-bottom: 35px;
        }
        .brand-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.4rem;
            font-weight: 700;
            color: #1a0f0a;
            letter-spacing: -0.5px;
        }
        .total-box {
            background: linear-gradient(145deg, rgba(202, 151, 69, 0.12), rgba(202, 151, 69, 0.04));
            border: 1px solid rgba(202, 151, 69, 0.4);
            padding: 25px;
            border-radius: 16px;
            margin-bottom: 35px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }
        .table thead th {
            background: #1a0f0a !important;
            color: #f5e4d0 !important;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.82rem;
            letter-spacing: 1px;
            padding: 14px;
        }
        .table tbody td {
            padding: 14px;
            border-bottom: 1px solid rgba(202, 151, 69, 0.2);
        }
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; background: #fff; }
            .total-box { border: 2px solid #ca9745 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .table thead th { background: #1a0f0a !important; color: #fff !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="container-fluid" style="max-width: 1000px;">
        <div class="report-header d-flex justify-content-between align-items-end flex-wrap gap-3">
            <div>
                <span class="badge px-3 py-2 rounded-pill mb-2" style="background: rgba(202, 151, 69, 0.2); color: #ca9745; font-weight: 700; letter-spacing: 1px; font-size: 0.75rem;">OFFICIAL FISCAL DOCUMENTATION</span>
                <h1 class="brand-title mb-1">Executive Sales Ledger</h1>
                <p class="text-muted mb-0 fw-semibold">Audit Interval: <strong style="color: #ca9745;"><?= ucfirst($period) ?></strong></p>
                <p class="text-muted small mb-0">Compiled Timestamp: <?= date('F d, Y • h:i A') ?></p>
            </div>
            <div class="text-end">
                <h2 class="brand-title mb-0" style="color: #ca9745;">Stitch Smart</h2>
                <p class="mb-0 fw-bold" style="font-size: 0.95rem;">Bespoke Tailoring & Luxury Apparel</p>
                <p class="text-muted small mb-0 font-monospace">Authorized Executive Report</p>
            </div>
        </div>

        <div class="total-box">
            <div class="row text-center g-4 align-items-center">
                <div class="col-6 border-end" style="border-color: rgba(202,151,69,0.3) !important;">
                    <span class="text-uppercase small fw-bold text-muted" style="letter-spacing: 1px;">Total Processed Orders</span>
                    <h2 class="display-6 fw-bolder mb-0 mt-1" style="color: #1a0f0a;"><?= count($orders) ?> <small class="fs-6 text-muted fw-normal">Contracts</small></h2>
                </div>
                <div class="col-6">
                    <span class="text-uppercase small fw-bold text-muted" style="letter-spacing: 1px;">Gross Period Revenue</span>
                    <h2 class="display-6 fw-bolder mb-0 mt-1" style="color: #ca9745;">₹ <?= number_format(array_sum(array_column($orders, 'total')), 2) ?></h2>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Order Ref</th>
                        <th>Transaction Date</th>
                        <th>Client / Purchaser</th>
                        <th>Fulfillment Status</th>
                        <th class="text-end">Contract Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $order): ?>
                    <tr>
                        <td class="fw-bold font-monospace">#<?= (int)$order['id'] ?></td>
                        <td><?= date('M d, Y', strtotime($order['created_at'])) ?></td>
                        <td class="fw-bold"><?= htmlspecialchars($order['customer_name'] ?? 'Client') ?></td>
                        <td>
                            <span class="badge rounded-pill px-3 py-1" style="background: rgba(202, 151, 69, 0.2); color: #ca9745; border: 1px solid rgba(202,151,69,0.4);">
                                <?= htmlspecialchars(ucwords($order['status'])) ?>
                            </span>
                        </td>
                        <td class="text-end fw-bolder" style="color: #1a0f0a;">₹ <?= number_format($order['total'], 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($orders)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted fst-italic">No financial transactions recorded within this interval.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-5 pt-4 border-top text-center text-muted small">
            <p class="mb-1 fw-bold">STITCH SMART LUXURY TAILORING SYSTEM • OFFICIAL ACCOUNTING RECORDS</p>
            <p class="mb-0">This document is electronically verified and generated directly from the corporate database. No physical signature required.</p>
        </div>

        <div class="no-print text-center mt-5 pt-3 d-flex justify-content-center gap-3">
            <button onclick="window.print()" class="btn px-5 py-3 rounded-pill shadow-lg d-flex align-items-center gap-2" style="background: linear-gradient(135deg, #ca9745, #e8c547); color: #1a0f0a; border: none; font-weight: 800; font-size: 1rem;">
                <i class="bi bi-printer-fill fs-5"></i> Print or Export to PDF
            </button>
            <button onclick="window.close()" class="btn px-4 py-3 rounded-pill border fw-bold" style="background: #fff; color: #1a0f0a;">
                <i class="bi bi-x-circle"></i> Close Preview
            </button>
        </div>
    </div>

</body>
</html>
