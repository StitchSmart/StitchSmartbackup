<?php
require_once BASE_PATH.'/app/models/pages.php';
require_once BASE_PATH.'/config/database.php';
require_once BASE_PATH.'/app/models/settings.php';
require_once BASE_PATH.'/app/models/Product.php';
require_once BASE_PATH.'/app/models/ad_category.php';
class PageController {

    private $pageModel;
  private $productModel;
    private $categoryModel;
   public function __construct(){
    $database = new Database();
    $db = $database->connect(); // returns mysqli connection

    $this->pageModel = new Page($db); // inject mysqli connection
     $this->productModel = new Product($db);
        $this->categoryModel = new Category($db);
}

    // Show all pages
    public function index() {
        $pages = $this->pageModel->getAllPages(); // use 'all()' from model
         $data = [
        'title' => 'Pages',
        'theme' => $_SESSION['theme'] ?? 'theme-default',
        'view' => 'admin/pages.php',
        'pages' => $pages
    ];

    extract($data);

    require BASE_PATH.'/app/views/admin/layout.php';
    }

    // Show add page form
    public function add() {
         $data = [
        'title' => 'Add Page',
        'theme' => $_SESSION['theme'] ?? 'theme-default',
        'view' => 'admin/add_page.php'
    ];

    extract($data);

    require BASE_PATH.'/app/views/admin/layout.php';
    }

    // Handle add page form
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $title = htmlspecialchars(trim($_POST['title']));
            $content = trim($_POST['content']);
            $meta_title = trim($_POST['meta_title'] ?? '');
            $meta_desc = trim($_POST['meta_desc'] ?? '');
            $meta_keywords = trim($_POST['meta_keywords'] ?? '');
            
            if (empty($title)) {
                $errors['title'] = "Fill the Title field.";
            }
            if (empty(strip_tags($content))) {
                $errors['content'] = "Fill the Content field.";
            }
            if (empty($meta_title)) {
                $errors['meta_title'] = "Fill the Meta Title field.";
            }
            if (empty($meta_desc)) {
                $errors['meta_desc'] = "Fill the Meta Description field.";
            }
            if (empty($meta_keywords)) {
                $errors['meta_keywords'] = "Fill the Meta Keywords field.";
            }
            
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old_input'] = [
                    'title' => $_POST['title'] ?? '',
                    'content' => $_POST['content'] ?? '',
                    'meta_title' => $_POST['meta_title'] ?? '',
                    'meta_desc' => $_POST['meta_desc'] ?? '',
                    'meta_keywords' => $_POST['meta_keywords'] ?? ''
                ];
                header("Location: ".url("") . "add_page");
                exit;
            }

            $data = [
                'title' => $title,
                'content' => $content,
                'meta_title' => $meta_title,
                'meta_description' => $meta_desc,
                'meta_keywords' => $meta_keywords
            ];

            $this->pageModel->createPage($data);

            header("Location: ".url("") . "pages");
            exit;
        }
    }

    // Show edit form
    public function edit($id) {
        $page = $this->pageModel->getPageById($id);; // use 'find()' from model
        if (!$page) die("Page not found");

         $data = [
        'title' => 'Edit Page',
        'theme' => $_SESSION['theme'] ?? 'theme-default',
        'view' => 'admin/edit_page.php',
        'page' => $page
    ];

    extract($data);

    require BASE_PATH.'/app/views/admin/layout.php';
    }

    // Handle edit form submission
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             $data = [
            'id' => $id, // OR $_POST['id']
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'meta_title' => $_POST['meta_title'],
            'meta_description' => $_POST['meta_desc'], // IMPORTANT mapping
            'meta_keywords' => $_POST['meta_keywords']
        ];

 $this->pageModel->updatePage($data);
            header("Location: ".url("") . "pages");
            exit;
        }
    }
public function show($slug){
    $normalizedSlug = str_replace('_', '-', $slug);
    $page = $this->pageModel->getPageBySlug($normalizedSlug);
    if (!$page) {
        $page = $this->pageModel->getPageBySlug($slug);
    }
    $slug = $normalizedSlug;

    if (!$page) {
        if ($slug === 'our-story' || $slug === 'ourstory') {
            $page = [
                'title' => 'Our Story',
                'content' => '<section class="container my-5"><h1>Our Story</h1><p>Stitch Smart brings quality craftsmanship, thoughtful design, and reliable delivery together for every customer.</p></section>',
                'meta_title' => 'Our Story | Stitch Smart',
                'meta_description' => 'Learn about the Stitch Smart story, values, and passion for custom apparel.',
                'meta_keywords' => 'our story, Stitch Smart story, custom apparel, craftsmanship'
            ];
        } elseif ($slug === 'about-us') {
            $page = [
                'title' => 'About Us',
                'content' => '<section class="container my-5"><h1>About Us</h1><p>Discover our mission to merge advanced technology with artisanal clothing craft, empowering you to design unique premium streetwear.</p></section>',
                'meta_title' => 'About Stitch-Smart | Premium Personalized Streetwear',
                'meta_description' => 'Discover our mission to merge advanced technology with artisanal clothing craft.',
                'meta_keywords' => 'custom hoodies, design crewneck, customized clothing, streetwear brand'
            ];
        } elseif ($slug === 'how-to-order') {
            $page = [
                'title' => 'How to Order',
                'content' => '<section class="container my-5"><h1>How to Order</h1><p>Experiencing premium tailoring has never been easier. 1. Select your style, 2. Provide measurements, 3. Secure checkout, 4. Crafting & Delivery.</p></section>',
                'meta_title' => 'How to Order | Stitch Smart Clothing',
                'meta_description' => 'Learn how to easily place an order at Stitch Smart Clothing.',
                'meta_keywords' => 'how to order online, shopping guide, place order clothing'
            ];
        } elseif ($slug === 'shipping-and-delivery') {
            $page = [
                'title' => 'Shipping and Delivery',
                'content' => '<section class="container my-5"><h1>Shipping and Delivery</h1><p>Fast, reliable, and premium delivery services to ensure your tailored garments arrive in perfect condition, exactly when you expect them.</p></section>',
                'meta_title' => 'Shipping & Delivery Policy | Stitch Smart Clothing',
                'meta_description' => 'Explore Stitch Smart Clothing shipping and delivery policy.',
                'meta_keywords' => 'shipping policy, delivery information, order shipping'
            ];
        } elseif ($slug === 'payment-and-financing') {
            $page = [
                'title' => 'Payment & Financing',
                'content' => '<section class="container my-5"><h1>Payment & Financing</h1><p>Experience seamless, secure, and flexible payment options tailored for your convenience. Shop our premium collections with complete peace of mind.</p></section>',
                'meta_title' => 'Payment & Financing | Stitch-Smart Secure Payments',
                'meta_description' => 'Explore safe payment options including Credit/Debit card checkout.',
                'meta_keywords' => 'easypaisa payment, secure clothing check, interest free installments'
            ];
        } elseif ($slug === 'product-advice') {
            $page = [
                'title' => 'Product Advice',
                'content' => '<section class="container my-5"><h1>Expert Product Advice</h1><p>Make informed choices with our comprehensive guides. From finding the perfect fit to caring for premium fabrics, we are here to help you elevate your wardrobe.</p></section>',
                'meta_title' => 'Product Advice & Sizing Guide | Stitch-Smart Clothing care',
                'meta_description' => 'Expert advice on custom fits, fabric qualities, and maintenance tips.',
                'meta_keywords' => 'clothing size guide, oversize hoodie wash, cotton fabric care'
            ];
        } elseif ($slug === 'terms-and-condition') {
            $page = [
                'title' => 'Terms & Conditions',
                'content' => '<section class="container my-5"><h1>Terms & Conditions</h1><p>Welcome to Stitch Smart. By accessing our platform and placing an order, you agree to comply with our standard terms and conditions of service.</p></section>',
                'meta_title' => 'Terms & Conditions | Stitch Smart',
                'meta_description' => 'Read our standard terms and conditions.',
                'meta_keywords' => 'terms and conditions, legal, service terms'
            ];
        }
    }

    $settingsModel = new Settings();  
        $webSettings = $settingsModel->getWebSettings();

        $webname = $webSettings['web_name'] ?? '';
        $webmail = $webSettings['web_mail'] ?? '';
        $webcontact = $webSettings['web_contact'] ?? '';
        $facebook = $webSettings['facebook'] ?? '';
        $instagram = $webSettings['instagram'] ?? '';
        $pinterest = $webSettings['pinterest'] ?? '';
        $linkdin = $webSettings['linkdin'] ?? '';
        $meta_title = $webSettings['meta_title'] ?? '';
        $meta_description = $webSettings['meta_description'] ?? '';
        $meta_keywords = $webSettings['meta_keywords'] ?? '';
        $global_theme = $webSettings['theme'] ?? 'theme-default';
        // fetch data for homepage
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getMainCategories();

 
      

    if(!$page){
        require BASE_PATH.'/app/views/User/404.php';
        exit;
    }

    // 👇 ADD THIS
    $pages = $this->pageModel->getAllPages();

    require BASE_PATH.'/app/views/User/page.php';
}
    // Delete page
    public function delete($id) {
        $this->pageModel->deletePage($id); // use 'delete()' from model

        header("Location: ".url("") . "pages");
        exit;
    }
}
