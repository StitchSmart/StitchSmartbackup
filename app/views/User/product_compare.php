<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$categories = $categories ?? [];
$categoryProducts = $categoryProducts ?? [];
$categoryNames = [];
$categoriesArray = [];
$allowed = ['men', 'women', 'kids', "men's", "women's", "kid's", "mens", "womens"];
foreach ($categories as $category) {
    if (in_array(strtolower(trim($category['c_name'])), $allowed)) {
        $categoryNames[$category['c_id']] = $category['c_name'];
        $categoriesArray[] = $category;
    }
}
$categories = $categoriesArray;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compare Products - <?= APP_NAME ?></title>
    <meta name="description" content="Compare products side-by-side at Stitch Smart to find the perfect match for your style and budget.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>css/navbar.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>css/footer.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>css/colors.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>css/<?= $global_theme ?? 'theme-luxury' ?>-frontend.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>

        /* ============================================================
           COMPARE PAGE — LUXURY DARK THEME OVERRIDES
           ============================================================ */
        :root.theme-luxury body {
            background: var(--bg-body, #0a0a0a) !important;
            color: var(--text-main, #f4e9d3) !important;
        }
        :root.theme-luxury .cp-hero {
            background: radial-gradient(ellipse 80% 60% at 50% 0%, rgba(193,154,78,0.15) 0%, transparent 70%);
            border-bottom-color: rgba(193,154,78,0.2);
        }
        :root.theme-luxury .cp-category-bar {
            border-bottom-color: rgba(193,154,78,0.2);
        }
        :root.theme-luxury .cp-pill {
            background: var(--bg-card, #141414);
            border-color: rgba(193,154,78,0.3);
            color: var(--text-main, #f4e9d3) !important;
        }
        :root.theme-luxury .cp-pill:hover {
            background: rgba(193,154,78,0.15);
            color: var(--text-primary, #fff) !important;
        }
        :root.theme-luxury .cp-slot {
            background: var(--bg-card, #111111);
            border-color: rgba(193,154,78,0.2);
        }
        :root.theme-luxury .cp-slot-empty {
            background: rgba(193,154,78,0.05);
            border-color: rgba(193,154,78,0.2);
        }
        :root.theme-luxury .cp-img-wrap {
            background: var(--bg-card, #111111);
            border-color: rgba(193,154,78,0.2);
        }
        :root.theme-luxury .cp-card-desc {
            border-top-color: rgba(193,154,78,0.2);
        }
        :root.theme-luxury .cp-verdict {
            background: linear-gradient(135deg, rgba(193,154,78,0.15) 0%, var(--bg-card, #111111) 100%);
            border-color: var(--accent-bronze);
        }
        :root.theme-luxury .cp-details-table thead th {
            background: rgba(193,154,78,0.1);
            border-bottom-color: rgba(193,154,78,0.2);
        }
        :root.theme-luxury .cp-details-table tbody tr {
            border-bottom-color: rgba(193,154,78,0.15);
        }
        :root.theme-luxury .cp-details-table tbody tr:nth-child(even) {
            background: rgba(193,154,78,0.02);
        }
        :root.theme-luxury .cp-details-table tbody tr:hover {
            background: rgba(193,154,78,0.08);
        }
        :root.theme-luxury .cp-details-panel,
        :root.theme-luxury .cp-how-panel,
        :root.theme-luxury .cp-browser-panel {
            background: var(--bg-card, #111111);
            border-color: rgba(193,154,78,0.2);
        }
        :root.theme-luxury .cp-product-item {
            background: var(--bg-card, #141414);
            border-color: rgba(193,154,78,0.2);
        }
        :root.theme-luxury .cp-product-item img {
            background: transparent;
            border-color: rgba(193,154,78,0.2);
        }
        :root.theme-luxury .cp-divider {
            background: linear-gradient(90deg, transparent, rgba(193,154,78,0.3), transparent);
        }
        :root.theme-luxury .cp-change-btn {
            background: var(--bg-card, #141414);
            border-color: rgba(193,154,78,0.3);
        }
        
        /* ============================================================
           COMPARE PAGE — BASE STYLES
           ============================================================ */

        /* ---------- Keyframes ---------- */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0);    }
        }
        @keyframes shimmer {
            0%   { background-position: -400px 0; }
            100% { background-position:  400px 0; }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(193,154,78,0.25); }
            50%       { box-shadow: 0 0 40px var(--accent-bronze); }
        }
        @keyframes spin-slow {
            from { transform: rotate(0deg);   }
            to   { transform: rotate(360deg); }
        }
        @keyframes badge-pop {
            0%   { transform: translateX(-50%) scale(0.7); opacity: 0; }
            60%  { transform: translateX(-50%) scale(1.1); }
            100% { transform: translateX(-50%) scale(1);   opacity: 1; }
        }

        /* ---------- Base Overrides ---------- */
        body {
            background: radial-gradient(circle at 20% 0%, rgba(193, 154, 78, 0.08), transparent 45%),
                        radial-gradient(circle at 80% 50%, rgba(193, 154, 78, 0.05), transparent 50%),
                        #FAF9F6 !important;
            color: var(--text-main, #5c4335) !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            letter-spacing: -0.01em;
        }

        .cp-wrap {
            background: transparent;
            color: var(--text-main, #5c4335) !important;
            min-height: 100vh;
        }

        .cp-wrap * { box-sizing: border-box; }

        /* ── NUCLEAR override: defeat global theme p/span/label gold rules ── */
        .cp-wrap p,
        .cp-wrap span:not(.cp-card-tag):not(.cp-hero-badge):not(.step-num):not(.cp-card-price):not(.cp-slot-label):not(.cp-browser-heading),
        .cp-wrap li,
        .cp-wrap td,
        .cp-wrap label {
            color: inherit !important;
        }
        /* headings inherit too */
        .cp-wrap h1, .cp-wrap h2, .cp-wrap h3,
        .cp-wrap h4, .cp-wrap h5, .cp-wrap h6 { color: inherit !important; }
        /* links inherit */
        .cp-wrap a { color: inherit; }

        /* ---------- Page Hero ---------- */
        .cp-hero {
            position: relative;
            padding: 50px 0 40px;
            text-align: center;
            background: transparent;
            border-bottom: 1px solid rgba(193, 154, 78, 0.15);
            overflow: hidden;
        }
        .cp-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 1.2rem;
            border-radius: 999px;
            border: 1px solid rgba(193, 154, 78, 0.4);
            background: rgba(193, 154, 78, 0.06);
            color: var(--accent-bronze) !important;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            margin-bottom: 1rem;
            animation: fadeInUp 0.6s ease both;
        }
        .cp-hero h1 {
            font-family: 'Playfair Display', serif !important;
            font-size: clamp(2.2rem, 5vw, 3.6rem) !important;
            font-weight: 900 !important;
            color: #1a0f0a !important;
            line-height: 1.15;
            letter-spacing: -0.02em;
            margin-bottom: 0.8rem;
            animation: fadeInUp 0.6s 0.1s ease both;
        }
        .cp-hero h1 span {
            color: var(--accent-bronze) !important;
            background: linear-gradient(135deg, #c5a059, #aa7c11);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .cp-hero p {
            font-size: 1.05rem;
            color: #5c4a40 !important;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.7;
            font-weight: 500;
            animation: fadeInUp 0.6s 0.2s ease both;
        }

        /* ---------- Section Wrapper ---------- */
        .cp-section {
            padding: 0 0 100px;
        }

        /* ---------- Category Bar ---------- */
        .cp-category-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 0.85rem;
            justify-content: center;
            padding: 24px 0 28px;
            border-bottom: 1px solid rgba(193,154,78,0.15);
        }
        .cp-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.7rem 1.8rem;
            border-radius: 999px;
            border: 1px solid rgba(193,154,78,0.25);
            background: rgba(255, 255, 255, 0.6);
            color: var(--text-main, #5c4335) !important;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            letter-spacing: 0.03em;
            backdrop-filter: blur(4px);
        }
        .cp-pill:hover {
            border-color: var(--accent-bronze);
            background: rgba(193, 154, 78, 0.08);
            color: var(--text-primary, #24150F) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(193,154,78,0.1);
        }
        .cp-pill.active {
            background: linear-gradient(135deg, var(--accent-bronze), var(--accent-bronze-hover, #B8832F));
            border-color: transparent;
            color: #ffffff !important;
            box-shadow: 0 6px 20px rgba(193,154,78,0.3);
            transform: translateY(-2px);
        }
        .cp-pill i { font-size: 1rem; }

        /* ---------- Main Grid ---------- */
        .cp-main-grid {
            max-width: 960px;
            margin: 0 auto;
            padding-top: 2.5rem;
        }

        /* ---------- Compare Stage ---------- */
        .cp-stage {
            display: grid;
            grid-template-columns: 1fr 60px 1fr;
            gap: 1.5rem;
            align-items: center;
        }
        @media (max-width: 768px) {
            .cp-stage {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            .cp-vs-divider {
                margin: 0.5rem 0;
            }
        }

        /* ---------- VS Divider ---------- */
        .cp-vs-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 5;
        }
        .cp-vs-divider span {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.95);
            color: var(--accent-bronze) !important;
            font-family: 'Playfair Display', serif !important;
            font-size: 1.15rem;
            font-weight: 900;
            font-style: italic;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(193, 154, 78, 0.15);
            border: 1px solid rgba(193, 154, 78, 0.35);
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
        }
        .cp-vs-divider:hover span {
            transform: scale(1.08) rotate(-5deg);
            border-color: var(--accent-bronze);
            box-shadow: 0 6px 20px rgba(193, 154, 78, 0.25);
        }
        :root.theme-luxury .cp-vs-divider span {
            background: rgba(20, 20, 20, 0.95);
            border-color: rgba(193, 154, 78, 0.2);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        /* ---------- Guide Banner ---------- */
        .cp-guide-banner {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            margin: 0 auto 3rem auto;
            max-width: 850px;
            padding: 0.85rem 2rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.75);
            border: 1px solid rgba(193, 154, 78, 0.15);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 30px rgba(193, 154, 78, 0.04);
        }
        :root.theme-luxury .cp-guide-banner {
            background: rgba(20, 20, 20, 0.6);
            border-color: rgba(193, 154, 78, 0.12);
        }
        .cp-guide-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .guide-dot {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: rgba(193, 154, 78, 0.12);
            color: var(--accent-bronze) !important;
            font-size: 0.75rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(193, 154, 78, 0.25);
        }
        .guide-text {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-secondary, #7a6253) !important;
        }
        .guide-line {
            flex-grow: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(193, 154, 78, 0.2), transparent);
            max-width: 80px;
        }
        @media (max-width: 768px) {
            .cp-guide-banner {
                flex-direction: column;
                gap: 0.75rem;
                border-radius: 24px;
                padding: 1.25rem;
            }
            .guide-line {
                display: none;
            }
        }

        /* ---------- Slot ---------- */
        .cp-slot {
            min-height: 380px;
            border-radius: 28px;
            border: 1px solid rgba(193,154,78,0.2);
            background: rgba(255, 255, 255, 0.9);
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            position: relative;
            transition: border-color 0.3s, box-shadow 0.3s, transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 10px 30px rgba(92,60,38,0.03);
            backdrop-filter: blur(10px);
            perspective: 1000px;
            transform-style: preserve-3d;
        }
        .cp-slot::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(193,154,78,0.04) 0%, transparent 60%);
            pointer-events: none;
        }
        .cp-slot:hover {
            border-color: var(--accent-bronze);
            box-shadow: 0 16px 48px rgba(193,154,78,0.12);
        }
        .cp-slot.active-picking {
            border-color: var(--accent-bronze) !important;
            animation: pulse-glow 2s infinite;
        }
        .cp-slot-label {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: var(--accent-bronze) !important;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .cp-slot-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(193,154,78,0.15);
        }

        /* ---------- Slot Placeholder ---------- */
        .cp-slot-empty {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 1.25rem;
            cursor: pointer;
            padding: 2.5rem 1.5rem;
            border-radius: 20px;
            border: 1.5px dashed rgba(193,154,78,0.3);
            background: rgba(255, 255, 255, 0.4);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .cp-slot-empty:hover {
            border-color: var(--accent-bronze);
            background: rgba(193,154,78,0.06);
            transform: scale(0.99);
        }
        .cp-slot-empty .plus-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(193,154,78,0.06);
            border: 1px solid rgba(193,154,78,0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-bronze) !important;
            font-size: 1.5rem;
            transition: all 0.3s;
        }
        .cp-slot-empty:hover .plus-icon {
            background: rgba(193,154,78,0.15);
            border-color: var(--accent-bronze);
            transform: scale(1.08) rotate(90deg);
        }
        .cp-slot-empty p {
            font-size: 0.92rem;
            color: var(--text-secondary, #7a6253) !important;
            margin: 0;
            line-height: 1.6;
        }
        .cp-slot-empty p strong {
            color: var(--accent-bronze) !important;
            font-weight: 700;
        }

        /* ---------- Product Card In Slot ---------- */
        .cp-card {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            flex: 1;
            animation: fadeInUp 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .cp-img-wrap {
            border-radius: 20px;
            overflow: hidden;
            background: #ffffff;
            border: 1px solid rgba(193,154,78,0.12);
            cursor: pointer;
            aspect-ratio: 4/3;
            box-shadow: 0 4px 16px rgba(0,0,0,0.02);
            transition: all 0.3s;
            transform: translateZ(25px);
            transform-style: preserve-3d;
        }
        .cp-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .cp-img-wrap:hover {
            border-color: var(--accent-bronze);
        }
        .cp-img-wrap:hover img { transform: scale(1.04); }

        .cp-card-meta { 
            display: flex; 
            flex-direction: column; 
            gap: 0.6rem;
            transform: translateZ(15px);
            transform-style: preserve-3d;
        }
        .cp-card-meta h4 {
            font-family: 'Playfair Display', serif !important;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-primary, #24150F) !important;
            margin: 0;
            line-height: 1.35;
        }
        .cp-card-tag {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.85rem;
            border-radius: 999px;
            background: rgba(193,154,78,0.1);
            color: var(--accent-bronze) !important;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            width: fit-content;
            border: 1px solid rgba(193,154,78,0.15);
        }
        .cp-card-price {
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--accent-bronze) !important;
            letter-spacing: -0.01em;
            margin: 0.1rem 0;
        }
        .cp-card-detail {
            font-size: 0.82rem;
            color: var(--text-secondary, #7a6253) !important;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px dashed rgba(193,154,78,0.1);
            padding-bottom: 0.35rem;
        }
        .cp-card-desc {
            font-size: 0.85rem;
            color: var(--text-muted, #9c8575) !important;
            line-height: 1.65;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            border-top: 1px solid rgba(193,154,78,0.1);
            padding-top: 0.65rem;
            margin-top: 0.2rem;
        }

        /* Add to Cart Button */
        .cp-cart-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.4rem;
            border-radius: 14px;
            border: none;
            background: linear-gradient(135deg, var(--accent-bronze), var(--accent-bronze-hover, #B8832F));
            color: #ffffff !important;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            margin-top: 0.5rem;
            transition: all 0.25s ease;
            letter-spacing: 0.02em;
        }
        .cp-cart-btn:hover {
            background: linear-gradient(135deg, var(--accent-bronze-hover, #B8832F), var(--accent-bronze));
            box-shadow: 0 8px 22px rgba(205,154,72,0.25);
            transform: translateY(-2px);
        }

        /* Change btn */
        .cp-change-btn {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 1px solid rgba(92,60,38,0.20);
            background: rgba(255,255,255,0.95);
            color: var(--accent-bronze) !important;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.9rem;
            z-index: 10;
            transition: all 0.2s;
            backdrop-filter: blur(4px);
        }
        .cp-change-btn:hover {
            background: var(--accent-bronze);
            color: #ffffff !important;
            border-color: transparent;
            transform: rotate(180deg);
        }

        /* Winner Badge */
        .cp-winner-badge {
            position: absolute;
            top: -1px;
            left: 50%;
            transform: translateX(-50%) translateZ(35px);
            background: linear-gradient(135deg, var(--accent-bronze), var(--accent-bronze-hover, #B8832F));
            color: #ffffff !important;
            padding: 0.3rem 1rem;
            border-radius: 0 0 14px 14px;
            font-size: 0.75rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 0.35rem;
            white-space: nowrap;
            box-shadow: 0 6px 20px rgba(193, 154, 78, 0.25);
            animation: badge-pop 0.4s ease both;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        /* ---------- Verdict Box ---------- */
        .cp-verdict {
            margin-top: 3rem;    /* ← extra gap from slots */
            padding: 2.25rem 2.5rem;
            border-radius: 28px;
            background: linear-gradient(135deg, rgba(193,154,78,0.1) 0%, rgba(255,255,255,0.9) 100%);
            border: 1px solid rgba(193,154,78,0.4);
            text-align: center;
            animation: fadeInUp 0.5s ease;
            box-shadow: 0 12px 40px rgba(193,154,78,0.1);
            backdrop-filter: blur(10px);
        }
        .cp-verdict-icon {
            font-size: 2.8rem;
            color: var(--accent-bronze) !important;
            display: block;
            margin-bottom: 0.85rem;
            filter: drop-shadow(0 4px 10px rgba(193,154,78,0.2));
        }
        .cp-verdict h4 {
            font-family: 'Playfair Display', serif !important;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-primary, #24150F) !important;
            margin-bottom: 0.65rem;
        }
        .cp-verdict p {
            color: var(--text-main, #5c4335) !important;
            font-size: 0.98rem;
            margin: 0;
            line-height: 1.65;
        }

        /* ---------- Details Table ---------- */
        .cp-details-wrap {
            margin-top: 3.5rem;   /* ← gap between verdict and table */
        }
        .cp-details-head {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }
        .cp-details-head h5 {
            font-family: 'Playfair Display', serif !important;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary, #24150F) !important;
            margin: 0;
        }
        .cp-details-head span {
            font-size: 0.75rem;
            color: var(--text-muted, #9c8575) !important;
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }
        .cp-details-table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 20px;
            overflow: hidden;
        }
        .cp-details-table thead th {
            padding: 1.15rem 1.4rem;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            background: rgba(193,154,78,0.12);
            border-bottom: 2px solid rgba(193,154,78,0.25);
        }
        .cp-details-table thead th:first-child {
            color: var(--text-muted, #9c8575) !important;
            width: 150px;
        }
        .cp-details-table thead th:not(:first-child) {
            color: var(--accent-bronze) !important;
        }
        .cp-details-table tbody tr {
            border-bottom: 1px solid rgba(193,154,78,0.1);
            transition: background 0.3s;
        }
        .cp-details-table tbody tr:last-child { border-bottom: none; }
        .cp-details-table tbody tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.4);
        }
        .cp-details-table tbody tr:hover {
            background: rgba(193,154,78,0.05);
        }
        .cp-details-table td {
            padding: 1.1rem 1.4rem;
            font-size: 0.92rem;
            vertical-align: middle;
            color: var(--text-main, #5c4335) !important;
            line-height: 1.6;
        }
        .cp-details-table td:first-child {
            color: var(--text-muted, #9c8575) !important;
            font-weight: 700;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            white-space: nowrap;
        }
        .cp-details-table td:not(:first-child) {
            color: var(--text-main, #5c4335) !important;
        }
        .cp-details-panel {
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(193,154,78,0.2);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(92,60,38,0.04);
            backdrop-filter: blur(10px);
        }

        /* ---------- Right Sidebar ---------- */
        .cp-sidebar { display: flex; flex-direction: column; gap: 1.5rem; }

        /* How To Panel */
        .cp-how-panel {
            background: #ffffff;
            border: 1px solid rgba(92,60,38,0.12);
            border-radius: 20px;
            padding: 1.75rem;
        }
        .cp-how-panel .panel-title {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            margin-bottom: 1.2rem;
        }
        .cp-how-panel .panel-title .icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(205,154,72,0.08);
            border: 1px solid rgba(205,154,72,0.20);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-bronze) !important;
            font-size: 1rem;
            flex-shrink: 0;
        }
        .cp-how-panel .panel-title h6 {
            font-family: 'Playfair Display', serif !important;
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-primary, #24150F) !important;
            margin: 0;
        }
        .cp-how-steps { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.9rem; }
        .cp-how-steps li {
            display: flex;
            align-items: flex-start;
            gap: 0.85rem;
            font-size: 0.87rem;
            color: var(--text-main, #5c4335) !important;
            line-height: 1.65;
        }
        .cp-how-steps li .step-num {
            min-width: 26px;
            height: 26px;
            border-radius: 50%;
            background: rgba(205,154,72,0.08);
            border: 1px solid rgba(205,154,72,0.20);
            color: var(--accent-bronze) !important;
            font-size: 0.72rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 1px;
            flex-shrink: 0;
        }
        .cp-how-steps li strong { color: var(--text-primary, #24150F) !important; font-weight: 700; }

        /* Product Browser Panel */
        .cp-browser-panel {
            background: #ffffff;
            border: 1px solid rgba(92,60,38,0.12);
            border-radius: 20px;
            padding: 1.75rem;
        }
        .cp-browser-heading {
            font-family: 'Playfair Display', serif !important;
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--accent-bronze) !important;
            margin-bottom: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 0.10em;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(92,60,38,0.12);
        }
        .cp-browser-empty {
            text-align: center;
            padding: 2.5rem 1rem;
            color: var(--text-muted, #9c8575) !important;
            font-size: 0.88rem;
            line-height: 1.7;
        }
        .cp-browser-empty i { font-size: 2.2rem; display: block; margin-bottom: 0.75rem; opacity: 0.35; color: var(--accent-bronze) !important; }

        /* Product List in Browser */
        .cp-product-list { display: flex; flex-direction: column; gap: 0.65rem; }
        .cp-product-item {
            display: grid;
            grid-template-columns: 76px 1fr;
            gap: 0.85rem;
            padding: 0.85rem 1rem;
            border-radius: 14px;
            border: 1px solid rgba(92,60,38,0.10);
            background: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            transition: all 0.22s ease;
        }
        .cp-product-item:hover {
            border-color: var(--accent-bronze);
            background: rgba(205,154,72,0.06);
            transform: translateX(4px);
            box-shadow: 0 4px 16px rgba(61, 36, 28, 0.05);
        }
        .cp-product-item.selected {
            border-color: var(--accent-bronze);
            background: rgba(205,154,72,0.10);
            box-shadow: 0 0 0 1px rgba(205,154,72,0.15);
        }
        .cp-product-item img {
            width: 76px;
            height: 76px;
            object-fit: contain;
            border-radius: 10px;
            background: #ffffff;
            border: 1px solid rgba(92,60,38,0.08);
        }
        .cp-product-item-info { display: flex; flex-direction: column; justify-content: center; gap: 0.25rem; }
        .cp-product-item h6 {
            font-size: 0.87rem;
            font-weight: 700;
            color: var(--text-primary, #24150F) !important;
            margin: 0;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .cp-product-item .meta {
            font-size: 0.76rem;
            color: var(--text-secondary, #7a6253) !important;
            font-weight: 500;
        }
        .cp-product-item .price {
            font-size: 0.9rem;
            font-weight: 800;
            color: var(--accent-bronze) !important;
            margin-top: 0.1rem;
        }
        .cp-product-item.selected h6 {
            color: var(--text-primary, #24150F) !important;
        }
        .cp-product-item.selected::after {
            content: '';
        }

        /* ---------- Utility ---------- */
        .hidden { display: none !important; }

        /* ---------- Scrollbar ---------- */
        .cp-product-list-wrap {
            max-height: 520px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(205,154,72,0.25) transparent;
        }
        .cp-product-list-wrap::-webkit-scrollbar { width: 5px; }
        .cp-product-list-wrap::-webkit-scrollbar-track { background: transparent; }
        .cp-product-list-wrap::-webkit-scrollbar-thumb {
            background: rgba(205,154,72,0.25);
            border-radius: 4px;
        }

        /* ---------- Dividers ---------- */
        .cp-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(92,60,38,0.15), transparent);
            margin: 3rem 0 2rem;
        }

        /* ---------- Section gap between stage & result area ---------- */
        .cp-result-area {
            margin-top: 2.5rem;
        }

        /* ============================================================
           MODAL FOR PRODUCT SELECTION
           ============================================================ */
        .cp-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(8px);
            z-index: 2000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .cp-modal-overlay.show {
            opacity: 1;
            pointer-events: auto;
        }
        .cp-modal-card {
            background: #ffffff;
            border: 1.5px solid rgba(205,154,72,0.3);
            border-radius: 24px;
            width: 90%;
            max-width: 850px;
            max-height: 85vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            transform: scale(0.95);
            transition: transform 0.3s ease;
            overflow: hidden;
        }
        .cp-modal-overlay.show .cp-modal-card {
            transform: scale(1);
        }
        
        /* Dark Theme Support */
        :root.theme-luxury .cp-modal-card {
            background: #111111;
            border-color: rgba(193,154,78,0.3);
            color: #f4e9d3;
        }
        
        .cp-modal-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(92,60,38,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        :root.theme-luxury .cp-modal-header {
            border-bottom-color: rgba(193,154,78,0.15);
        }
        .cp-modal-header h3 {
            font-family: 'Playfair Display', serif !important;
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0;
            color: var(--text-primary, #24150F) !important;
        }
        :root.theme-luxury .cp-modal-header h3 {
            color: #ffffff !important;
        }
        .cp-modal-subtitle {
            font-size: 0.85rem;
            color: var(--text-secondary, #7a6253);
            margin: 0.25rem 0 0 0;
        }
        .cp-modal-close {
            background: transparent;
            border: none;
            color: var(--text-secondary, #7a6253);
            font-size: 1.25rem;
            cursor: pointer;
            transition: color 0.2s, transform 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
        }
        .cp-modal-close:hover {
            color: var(--accent-bronze);
            background: rgba(205,154,72,0.1);
            transform: rotate(90deg);
        }
        
        /* Filters inside Modal */
        .cp-modal-filters {
            padding: 1rem 2rem;
            background: rgba(205,154,72,0.03);
            border-bottom: 1px solid rgba(92,60,38,0.08);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        @media (min-width: 768px) {
            .cp-modal-filters {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
        }
        :root.theme-luxury .cp-modal-filters {
            background: rgba(193,154,78,0.02);
            border-bottom-color: rgba(193,154,78,0.1);
        }
        
        .cp-modal-tabs {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .cp-modal-tab-pill {
            padding: 0.5rem 1.2rem;
            border-radius: 999px;
            border: 1px solid rgba(205,154,72,0.25);
            background: #ffffff;
            color: var(--text-main, #5c4335) !important;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        :root.theme-luxury .cp-modal-tab-pill {
            background: #181818;
            color: #f4e9d3 !important;
            border-color: rgba(193,154,78,0.2);
        }
        .cp-modal-tab-pill:hover {
            border-color: var(--accent-bronze);
            background: rgba(205,154,72,0.08);
        }
        .cp-modal-tab-pill.active {
            background: linear-gradient(135deg, var(--accent-bronze), var(--accent-bronze-hover, #B8832F));
            color: #ffffff !important;
            border-color: transparent;
        }
        
        /* Search */
        .cp-modal-search-wrapper {
            position: relative;
            max-width: 300px;
            width: 100%;
        }
        .cp-modal-search-wrapper .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted, #9c8575);
            font-size: 0.9rem;
        }
        .cp-modal-search-wrapper input {
            width: 100%;
            padding: 0.5rem 1rem 0.5rem 2.2rem;
            border-radius: 12px;
            border: 1px solid rgba(92,60,38,0.15);
            background: #ffffff;
            font-size: 0.88rem;
            color: var(--text-primary, #24150F);
            outline: none;
            transition: border-color 0.2s;
        }
        :root.theme-luxury .cp-modal-search-wrapper input {
            background: #181818;
            border-color: rgba(193,154,78,0.2);
            color: #ffffff;
        }
        .cp-modal-search-wrapper input:focus {
            border-color: var(--accent-bronze);
        }

        /* Modal Body Scroll */
        .cp-modal-body {
            padding: 1.5rem 2rem;
            overflow-y: auto;
            flex: 1;
            scrollbar-width: thin;
            scrollbar-color: rgba(205,154,72,0.25) transparent;
        }
        .cp-modal-body::-webkit-scrollbar { width: 5px; }
        .cp-modal-body::-webkit-scrollbar-thumb {
            background: rgba(205,154,72,0.25);
            border-radius: 4px;
        }
        
        /* Grid inside Modal */
        .cp-modal-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 1.25rem;
        }
        
        .cp-modal-item {
            background: rgba(255,255,255,0.8);
            border: 1px solid rgba(92,60,38,0.1);
            border-radius: 16px;
            padding: 0.75rem;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        :root.theme-luxury .cp-modal-item {
            background: #161616;
            border-color: rgba(193,154,78,0.15);
        }
        .cp-modal-item:hover {
            border-color: var(--accent-bronze);
            background: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(61, 36, 28, 0.08);
        }
        :root.theme-luxury .cp-modal-item:hover {
            background: #1d1d1d;
            box-shadow: 0 8px 24px rgba(0,0,0,0.4);
        }
        .cp-modal-item.selected {
            border-color: var(--accent-bronze);
            background: rgba(205,154,72,0.06);
            box-shadow: 0 0 0 1px var(--accent-bronze);
        }
        :root.theme-luxury .cp-modal-item.selected {
            background: rgba(193,154,78,0.06);
        }
        .cp-modal-item-img {
            aspect-ratio: 1;
            width: 100%;
            border-radius: 10px;
            object-fit: contain;
            background: #ffffff;
            border: 1px solid rgba(92,60,38,0.06);
            margin-bottom: 0.75rem;
        }
        :root.theme-luxury .cp-modal-item-img {
            background: #111111;
            border-color: rgba(193,154,78,0.08);
        }
        .cp-modal-item-name {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text-primary, #24150F) !important;
            margin: 0 0 0.25rem 0;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex-grow: 1;
        }
        :root.theme-luxury .cp-modal-item-name {
            color: #f4e9d3 !important;
        }
        .cp-modal-item-article {
            font-size: 0.75rem;
            color: var(--text-muted, #9c8575);
            margin-bottom: 0.25rem;
        }
        .cp-modal-item-price {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--accent-bronze) !important;
        }
        .cp-modal-empty {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem 1rem;
            color: var(--text-muted, #9c8575);
        }
        .cp-modal-empty i {
            font-size: 2.5rem;
            display: block;
            margin-bottom: 0.75rem;
            color: var(--accent-bronze);
            opacity: 0.6;
        }

        /* ---------- Horizontal steps guide style ---------- */
        .cp-how-box {
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(193, 154, 78, 0.2);
            border-radius: 24px;
            padding: 1.5rem 2rem;
            margin-bottom: 2.5rem;
            backdrop-filter: blur(8px);
            box-shadow: 0 8px 30px rgba(193,154,78,0.04);
        }
        :root.theme-luxury .cp-how-box {
            background: rgba(20, 20, 20, 0.6);
            border-color: rgba(193,154,78,0.15);
        }
        .cp-how-title {
            font-family: 'Playfair Display', serif !important;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--accent-bronze) !important;
            margin-bottom: 1.25rem;
            text-align: center;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
        .cp-how-steps-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
        }
        @media (max-width: 768px) {
            .cp-how-steps-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
        .cp-step-item {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            position: relative;
        }
        @media (min-width: 769px) {
            .cp-step-item:not(:last-child)::after {
                content: '';
                position: absolute;
                right: -1rem;
                top: 50%;
                transform: translateY(-50%);
                width: 1px;
                height: 24px;
                background: rgba(193, 154, 78, 0.15);
            }
        }
        .cp-step-item .step-num {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: rgba(193, 154, 78, 0.1);
            border: 1px solid rgba(193, 154, 78, 0.3);
            color: var(--accent-bronze) !important;
            font-size: 0.8rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: inset 0 0 4px rgba(193,154,78,0.1);
        }
        .cp-step-item p {
            margin: 0;
            font-size: 0.85rem;
            line-height: 1.45;
            color: var(--text-secondary, #7a6253) !important;
            font-weight: 500;
        }

        /* ---------- Section gap between stage & result area ---------- */
        .cp-result-area {
            margin-top: 2.5rem;
        }
    </style>
</head>
<body class="theme-aware-body">
<?php include('header.php'); ?>

<div class="cp-wrap">

    <!-- ══════════════════════════════ HERO ══════════════════════════════ -->
    <div class="cp-hero">
        <div class="container">
            <div class="cp-hero-badge">
                <i class="bi bi-intersect"></i>
                Product Comparison
            </div>
            <h1>Compare Our <span>Collections</span></h1>
            <p>Select two products side-by-side and let us help you find the perfect match. We'll highlight the best value automatically.</p>
        </div>
    </div>

    <!-- ══════════════════════════════ SECTION ══════════════════════════════ -->
    <div class="cp-section">
        <div class="container">

            <!-- How to Compare Minimalist Guide -->
            <div class="cp-guide-banner">
                <div class="cp-guide-item">
                    <span class="guide-dot">1</span>
                    <span class="guide-text">Click a slot (Product A/B)</span>
                </div>
                <div class="guide-line"></div>
                <div class="cp-guide-item">
                    <span class="guide-dot">2</span>
                    <span class="guide-text">Select product from popup</span>
                </div>
                <div class="guide-line"></div>
                <div class="cp-guide-item">
                    <span class="guide-dot">3</span>
                    <span class="guide-text">Compare & find best value</span>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="cp-main-grid">

                <!-- Slots -->
                <div class="cp-stage" id="cpStage">
                    <!-- Slot A -->
                    <div class="cp-slot" id="cpSlotLeft">
                        <div class="cp-slot-label"><i class="bi bi-circle-half"></i>Product A</div>
                        <div class="cp-slot-empty" id="slotLeftEmpty" onclick="openProductBrowser('left')">
                            <div class="plus-icon"><i class="bi bi-plus-lg"></i></div>
                            <p>Click to select<br><strong style="color:rgba(255,255,255,0.7)!important;">Product A</strong></p>
                        </div>
                    </div>

                    <!-- VS Divider -->
                    <div class="cp-vs-divider">
                        <span>VS</span>
                    </div>

                    <!-- Slot B -->
                    <div class="cp-slot" id="cpSlotRight">
                        <div class="cp-slot-label"><i class="bi bi-circle-half" style="transform:scaleX(-1);display:inline-block;"></i>Product B</div>
                        <div class="cp-slot-empty" id="slotRightEmpty" onclick="openProductBrowser('right')">
                            <div class="plus-icon"><i class="bi bi-plus-lg"></i></div>
                            <p>Click to select<br><strong style="color:rgba(255,255,255,0.7)!important;">Product B</strong></p>
                        </div>
                    </div>
                </div>

                <!-- Verdict + Details: wrapped with top margin for clear separation -->
                <div class="cp-result-area">
                    <!-- Verdict -->
                    <div class="cp-verdict hidden" id="cpVerdict">
                        <i class="bi bi-trophy-fill cp-verdict-icon" id="cpVerdictIcon"></i>
                        <h4 id="cpVerdictTitle">Winner: Product A</h4>
                        <p id="cpVerdictMsg">Product A offers the best value based on price.</p>
                    </div>

                    <!-- Comparison Details Table -->
                    <div class="cp-details-wrap hidden" id="cpDetailsWrap">
                        <div class="cp-divider"></div>
                        <div class="cp-details-head">
                            <h5><i class="bi bi-table" style="color:#c19a4e;margin-right:0.4rem;"></i>Comparison Details</h5>
                            <span>Side-by-side breakdown</span>
                        </div>
                        <div class="cp-details-panel">
                            <table class="cp-details-table">
                                <thead>
                                    <tr>
                                        <th>Attribute</th>
                                        <th><i class="bi bi-circle-half me-1"></i>Product A</th>
                                        <th><i class="bi bi-circle-half me-1" style="transform:scaleX(-1);display:inline-block;"></i>Product B</th>
                                    </tr>
                                </thead>
                                <tbody id="cpDetailsTbody"></tbody>
                            </table>
                        </div>
                    </div><!-- /cp-details-wrap -->
                </div><!-- /cp-result-area -->
            </div><!-- /main-grid -->
        </div><!-- /container -->
    </div><!-- /section -->
</div><!-- /cp-wrap -->

<!-- Product Selection Modal -->
<div class="cp-modal-overlay hidden" id="cpModalOverlay" onclick="closeProductModal(event)">
    <div class="cp-modal-card" onclick="event.stopPropagation()">
        <div class="cp-modal-header">
            <div>
                <h3 id="cpModalTitle">Select Product</h3>
                <p class="cp-modal-subtitle">Browse and select a product to compare</p>
            </div>
            <button class="cp-modal-close" onclick="closeProductModal()"><i class="bi bi-x-lg"></i></button>
        </div>
        
        <!-- Modal Category Tabs & Search -->
        <div class="cp-modal-filters">
            <div class="cp-modal-tabs" id="cpModalTabs"></div>
            <div class="cp-modal-search-wrapper">
                <i class="bi bi-search search-icon"></i>
                <input type="text" id="cpModalSearch" placeholder="Search by name or article..." oninput="filterModalProducts()">
            </div>
        </div>

        <!-- Modal Body / Product Grid -->
        <div class="cp-modal-body">
            <div class="cp-modal-grid" id="cpModalProductGrid"></div>
        </div>
    </div>
</div>

<!-- ══════════════════════════ JAVASCRIPT ══════════════════════════ -->
<script>
    /* ── Data from PHP ── */
    const categories      = <?= json_encode($categories,      JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>;
    const categoryProducts= <?= json_encode($categoryProducts, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>;
    const categoryNames   = <?= json_encode($categoryNames,    JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>;
    const initialCatId    = <?= json_encode($selectedCategoryId ?? null, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>;
    const initialProdAId  = <?= json_encode($selectedProductA  ?? null, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>;
    const initialProdBId  = <?= json_encode($selectedProductB  ?? null, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>;
    const csrfToken       = <?= json_encode($_SESSION['csrf_token'] ?? '', JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>;

    /* ── DOM references ── */
    const cpSlotLeft    = document.getElementById('cpSlotLeft');
    const cpSlotRight   = document.getElementById('cpSlotRight');
    const slotLeftEmpty = document.getElementById('slotLeftEmpty');
    const slotRightEmpty= document.getElementById('slotRightEmpty');
    const cpVerdict     = document.getElementById('cpVerdict');
    const cpVerdictIcon = document.getElementById('cpVerdictIcon');
    const cpVerdictTitle= document.getElementById('cpVerdictTitle');
    const cpVerdictMsg  = document.getElementById('cpVerdictMsg');
    const cpDetailsWrap = document.getElementById('cpDetailsWrap');
    const cpDetailsTbody= document.getElementById('cpDetailsTbody');

    /* ── State ── */
    let selectedCatId = null;
    let compareSlots  = { left: null, right: null };
    let activeSlot    = null;

    /* ── Category Pills ── */
    document.querySelectorAll('.cp-pill').forEach(btn => {
        btn.addEventListener('click', () => {
            selectCategory(parseInt(btn.dataset.categoryId, 10));
        });
    });

    function selectCategory(catId) {
        selectedCatId = catId;
        document.querySelectorAll('.cp-pill').forEach(b => b.classList.remove('active'));
        const active = document.querySelector(`.cp-pill[data-category-id="${catId}"]`);
        if (active) active.classList.add('active');
    }

    function isSelected(id) {
        return (compareSlots.left  && compareSlots.left.id  == id) ||
               (compareSlots.right && compareSlots.right.id == id);
    }

    function openProductBrowser(slot) {
        activeSlot = slot;
        cpSlotLeft .classList.remove('active-picking');
        cpSlotRight.classList.remove('active-picking');
        if (slot === 'left')  cpSlotLeft .classList.add('active-picking');
        if (slot === 'right') cpSlotRight.classList.add('active-picking');

        // Set title in modal
        const modalTitle = document.getElementById('cpModalTitle');
        if (modalTitle) {
            modalTitle.textContent = slot === 'left' ? 'Select Product A' : 'Select Product B';
        }

        // Default to first category if none selected
        if (!selectedCatId && categories.length > 0) {
            selectedCatId = categories[0].c_id;
        }

        // Sync main pill highlight
        if (selectedCatId) {
            document.querySelectorAll('.cp-pill').forEach(b => b.classList.remove('active'));
            const active = document.querySelector(`.cp-pill[data-category-id="${selectedCatId}"]`);
            if (active) active.classList.add('active');
        }

        // Open modal
        const modalOverlay = document.getElementById('cpModalOverlay');
        if (modalOverlay) {
            modalOverlay.classList.remove('hidden');
            // Force reflow
            modalOverlay.offsetHeight;
            modalOverlay.classList.add('show');
            document.body.style.overflow = 'hidden'; // prevent background scrolling
        }

        // Render modal tabs and products
        renderModalTabs();
        loadModalProducts();
    }

    function closeProductModal(event) {
        const modalOverlay = document.getElementById('cpModalOverlay');
        if (modalOverlay) {
            modalOverlay.classList.remove('show');
            setTimeout(() => {
                modalOverlay.classList.add('hidden');
            }, 300);
            document.body.style.overflow = '';
        }
        cpSlotLeft .classList.remove('active-picking');
        cpSlotRight.classList.remove('active-picking');
        activeSlot = null;
    }

    function renderModalTabs() {
        const tabsContainer = document.getElementById('cpModalTabs');
        if (!tabsContainer) return;
        
        tabsContainer.innerHTML = categories.map(cat => {
            const isActive = cat.c_id === selectedCatId ? ' active' : '';
            return `<button type="button" class="cp-modal-tab-pill${isActive}" onclick="selectModalCategory(${cat.c_id})">${escapeHTML(cat.c_name)}</button>`;
        }).join('');
    }

    function selectModalCategory(catId) {
        selectedCatId = catId;
        renderModalTabs();
        
        // Also sync with main page category active state
        document.querySelectorAll('.cp-pill').forEach(b => b.classList.remove('active'));
        const active = document.querySelector(`.cp-pill[data-category-id="${catId}"]`);
        if (active) active.classList.add('active');

        // Clear search
        const searchInput = document.getElementById('cpModalSearch');
        if (searchInput) searchInput.value = '';

        loadModalProducts();
    }

    function loadModalProducts() {
        const grid = document.getElementById('cpModalProductGrid');
        if (!grid) return;
        
        const products = categoryProducts[selectedCatId] || [];
        renderModalProducts(products);
    }

    function renderModalProducts(products) {
        const grid = document.getElementById('cpModalProductGrid');
        if (!grid) return;

        if (!products.length) {
            grid.innerHTML = `
                <div class="cp-modal-empty">
                    <i class="bi bi-box-seam"></i>
                    No products available.
                </div>`;
            return;
        }

        grid.innerHTML = products.map(p => {
            const sel = isSelected(p.id) ? ' selected' : '';
            return `
                <div class="cp-modal-item${sel}" onclick="pickProduct(${p.id})">
                    <img class="cp-modal-item-img" src="<?= BASE_URL ?>/${escapeHTML(p.image_url)}" alt="${escapeHTML(p.name)}" loading="lazy">
                    <h5 class="cp-modal-item-name">${escapeHTML(p.name)}</h5>
                    <div class="cp-modal-item-article">Article: ${escapeHTML(p.article_number || 'N/A')}</div>
                    <div class="cp-modal-item-price">Rs. ${fmt(p.price)}</div>
                </div>`;
        }).join('');
    }

    function filterModalProducts() {
        const query = document.getElementById('cpModalSearch').value.toLowerCase().trim();
        const products = categoryProducts[selectedCatId] || [];
        
        if (!query) {
            renderModalProducts(products);
            return;
        }
        
        const filtered = products.filter(p => {
            const nameMatch = p.name && p.name.toLowerCase().includes(query);
            const artMatch = p.article_number && p.article_number.toLowerCase().includes(query);
            return nameMatch || artMatch;
        });
        
        renderModalProducts(filtered);
    }

    function pickProduct(productId) {
        const products = categoryProducts[selectedCatId] || [];
        const product  = products.find(p => p.id == productId);
        if (!product) return;

        if (activeSlot === 'left') {
            compareSlots.left = product;
            activeSlot = null;
            cpSlotLeft.classList.remove('active-picking');
        } else if (activeSlot === 'right') {
            compareSlots.right = product;
            activeSlot = null;
            cpSlotRight.classList.remove('active-picking');
        } else {
            if (!compareSlots.left)        compareSlots.left  = product;
            else if (!compareSlots.right)  compareSlots.right = product;
            else                           compareSlots.right = product;
        }

        /* Prevent same product in both slots */
        if (compareSlots.left && compareSlots.right &&
            compareSlots.left.id == compareSlots.right.id) {
            compareSlots.right = null;
        }

        if (selectedCatId) selectCategory(selectedCatId);
        renderSlots();
        closeProductModal();
    }

    /* ── Pre-load a slot from URL params ── */
    function setSlot(slot, productId) {
        const p = findById(productId);
        if (!p) return;
        compareSlots[slot] = p;
        if (!selectedCatId) { selectedCatId = p.parent_cat; selectCategory(selectedCatId); }
        else renderSlots();
    }
    function findById(id) {
        for (const cid in categoryProducts) {
            const p = categoryProducts[cid].find(x => x.id == id);
            if (p) return p;
        }
        return null;
    }

    /* ── Verdict ── */
    function calcWinner() {
        if (!compareSlots.left || !compareSlots.right) {
            cpVerdict.classList.add('hidden');
            return null;
        }
        
        const pA = parseFloat(compareSlots.left.price) || 0;
        const pB = parseFloat(compareSlots.right.price) || 0;
        
        const rA = parseFloat(compareSlots.left.rating) || 0;
        const rB = parseFloat(compareSlots.right.rating) || 0;

        const revA = parseInt(compareSlots.left.review_count) || 0;
        const revB = parseInt(compareSlots.right.review_count) || 0;

        // Weighted scoring system
        // 1. Price Score: Lower is better (up to 40 points)
        const maxPrice = Math.max(pA, pB, 1);
        const scorePriceA = ((maxPrice - pA) / maxPrice) * 40;
        const scorePriceB = ((maxPrice - pB) / maxPrice) * 40;

        // 2. Rating Score: Higher is better (up to 35 points)
        const scoreRatingA = (rA > 0 ? (rA / 5.0) : 0.7) * 35;
        const scoreRatingB = (rB > 0 ? (rB / 5.0) : 0.7) * 35;

        // 3. Review Count / Popularity: More reviews is better (up to 15 points)
        const maxRevs = Math.max(revA, revB, 1);
        const scorePopA = (revA / maxRevs) * 15;
        const scorePopB = (revB / maxRevs) * 15;

        // 4. Fabric / Detail Bonus: "premium" or quality fabric terms (up to 10 points)
        const getDescBonus = (p) => {
            const desc = ((p.description || '') + ' ' + (p.details || '') + ' ' + (p.Fabric_Type || '')).toLowerCase();
            let bonus = 5; // default
            if (desc.includes('cotton') || desc.includes('linen') || desc.includes('silk')) bonus += 3;
            if (desc.includes('premium') || desc.includes('luxury') || desc.includes('organic')) bonus += 2;
            return Math.min(bonus, 10);
        };
        const scoreBonusA = getDescBonus(compareSlots.left);
        const scoreBonusB = getDescBonus(compareSlots.right);

        const totalA = scorePriceA + scoreRatingA + scorePopA + scoreBonusA;
        const totalB = scorePriceB + scoreRatingB + scorePopB + scoreBonusB;

        let winner, reason;
        if (Math.abs(totalA - totalB) < 3.5) {
            winner = 'tie';
            reason = `Both products offer extremely close value score. ${escapeHTML(compareSlots.left.name)} is priced at Rs. ${fmt(pA)} while ${escapeHTML(compareSlots.right.name)} is Rs. ${fmt(pB)}. Choose whichever style suits your wardrobe best!`;
        } else if (totalA > totalB) {
            winner = 'left';
            const diff = pB - pA;
            if (diff > 0) {
                reason = `offers better overall value. It is Rs. ${fmt(diff)} more affordable and holds a solid rating profile.`;
            } else {
                reason = `is selected as the premium choice. Even though it is slightly higher priced, its superior user ratings, reviews, and quality details give it the edge.`;
            }
        } else {
            winner = 'right';
            const diff = pA - pB;
            if (diff > 0) {
                reason = `offers better overall value. It is Rs. ${fmt(diff)} more affordable and holds a solid rating profile.`;
            } else {
                reason = `is selected as the premium choice. Even though it is slightly higher priced, its superior user ratings, reviews, and quality details give it the edge.`;
            }
        }

        cpVerdict.classList.remove('hidden');
        if (winner === 'tie') {
            cpVerdictIcon.className = 'bi bi-stars cp-verdict-icon';
            cpVerdictTitle.textContent = "It's a Tie!";
            cpVerdictMsg.textContent = reason;
        } else {
            const w = winner === 'left' ? compareSlots.left : compareSlots.right;
            cpVerdictIcon.className = 'bi bi-trophy-fill cp-verdict-icon';
            cpVerdictTitle.textContent = `Smart Pick: ${escapeHTML(w.name)}`;
            cpVerdictMsg.textContent = `${escapeHTML(w.name)} ${reason}`;
        }
        return winner;
    }

    /* ── Render Slots ── */
    function renderSlots() {
        const winner = calcWinner();
        renderOneSlot(cpSlotLeft,  compareSlots.left,  slotLeftEmpty,  'left',  winner === 'left');
        renderOneSlot(cpSlotRight, compareSlots.right, slotRightEmpty, 'right', winner === 'right');
        renderTable();
    }

    function renderOneSlot(el, product, empty, side, isWinner) {
        el.querySelector('.cp-card')?.remove();
        el.querySelector('.cp-change-btn')?.remove();
        el.querySelector('.cp-winner-badge')?.remove();

        if (product) {
            empty.style.display = 'none';

            if (isWinner) {
                const badge = document.createElement('div');
                badge.className = 'cp-winner-badge';
                badge.innerHTML = '<i class="bi bi-star-fill"></i> Best Choice';
                el.appendChild(badge);
            }

            const changeBtn = document.createElement('button');
            changeBtn.className = 'cp-change-btn';
            changeBtn.title = 'Change product';
            changeBtn.innerHTML = '<i class="bi bi-arrow-repeat"></i>';
            changeBtn.onclick = () => openProductBrowser(side);
            el.appendChild(changeBtn);

            const card = document.createElement('div');
            card.className = 'cp-card';
            card.innerHTML = `
                <div class="cp-img-wrap" onclick="openProductBrowser('${side}')">
                    <img src="<?= BASE_URL ?>/${escapeHTML(product.image_url)}" alt="${escapeHTML(product.name)}" loading="lazy">
                </div>
                <div class="cp-card-meta">
                    <h4>${escapeHTML(product.name)}</h4>
                    <span class="cp-card-tag">${escapeHTML(categoryNames[product.parent_cat] || 'Apparel')}</span>
                    <div class="cp-card-price">Rs. ${fmt(product.price)}</div>
                    <div class="cp-card-detail">Article: ${escapeHTML(product.article_number || 'N/A')}</div>
                    <div class="cp-card-detail">Size: ${escapeHTML(product.size || 'Standard')}</div>
                    <div class="cp-card-desc">${escapeHTML(truncate(product.description || 'No description available.', 130))}</div>
                    <button class="cp-cart-btn" onclick="addToCart(${product.id})">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                </div>`;
            el.appendChild(card);
        } else {
            empty.style.display = '';
        }
    }

    /* ── Comparison Table ── */
    function renderTable() {
        if (!compareSlots.left || !compareSlots.right) {
            cpDetailsWrap.classList.add('hidden');
            return;
        }
        cpDetailsWrap.classList.remove('hidden');
        const rows = [
            { label: 'Name',        left: compareSlots.left.name,                           right: compareSlots.right.name },
            { label: 'Article',     left: compareSlots.left.article_number || 'N/A',         right: compareSlots.right.article_number || 'N/A' },
            { label: 'Price',       left: 'Rs. ' + fmt(compareSlots.left.price),             right: 'Rs. ' + fmt(compareSlots.right.price) },
            { label: 'Category',    left: categoryNames[compareSlots.left.parent_cat]||'—',  right: categoryNames[compareSlots.right.parent_cat]||'—' },
            { label: 'Size',        left: compareSlots.left.size || 'Standard',              right: compareSlots.right.size || 'Standard' },
            { label: 'Description', left: compareSlots.left.description  || '—',             right: compareSlots.right.description  || '—' },
            { label: 'Details',     left: compareSlots.left.details      || '—',             right: compareSlots.right.details      || '—' }
        ];
        cpDetailsTbody.innerHTML = rows.map(r => `
            <tr>
                <td>${escapeHTML(r.label)}</td>
                <td>${escapeHTML(String(r.left))}</td>
                <td>${escapeHTML(String(r.right))}</td>
            </tr>`).join('');
    }

    /* ── Add to Cart ── */
    function addToCart(productId) {
        const form = document.createElement('form');
        form.method = 'post';
        form.action = '<?= BASE_URL ?>/index.php?page=cart_add';
        form.style.display = 'none';
        [['csrf_token', csrfToken], ['product_id', productId], ['qty', 1],
         ['redirect_to', '?page=product_compare']].forEach(([n,v]) => {
            const inp = Object.assign(document.createElement('input'), {type:'hidden', name:n, value:v});
            form.appendChild(inp);
        });
        document.body.appendChild(form);
        form.submit();
    }

    /* ── Helpers ── */
    function fmt(v) { return Number(v||0).toLocaleString('en-US'); }
    function truncate(t, n) { return t && t.length > n ? t.slice(0,n)+'…' : (t||''); }
    function escapeHTML(v) {
        if (v === null || v === undefined) return '';
        return String(v).replace(/&/g,'&amp;').replace(/</g,'&lt;')
                        .replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#039;');
    }

    /* ── Init ── */
    document.addEventListener('DOMContentLoaded', () => {
        if (initialCatId) selectCategory(initialCatId);
        else if (initialProdAId) {
            const p = findById(initialProdAId);
            if (p) selectCategory(p.parent_cat);
        } else if (initialProdBId) {
            const p = findById(initialProdBId);
            if (p) selectCategory(p.parent_cat);
        }

        if (initialProdAId) setSlot('left',  initialProdAId);
        if (initialProdBId) setSlot('right', initialProdBId);
        
        init3dTilt();
    });

    function init3dTilt() {
        document.querySelectorAll('.cp-slot').forEach(card => {
            card.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const maxRotateX = 8;
                const maxRotateY = 8;
                
                const rotateX = ((centerY - y) / centerY) * maxRotateX;
                const rotateY = ((x - centerX) / centerX) * maxRotateY;
                
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-5px) translateZ(10px)`;
                card.style.boxShadow = '0 20px 40px rgba(193, 154, 78, 0.18)';
                card.style.transition = 'none';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0) translateZ(0)';
                card.style.boxShadow = '0 10px 30px rgba(92,60,38,0.03)';
                card.style.transition = 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.5s ease';
            });
        });
    }
</script>
<script>window.preventAutoChatOpenOnComparePage = true;</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php include('footer.php'); ?>
</body>
</html>
