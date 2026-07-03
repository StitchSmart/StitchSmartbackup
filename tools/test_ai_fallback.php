<!DOCTYPE html>
<html>
<head>
    <title>Test AI Fallback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
<div class="container">
    <h2>🧪 AI Fallback Test</h2>
    <button class="btn btn-success mb-3" onclick="testFallback()">Test Fallback with Quota Error</button>
    <div id="ai-error-container"></div>
    <div class="mt-4 p-3 border">
        <h5>Form Fields (will be filled by fallback):</h5>
        <div class="mb-2">
            <label>Product Name:</label>
            <input type="text" id="pname" class="form-control" />
        </div>
        <div class="mb-2">
            <label>Description:</label>
            <textarea id="pdesc" class="form-control"></textarea>
        </div>
        <div class="mb-2">
            <label>Details:</label>
            <input type="text" name="details" class="form-control" />
        </div>
        <div class="mb-2">
            <label>Price:</label>
            <input type="text" name="price" class="form-control" />
        </div>
        <div class="mb-2">
            <label>Meta Title:</label>
            <input type="text" id="meta_title" class="form-control" />
        </div>
        <div class="mb-2">
            <label>Meta Description:</label>
            <input type="text" id="meta_desc" class="form-control" />
        </div>
        <div class="mb-2">
            <label>Meta Keywords:</label>
            <input type="text" id="meta_keywords" class="form-control" />
        </div>
    </div>
</div>

<script>
// Fallback function - generates suggested values when API quota exceeded
function useFallbackData() {
    const suggestions = {
        titles: ["Premium Product", "Quality Item", "Trendy Design", "Classic Style", "Premium Collection"],
        descriptions: ["High-quality product with excellent finish", "Carefully selected for premium quality", "Durable and stylish design", "Perfect for everyday use", "Excellent value for money"],
        details: ["Premium quality material", "Durable and long-lasting", "Comfortable and practical", "Modern design and finish", "Professional quality"],
        prices: [1500, 2000, 2500, 3000, 4000, 5000],
        seo_titles: ["Quality Product - Premium Selection", "Best Value Product", "Top Rated Item"],
        seo_descriptions: ["Shop quality products with excellent designs", "Find the best products at competitive prices", "Premium selection of quality items"],
        seo_keywords: ["quality, design, trending, fashion, premium"]
    };

    // Generate random suggestions
    const title = suggestions.titles[Math.floor(Math.random() * suggestions.titles.length)];
    const description = suggestions.descriptions[Math.floor(Math.random() * suggestions.descriptions.length)];
    const details = suggestions.details[Math.floor(Math.random() * suggestions.details.length)];
    const price = suggestions.prices[Math.floor(Math.random() * suggestions.prices.length)];
    const seo_title = suggestions.seo_titles[Math.floor(Math.random() * suggestions.seo_titles.length)];
    const seo_description = suggestions.seo_descriptions[Math.floor(Math.random() * suggestions.seo_descriptions.length)];

    // Fill form fields
    document.getElementById("pname").value = title;
    document.getElementById("pdesc").value = description;
    document.querySelector('[name="details"]').value = details;
    document.querySelector('[name="price"]').value = price;
    document.getElementById("meta_title").value = seo_title;
    document.getElementById("meta_desc").value = seo_description;
    document.getElementById("meta_keywords").value = suggestions.seo_keywords;
}

// Show warning message
function showWarning(message) {
    const container = document.getElementById("ai-error-container");
    if (container) {
        container.innerHTML = `
            <div class="alert alert-warning alert-dismissible fade show mt-3 border-0 rounded-3 p-3 shadow" role="alert" style="background: rgba(255, 193, 7, 0.15); border: 1px solid rgba(255, 193, 7, 0.3) !important; color: #ffc107;">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                <strong>Note:</strong> ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
    }
}

function testFallback() {
    useFallbackData();
    showWarning("API quota temporarily exceeded. Using suggested values - please review and edit as needed.");
    alert("✓ Fallback test complete! Check the form fields above.");
}
</script>
</body>
</html>
