<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-white mb-0" style="font-size: 2.2rem; font-weight: 900; letter-spacing: -0.5px;">🏷️ Categories Portal</h2>
    <a href="<?= BASE_URL ?>/index.php?page=add_category" class="btn btn-primary px-4 rounded-pill" style="background: linear-gradient(135deg, #CD9A48, #e8c547); border: none; font-weight: 700; box-shadow: 0 4px 15px rgba(205, 154, 72, 0.3);">
        + Add New Category
    </a>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="luxury-list" id="categoryList">
            <?php foreach($categories as $index => $cat): ?>
                <div class="mb-3 border-0 bg-transparent main-category-item">
                    <div class="position-relative" id="heading-<?= $cat['c_id'] ?>">
                        <div class="rounded-4 py-4 pe-5 main-category-button-static" 
                             style="background: linear-gradient(135deg, rgba(205, 154, 72, 0.15), rgba(205, 154, 72, 0.05)); border: 2px solid rgba(205, 154, 72, 0.4); color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.2); transition: all 0.3s ease; padding: 1.5rem 1.25rem;">
                            
                            <div class="d-flex align-items-center w-100 pe-5">
                                <img src="<?= BASE_URL ?>/<?= !empty($cat['c_image']) ? htmlspecialchars($cat['c_image']) : 'pictures/home/cat1.webp' ?>" 
                                     class="rounded-3 me-3" 
                                     style="width: 60px; height: 60px; object-fit: cover; border: 2px solid #CD9A48; flex-shrink: 0;">

                                <div class="flex-grow-1">
                                    <span class="fs-4 fw-bold text-uppercase" style="letter-spacing: 1.5px; color: #CD9A48;">
                                        <?= htmlspecialchars($cat['c_name']) ?>
                                    </span>
                                    <br>
                                    <small class="text-muted"><?= count($cat['subs'] ?? []) ?> Subcategories</small>
                                </div>

                                <div class="d-flex gap-2 ms-auto" style="flex-shrink: 0;">
                                    <a href="<?= BASE_URL ?>/index.php?page=edit_category&id=<?= $cat['c_id'] ?>"
                                       class="btn btn-sm btn-outline-warning rounded-pill px-3 fw-bold" style="position: relative; z-index: 10;">✏️ Edit</a>
                                    <a href="<?= BASE_URL ?>/index.php?page=delete_category&id=<?= $cat['c_id'] ?>"
                                       class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold"
                                       onclick="return confirm('Delete this main category?')" style="position: relative; z-index: 10;">🗑️ Delete</a>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($cat['subs'])): ?>
                        <div class="mt-2 ms-4 ps-3" style="border-left: 2px solid rgba(205,154,72,0.3);">
                            <table class="table table-hover table-dark mb-0 align-middle rounded-3 overflow-hidden" style="background: rgba(0,0,0,0.2);">
                                <thead style="background: rgba(193, 154, 78, 0.05);">
                                    <tr>
                                        <th class="ps-4 py-2 text-muted small" style="width: 80px;">CID</th>
                                        <th class="py-2 text-muted small">Subcategory Name</th>
                                        <th class="py-2 text-muted small text-end pe-4">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($cat['subs'] as $sub): ?>
                                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                            <td class="ps-4"><small class="text-muted">#<?= $sub['c_id'] ?></small></td>
                                            <td><span class="text-white-50"><?= htmlspecialchars($sub['c_name']) ?></span></td>
                                            <td class="text-end pe-4">
                                                <a href="<?= BASE_URL ?>/index.php?page=edit_category&id=<?= $sub['c_id'] ?>"
                                                   class="btn btn-sm btn-link text-warning text-decoration-none px-3">Edit</a>
                                                <a href="<?= BASE_URL ?>/index.php?page=delete_category&id=<?= $sub['c_id'] ?>"
                                                   class="btn btn-sm btn-link text-danger text-decoration-none px-3"
                                                   onclick="return confirm('Delete this subcategory?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if(empty($categories)): ?>
            <div class="text-center py-5">
                <p style="font-size: 3rem;">🏷️</p>
                <p class="text-muted">No categories yet. Click <strong>+ Add New Category</strong> to create one.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.main-category-button-static:hover {
    border-color: rgba(205, 154, 72, 0.7) !important;
    box-shadow: 0 6px 20px rgba(205, 154, 72, 0.15) !important;
    transform: translateY(-2px);
}

.main-category-item {
    transition: transform 0.2s ease;
}

.accordion-button::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffd700'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
    background-size: 1.5rem !important;
    width: 1.5rem !important;
    height: 1.5rem !important;
    transition: transform 0.3s ease-in-out;
}

.accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffd700'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
    transform: rotate(-180deg);
}

.accordion-button:not(.collapsed) {
    background: rgba(193, 154, 78, 0.15) !important;
    box-shadow: inset 0 -1px 0 rgba(193, 154, 78, 0.2);
    color: var(--accent-bronze) !important;
}

.accordion-button:focus {
    box-shadow: 0 0 0 0.25rem rgba(193, 154, 78, 0.1);
}

.main-category-row:hover {
    background: rgba(193, 154, 78, 0.1) !important;
}

/* Subcategory Card Styling */
.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    border-color: rgba(205, 154, 72, 0.5) !important;
    box-shadow: 0 12px 25px rgba(205, 154, 72, 0.2) !important;
    background: rgba(255,255,255,0.06) !important;
}

.card:hover .card-title {
    color: #CD9A48 !important;
}

.accordion-item {
    transition: transform 0.2s ease;
}

.accordion-item:hover {
    transform: translateX(5px);
}
</style>
