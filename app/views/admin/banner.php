<style>
    .form-control.is-invalid {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.15rem rgba(220, 53, 69, 0.25);
        background: rgba(220, 53, 69, 0.06);
    }
    .form-control.is-invalid::placeholder {
        color: #b02a37 !important;
        opacity: 1 !important;
        font-weight: 600;
    }
    .invalid-feedback-custom {
        color: #c92a2a;
        font-size: 0.95rem;
        margin-top: 0.25rem;
        display: block;
    }
</style>

<div class="container-fluid py-4">
    <div class="card p-4 p-md-5 mx-auto rounded-4 shadow-lg" style="max-width: 820px; background: #ffffff; border: 1px solid rgba(202, 151, 69, 0.35);">

        <!-- Card Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom flex-wrap gap-3">
            <div>
                <h3 class="fw-bolder mb-0" style="color: #1a0f0a; font-size: 1.85rem;">Add New Banner</h3>
            </div>
            <a href="<?= url('') ?>homepage" class="btn px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2" style="background: rgba(202, 151, 69, 0.12); color: #ca9745; border: 1px solid rgba(202, 151, 69, 0.4); font-weight: 700; font-size: 0.9rem; transition: all 0.3s ease; text-decoration: none;" onmouseover="this.style.background='rgba(202, 151, 69, 0.25)'; this.style.color='#1a0f0a';" onmouseout="this.style.background='rgba(202, 151, 69, 0.12)'; this.style.color='#ca9745';">
                <i class="bi bi-arrow-left pe-1"></i> Back to Store Homepage
            </a>
        </div>

        <?php if (!empty($_SESSION['errors']) && is_array($_SESSION['errors'])): ?>
            <div class="alert alert-danger rounded-4 border-0 p-3 shadow-sm mb-4">
                <i class="bi bi-exclamation-triangle-fill pe-2"></i><strong>Please check the highlighted fields below.</strong>
            </div>
        <?php endif; ?>

        <!-- Banner Form -->
        <form action="<?php echo url('') ?>banner_add" method="POST" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
            <input type="hidden" name="addbanner" value="1">

            <div class="mb-4">
                <label for="text" class="form-label fw-bold">Banner Title / Headline <span class="text-danger">*</span></label>
                <input type="text" name="text" id="text" placeholder="e.g. Autumn Tailoring Collection 2026" class="form-control px-3 py-2 <?= isset($_SESSION['errors']['text']) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($_SESSION['old_input']['text'] ?? '') ?>" required>
                <?php if(isset($_SESSION['errors']['text'])): ?>
                    <span class="invalid-feedback-custom"><?= htmlspecialchars($_SESSION['errors']['text']) ?></span>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="alt" class="form-label fw-bold">Subtitle / Promotional Description <span class="text-danger">*</span></label>
                <textarea name="alt" id="alt" class="form-control px-3 py-2 <?= isset($_SESSION['errors']['alt']) ? 'is-invalid' : '' ?>" rows="3" placeholder="Enter the secondary text or call-to-action message" required><?= htmlspecialchars($_SESSION['old_input']['alt'] ?? '') ?></textarea>
                <?php if(isset($_SESSION['errors']['alt'])): ?>
                    <span class="invalid-feedback-custom"><?= htmlspecialchars($_SESSION['errors']['alt']) ?></span>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label for="image" class="form-label fw-bold">Banner Image File <span class="text-danger">*</span> <small class="text-muted fw-normal">(Recommended: 1920x800px landscape)</small></label>
                <input type="file" name="bimage" id="image" class="form-control px-3 py-2 <?= isset($_SESSION['errors']['bimage']) ? 'is-invalid' : '' ?>" required>
                <?php if(isset($_SESSION['errors']['bimage'])): ?>
                    <span class="invalid-feedback-custom"><?= htmlspecialchars($_SESSION['errors']['bimage']) ?></span>
                <?php endif; ?>
            </div>

            <div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top">
                <a href="<?= url('') ?>homepage" class="btn px-4 py-2 rounded-pill border" style="font-weight: 600;">Cancel</a>
                <button type="submit" class="btn px-5 py-2 rounded-pill shadow-sm" style="background: linear-gradient(135deg, #ca9745, #e8c547); color: #1a0f0a; font-weight: 800;">Upload &amp; Publish Banner</button>
            </div>
        </form>

    </div>
</div>
<?php unset($_SESSION['errors'], $_SESSION['old_input']); ?>
