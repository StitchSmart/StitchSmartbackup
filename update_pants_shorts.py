import re

def update_file(filename, prefix):
    with open(filename, 'r', encoding='utf-8') as f:
        content = f.read()

    # Increase total steps
    content = content.replace("const totalSteps = 6;", "const totalSteps = 7;")
    
    # HTML blocks to insert
    finishing_html = f"""
        <!-- Step 4: Customize Finishing -->
        <div id="step4" class="step card p-4 shadow">
            <h2 class="text-center mb-4">Step 4: Customize Finishing</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <h5>Sunfade</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sunfadeOption" id="noneSunfade" value="None" checked onchange="updateSunfadeImage()">
                        <label class="form-check-label" for="noneSunfade">None</label>
                    </div>
                    <div id="sunfadeOptions">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sunfadeOption" id="waistSunfade" value="Waist Sunfade" onchange="updateSunfadeImage()">
                            <label class="form-check-label" for="waistSunfade">Waist Sunfade</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sunfadeOption" id="waistBottomSunfade" value="Waist & Bottom Sunfade" onchange="updateSunfadeImage()">
                            <label class="form-check-label" for="waistBottomSunfade">Waist & Bottom Sunfade</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sunfadeOption" id="circular" value="Circular Sunfade" onchange="updateSunfadeImage()">
                            <label class="form-check-label" for="circular">Circular Sunfade</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sunfadeOption" id="allover" value="All-over Sunfade" onchange="updateSunfadeImage()">
                            <label class="form-check-label" for="allover">All-over Sunfade</label>
                        </div>
                    </div>
                    <img id="sunfadeImage" class="dynamic-image mt-3" src="<?= BASE_URL ?>/pictures/design/empty_{'pants' if prefix == 'P' else 'shorts'}.png" alt="Sunfade Preview">
                </div>
                <div class="col-md-4">
                    <h5>Stitching</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="stitchingOption" id="noneStitching" value="None" checked onchange="updateStitchingImage()">
                        <label class="form-check-label" for="noneStitching">None</label>
                    </div>
                    <div id="stitchingOptions">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stitchingOption" id="standardStitching" value="Standard Stitching" onchange="updateStitchingImage()">
                            <label class="form-check-label" for="standardStitching">Standard Stitching</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stitchingOption" id="insideOut" value="Inside-Out Stitching" onchange="updateStitchingImage()">
                            <label class="form-check-label" for="insideOut">Inside-Out Stitching</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stitchingOption" id="rawEdge" value="Raw Edge Stitching" onchange="updateStitchingImage()">
                            <label class="form-check-label" for="rawEdge">Raw Edge Stitching</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stitchingOption" id="flatlock" value="Flatlock Stitching" onchange="updateStitchingImage()">
                            <label class="form-check-label" for="flatlock">Flatlock Stitching</label>
                        </div>
                    </div>
                    <input type="text" class="form-control mt-2" id="stitchingColor" placeholder="Stitching Color (e.g. white, black)">
                    <img id="stitchingImage" class="dynamic-image mt-3" src="<?= BASE_URL ?>/pictures/design/empty_{'pants' if prefix == 'P' else 'shorts'}.png" alt="Stitching Preview">
                </div>
                <div class="col-md-4">
                    <h5>Distressing</h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="distressingOption" id="noneDistressing" value="None" checked onchange="updateDistressingImage()">
                        <label class="form-check-label" for="noneDistressing">None</label>
                    </div>
                    <div id="distressingOptions">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="distressingOption" id="heavy" value="Heavy Distressing" onchange="updateDistressingImage()">
                            <label class="form-check-label" for="heavy">Heavy Distressing</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="distressingOption" id="light" value="Light Distressing" onchange="updateDistressingImage()">
                            <label class="form-check-label" for="light">Light Distressing</label>
                        </div>
                    </div>
                    <img id="distressingImage" class="dynamic-image mt-3" src="<?= BASE_URL ?>/pictures/design/empty_{'pants' if prefix == 'P' else 'shorts'}.png" alt="Distressing Preview">
                </div>
            </div>

            <div class="text-end mt-5">
                <button class="btn btn-secondary me-4 px-5 py-3" onclick="prevStep(4)">Previous</button>
                <button class="btn btn-secondary px-5 py-3" onclick="nextStep(4)">Next →</button>
            </div>
        </div>
"""

    # Shift steps in HTML
    content = content.replace('id="step6"', 'id="step7"')
    content = content.replace('id="step5"', 'id="step6"')
    content = content.replace('id="step4"', 'id="step5"')
    
    content = content.replace('<!-- Step 6:', '<!-- Step 7:')
    content = content.replace('<!-- Step 5:', '<!-- Step 6:')
    content = content.replace('<!-- Step 4:', '<!-- Step 5:')
    
    content = content.replace('Step 6: Contact', 'Step 7: Contact')
    content = content.replace('Step 5: Quantity', 'Step 6: Quantity')
    content = content.replace('Step 4: About', 'Step 5: About')
    
    content = content.replace('prevStep(6)', 'prevStep(7)')
    content = content.replace('nextStep(5)', 'nextStep(6)')
    content = content.replace('prevStep(5)', 'prevStep(6)')
    content = content.replace('nextStep(4)', 'nextStep(5)')
    content = content.replace('prevStep(4)', 'prevStep(5)')

    # Insert Step 4 before Step 5
    content = content.replace('<!-- Step 5: About', finishing_html + '\n        <!-- Step 5: About')
    
    # Step shifting in JS logic
    content = content.replace('} else if (step === 6) {', '} else if (step === 7) {')
    content = content.replace('} else if (step === 5) {', '} else if (step === 6) {')
    
    # JS Updates for collectData
    js_collect_addition = """
            } else if (step === 4) {
                orderData.sunfadeOption = document.querySelector('input[name="sunfadeOption"]:checked')?.value || '';
                orderData.stitchingOption = document.querySelector('input[name="stitchingOption"]:checked')?.value || '';
                const stitchingColorInput = document.getElementById('stitchingColor');
                if (stitchingColorInput) { orderData.stitchingColor = stitchingColorInput.value; }
                orderData.distressingOption = document.querySelector('input[name="distressingOption"]:checked')?.value || '';
"""
    content = content.replace('} else if (step === 6) {', js_collect_addition + '            } else if (step === 6) {', 1) # Only for collectData!
    # Wait, replace the FIRST occurrence which is validateStep? Actually let's use regex
    
    content = re.sub(
        r'(\} else if \(step === 3\) \{[\s\S]*?\} else if \(step === 6\) \{)',
        r'} else if (step === 4) { \n                // validation for step 4 if any\n            \1',
        content, count=1 # First is validateStep
    )
    
    content = re.sub(
        r'(orderData\.establishmentComments.*?;\n\s*)(\} else if \(step === 6\) \{)',
        r'\1' + js_collect_addition.strip() + '\n            \2',
        content
    )

    # Add finishing logic
    js_finishing_logic = f"""
        const sunfadeImages = {{
            'Waist Sunfade': '<?= BASE_URL ?>/pictures/design/Waist Sunfade ({prefix}).png',
            'Waist & Bottom Sunfade': '<?= BASE_URL ?>/pictures/design/Waist & Bottom Sunfade ({prefix}).png',
            'Circular Sunfade': '<?= BASE_URL ?>/pictures/design/Circular Sunfade ({prefix}).png',
            'All-over Sunfade': '<?= BASE_URL ?>/pictures/design/All-over Sunfade ({prefix}).png'
        }};
        const stitchingImages = {{
            'Standard Stitching': '<?= BASE_URL ?>/pictures/design/Standard Stitching ({prefix}).png',
            'Inside-Out Stitching': '<?= BASE_URL ?>/pictures/design/Inside-Out Stitching ({prefix}).png',
            'Raw Edge Stitching': '<?= BASE_URL ?>/pictures/design/Raw Edge Stitching ({prefix}).png',
            'Flatlock Stitching': '<?= BASE_URL ?>/pictures/design/Flatlock Stitching ({prefix}).png'
        }};
        const distressingImages = {{
            'Heavy Distressing': '<?= BASE_URL ?>/pictures/design/Heavy Distressing ({prefix}).png',
            'Light Distressing': '<?= BASE_URL ?>/pictures/design/Light Distressing ({prefix}).png'
        }};

        function updateSunfadeImage() {{ updateImage('sunfade'); }}
        function updateStitchingImage() {{ updateImage('stitching'); }}
        function updateDistressingImage() {{ updateImage('distressing'); }}

        function updateImage(type) {{
            const option = document.querySelector(`input[name="${{type}}Option"]:checked`)?.value;
            let images = {{}};
            if (type === 'sunfade') images = sunfadeImages;
            if (type === 'stitching') images = stitchingImages;
            if (type === 'distressing') images = distressingImages;
            const src = images[option] || '<?= BASE_URL ?>/pictures/design/empty_{'pants' if prefix == 'P' else 'shorts'}.png';
            const img = document.getElementById(`${{type}}Image`);
            if (img) {{
                img.src = src;
                if (img.parentElement.classList.contains('color-wrapper')) {{
                    const colorLayer = img.parentElement.querySelector('.color-layer');
                    if (colorLayer) {{
                        colorLayer.style.maskImage = `url("${{src}}")`;
                        colorLayer.style.webkitMaskImage = `url("${{src}}")`;
                    }}
                }}
            }}
        }}
"""
    content = content.replace('// Initialize', js_finishing_logic + '\n        // Initialize')

    # Update email body
    email_injection = """
Finishing:
- Sunfade: ${orderData.sunfadeOption !== 'None' && orderData.sunfadeOption ? orderData.sunfadeOption : 'No'}
- Stitching: ${orderData.stitchingOption !== 'None' && orderData.stitchingOption ? orderData.stitchingOption + ' (' + (orderData.stitchingColor || 'default') + ')' : 'No'}
- Distressing: ${orderData.distressingOption !== 'None' && orderData.distressingOption ? orderData.distressingOption : 'No'}
"""
    content = content.replace('Prints & Requests: ${orderData.establishmentComments || \'None\'}', 'Prints & Requests: ${orderData.establishmentComments || \'None\'}' + email_injection)

    with open(filename, 'w', encoding='utf-8') as f:
        f.write(content)

update_file('app/views/User/designyourself/sweatpant.php', 'P')
update_file('app/views/User/designyourself/shorts.php', 'S')
print("Successfully updated files.")
