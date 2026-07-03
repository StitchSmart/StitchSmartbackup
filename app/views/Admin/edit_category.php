



<div class="d-flex justify-content-center align-items-center mt-5">


    <form class="w-75 p-4 border rounded" method="POST" enctype="multipart/form-data" action="<?= BASE_URL ?>/index.php?page=update_category">
    
    <style>
        select.form-control {
            background-color: rgba(243, 226, 205, 0.8) !important;
            color: #000 !important;
        }
        select.form-control option {
            background-color: #f5e4d0 !important;
            color: #000 !important;
        }
        select.form-control option:hover,
        select.form-control option:checked {
            background-color: #e8d3b3 !important;
            color: #000 !important;
        }
    </style>

    <div class="card-header py-3">
        <h3 class="text-center mb-0">Edit Category</h3>
    </div>
    <input type="hidden" name="id" value="<?= $category['c_id'] ?>">
        <input type="hidden" name="old_banner" value="<?= $category['c_img2'] ?>">
        <input type="hidden" name="old_image" value="<?= $category['c_image'] ?>">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">>

        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" name="cat_name" class="form-control" value="<?= htmlspecialchars($category['c_name']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Category Description</label>
            <textarea name="cat_desc" class="form-control"><?= htmlspecialchars($category['c_description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Parent Category</label>
            <select name="parent_id" class="form-control" required>
                <option value="0" <?= ($category['parent_id'] == 0) ? 'selected' : '' ?>>-- None (Top Level) --</option>
                <?php foreach($parents as $parent): ?>
                    <option value="<?= $parent['c_id'] ?>" <?= ($parent['c_id'] == $category['parent_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($parent['c_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>



        <div class="mb-3">
            <label>Category Image</label><br>
            <?php if($category['c_image']): ?>
                <img src="<?= BASE_URL ?>/<?= $category['c_image'] ?>" width="100"><br>
            <?php endif; ?>
            <input type="file" name="cimage" class="form-control">
        </div>
<h4 class="text-center bg-success text-white p-2">
Add Meta Info
</h4>
        <h4>Meta Info</h4>
        <div class="mb-3">
            <label>Meta Title</label>
            <textarea name="meta_title" class="form-control"><?= htmlspecialchars($category['meta_title']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Meta Description</label>
            <textarea name="meta_desc" class="form-control"><?= htmlspecialchars($category['meta_description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Meta Keywords</label>
            <textarea name="meta_keywords" class="form-control"><?= htmlspecialchars($category['meta_keywords']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Category</button>
    </form>
</div>

