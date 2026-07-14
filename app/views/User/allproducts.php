<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<title>All Products | <?= APP_NAME ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>

<link rel="stylesheet" href="<?= BASE_URL ?>css/navbar.css">
<link rel="stylesheet" href="<?= BASE_URL ?>css/colors.css">
<link rel="stylesheet" href="<?= BASE_URL ?>css/footer.css">
<link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
<link href="<?= BASE_URL ?>css/<?= $global_theme ?? 'theme-luxury' ?>-frontend.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
/* PREMIUM CONTAINER AND WRAPPER */
#productsGrid {
    align-items: flex-start !important;
}
#productsGrid .col-md-4 {
    display: flex;
    flex-direction: column;
}
.shop-container {
    padding: 60px 0;
    font-family: var(--font-body, 'Inter'), sans-serif;
    color: var(--text-main, #3d241c);
}

/* FILTERS SIDEBAR */
.filters-sidebar {
    background: var(--bg-card, rgba(255, 255, 255, 0.9));
    border: 1px solid var(--border-color, rgba(202, 151, 69, 0.15));
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    position: sticky;
    top: 100px;
    transition: all 0.3s ease;
}

.filters-sidebar:hover {
    box-shadow: 0 15px 40px rgba(0,0,0,0.06);
}

.filters-title {
    font-family: var(--font-headings, 'Playfair Display'), 'Outfit', serif;
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 30px;
    color: var(--text-main, #3d241c);
    border-bottom: 2px solid var(--accent-bronze, #ca9745);
    padding-bottom: 12px;
}

.filter-group {
    margin-bottom: 35px;
}

.filter-group-title {
    font-family: var(--font-headings, 'Playfair Display'), 'Outfit', serif;
    font-size: 1.35rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: capitalize;
    color: var(--accent-brown, #5c3c26);
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid var(--border-color, rgba(202, 151, 69, 0.15));
    padding-bottom: 8px;
}

/* Custom Styled Checkboxes */
.custom-checkbox-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.custom-checkbox-item {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-size: 0.95rem;
    font-weight: 500;
    transition: color 0.2s ease;
    user-select: none;
}

.custom-checkbox-item:hover {
    color: var(--accent-bronze, #ca9745);
}

.custom-checkbox-input {
    display: none;
}

.custom-checkbox-box {
    width: 20px;
    height: 20px;
    border: 2px solid var(--accent-bronze, #ca9745);
    border-radius: 6px;
    margin-right: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    background: transparent;
}

.custom-checkbox-input:checked + .custom-checkbox-box {
    background: var(--accent-bronze, #ca9745);
}

.custom-checkbox-box::after {
    content: "\f00c";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    color: #fff;
    font-size: 10px;
    display: none;
}

.custom-checkbox-input:checked + .custom-checkbox-box::after {
    display: block;
}

.rating-slider-wrap {
    padding: 5px 0;
}

.rating-slider-values {
    display: flex;
    justify-content: space-between;
    font-size: 0.9rem;
    font-weight: 600;
    margin-top: 12px;
    color: var(--text-muted, #5c3c26);
}

.rating-slider-values span:last-child {
    color: var(--accent-bronze, #ca9745);
}

.custom-range {
    -webkit-appearance: none;
    width: 100%;
    height: 6px;
    border-radius: 5px;
    background: var(--border-color, rgba(202, 151, 69, 0.2));
    outline: none;
    transition: background 0.3s ease;
}

.custom-range::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: var(--accent-bronze, #ca9745);
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    transition: transform 0.2s ease, background-color 0.2s ease;
}

.custom-range::-webkit-slider-thumb:hover {
    transform: scale(1.2);
    background-color: var(--accent-bronze-hover, #ca9745);
}

.custom-range::-moz-range-thumb {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: var(--accent-bronze, #ca9745);
    cursor: pointer;
    border: none;
}

/* Price Range Slider */
.price-slider-wrap {
    padding: 5px 0;
}

.custom-range {
    -webkit-appearance: none;
    width: 100%;
    height: 6px;
    border-radius: 5px;
    background: var(--border-color, rgba(202, 151, 69, 0.2));
    outline: none;
    transition: background 0.3s ease;
}

.custom-range::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: var(--accent-bronze, #ca9745);
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    transition: transform 0.2s ease, background-color 0.2s ease;
}

.custom-range::-webkit-slider-thumb:hover {
    transform: scale(1.2);
    background-color: var(--accent-bronze-hover, #ca9745);
}

.price-slider-values {
    display: flex;
    justify-content: space-between;
    font-size: 0.9rem;
    font-weight: 600;
    margin-top: 12px;
    color: var(--text-muted, #5c3c26);
}

/* PRODUCT GRID AREA */
.grid-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    flex-wrap: wrap;
    gap: 15px;
}

.grid-title {
    font-family: var(--font-headings, 'Playfair Display'), 'Outfit', serif;
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0;
    color: var(--text-main, #3d241c);
}

/* Custom Sort Dropdown */
.sort-select-wrapper {
    position: relative;
    width: 200px;
}

.sort-select {
    width: 100%;
    padding: 10px 18px;
    background: var(--bg-card, rgba(255, 255, 255, 0.9)) !important;
    border: 1px solid var(--border-color, rgba(202, 151, 69, 0.25)) !important;
    border-radius: 12px !important;
    font-size: 0.9rem !important;
    font-weight: 600 !important;
    color: var(--text-main, #3d241c) !important;
    cursor: pointer;
    appearance: none;
    -webkit-appearance: none;
    transition: all 0.3s ease;
}

.sort-select:focus {
    outline: none;
    border-color: var(--accent-bronze, #ca9745) !important;
    box-shadow: 0 0 10px rgba(202, 151, 69, 0.15);
}

.sort-select-wrapper::after {
    content: "\f078";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: 11px;
    position: absolute;
    right: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--accent-bronze, #ca9745);
    pointer-events: none;
}

/* PRODUCT CARDS */
.prod-grid-card {
    background: #ffffff !important; /* Pure white card background like the sample image */
    border: 1px solid var(--border-color, rgba(202, 151, 69, 0.15));
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.02);
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    height: 100% !important;
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
    width: 100% !important;
    flex: 1 1 100% !important;
}

.prod-grid-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(202, 151, 69, 0.08);
    border-color: var(--accent-bronze, #ca9745);
}

.prod-grid-img-wrap {
    background: #F5EFEB !important; /* Warm cream/tan wrapper background like the sample image */
    border: none;
    border-radius: 16px;
    height: 280px; /* Increased size to take up half of the complete card */
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    padding: 20px;
}

.prod-grid-card:hover .prod-grid-img-wrap {
    background: #EFE6D5 !important; /* Elegant hover darkening of the cream container */
}

.prod-grid-img-wrap img {
    max-width: 95%;
    max-height: 95%;
    object-fit: contain;
    transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}

.prod-grid-card:hover .prod-grid-img-wrap img {
    transform: scale(1.06);
}

.prod-grid-badge {
    background: rgba(202, 151, 69, 0.08);
    color: #9a7522 !important;
    font-size: 0.72rem;
    font-weight: 800;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 50px;
    display: inline-block;
    margin-bottom: 12px;
    width: fit-content;
}

.prod-grid-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: #9a7522 !important;
    margin-bottom: 6px;
    line-height: 1.35;
    height: 48px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.prod-grid-desc {
    font-size: 0.85rem;
    color: #b08d3e !important;
    margin-bottom: 20px;
    line-height: 1.5;
    height: 40px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex-grow: 1;
}

.prod-grid-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid rgba(154, 117, 34, 0.15);
    padding-top: 16px;
    margin-top: auto;
}

.prod-grid-price-block {
    display: flex;
    flex-direction: column;
}

.prod-grid-price {
    font-size: 1.35rem;
    font-weight: 800;
    color: #9a7522 !important;
    line-height: 1;
    white-space: nowrap;
}

.prod-grid-old-price {
    font-size: 0.82rem;
    color: #ca9745 !important;
    text-decoration: line-through;
    margin-top: 3px;
    white-space: nowrap;
}
.prod-grid-btn,
.prod-grid-card:hover .prod-grid-btn {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: var(--accent-bronze, #ca9745) !important;
    border: none !important;
    color: #fff !important;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(202, 151, 69,0.3) !important;
    transition: all 0.3s ease !important;
    transform: none;
}

.prod-grid-btn:hover,
.prod-grid-card:hover .prod-grid-btn:hover {
    background: #ca9745 !important;
    color: #fff !important;
    transform: scale(1.1) !important;
    box-shadow: 0 6px 16px rgba(202, 151, 69,0.45) !important;
}

.prod-grid-btn i {
    font-size: 0.9rem;
}

/* PAGINATION */
.custom-pagination-wrap {
    display: flex;
    justify-content: center;
    margin-top: 50px;
}

.custom-pagination {
    display: flex;
    gap: 8px;
    list-style: none;
    padding: 0;
}

.custom-pagination-btn {
    padding: 10px 18px;
    border-radius: 12px;
    border: 1px solid var(--border-color, rgba(202, 151, 69, 0.2));
    background: var(--bg-card, rgba(255, 255, 255, 0.9));
    color: var(--text-main, #3d241c);
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.custom-pagination-btn:hover, .custom-pagination-btn.active {
    background: var(--accent-bronze, #ca9745);
    border-color: var(--accent-bronze, #ca9745);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(202, 151, 69, 0.15);
}

.custom-pagination-btn.disabled {
    opacity: 0.5;
    pointer-events: none;
}

@media (max-width: 991px) {
    .filters-sidebar {
        position: static;
        top: auto;
        box-shadow: none;
        padding: 24px 18px;
        margin-bottom: 30px;
    }

    .shop-container {
        padding: 40px 0;
    }

    .rating-slider-values,
    .price-slider-values {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }

    .sort-select-wrapper {
        width: 100%;
    }

    .grid-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
}

@media (max-width: 576px) {
    .shop-container {
        padding: 24px 0;
    }

    .filters-sidebar {
        padding: 18px 14px;
    }

    .grid-title {
        font-size: 1.65rem;
    }

    .custom-pagination-btn {
        min-width: 34px;
        height: 34px;
        font-size: 0.78rem;
    }
}

/* ── RATING PANEL ── */
.rate-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    width: 100%;
    margin-top: 12px;
    padding: 10px 0;
    border: 1.5px solid rgba(202, 151, 69,0.4);
    border-radius: 12px;
    background: transparent;
    color: #ca9745;
    font-size: 0.83rem;
    font-weight: 700;
    letter-spacing: 0.4px;
    cursor: pointer;
    transition: all 0.2s ease;
}
.rate-btn:hover {
    background: rgba(202, 151, 69,0.13);
    border-color: #ca9745;
    color: #ca9745;
}
.rate-btn i { font-size: 0.95rem; color: #ca9745; }
.rating-panel {
    display: none;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    margin-top: 10px;
    padding: 16px 14px;
    background: linear-gradient(135deg, rgba(255,249,240,0.98), rgba(253,245,230,0.98));
    border: 1.5px solid rgba(202, 151, 69,0.25);
    border-radius: 16px;
    animation: panelIn 0.3s cubic-bezier(0.16,1,0.3,1);
    position: absolute;
    bottom: 58px;
    left: 16px;
    right: 16px;
    z-index: 50;
    width:100%
    box-sizing: border-box;
    margin-top: 12px;
}
.rating-expand {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.35s cubic-bezier(0.16,1,0.3,1), 
                opacity 0.25s ease,
                margin 0.25s ease;
    opacity: 0;
    margin-top: 0;
}
.rating-expand.open {
    max-height: 180px;
    opacity: 1;
    margin-top: 10px;
}
.rating-expand-inner {
    padding: 14px 16px 12px;
    background: rgba(255,249,240,0.98);
    border: 1px solid rgba(202, 151, 69,0.2);
    border-radius: 14px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}
.rating-panel.open { display: flex; }
@keyframes panelIn {
    from { opacity:0; transform:translateY(-8px); }
    to   { opacity:1; transform:translateY(0); }
}
.rating-panel-title {
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    color: #8a6535;
}
.rp-label {
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.6px;
    text-transform: uppercase;
    color: #ca9745;
}
.rating-stars-row {
    display: flex;
    gap: 8px;
}
.rp-star {
    font-size: 1.7rem;
    color: rgba(202, 151, 69,0.25);
    cursor: pointer;
    transition: color 0.15s ease, transform 0.15s ease;
    line-height: 1;
    user-select: none;
}
.rp-star.lit {
    color: #ca9745;
    transform: scale(1.12);
}
.rp-actions {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-top: 2px;
}

.rp-star.hovered, .rp-star.selected {
    color: #ca9745;
    transform: scale(1.15);
}
.rp-star.selected { animation: starBounce 0.3s ease; }
@keyframes starBounce {
    0%  { transform: scale(1); }
    50% { transform: scale(1.35); }
    100%{ transform: scale(1.15); }
}
.rp-submit {
    padding: 7px 22px;
    border-radius: 50px;
    border: none;
    background: #ca9745;
    color: #fff;
    font-size: 0.8rem;
    font-weight: 700;
    cursor: pointer;
    opacity: 0.45;
    pointer-events: none;
    transition: opacity 0.2s, transform 0.2s, box-shadow 0.2s;
    box-shadow: 0 3px 10px rgba(202, 151, 69,0.25);
}
.rp-submit.ready {
    opacity: 1;
    pointer-events: all;
}
.rp-submit.ready:hover {
    transform: translateY(-1px);
    box-shadow: 0 5px 16px rgba(202, 151, 69,0.4);
} 
.rp-cancel {
    font-size: 0.75rem;
    color: #bbb;
    background: none;
    border: none;
    cursor: pointer;
    text-decoration: underline;
    padding: 0;
}
.rp-cancel:hover { color: #999; }
.rp-success {
    font-size: 0.8rem;
    font-weight: 600;
    color: #5a8a3a;
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 6px 0;
}
.rp-done-msg {
    font-size: 0.8rem;
    font-weight: 600;
    color: #6a8c4a;
    text-align: center;
}
.prod-rated-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    margin-top: 8px;
    padding: 4px 10px;
    background: rgba(202, 151, 69,0.1);
    border: 1px solid rgba(202, 151, 69,0.25);
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 700;
    color: #ca9745;
}

/* ---- DARK THEME: allproducts cards and sidebar black ---- */
<?php if ((($global_theme ?? 'theme-luxury') === 'theme-luxury')): ?>
.prod-grid-card {
    background: #161616 !important;
    border-color: rgba(202, 151, 69, 0.25) !important;
    box-shadow: 0 8px 25px rgba(0,0,0,0.5) !important;
}
.prod-grid-img-wrap {
    background: #1f1f1f !important;
}
.prod-grid-card:hover .prod-grid-img-wrap {
    background: #282828 !important;
}
.prod-grid-title {
    color: #f4e9d3 !important;
}
.prod-grid-desc {
    color: #ca9745 !important;
}
.prod-grid-price {
    color: #f4e9d3 !important;
}
.prod-grid-old-price {
    color: #999 !important;
}
.prod-grid-badge {
    background: rgba(202, 151, 69, 0.15) !important;
    color: #f2c96d !important;
}
.prod-grid-btn, .prod-grid-card:hover .prod-grid-btn {
    background: #ca9745 !important;
    color: #fff !important;
    border: none !important;
}
.prod-grid-btn:hover, .prod-grid-card:hover .prod-grid-btn:hover {
    background: #ca9745 !important;
    color: #fff !important;
    transform: scale(1.1) !important;
}
.no-ratings-text {
    color: #f4e9d3 !important;
}
.filters-sidebar {
    background: #161616 !important;
    border-color: rgba(202, 151, 69, 0.2) !important;
}
.filters-title, .filter-group-title, .custom-checkbox-item, .grid-title {
    color: #f4e9d3 !important;
}
.sort-select {
    background: #161616 !important;
    color: #f4e9d3 !important;
    border-color: rgba(202, 151, 69, 0.3) !important;
}
.custom-pagination-btn {
    background: #161616 !important;
    color: #f4e9d3 !important;
    border-color: rgba(202, 151, 69, 0.3) !important;
}
<?php else: ?>
.no-ratings-text {
    color: #1a0f0a !important;
}
<?php endif; ?>
</style>
</head>

<body>

<?php include('header.php'); ?>

<div class="main">

    <div class="shop-container">
        <div class="container">
            <div class="row g-4">
                
                <!-- Left Sidebar Filters (25% width) -->
                <div class="col-lg-3">
                    <div class="filters-sidebar">
                        <div class="filters-title">Filters</div>
                        
                        <!-- Categories Filter Group -->
                        <div class="filter-group">
                            <div class="filter-group-title">Category</div>
                            <div class="custom-checkbox-list" id="categoryChecklist">
                                <!-- Categories dynamically loaded via JS -->
                            </div>
                        </div>
                        
                        <!-- Rating Filter Group -->
                        <div class="filter-group">
                            <div class="filter-group-title">Rating</div>
                            <div class="rating-slider-wrap">
                                <input type="range" id="ratingSlider" class="custom-range" min="0" max="5" value="0" step="1">
                                <div class="rating-slider-values">
                                    <span>All Ratings</span>
                                    <span id="ratingSliderLabel">All</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Price Range Filter Group -->
                        <div class="filter-group">
                            <div class="filter-group-title">Price Range</div>
                            <div class="price-slider-wrap">
                                <input type="range" id="priceSlider" class="custom-range" min="0" max="1000" value="1000" step="5">
                                <div class="price-slider-values">
                                    <span>Rs. 0</span>
                                    <span id="priceSliderLabel">Rs. 0 - Rs. 1000</span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <!-- Right Products Grid (75% width) -->
                <div class="col-lg-9">
                    <div class="grid-header">
                        <h2 class="grid-title">All Products</h2>
                        
                        <div class="sort-select-wrapper">
                            <select id="sortSelect" class="sort-select">
                                <option value="featured">Sort: Featured</option>
                                <option value="price_low">Price: Low to High</option>
                                <option value="price_high">Price: High to Low</option>
                                <option value="name_az">Name: A to Z</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Products Grid -->
<div class="row g-4 align-items-start" id="productsGrid">                        <!-- Products dynamically rendered here -->
                    </div>
                    
                    <!-- Empty State -->
                    <div id="emptyState" class="empty-state-container text-center py-5 d-none" style="background: rgba(255, 253, 248, 0.5); border: 1px dashed rgba(202, 151, 69, 0.4); border-radius: 20px; margin-top: 2rem;">
                        <div class="empty-state-icon mb-3">
                            <i class="bi bi-search" style="font-size: 3rem; color: rgba(202, 151, 69,0.6);"></i>
                        </div>
                        <h3 class="fw-bold empty-state-title" style="color: #1a1a1a; font-family: 'Playfair Display', serif;">No Products Found</h3>
                        <p class="text-muted empty-state-desc" style="max-width: 420px; margin: 0 auto; line-height: 1.6; font-size: 0.95rem;">
                            We couldn't find any items matching your current search or filters. Try adjusting your criteria to explore our premium collection.
                        </p>
                    </div>
                    
                    <!-- Pagination Controls -->
                    <div class="custom-pagination-wrap" id="paginationWrap">
                        <ul class="custom-pagination" id="paginationList">
                            <!-- Pagination dynamically loaded here -->
                        </ul>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>

</div>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- FILTERING, SORTING, PAGINATION LOGIC -->
<script>
// Load full list of products injected securely from PHP
const allProducts = <?= json_encode($allProducts); ?>;
const categoriesTree = <?= json_encode($categories); ?>;
const baseUrl = "<?= BASE_URL ?>";
const wishlistedProductIds = <?= json_encode(array_map('intval', $wishlistedProductIds ?? [])); ?>;
const csrfToken = <?= json_encode($_SESSION['csrf_token'] ?? '', JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP); ?>;

// Extract dynamic options
const prices = allProducts.map(p => parseFloat(p.price) || 0);
const maxProductPrice = prices.length ? Math.ceil(Math.max(...prices)) : 1000;

// Filter State
let selectedParentCategoryIds = [];
let currentPriceMax = maxProductPrice;
let currentRatingMin = 0;
let currentSort = "featured";
let currentPage = 1;
const itemsPerPage = 6;

// Parse initial URL query parameters
const urlParams = new URLSearchParams(window.location.search);
const urlCatId = parseInt(urlParams.get('category_id'), 10);
if (!isNaN(urlCatId)) {
    selectedParentCategoryIds = [urlCatId];
}
// Support ?category_name=Kids|Men|Women from header Shop dropdown
const urlCatName = (urlParams.get('category_name') || '').toLowerCase().trim();
if (urlCatName && selectedParentCategoryIds.length === 0) {
    const matched = categoriesTree.find(c => (c.c_name || '').toLowerCase() === urlCatName);
    if (matched) {
        selectedParentCategoryIds = [parseInt(matched.c_id)];
    }
}
const searchVal = urlParams.get('search') ? urlParams.get('search').toLowerCase().trim() : '';

function escapeHtml(str) {
    return str
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

// Elements
const categoryChecklist = document.getElementById('categoryChecklist');
const ratingSlider = document.getElementById('ratingSlider');
const ratingSliderLabel = document.getElementById('ratingSliderLabel');
const priceSlider = document.getElementById('priceSlider');
const priceSliderLabel = document.getElementById('priceSliderLabel');
const productsGrid = document.getElementById('productsGrid');
const emptyState = document.getElementById('emptyState');
const sortSelect = document.getElementById('sortSelect');
const paginationList = document.getElementById('paginationList');

// Initialize Filters
function initFilters() {
    // Setup Price Range Slider Limits
    priceSlider.max = maxProductPrice;
    priceSlider.value = maxProductPrice;
    currentPriceMax = maxProductPrice;
    priceSliderLabel.innerText = `Rs. 0 - Rs. ${maxProductPrice}`;
    
    // Render Category Checkboxes based on parent categories from the database tree
    categoryChecklist.innerHTML = "";
    
    // Add "All Products" option first
    const allItem = document.createElement('label');
    allItem.className = 'custom-checkbox-item';
    allItem.htmlFor = 'cat_all';
    allItem.innerHTML = `
        <input type="radio" name="cat_filter" id="cat_all" class="custom-checkbox-input" value="all" ${selectedParentCategoryIds.length === 0 ? 'checked' : ''}>
        <div class="custom-checkbox-box"></div>
        <span>All Products</span>
    `;
    categoryChecklist.appendChild(allItem);

    categoriesTree.forEach((parentCat) => {
        const id = `cat_${parentCat.c_id}`;
        const isChecked = selectedParentCategoryIds.includes(parseInt(parentCat.c_id)) ? 'checked' : '';
        
        let subHtml = '';
        if (parentCat.subs && parentCat.subs.length > 0) {
            subHtml = `<div class="subcategory-list" style="display: none; padding-left: 28px; margin-top: 6px; flex-direction: column; gap: 6px; transition: all 0.3s ease;">`;
            parentCat.subs.forEach(sub => {
                const subId = `cat_${sub.c_id}`;
                const isSubChecked = selectedParentCategoryIds.includes(parseInt(sub.c_id)) ? 'checked' : '';
                subHtml += `
                    <label class="custom-checkbox-item" for="${subId}" style="font-size: 0.85rem; color: var(--accent-brown, #5c3c26);">
                        <input type="radio" name="cat_filter" id="${subId}" class="custom-checkbox-input" value="${sub.c_id}" ${isSubChecked}>
                        <div class="custom-checkbox-box" style="width:16px; height:16px;"></div>
                        <span>${sub.c_name}</span>
                    </label>
                `;
            });
            subHtml += `</div>`;
        }

        const itemWrap = document.createElement('div');
        itemWrap.className = 'category-item-wrap';
        itemWrap.style.marginBottom = '12px';
        itemWrap.innerHTML = `
            <label class="custom-checkbox-item" for="${id}" style="margin-bottom:0;">
                <input type="radio" name="cat_filter" id="${id}" class="custom-checkbox-input" value="${parentCat.c_id}" ${isChecked}>
                <div class="custom-checkbox-box"></div>
                <span>${parentCat.c_name}</span>
            </label>
            ${subHtml}
        `;
        
        // Add hover effects for subcategories
        if (parentCat.subs && parentCat.subs.length > 0) {
            itemWrap.addEventListener('mouseenter', () => {
                const subList = itemWrap.querySelector('.subcategory-list');
                if(subList) subList.style.display = 'flex';
            });
            itemWrap.addEventListener('mouseleave', () => {
                const subList = itemWrap.querySelector('.subcategory-list');
                if(subList) {
                    // Keep open only if a subcategory is actively checked
                    const hasCheckedSub = Array.from(subList.querySelectorAll('.custom-checkbox-input')).some(inp => inp.checked);
                    if (!hasCheckedSub) {
                        subList.style.display = 'none';
                    }
                }
            });
            
            // Auto-open on initial load if a subcategory was already selected
            const subList = itemWrap.querySelector('.subcategory-list');
            if (subList) {
                const hasCheckedSub = Array.from(subList.querySelectorAll('.custom-checkbox-input')).some(inp => inp.checked);
                if (hasCheckedSub) {
                    subList.style.display = 'flex';
                }
            }
        }
        
        categoryChecklist.appendChild(itemWrap);
    });

    ratingSlider.max = 5;
    ratingSlider.min = 0;
    ratingSlider.step = 1;
    ratingSlider.value = 0;
    currentRatingMin = 0;
    ratingSliderLabel.innerText = 'All';

    ratingSlider.addEventListener('input', (e) => {
        currentRatingMin = parseInt(e.target.value, 10);
        ratingSliderLabel.innerText = currentRatingMin === 0 ? 'All' : `${currentRatingMin}★ & up`;
        currentPage = 1;
        applyFiltersAndRender();
    });
    
    // Event listeners
    categoryChecklist.addEventListener('change', (e) => {
        if(e.target.classList.contains('custom-checkbox-input')) {
            if (e.target.value === 'all') {
                selectedParentCategoryIds = [];
            } else {
                selectedParentCategoryIds = [parseInt(e.target.value)];
            }
            currentPage = 1;
            applyFiltersAndRender();
        }
    });
    
    priceSlider.addEventListener('input', (e) => {
        currentPriceMax = parseFloat(e.target.value);
        priceSliderLabel.innerText = `Rs. 0 - Rs. ${currentPriceMax}`;
        currentPage = 1;
        applyFiltersAndRender();
    });
    
    sortSelect.addEventListener('change', (e) => {
        currentSort = e.target.value;
        currentPage = 1;
        applyFiltersAndRender();
    });
}

// Filter, Sort and Paginate
function applyFiltersAndRender() {
    // Compute all allowed category IDs based on checked parents (include children)
    let allowedCategoryIds = [];
    selectedParentCategoryIds.forEach(parentId => {
        allowedCategoryIds.push(parentId);
        const parent = categoriesTree.find(c => parseInt(c.c_id) === parentId);
        if (parent && parent.subs) {
            parent.subs.forEach(sub => {
                allowedCategoryIds.push(parseInt(sub.c_id));
            });
        }
    });

    // 1. Filtering
    let filtered = allProducts.filter(prod => {
        const prodCatId = parseInt(prod.parent_cat);
        const matchesCategory = selectedParentCategoryIds.length === 0 || allowedCategoryIds.includes(prodCatId);
        const prodRating = parseFloat(prod.rating) || 0;
        const matchesRating = currentRatingMin === 0 || prodRating >= currentRatingMin;
        const matchesPrice = (parseFloat(prod.price) || 0) <= currentPriceMax;
        
        // Search filter
        const prodName = (prod.name || '').toLowerCase();
        const prodDesc = (prod.description || '').toLowerCase();
        const matchesSearch = searchVal === '' || prodName.includes(searchVal) || prodDesc.includes(searchVal);
        
        return matchesCategory && matchesRating && matchesPrice && matchesSearch;
    });
    
    // 2. Sorting
    if (currentSort === "price_low") {
        filtered.sort((a, b) => (parseFloat(a.price) || 0) - (parseFloat(b.price) || 0));
    } else if (currentSort === "price_high") {
        filtered.sort((a, b) => (parseFloat(b.price) || 0) - (parseFloat(a.price) || 0));
    } else if (currentSort === "name_az") {
        filtered.sort((a, b) => (a.name || "").localeCompare(b.name || ""));
    } else {
        // "featured" default - sort by ID or featured column
        filtered.sort((a, b) => b.id - a.id);
    }
    
    // 3. Paginate
    const totalItems = filtered.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    currentPage = Math.min(currentPage, totalPages || 1);
    
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = Math.min(startIndex + itemsPerPage, totalItems);
    const paginatedItems = filtered.slice(startIndex, endIndex);
    
    // Render Products Grid
    renderGrid(paginatedItems);
    
    // Render Pagination
    renderPagination(totalPages);
    
    // Handle Empty State
    if(totalItems === 0) {
        emptyState.classList.remove('d-none');
        productsGrid.innerHTML = "";
    } else {
        emptyState.classList.add('d-none');
    }
    
    // Set grid title dynamically
    const titleEl = document.querySelector('.grid-title');
    if (titleEl) {
        if (searchVal !== '') {
            titleEl.innerHTML = `<span style="font-size:1.1rem; color:#888; font-weight:400;">Search Results for:</span> <br><span style="color:#ca9745; font-style:italic;">"${escapeHtml(searchVal)}"</span>`;
        } else if (selectedParentCategoryIds.length > 0) {
            const parent = categoriesTree.find(c => parseInt(c.c_id) === selectedParentCategoryIds[0]);
            titleEl.innerText = parent ? parent.c_name + " Collection" : "Collection";
        } else {
            titleEl.innerText = "All Products";
        }
    }
}

// Render Products into Grid
function renderGrid(products) {
    productsGrid.innerHTML = "";
    products.forEach(prod => {
        const retailPrice = Math.round(parseFloat(prod.price) * 1.45) || (parseFloat(prod.price) + 40);
        
        // Dynamic bulletproof image URL resolution
        let cleanImgUrl = "";
        if (prod.image_url) {
            let path = prod.image_url.split(',')[0].trim();
            // strip leading slash if present
            if (path.startsWith('/')) {
                path = path.substring(1);
            }
            cleanImgUrl = baseUrl.endsWith('/') ? baseUrl + path : baseUrl + '/' + path;
        } else {
            cleanImgUrl = "https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=350&q=80"; // Premium fallback image
        }

        const prodRating   = parseFloat(prod.rating) || 0;
        const reviewCount  = parseInt(prod.review_count) || 0;
        const ratingDisplay = prodRating > 0
            ? `<span class="fas fa-star" style="color:#ca9745;font-size:.85rem"></span> ${prodRating.toFixed(1)} <span style="color:#9a7522">(${reviewCount})</span>`
            : `<span class="no-ratings-text" style="font-size:.85rem;font-weight:700;">No ratings yet</span>`;

        const card = document.createElement('div');
        card.className = "col-md-4 mb-4";
card.style.cssText = "align-items: flex-start;";
        card.innerHTML = `
            <div class="prod-grid-card" style="position:relative;">
                 <a href="${baseUrl}product_show?id=${prod.id}" style="text-decoration:none;">
    <div class="prod-grid-img-wrap">
        <img src="${cleanImgUrl}" alt="${prod.name}" class="img-fluid">
    </div>
</a>
                <div class="prod-grid-badge">${prod.category || 'Collection'}</div>
                <div class="prod-grid-rating">
                    <div class="stars" id="stars-display-${prod.id}">
                        ${Array.from({length:5},(_,i)=>{
                            const n=i+1;
                            let c='far fa-star';
                            if(n<=Math.floor(prodRating))c='fas fa-star';
                            else if(n===Math.ceil(prodRating)&&prodRating%1>=0.5)c='fas fa-star-half-alt';
                            return `<i class="${c}" style="color:#ca9745"></i>`;
                        }).join('')}
                    </div>
                    <div id="rating-summary-${prod.id}" style="font-size:.82rem;margin-top:2px">${ratingDisplay}</div>
                </div>
                <a href="${baseUrl}product_show?id=${prod.id}" style="text-decoration:none; color:inherit;">
    <h3 class="prod-grid-title">${prod.name}</h3>
</a>
                <p class="prod-grid-desc">${prod.description || 'Exclusive handcrafted luxury garment.'}</p>
                <div class="prod-grid-footer">
                    <div class="prod-grid-price-block">
                        <span class="prod-grid-price">Rs. ${prod.price}</span>
                        <span class="prod-grid-old-price">Rs. ${retailPrice}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <form method="POST" action="${baseUrl}cart_add" class="m-0">
                            <input type="hidden" name="product_id" value="${prod.id}">
                            <input type="hidden" name="qty" value="1">
                            <input type="hidden" name="csrf_token" value="${csrfToken}">
                            <input type="hidden" name="redirect_to" value="allproducts">
                            <button type="submit" class="prod-grid-btn" title="Add to cart">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </form>
                        <form method="POST" action="${baseUrl}wishlist_toggle" class="m-0">
                            <input type="hidden" name="csrf_token" value="${csrfToken}">
                            <input type="hidden" name="product_id" value="${prod.id}">
                            <input type="hidden" name="redirect_to" value="allproducts">
                            <button type="submit" class="prod-grid-btn" title="Wishlist">
                                <i class="bi ${wishlistedProductIds.includes(parseInt(prod.id,10))?'bi-heart-fill text-danger':'bi-heart'}"></i>
                            </button>
                        </form>
                    </div>
                </div>
                    </div>
                </div>

            </div>
        `;
        productsGrid.appendChild(card);
    });
}

// Render Pagination controls
function renderPagination(totalPages) {
    paginationList.innerHTML = "";
    if (totalPages <= 1) return;
    
    // Prev button
    const prevLi = document.createElement('li');
    prevLi.innerHTML = `<button class="custom-pagination-btn ${currentPage === 1 ? 'disabled' : ''}">Previous</button>`;
    prevLi.querySelector('button').addEventListener('click', () => {
        if(currentPage > 1) {
            currentPage--;
            applyFiltersAndRender();
            window.scrollTo({ top: 300, behavior: 'smooth' });
        }
    });
    paginationList.appendChild(prevLi);
    
    // Numbers
    for(let i = 1; i <= totalPages; i++) {
        const numLi = document.createElement('li');
        numLi.innerHTML = `<button class="custom-pagination-btn ${currentPage === i ? 'active' : ''}">${i}</button>`;
        numLi.querySelector('button').addEventListener('click', () => {
            currentPage = i;
            applyFiltersAndRender();
            window.scrollTo({ top: 300, behavior: 'smooth' });
        });
        paginationList.appendChild(numLi);
    }
    
    // Next button
    const nextLi = document.createElement('li');
    nextLi.innerHTML = `<button class="custom-pagination-btn ${currentPage === totalPages ? 'disabled' : ''}">Next</button>`;
    nextLi.querySelector('button').addEventListener('click', () => {
        if(currentPage < totalPages) {
            currentPage++;
            applyFiltersAndRender();
            window.scrollTo({ top: 300, behavior: 'smooth' });
        }
    });
    paginationList.appendChild(nextLi);
}

// Rating panel state per product
const selectedRatings = {};

function toggleRating(pid) {
    pid = String(pid);
    const panel = document.getElementById('rp-' + pid);
    const btn   = document.getElementById('ratebtn-' + pid);
    if (!panel) return;

    const isOpen = panel.classList.contains('open');

    // Pehle sab band karo
    document.querySelectorAll('.rating-expand.open').forEach(p => {
        p.classList.remove('open');
        const id = p.id.replace('rp-', '');
        const b  = document.getElementById('ratebtn-' + id);
        if (b) b.style.display = 'flex';
        resetStars(id);
    });

    if (!isOpen) {
        panel.classList.add('open');
        if (btn) btn.style.display = 'none';
    }
}

function resetStars(pid) {
    pid = String(pid);
    delete selectedRatings[pid];
    const row = document.getElementById('rp-stars-' + pid);
    if (row) row.querySelectorAll('.rp-star').forEach(s => s.classList.remove('lit'));
    const sub = document.getElementById('rp-submit-' + pid);
    if (sub) sub.classList.remove('ready');
}

// Star hover + click (delegated)
document.addEventListener('mouseover', e => {
    const s = e.target.closest('.rp-star');
    if (!s) return;
    const pid = s.dataset.pid, val = +s.dataset.val;
    document.getElementById('rp-stars-' + pid)
        ?.querySelectorAll('.rp-star')
        .forEach(x => x.classList.toggle('lit', +x.dataset.val <= val));
});

document.addEventListener('mouseout', e => {
    const s = e.target.closest('.rp-star');
    if (!s) return;
    const pid = s.dataset.pid;
    const sel = selectedRatings[pid] || 0;
    document.getElementById('rp-stars-' + pid)
        ?.querySelectorAll('.rp-star')
        .forEach(x => x.classList.toggle('lit', +x.dataset.val <= sel));
});

document.addEventListener('click', e => {
    const s = e.target.closest('.rp-star');
    if (!s) return;
    const pid = String(s.dataset.pid), val = +s.dataset.val;
    selectedRatings[pid] = val;
    document.getElementById('rp-stars-' + pid)
        ?.querySelectorAll('.rp-star')
        .forEach(x => x.classList.toggle('lit', +x.dataset.val <= val));
    const sub = document.getElementById('rp-submit-' + pid);
    if (sub) sub.classList.add('ready');
});

function submitQuickRating(pid) {
    pid = String(pid);
    const rating = selectedRatings[pid];
    if (!rating) return;

    const submitBtn = document.getElementById('rp-submit-' + pid);
    if (submitBtn) { submitBtn.textContent = 'Saving…'; submitBtn.classList.remove('ready'); }

    const formData = new FormData();
    formData.append('product_id', pid);
    formData.append('rating', rating);
    formData.append('csrf_token', csrfToken);

    fetch(baseUrl + 'quick_rate', { method: 'POST', body: formData })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                const avg = parseFloat(data.average);
                const cnt = parseInt(data.count);

                // Stars update
                const starsDisplay = document.getElementById('stars-display-' + pid);
                if (starsDisplay) {
                    starsDisplay.innerHTML = [1,2,3,4,5].map(n => {
                        let c = 'far fa-star';
                        if (n <= Math.floor(avg)) c = 'fas fa-star';
                        else if (n === Math.ceil(avg) && avg % 1 >= 0.5) c = 'fas fa-star-half-alt';
                        return `<i class="${c}" style="color:#ca9745"></i>`;
                    }).join('');
                }

                // Summary update
                const summaryEl = document.getElementById('rating-summary-' + pid);
                if (summaryEl) {
                    summaryEl.innerHTML = `<span class="fas fa-star" style="color:#ca9745;font-size:.85rem"></span> ${avg.toFixed(1)} <span style="color:#aaa">(${cnt})</span>`;
                }

                // allProducts update
                const prodObj = allProducts.find(p => String(p.id) === pid);
                if (prodObj) { prodObj.rating = avg; prodObj.review_count = cnt; }

                // Success message panel mein
                const inner = document.querySelector(`#rp-${pid} .rating-expand-inner`);
                if (inner) {
                    inner.innerHTML = `<div class="rp-success"><i class="fas fa-check-circle"></i> ${rating}★ rating save ho gayi!</div>`;
                }

                setTimeout(() => {
                    const panel = document.getElementById('rp-' + pid);
                    if (panel) panel.classList.remove('open');
                    const btn = document.getElementById('ratebtn-' + pid);
                    if (btn) btn.style.display = 'flex';
                    resetStars(pid);
                }, 1600);

            } else {
                if (submitBtn) { submitBtn.textContent = 'Submit Rating'; submitBtn.classList.add('ready'); }
            }
        })
        .catch(() => {
            if (submitBtn) { submitBtn.textContent = 'Submit Rating'; submitBtn.classList.add('ready'); }
        });
}
// Run
initFilters();
applyFiltersAndRender();
</script>

</body>
</html>