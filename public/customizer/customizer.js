document.addEventListener('DOMContentLoaded', () => {
  const defaults = {
    hoodieColor: '#1a2234',
    sleeveColor: '#1a2234',
    hoodInnerColor: '#ece7e2',
    size: 'M',
    stitching: 'Outside',
    fabric: 'Cotton',
    fit: 'Regular',
    logo: {
      image: null,
      scale: 0.26,
      offsetX: 0,
      offsetY: 0
    },
    text: {
      value: '',
      color: '#ffffff'
    }
  };

  const state = { ...defaults };
  let scene, camera, renderer, controls, hoodieGroup;
  let bodyMaterial, sleeveMaterial, hoodMaterial, chestMaterial;
  let logoCanvas, logoContext;
  let stitchLines;
  let logoDrag = false;
  const fabricStyles = {
    Fleece: { roughness: 0.45, metalness: 0.02, emissive: 0x111111 },
    Cotton: { roughness: 0.7, metalness: 0.05, emissive: 0x0 },
    Polyester: { roughness: 0.32, metalness: 0.18, emissive: 0x050b0f }
  };
  const stitchStyles = {
    Outside: { color: 0x2b80ff, dash: [2, 2] },
    Inside: { color: 0x1f2937, dash: [1, 4] },
    Flat: { color: 0x7c8fa4, dash: [4, 2] },
    Overlock: { color: 0xec4899, dash: [6, 3] }
  };

  const canvasWrapper = document.getElementById('hoodie-canvas');
  const logoInput = document.getElementById('logo-upload-file');
  const logoHandle = document.getElementById('logo-handle');
  const logoPositioner = document.getElementById('logo-positioner');
  const sizeOptions = document.getElementById('size-options');
  const summaryList = document.getElementById('summary-list');
  const downloadButton = document.getElementById('download-button');
  const saveServerButton = document.getElementById('save-logo-server');
  const statusText = document.getElementById('upload-status');
  const logoWidthInput = document.getElementById('logo-scale');
  const logoXInput = document.getElementById('logo-x');
  const logoYInput = document.getElementById('logo-y');
  const textInput = document.getElementById('custom-text');
  const textColorInput = document.getElementById('text-color');
  const fabricRadios = document.querySelectorAll('input[name="fabric"]');
  const fitButtons = document.querySelectorAll('[data-fit]');
  const stitchButtons = document.querySelectorAll('[data-stitch]');
  const colorButtons = document.querySelectorAll('[data-part] .swatch-button');

  initOptions();
  initScene();
  applyState();

  function initOptions() {
    if (Array.isArray(window.SIZES)) {
      window.SIZES.forEach(item => {
        const option = document.createElement('button');
        option.type = 'button';
        option.className = 'option-button';
        option.textContent = item.label;
        option.dataset.size = item.label;
        option.title = item.measurements + ' — ' + item.description;
        if (item.label === state.size) option.classList.add('active');
        option.addEventListener('click', () => {
          state.size = item.label;
          document.querySelectorAll('[data-size]').forEach(btn => btn.classList.toggle('active', btn.dataset.size === item.label));
          applyState();
        });
        sizeOptions.appendChild(option);
      });
    }

    colorButtons.forEach(button => {
      button.addEventListener('click', () => {
        const part = button.closest('[data-part]').dataset.part;
        const color = button.dataset.color;
        button.parentElement.querySelectorAll('.swatch-button').forEach(btn => btn.classList.toggle('active', btn === button));
        if (part === 'hoodie') state.hoodieColor = color;
        if (part === 'sleeve') state.sleeveColor = color;
        if (part === 'hood-inner') state.hoodInnerColor = color;
        applyState();
      });
    });

    stitchButtons.forEach(button => {
      button.addEventListener('click', () => {
        state.stitching = button.dataset.stitch;
        stitchButtons.forEach(btn => btn.classList.toggle('active', btn === button));
        applyState();
      });
    });

    fabricRadios.forEach(radio => {
      radio.addEventListener('change', () => {
        if (!radio.checked) return;
        state.fabric = radio.value;
        applyState();
      });
    });

    fitButtons.forEach(button => {
      button.addEventListener('click', () => {
        state.fit = button.dataset.fit;
        fitButtons.forEach(btn => btn.classList.toggle('active', btn === button));
        applyState();
      });
    });

    logoInput.addEventListener('change', handleLogoFile);
    logoWidthInput.addEventListener('input', event => {
      state.logo.scale = parseFloat(event.target.value);
      applyState();
    });
    logoXInput.addEventListener('input', event => {
      state.logo.offsetX = parseFloat(event.target.value);
      updateLogoHandle();
      applyState();
    });
    logoYInput.addEventListener('input', event => {
      state.logo.offsetY = parseFloat(event.target.value);
      updateLogoHandle();
      applyState();
    });
    textInput.addEventListener('input', () => {
      state.text.value = textInput.value;
      applyState();
    });
    textColorInput.addEventListener('input', () => {
      state.text.color = textColorInput.value;
      applyState();
    });
    saveServerButton.addEventListener('click', uploadToServer);
    downloadButton.addEventListener('click', downloadPreview);

    logoHandle.addEventListener('pointerdown', event => {
      logoDrag = true;
      logoHandle.setPointerCapture(event.pointerId);
    });
    document.addEventListener('pointermove', event => {
      if (!logoDrag) return;
      const rect = logoPositioner.getBoundingClientRect();
      let x = (event.clientX - rect.left) / rect.width;
      let y = (event.clientY - rect.top) / rect.height;
      x = Math.min(1, Math.max(0, x));
      y = Math.min(1, Math.max(0, y));
      state.logo.offsetX = (x - 0.5) * 0.7;
      state.logo.offsetY = (0.5 - y) * 0.4;
      logoXInput.value = state.logo.offsetX.toFixed(2);
      logoYInput.value = state.logo.offsetY.toFixed(2);
      updateLogoHandle();
      applyState();
    });
    document.addEventListener('pointerup', () => {
      logoDrag = false;
    });
  }

  function initScene() {
    scene = new THREE.Scene();
    scene.background = new THREE.Color(0xf5f7fb);
    const width = canvasWrapper.clientWidth;
    const height = canvasWrapper.clientHeight;

    camera = new THREE.PerspectiveCamera(42, width / height, 0.1, 100);
    camera.position.set(0, 1.4, 2.6);

    renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(width, height);
    renderer.outputEncoding = THREE.sRGBEncoding;
    canvasWrapper.appendChild(renderer.domElement);

    controls = new THREE.OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.08;
    controls.minDistance = 1.6;
    controls.maxDistance = 4.2;
    controls.maxPolarAngle = Math.PI * 0.9;

    const ambient = new THREE.HemisphereLight(0xeaf2ff, 0x606880, 0.8);
    scene.add(ambient);
    const rimLight = new THREE.DirectionalLight(0xffffff, 0.65);
    rimLight.position.set(-1, 3, 2);
    scene.add(rimLight);
    const fillLight = new THREE.DirectionalLight(0xe8f1ff, 0.45);
    fillLight.position.set(2.2, 2.5, -1.2);
    scene.add(fillLight);

    const grid = new THREE.GridHelper(4.5, 10, 0xdde2eb, 0xdde2eb);
    grid.position.y = 0;
    scene.add(grid);

    logoCanvas = document.createElement('canvas');
    logoCanvas.width = 1024;
    logoCanvas.height = 1024;
    logoContext = logoCanvas.getContext('2d');

    loadHoodieModel();
    window.addEventListener('resize', resizeScene);
    animate();
  }

  function loadHoodieModel() {
    const loader = new THREE.GLTFLoader();
    loader.load('../assets/models/hoodie.glb', gltf => {
      hoodieGroup = gltf.scene;
      updateMaterials();
      hoodieGroup.scale.set(1.2, 1.2, 1.2);
      hoodieGroup.position.set(0, -0.3, 0);
      scene.add(hoodieGroup);
      applyState();
    }, undefined, () => {
      createFallbackHoodie();
      applyState();
    });
  }

  function createFallbackHoodie() {
    hoodieGroup = new THREE.Group();
    bodyMaterial = createMaterial();
    sleeveMaterial = createMaterial();
    hoodMaterial = createMaterial();
    chestMaterial = createMaterial({ roughness: 0.18, metalness: 0.05, emissive: new THREE.Color(0x111111) });

    const body = new THREE.Mesh(new THREE.BoxGeometry(1.2, 1, 0.55, 32, 24, 8), bodyMaterial);
    body.position.set(0, 0.75, 0);
    body.rotation.x = 0.03;
    hoodieGroup.add(body);

    const sleeveLeft = new THREE.Mesh(new THREE.CylinderGeometry(0.18, 0.25, 1.1, 24), sleeveMaterial);
    sleeveLeft.rotation.z = Math.PI / 2.1;
    sleeveLeft.position.set(-0.86, 0.75, 0);
    hoodieGroup.add(sleeveLeft);

    const sleeveRight = sleeveLeft.clone();
    sleeveRight.position.set(0.86, 0.75, 0);
    hoodieGroup.add(sleeveRight);

    const hood = new THREE.Mesh(new THREE.TorusGeometry(0.48, 0.2, 24, 48, Math.PI), hoodMaterial);
    hood.rotation.x = Math.PI / 2;
    hood.position.set(0, 1.4, 0.05);
    hoodieGroup.add(hood);

    const frontPocket = new THREE.Mesh(new THREE.BoxGeometry(0.75, 0.32, 0.12), bodyMaterial);
    frontPocket.position.set(0, 0.5, 0.32);
    hoodieGroup.add(frontPocket);

    const chest = new THREE.Mesh(new THREE.PlaneGeometry(0.38, 0.28), chestMaterial);
    chest.position.set(0, 0.95, 0.29);
    hoodieGroup.add(chest);

    const seamLines = new THREE.Group();
    seamLines.name = 'stitch-lines';
    hoodieGroup.add(seamLines);

    hoodieGroup.position.set(0, -0.3, 0);
    scene.add(hoodieGroup);
  }

  function createMaterial(overrides = {}) {
    const fabric = fabricStyles[state.fabric] || fabricStyles.Cotton;
    return new THREE.MeshStandardMaterial(Object.assign({
      color: new THREE.Color(state.hoodieColor),
      roughness: fabric.roughness,
      metalness: fabric.metalness,
      emissive: new THREE.Color(fabric.emissive),
      side: THREE.DoubleSide
    }, overrides));
  }

  function updateMaterials() {
    if (!hoodieGroup) return;
    bodyMaterial = createMaterial({ color: new THREE.Color(state.hoodieColor) });
    sleeveMaterial = createMaterial({ color: new THREE.Color(state.sleeveColor) });
    hoodMaterial = createMaterial({ color: new THREE.Color(state.hoodInnerColor) });
    chestMaterial = createMaterial({ roughness: 0.18, metalness: 0.05, emissive: new THREE.Color(0x111111) });
    hoodieGroup.traverse(node => {
      if (!node.isMesh) return;
      const name = node.name.toLowerCase();
      if (name.includes('sleeve')) {
        node.material = sleeveMaterial;
      } else if (name.includes('hood') && !name.includes('inner')) {
        node.material = bodyMaterial;
      } else if (name.includes('hood') || name.includes('hoodie')) {
        node.material = hoodMaterial;
      } else if (name.includes('logo') || name.includes('text') || node.geometry.type === 'PlaneGeometry') {
        node.material = chestMaterial;
      } else {
        node.material = bodyMaterial;
      }
    });
  }

  function applyState() {
    updateLogoHandle();
    updateMaterials();
    updateChestTexture();
    updateStitching();
    updateSummary();
  }

  function updateChestTexture() {
    if (!chestMaterial) return;
    logoContext.clearRect(0, 0, logoCanvas.width, logoCanvas.height);
    logoContext.fillStyle = 'rgba(255,255,255,0)';
    logoContext.fillRect(0, 0, logoCanvas.width, logoCanvas.height);

    if (state.logo.image) {
      const maxWidth = logoCanvas.width * state.logo.scale;
      const aspect = state.logo.image.width / state.logo.image.height;
      const drawWidth = maxWidth;
      const drawHeight = maxWidth / aspect;
      const x = (logoCanvas.width - drawWidth) / 2 + state.logo.offsetX * logoCanvas.width * 0.18;
      const y = (logoCanvas.height - drawHeight) / 2 - state.logo.offsetY * logoCanvas.height * 0.18;
      logoContext.drawImage(state.logo.image, x, y, drawWidth, drawHeight);
    }

    if (state.text.value.trim()) {
      logoContext.font = 'bold 96px Inter, sans-serif';
      logoContext.textAlign = 'center';
      logoContext.textBaseline = 'middle';
      logoContext.fillStyle = state.text.color;
      const lines = state.text.value.split('\n');
      const totalHeight = lines.length * 96 + (lines.length - 1) * 14;
      let y = logoCanvas.height / 2 - totalHeight / 2;
      lines.forEach(line => {
        logoContext.fillText(line, logoCanvas.width / 2, y + 52);
        y += 110;
      });
    }

    const texture = new THREE.CanvasTexture(logoCanvas);
    texture.flipY = false;
    texture.encoding = THREE.sRGBEncoding;
    texture.anisotropy = renderer.capabilities.getMaxAnisotropy();
    chestMaterial.map = texture;
    chestMaterial.needsUpdate = true;
  }

  function updateStitching() {
    if (!hoodieGroup) return;
    const existing = hoodieGroup.getObjectByName('stitch-lines');
    if (existing) {
      hoodieGroup.remove(existing);
    }
    const lines = new THREE.Group();
    lines.name = 'stitch-lines';
    hoodieGroup.traverse(node => {
      if (!node.isMesh) return;
      const edges = new THREE.EdgesGeometry(node.geometry, 15);
      const material = new THREE.LineDashedMaterial({
        color: stitchStyles[state.stitching].color,
        dashSize: stitchStyles[state.stitching].dash[0],
        gapSize: stitchStyles[state.stitching].dash[1],
        scale: 1.5,
        linewidth: 1
      });
      const edgeMesh = new THREE.LineSegments(edges, material);
      edgeMesh.computeLineDistances();
      edgeMesh.position.copy(node.position);
      edgeMesh.rotation.copy(node.rotation);
      lines.add(edgeMesh);
    });
    hoodieGroup.add(lines);
  }

  function updateSummary() {
    summaryList.innerHTML = '';
    appendSummaryItem('Hoodie color', state.hoodieColor.toUpperCase());
    appendSummaryItem('Sleeve color', state.sleeveColor.toUpperCase());
    appendSummaryItem('Hood lining', state.hoodInnerColor.toUpperCase());
    appendSummaryItem('Size', state.size);
    appendSummaryItem('Fit', state.fit);
    appendSummaryItem('Fabric', state.fabric);
    appendSummaryItem('Stitching', state.stitching);
    appendSummaryItem('Logo', state.logo.image ? 'Custom artwork' : 'None');
    appendSummaryItem('Custom text', state.text.value.trim() || 'None');
  }

  function appendSummaryItem(label, value) {
    const li = document.createElement('li');
    li.innerHTML = `<span>${label}</span><strong>${value}</strong>`;
    summaryList.appendChild(li);
  }

  function updateLogoHandle() {
    const x = 50 + state.logo.offsetX * 72;
    const y = 50 - state.logo.offsetY * 55;
    logoHandle.style.left = `${x}%`;
    logoHandle.style.top = `${y}%`;
    logoWidthInput.value = state.logo.scale.toFixed(2);
    logoXInput.value = state.logo.offsetX.toFixed(2);
    logoYInput.value = state.logo.offsetY.toFixed(2);
  }

  function handleLogoFile(event) {
    const file = event.target.files[0];
    if (!file) return;
    if (!file.type.match('image.*')) {
      alert('Upload a PNG or JPG file only.');
      return;
    }
    const reader = new FileReader();
    reader.onload = () => {
      const img = new Image();
      img.onload = () => {
        state.logo.image = img;
        state.logo.scale = 0.26;
        state.logo.offsetX = 0;
        state.logo.offsetY = 0;
        updateLogoHandle();
        applyState();
      };
      img.src = reader.result;
    };
    reader.readAsDataURL(file);
  }

  function uploadToServer() {
    const file = logoInput.files[0];
    if (!file) {
      statusText.textContent = 'Choose an image first.';
      return;
    }
    const formData = new FormData();
    formData.append('logoFile', file);
    saveServerButton.disabled = true;
    statusText.textContent = 'Uploading...';
    fetch('upload.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.json())
      .then(data => {
        saveServerButton.disabled = false;
        if (data.success) {
          statusText.textContent = 'Logo saved to server successfully.';
        } else {
          statusText.textContent = data.error || 'Upload failed.';
        }
      })
      .catch(() => {
        saveServerButton.disabled = false;
        statusText.textContent = 'Upload failed. Try again.';
      });
  }

  function downloadPreview() {
    if (!renderer) return;
    const dataUrl = renderer.domElement.toDataURL('image/png');
    const link = document.createElement('a');
    link.href = dataUrl;
    link.download = `hoodie-customizer-${state.size}.png`;
    link.click();
  }

  function resizeScene() {
    const width = canvasWrapper.clientWidth;
    const height = canvasWrapper.clientHeight;
    renderer.setSize(width, height);
    camera.aspect = width / height;
    camera.updateProjectionMatrix();
  }

  function animate() {
    requestAnimationFrame(animate);
    if (controls) controls.update();
    renderer.render(scene, camera);
  }
});
