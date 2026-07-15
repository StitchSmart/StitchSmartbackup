<?php

require_once BASE_PATH.'/config/database.php';
require_once BASE_PATH.'/app/models/settings.php';
require_once BASE_PATH.'/app/models/Product.php';
require_once BASE_PATH.'/app/models/ad_category.php';
require_once BASE_PATH.'/app/models/SchemaBootstrap.php';

class HomeController {

    private $productModel;
    private $categoryModel;

    public function __construct(){
        $database = new Database();
        $db = $database->connect();

        $this->productModel = new Product($db);
        $this->categoryModel = new Category($db);
    }

    private function sanitizeCategoryTree(array $categories): array {
        // Fields that should stay numeric (not HTML-escaped)
        $numericFields = ['c_id', 'parent_id', 'min_price', 'product_count'];
        $sanitized = [];
        foreach ($categories as $category) {
            if (!is_array($category)) {
                continue;
            }

            $clean = [];
            foreach ($category as $key => $value) {
                if (is_array($value)) {
                    $clean[$key] = $this->sanitizeCategoryTree($value);
                } elseif (in_array($key, $numericFields, true)) {
                    // Preserve numeric fields as-is (float/int)
                    $clean[$key] = is_numeric($value) ? (float)$value : $value;
                } elseif (is_scalar($value)) {
                    $clean[$key] = htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
                }
            }

            $sanitized[] = $clean;
        }

        return $sanitized;
    }

    
    public function index(){
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
        $products = $this->productModel->getSaleProductsPaginated(4, 0);
        $featuredProducts = $this->productModel->getFeaturedProducts(4, 0);
        $categories = $this->sanitizeCategoryTree($this->categoryModel->getCategoriesTree());

        $wishlistedProductIds = [];
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $customerId = $_SESSION['customer_id'] ?? null;
        if ($customerId) {
            $wishlistBootstrap = new SchemaBootstrap((new Database())->connect(), false);
            $wishlistedProductIds = $wishlistBootstrap->getWishlistProductIdsForUser((int)$customerId);
        }

 $bannerModel = new Banner();
        $banners = $bannerModel->getAllBanners();
      

        require BASE_PATH.'/app/views/User/home.php';
    }
    public function allproducts(){

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

    // Pagination logic
    $limit = 8;
    $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
    $page = max($page, 1);
    $offset = ($page - 1) * $limit;

   
   $totalProducts = $this->productModel->getAllProductsCount();
   $totalPages = ceil($totalProducts / $limit);

    $products = $this->productModel->getAllProductsPaginated($limit, $offset);
    $allProducts = $this->productModel->getAllProductsForAI(); // Fetch all products with categories for client-side slider & category filters
    $categories = $this->sanitizeCategoryTree($this->categoryModel->getCategoriesTree());

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Save search query for AI tracking
    $searchQuery = $_GET['search'] ?? null;
    $customerId = $_SESSION['customer_id'] ?? null;
    if ($searchQuery && $customerId) {
        try {
            $this->productModel->logUserSearch((int)$customerId, trim($searchQuery));
        } catch (Exception $e) {
            // Silently ignore so user experience is not disrupted, but tracking works
        }
    }

    $wishlistedProductIds = [];
    $deliveredProductIds = [];
    $reviewedProductIds = [];
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $customerId = $_SESSION['customer_id'] ?? null;
    if ($customerId) {
        $wishlistBootstrap = new SchemaBootstrap((new Database())->connect(), false);
        $wishlistedProductIds = $wishlistBootstrap->getWishlistProductIdsForUser((int)$customerId);
        $deliveredProductIds = $this->productModel->getDeliveredProductIdsForUser((int)$customerId);
        $reviewedProductIds = $this->productModel->getReviewedProductIdsForUser((int)$customerId);
    }

    foreach ($allProducts as &$prod) {
        $pId = (int)$prod['id'];
        $prod['can_review'] = in_array($pId, $deliveredProductIds) && !in_array($pId, $reviewedProductIds);
    }
    unset($prod);

    require BASE_PATH.'/app/views/User/allproducts.php';
}
public function sales(){

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

    $limit = 12;
    $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
    $page = max($page, 1);
    $offset = ($page - 1) * $limit;

    $totalProducts = $this->productModel->getSaleProductsCount();
    $totalPages = ceil($totalProducts / $limit);

    $products = $this->productModel->getSaleProductsPaginated($limit, $offset);
    $categories = $this->sanitizeCategoryTree($this->categoryModel->getCategoriesTree());

 $wishlistedProductIds = [];
 if (session_status() === PHP_SESSION_NONE) {
     session_start();
 }
 $customerId = $_SESSION['customer_id'] ?? null;
 if ($customerId) {
     $wishlistBootstrap = new SchemaBootstrap((new Database())->connect(), false);
     $wishlistedProductIds = $wishlistBootstrap->getWishlistProductIdsForUser((int)$customerId);
 }

require BASE_PATH.'/app/views/User/sale.php';
}

public function featuredProducts(){

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

    // Pagination logic
    $limit = 16;
    $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
    $page = max($page, 1);
    $offset = ($page - 1) * $limit;

    $totalProducts = $this->productModel->getFeaturedProductsCount();
    $totalPages = ceil($totalProducts / $limit);

    $products = $this->productModel->getFeaturedProducts($limit, $offset);
    $categories = $this->sanitizeCategoryTree($this->categoryModel->getCategoriesTree());

    $wishlistedProductIds = [];
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $customerId = $_SESSION['customer_id'] ?? null;
    if ($customerId) {
        $wishlistBootstrap = new SchemaBootstrap((new Database())->connect(), false);
        $wishlistedProductIds = $wishlistBootstrap->getWishlistProductIdsForUser((int)$customerId);
    }

    require BASE_PATH.'/app/views/User/featured_products.php';
}
}
