<?php
$sizes = json_decode(file_get_contents(__DIR__ . '/sizes.json'), true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Live 3D Hoodie Customizer</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://unpkg.com/three@0.128.0/build/three.min.js"></script>
  <script src="https://unpkg.com/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
  <script src="https://unpkg.com/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>
</head>
<body>
  <div class="customizer-shell">
    <main class="preview-panel">
      <div class="preview-header">
        <div>
          <h1>Design your hoodie in 3D</h1>
          <p>Use the controls to change colors, fabric, fit, stitching, and add your own logo or text. The preview updates instantly.</p>
        </div>
      </div>
      <div id="preview-frame">
        <div id="hoodie-canvas"></div>
      </div>
      <div class="footer-note">Rotate with drag. Zoom with mouse wheel. Use the control panel for live customization.</div>
    </main>

    <aside class="control-panel">
      <section class="control-group" data-part="hoodie">
        <h2>Hoodie color</h2>
        <div class="swatch-grid">
          <button class="swatch-button active" type="button" data-color="#1a2234"></button>
          <button class="swatch-button" type="button" data-color="#2b80ff"></button>
          <button class="swatch-button" type="button" data-color="#d84f8e"></button>
          <button class="swatch-button" type="button" data-color="#f6b73d"></button>
          <button class="swatch-button" type="button" data-color="#3a8d59"></button>
          <button class="swatch-button" type="button" data-color="#ece7e2"></button>
        </div>
      </section>

      <section class="control-group" data-part="sleeve">
        <h2>Sleeve color</h2>
        <div class="swatch-grid">
          <button class="swatch-button active" type="button" data-color="#1a2234"></button>
          <button class="swatch-button" type="button" data-color="#2b80ff"></button>
          <button class="swatch-button" type="button" data-color="#d84f8e"></button>
          <button class="swatch-button" type="button" data-color="#f6b73d"></button>
          <button class="swatch-button" type="button" data-color="#3a8d59"></button>
          <button class="swatch-button" type="button" data-color="#ece7e2"></button>
        </div>
      </section>

      <section class="control-group" data-part="hood-inner">
        <h2>Hood lining</h2>
        <div class="swatch-grid">
          <button class="swatch-button" type="button" data-color="#1a2234"></button>
          <button class="swatch-button" type="button" data-color="#2b80ff"></button>
          <button class="swatch-button" type="button" data-color="#d84f8e"></button>
          <button class="swatch-button" type="button" data-color="#f6b73d"></button>
          <button class="swatch-button" type="button" data-color="#3a8d59"></button>
          <button class="swatch-button active" type="button" data-color="#ece7e2"></button>
        </div>
      </section>

      <section class="control-group">
        <h2>Fit & size</h2>
        <div class="option-buttons" id="size-options"></div>
        <div class="option-buttons" style="margin-top: 12px;">
          <button class="option-button active" type="button" data-fit="Regular">Regular</button>
          <button class="option-button" type="button" data-fit="Slim">Slim</button>
          <button class="option-button" type="button" data-fit="Oversized">Oversized</button>
        </div>
      </section>

      <section class="control-group">
        <h2>Stitching style</h2>
        <div class="option-buttons">
          <button class="option-button active" type="button" data-stitch="Outside">Outside</button>
          <button class="option-button" type="button" data-stitch="Inside">Inside</button>
          <button class="option-button" type="button" data-stitch="Flat">Flat</button>
          <button class="option-button" type="button" data-stitch="Overlock">Overlock</button>
        </div>
      </section>

      <section class="control-group">
        <h2>Fabric choice</h2>
        <div class="fabric-grid">
          <label class="fabric-option">
            <input type="radio" name="fabric" value="Fleece">
            <div class="fabric-chip">
              <strong>Fleece</strong>
              Soft, matte texture with subtle depth.
            </div>
          </label>
          <label class="fabric-option">
            <input type="radio" name="fabric" value="Cotton" checked>
            <div class="fabric-chip">
              <strong>Cotton</strong>
              Classic breathable feel with natural matte finish.
            </div>
          </label>
          <label class="fabric-option">
            <input type="radio" name="fabric" value="Polyester">
            <div class="fabric-chip">
              <strong>Polyester</strong>
              Smooth sheen, lightweight and premium.
            </div>
          </label>
        </div>
      </section>

      <section class="control-group logo-upload-box">
        <h2>Logo & Text</h2>
        <label for="logo-upload-file">Upload artwork</label>
        <input type="file" id="logo-upload-file" accept="image/png,image/jpeg">
        <div class="logo-controls">
          <div class="range-field">
            <label for="logo-scale">Logo scale</label>
            <input type="range" id="logo-scale" min="0.12" max="0.48" step="0.02" value="0.26">
          </div>
          <div class="range-field">
            <label for="logo-x">Horizontal position</label>
            <input type="range" id="logo-x" min="-0.35" max="0.35" step="0.01" value="0">
          </div>
          <div class="range-field">
            <label for="logo-y">Vertical position</label>
            <input type="range" id="logo-y" min="-0.25" max="0.25" step="0.01" value="0">
          </div>
          <div id="logo-positioner"><div id="logo-handle"></div></div>
          <label for="custom-text">Custom text</label>
          <textarea id="custom-text" rows="3" placeholder="Type your slogan or initials"></textarea>
          <div class="range-field">
            <label for="text-color">Text color</label>
            <input type="color" id="text-color" value="#ffffff">
          </div>
          <button type="button" id="save-logo-server">Save logo to server</button>
          <p class="status-text" id="upload-status"></p>
        </div>
      </section>

      <section class="control-group summary-card">
        <h3>Current configuration</h3>
        <ul class="summary-list" id="summary-list"></ul>
        <button type="button" id="download-button">Download preview</button>
      </section>
    </aside>
  </div>

  <script>
    const SIZES = <?= json_encode($sizes, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
  </script>
  <script src="customizer.js"></script>
</body>
</html>
