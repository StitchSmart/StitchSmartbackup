<div class="container-fluid py-4">
    <div class="card p-4 p-md-5 mx-auto rounded-4 shadow-lg border-0" style="max-width: 900px; background: linear-gradient(145deg, #ffffff, #fcfbf9); border: 1px solid rgba(202, 151, 69, 0.2) !important;">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom flex-wrap gap-3">
            <div>
                <h3 class="fw-bolder mb-0" style="color: #1a0f0a; font-size: 1.85rem;">Edit Category Collection</h3>
            </div>
            <a href="<?= url('') ?>admin_categories" class="btn px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2" style="background: rgba(202, 151, 69, 0.12); color: #ca9745; border: 1px solid rgba(202, 151, 69, 0.4); font-weight: 700; font-size: 0.9rem; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.background='rgba(202, 151, 69, 0.25)'; this.style.color='#1a0f0a';" onmouseout="this.style.background='rgba(202, 151, 69, 0.12)'; this.style.color='#ca9745';">
                <i class="bi bi-arrow-left pe-1"></i> Back to Categories
            </a>
        </div>
    <form method="POST" enctype="multipart/form-data" action="<?= url('') ?>update_category">
        <input type="hidden" name="id" value="<?= (int)$category['c_id'] ?>">
        <input type="hidden" name="old_banner" value="<?= htmlspecialchars($category['c_img2'] ?? '') ?>">
        <input type="hidden" name="old_image" value="<?= htmlspecialchars($category['c_image'] ?? '') ?>">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Category Name <span class="text-danger">*</span></label>
                <input type="text" name="cat_name" class="form-control px-3 py-2" value="<?= htmlspecialchars($category['c_name'] ?? '') ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Parent Category</label>
                <select name="parent_id" class="form-select px-3 py-2" required>
                    <option value="0" <?= ($category['parent_id'] == 0) ? 'selected' : '' ?>>-- None (Top Level Main Category) --</option>
                    <?php foreach($parents as $parent): ?>
                        <option value="<?= $parent['c_id'] ?>" <?= ($parent['c_id'] == $category['parent_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($parent['c_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label fw-bold">Category Description <span class="text-danger">*</span></label>
                <textarea name="cat_desc" class="form-control px-3 py-2" rows="4" required><?= htmlspecialchars($category['c_description'] ?? '') ?></textarea>
            </div>

            <div class="col-12">
                <div class="p-3 rounded-3 border d-flex flex-column flex-md-row align-items-center gap-4" style="background: rgba(0,0,0,0.03);">
                    <?php if(!empty($category['c_image'])): ?>
                        <div class="text-center flex-shrink-0">
                            <small class="text-muted d-block mb-1 fw-bold">Current Icon / Photo:</small>
                            <img src="<?= BASE_URL ?>/<?= htmlspecialchars($category['c_image']) ?>" class="rounded shadow-sm border" style="max-height: 100px; object-fit: cover;">
                        </div>
                    <?php endif; ?>
                    <div class="flex-grow-1 w-100">
                        <label class="form-label fw-bold">Replace Category Icon / Photo <small class="text-muted fw-normal">(Optional)</small></label>
                        <input type="file" name="cimage" class="form-control px-3 py-2">
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Section -->
        <div class="col-12 mt-4 pt-3 border-top">
            <p class="fw-bold mb-0" style="font-size: 0.78rem; letter-spacing: 1.5px; color: #ca9745; text-transform: uppercase;"><i class="bi bi-search pe-1"></i> Global Search Metadata (SEO) <span class="text-muted fw-normal" style="font-size:0.75rem; letter-spacing:0; text-transform:none;">(Optional)</span></p>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Meta Title</label>
                <input type="text" name="meta_title" class="form-control px-3 py-2" value="<?= htmlspecialchars($category['meta_title'] ?? '') ?>" placeholder="StitchSmart Category Title">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Meta Keywords</label>
                <input type="text" name="meta_keywords" class="form-control px-3 py-2" value="<?= htmlspecialchars($category['meta_keywords'] ?? '') ?>" placeholder="tailoring, collection, luxury">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">Meta Description</label>
                <textarea name="meta_desc" class="form-control px-3 py-2" rows="3"><?= htmlspecialchars($category['meta_description'] ?? '') ?></textarea>
            </div>
        </div>

        <div class="d-flex justify-content-end align-items-center gap-3 mt-5 pt-3 border-top">
            <a href="<?= url('') ?>admin_categories" class="btn px-4 py-3 rounded-pill border" style="font-weight: 600;">Cancel</a>
            <button type="submit" class="btn px-5 py-3 rounded-pill shadow-lg d-flex align-items-center gap-2" style="background: linear-gradient(135deg, #ca9745, #e8c547); color: #1a0f0a; border: none; font-weight: 800; font-size: 1.02rem; animation: adminPulseGlow 2.5s ease infinite; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 28px rgba(202, 151, 69, 0.7)';" onmouseout="this.style.transform='translateY(0)';">
                <i class="bi bi-check-circle-fill fs-5"></i> Update Category Collection
            </button>
        </div>
    </form>
    </div>
</div>
