<!DOCTYPE html>
<?php
$newOrderCount = 0;
if (class_exists('Database')) {
    $db = new Database();
    $conn = $db->connect();
    $result = $conn->query("SELECT COUNT(*) as c FROM orders WHERE status LIKE 'Pending%'");
    if ($result) {
        $newOrderCount = (int) $result->fetch_assoc()['c'];
    }
}
?>
<html>
<head>
    <title><?= $title ?? 'Admin' ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
<link href="<?= BASE_URL ?>/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/admin/base.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/admin/<?= $theme ?>.css?v=<?= time() ?>">
</head>

<body>

<header>
    <div class="head">
        <div class="container-fluid text-light">
            <div class="box">
                <h4 class="mt-4">Stitch<span>Smart</span></h4>
                <div class="mt-3 d-flex gap-3 align-items-center justify-content-between">
                    <div class="d-flex gap-3 align-items-center">
                        <a href="<?= BASE_URL ?>/index.php?page=switch_theme&theme=theme-default" 
                           style="
                               display: inline-block;
                               padding: 6px 20px;
                               border-radius: 30px;
                               text-decoration: none;
                               font-weight: 600;
                               font-size: 0.9rem;
                               transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                               border: 2px solid #ccc;
                               <?= ($theme === 'theme-default') ? 'background: #fff; color: #000;' : 'background: transparent; color: #ccc;' ?>
                           "
                           onmouseover="this.style.transform='scale(1.05) translateY(-2px)'; <?= ($theme === 'theme-default') ? '' : 'this.style.borderColor=\'#fff\'; this.style.color=\'#fff\';' ?>"
                           onmouseout="this.style.transform='scale(1) translateY(0)'; <?= ($theme === 'theme-default') ? '' : 'this.style.borderColor=\'#ccc\'; this.style.color=\'#ccc\';' ?>"
                           >
                            <i class="bi bi-palette2 me-1"></i> Default
                        </a>
                        <a href="<?= BASE_URL ?>/index.php?page=switch_theme&theme=theme-luxury" 
                           style="
                               display: inline-block;
                               padding: 6px 20px;
                               border-radius: 30px;
                               text-decoration: none;
                               font-weight: 600;
                               font-size: 0.9rem;
                               transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                               border: 2px solid var(--accent-bronze, #c19a4e);
                               <?= ($theme === 'theme-luxury') ? 'background: linear-gradient(135deg, #c19a4e 0%, #8b5a2b 100%); color: #000;' : 'background: transparent; color: #c19a4e;' ?>
                           "
                           onmouseover="this.style.transform='scale(1.05) translateY(-2px)'; this.style.boxShadow='0 5px 15px rgba(193, 154, 78, 0.4)';"
                           onmouseout="this.style.transform='scale(1) translateY(0)'; this.style.boxShadow='none';"
                           >
                            <i class="bi bi-stars me-1"></i> Luxury ✨
                        </a>
                    </div>
                    <a href="<?= BASE_URL ?>/index.php?page=manage_orders" class="order-bell" title="View pending orders">
                        <i class="bi bi-bell-fill"></i>
                        <?php if ($newOrderCount > 0): ?>
                            <span class="notif-badge"><?= $newOrderCount ?></span>
                        <?php endif; ?>
                    </a>
                </div>
                <h1 class="text-center"><?= $title ?? 'Admin' ?></h1>
                <p class="text-center">Manage content, products, categories, and orders of E-commerce store.</p>
            </div>
        </div>
    </div>
</header>

<main>
    <div class="row mt-5 mx-0 px-3">
        
        <?php include '../app/views/admin/sidebar.php'; ?>

        <div class="col-xl-9 col-sm-8">

            <!-- Global Notifications -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="ss-toast ss-toast--success" role="alert" aria-live="assertive">
                    <div class="ss-toast__icon">
                        <i class="bi bi-check-lg"></i>
                    </div>
                    <div class="ss-toast__body">
                        <div class="ss-toast__label">Success</div>
                        <div class="ss-toast__message"><?= htmlspecialchars($_SESSION['success']); ?></div>
                    </div>
                    <button class="ss-toast__close" aria-label="Close" onclick="this.closest('.ss-toast').classList.add('ss-toast--hiding'); setTimeout(()=>this.closest('.ss-toast').remove(),350);">&times;</button>
                    <div class="ss-toast__progress"></div>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['errors'])): ?>
                <div class="ss-toast ss-toast--error" role="alert" aria-live="assertive">
                    <div class="ss-toast__icon">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <div class="ss-toast__body">
                        <div class="ss-toast__label">Errors</div>
                        <div class="ss-toast__message">
                            <ul class="mb-0 ps-3">
                                <?php foreach ($_SESSION['errors'] as $err): ?>
                                    <li><?= htmlspecialchars($err) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <button class="ss-toast__close" aria-label="Close" onclick="this.closest('.ss-toast').classList.add('ss-toast--hiding'); setTimeout(()=>this.closest('.ss-toast').remove(),350);">&times;</button>
                    <div class="ss-toast__progress ss-toast__progress--error"></div>
                </div>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="ss-toast ss-toast--error" role="alert" aria-live="assertive">
                    <div class="ss-toast__icon">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <div class="ss-toast__body">
                        <div class="ss-toast__label">Error</div>
                        <div class="ss-toast__message"><?= htmlspecialchars($_SESSION['error']); ?></div>
                    </div>
                    <button class="ss-toast__close" aria-label="Close" onclick="this.closest('.ss-toast').classList.add('ss-toast--hiding'); setTimeout(()=>this.closest('.ss-toast').remove(),350);">&times;</button>
                    <div class="ss-toast__progress ss-toast__progress--error"></div>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php require_once "../app/views/" . $view; ?>

        </div>

    </div>
</main>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

<!-- Toast Container -->
<div id="ss-toast-container" aria-live="polite" aria-atomic="false"></div>

<style>
/* ═══════════════════════════════════════════
   STITCHSMART TOAST NOTIFICATION SYSTEM
   Bottom-right corner · Never overlaps content
═══════════════════════════════════════════ */
#ss-toast-container {
    position: fixed;
    bottom: 28px;
    right: 28px;
    z-index: 999999;
    display: flex;
    flex-direction: column;
    gap: 12px;
    pointer-events: none;
    max-width: 380px;
    width: calc(100vw - 40px);
}

.ss-toast {
    pointer-events: all;
    display: flex;
    align-items: center;
    gap: 14px;
    background: #ffffff;
    border-radius: 14px;
    padding: 16px 18px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.12), 0 2px 8px rgba(0,0,0,0.06);
    border: 1px solid rgba(193, 154, 78, 0.18);
    position: relative;
    overflow: hidden;
    font-family: 'Plus Jakarta Sans', sans-serif;
    animation: ssToastSlideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    min-width: 280px;
}

.ss-toast--error {
    border-color: rgba(220, 53, 69, 0.18);
}

.ss-toast--hiding {
    animation: ssToastSlideDown 0.35s cubic-bezier(0.4, 0, 1, 1) forwards !important;
}

/* Icon circle */
.ss-toast__icon {
    flex-shrink: 0;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: rgba(193, 154, 78, 0.10);
    border: 1px solid rgba(193, 154, 78, 0.22);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #c19a4e;
    font-size: 1.1rem;
}
.ss-toast--error .ss-toast__icon {
    background: rgba(220, 53, 69, 0.08);
    border-color: rgba(220, 53, 69, 0.18);
    color: #dc3545;
}

/* Body */
.ss-toast__body {
    flex: 1;
    min-width: 0;
}
.ss-toast__label {
    font-size: 0.7rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.9px;
    color: #c19a4e;
    margin-bottom: 3px;
    line-height: 1;
}
.ss-toast--error .ss-toast__label {
    color: #dc3545;
}
.ss-toast__message {
    font-size: 0.88rem;
    font-weight: 600;
    color: #3b2b20;
    line-height: 1.4;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.ss-toast__message ul {
    white-space: normal;
}

/* Close button */
.ss-toast__close {
    flex-shrink: 0;
    background: none;
    border: none;
    cursor: pointer;
    color: #9b8c80;
    font-size: 1.25rem;
    line-height: 1;
    padding: 0 0 0 4px;
    transition: color 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    border-radius: 50%;
}
.ss-toast__close:hover {
    color: #3b2b20;
    background: rgba(0,0,0,0.05);
}

/* Progress bar (auto-dismiss timer) */
.ss-toast__progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    border-radius: 0 0 0 14px;
    background: linear-gradient(90deg, #c19a4e, #e8c07a);
    animation: ssToastProgress 5s linear forwards;
}
.ss-toast__progress--error {
    background: linear-gradient(90deg, #dc3545, #ff6b7a);
}

/* Animations */
@keyframes ssToastSlideUp {
    from {
        transform: translateY(24px) scale(0.96);
        opacity: 0;
    }
    to {
        transform: translateY(0) scale(1);
        opacity: 1;
    }
}
@keyframes ssToastSlideDown {
    from {
        transform: translateY(0) scale(1);
        opacity: 1;
    }
    to {
        transform: translateY(16px) scale(0.95);
        opacity: 0;
    }
}
@keyframes ssToastProgress {
    from { width: 100%; }
    to   { width: 0%; }
}

/* Mobile adjustment */
@media (max-width: 576px) {
    #ss-toast-container {
        bottom: 16px;
        right: 12px;
        left: 12px;
        width: auto;
    }
    .ss-toast {
        min-width: unset;
    }
}
</style>

<script>
(function() {
    function initToasts() {
        var container = document.getElementById('ss-toast-container');
        if (!container) return;
        document.querySelectorAll('.ss-toast').forEach(function(toast) {
            if (toast.parentElement !== container) {
                container.appendChild(toast);
            }
            var timer = setTimeout(function() {
                toast.classList.add('ss-toast--hiding');
                setTimeout(function() { toast.remove(); }, 350);
            }, 5000);
            toast.addEventListener('mouseenter', function() {
                toast.querySelectorAll('.ss-toast__progress').forEach(function(p) {
                    p.style.animationPlayState = 'paused';
                });
                clearTimeout(timer);
            });
            toast.addEventListener('mouseleave', function() {
                toast.querySelectorAll('.ss-toast__progress').forEach(function(p) {
                    p.style.animationPlayState = 'running';
                });
                timer = setTimeout(function() {
                    toast.classList.add('ss-toast--hiding');
                    setTimeout(function() { toast.remove(); }, 350);
                }, 2000);
            });
        });
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initToasts);
    } else {
        initToasts();
    }
})();
</script>

</body>
</html>