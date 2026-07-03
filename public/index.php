<?php
// Load config and database first so env constants are available
require_once "../config/config.php";
require_once "../config/database.php";
require_once "../app/models/SchemaBootstrap.php";

// public/index.php
define('BASE_PATH', realpath(__DIR__ . '/..'));  // points to project root FYP-UMT

$cookieSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => $cookieSecure,
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start(); // start session for admin login or user login

$database = new Database();
$conn = $database->connect();
(new SchemaBootstrap($conn));

// Load site-wide web settings so views can read selected theme
require_once __DIR__ . '/../app/models/settings.php';
$settingsModel = new Settings();
$ws = $settingsModel->getWebSettings();
$global_theme = $ws['theme'] ?? 'theme-default';

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$sessionTimeoutSeconds = (int) env('SESSION_TIMEOUT_SECONDS', 1800);
if (!isset($_SESSION['last_activity'])) {
    $_SESSION['last_activity'] = time();
}

if ((time() - (int) $_SESSION['last_activity']) > $sessionTimeoutSeconds) {
    $hadAdminSession = !empty($_SESSION['admin_logged_in']);
    $hadCustomerSession = !empty($_SESSION['customer_logged_in']);
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }
    session_destroy();
    session_start();
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    $_SESSION['last_activity'] = time();
    $_SESSION['session_expired'] = true;
    $_SESSION['session_expired_just_now'] = true; // Flag to skip CSRF on login form
    if ($hadAdminSession) {
        $_SESSION['login_error'] = 'Your session expired due to inactivity. Please log in again.';
        header('Location: ' . BASE_URL . 'index.php?page=admin_login');
        exit;
    }

    if ($hadCustomerSession) {
        $_SESSION['login_error'] = 'Your session expired due to inactivity. Please log in again.';
        header('Location: ' . BASE_URL . 'index.php?page=customer_login');
        exit;
    }
} else {
    $_SESSION['last_activity'] = time();
}

function resolveSafeRedirectUrl(string $redirectTo, string $fallbackRoute): string
{
    $redirectTo = trim($redirectTo);

    if ($redirectTo === '') {
        return BASE_URL . 'index.php?page=' . urlencode($fallbackRoute);
    }

    $sanitized = preg_replace('/[^A-Za-z0-9_=&?\-\/\.]/', '', $redirectTo);

    if ($sanitized === '') {
        return BASE_URL . 'index.php?page=' . urlencode($fallbackRoute);
    }

    if (strpos($sanitized, 'index.php?') === 0) {
        return BASE_URL . '/' . ltrim($sanitized, '/');
    }

    if (strpos($sanitized, '?page=') === 0) {
        return BASE_URL . 'index.php' . $sanitized;
    }

    if (preg_match('/^[A-Za-z0-9_\-]+$/', $sanitized)) {
        return BASE_URL . 'index.php?page=' . $sanitized;
    }

    return BASE_URL . 'index.php?page=' . urlencode($fallbackRoute);
}

// Get page from URL (default to 'home')
$page = $_GET['page'] ?? 'home';

// Save the last page URL in the session (excluding login/registration/logout/ajax pages)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !in_array($page, [
    'customer_login', 'customer_register', 'customer_logout', 
    'customer_forgot_password', 'customer_forgot_password_process', 
    'admin_login', 'admin_logout', 'admin_forgot_password', 
    'admin_confirm_reset', 'live_search', 'user_search_history',
    'user_chat_history', 'user_similar_products'
], true)) {
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
}

// Frontend Pages
$frontendPages = [
    'home' => ['controller' => 'HomeController', 'method' => 'index', 'file' => '../app/controllers/User/HomeController.php'],
        'sale' => ['controller' => 'HomeController', 'method' => 'sales', 'file' => '../app/controllers/User/HomeController.php'],
        'featured_products' => ['controller' => 'HomeController', 'method' => 'featuredProducts', 'file' => '../app/controllers/User/HomeController.php'],
        'allproducts' => ['controller' => 'HomeController', 'method' => 'allproducts', 'file' => '../app/controllers/User/HomeController.php'],
    'products' => ['controller' => 'HomeController', 'method' => 'allproducts', 'file' => '../app/controllers/User/HomeController.php'],
    'product' => ['controller' => 'ProductController', 'method' => 'show', 'file' => '../app/controllers/User/ProductController.php'],
    'product_show' => ['controller' => 'ProductController','method' => 'show','file' => '../app/controllers/User/ProductController.php'],    'product_compare' => ['controller' => 'ProductController','method'=>'compare','file' => '../app/controllers/User/ProductController.php'],    'cart_add' => [ 'controller' => 'CartController', 'method' => 'add', 'file' => '../app/controllers/User/CartController.php'
],
'contact_send' => [
    'controller' => 'ContactController',
    'method' => 'send',
    'file' => '../app/controllers/User/ContactController.php'
],
'subscribe_newsletter' => [
    'controller' => 'NewsletterController',
    'method' => 'subscribe',
    'file' => '../app/controllers/User/NewsletterController.php'
],
'live_search' => [
    'controller' => 'ProductController',
    'method' => 'liveSearch',
    'file' => '../app/controllers/User/ProductController.php'
],
'product_review' => [
    'controller' => 'ProductController',
    'method' => 'saveReview',
    'file' => '../app/controllers/User/ProductController.php'
],
'wishlist_toggle' => [
    'controller' => 'ProductController',
    'method' => 'toggleWishlist',
    'file' => '../app/controllers/User/ProductController.php'
],
'toggle_wishlist' => [
    'controller' => 'ProductController',
    'method' => 'toggleWishlist',
    'file' => '../app/controllers/User/ProductController.php'
],
'quick_rate' => [
    'controller' => 'ProductController',
    'method' => 'quickRate',
    'file' => '../app/controllers/User/ProductController.php'
],
'customer_wishlist' => [
    'controller' => 'ProductController',
    'method' => 'customerWishlist',
    'file' => '../app/controllers/User/ProductController.php'
],
'cart' => [
    'controller' => 'CartController',
    'method' => 'index',
    'file' => '../app/controllers/User/CartController.php'
],
'checkout' => [
    'controller' => 'OrderController',
    'method' => 'checkout',
    'file' => '../app/controllers/User/OrderController.php'
],

'place_order' => [
    'controller' => 'OrderController',
    'method' => 'placeOrder',
    'file' => '../app/controllers/User/OrderController.php'
],
'order_success' => [
    'controller' => 'OrderController',
    'method' => 'success',
    'file' => '../app/controllers/User/OrderController.php'
],
'cart_remove' => [
    'controller' => 'CartController',
    'method' => 'remove',
    'file' => '../app/controllers/User/CartController.php'
],
'cart_update' => [
    'controller' => 'CartController',
    'method' => 'update',
    'file' => '../app/controllers/User/CartController.php'
],
'design' => ['controller' => 'DesignController', 'method' => 'index', 'file' => '../app/controllers/User/DesignController.php'],
'shopall_customizer' => ['controller' => 'DesignController', 'method' => 'shopAllCustomizer', 'file' => '../app/controllers/User/DesignController.php'],
'hoodie' => ['controller' => 'DesignController', 'method' => 'hoodie', 'file' => '../app/controllers/User/DesignController.php'],
'shorts' => ['controller' => 'DesignController', 'method' => 'shorts', 'file' => '../app/controllers/User/DesignController.php'],
'crewneck' => ['controller' => 'DesignController', 'method' => 'crewneck', 'file' => '../app/controllers/User/DesignController.php'],
'sweatpant' => ['controller' => 'DesignController', 'method' => 'sweatpant', 'file' => '../app/controllers/User/DesignController.php'],
'send_design_inquiry' => ['controller' => 'DesignController', 'method' => 'sendInquiry', 'file' => '../app/controllers/User/DesignController.php'],

'contact' => ['controller' => 'PageController', 'method' => 'index', 'file' => '../app/controllers/User/PageController.php'],
'page' => [
    'controller' => 'PageController',
    'method' => 'show',
    'file' => '../app/controllers/Admin/PageController.php'
],
'customer_login' => [
    'controller' => 'CustomerController',
    'method' => 'login',
    'file' => '../app/controllers/User/CustomerController.php'
],
'customer_register' => [
    'controller' => 'CustomerController',
    'method' => 'register',
    'file' => '../app/controllers/User/CustomerController.php'
],
'customer_logout' => [
    'controller' => 'CustomerController',
    'method' => 'logout',
    'file' => '../app/controllers/User/CustomerController.php'
],
'customer_forgot_password' => [
    'controller' => 'CustomerController',
    'method' => 'forgotPasswordForm',
    'file' => '../app/controllers/User/CustomerController.php'
],
'customer_forgot_password_process' => [
    'controller' => 'CustomerController',
    'method' => 'processForgotPassword',
    'file' => '../app/controllers/User/CustomerController.php'
],
'customer_orders' => [
    'controller' => 'OrderController',
    'method' => 'customerOrders',
    'file' => '../app/controllers/User/OrderController.php'
],
'customer_order_detail' => [
    'controller' => 'OrderController',
    'method' => 'customerOrderDetail',
    'file' => '../app/controllers/User/OrderController.php'
],
'customer_order_review' => [
    'controller' => 'OrderController',
    'method' => 'customerOrderReview',
    'file' => '../app/controllers/User/OrderController.php'
],
'save_review' => [
    'controller' => 'OrderController',
    'method' => 'saveReview',
    'file' => '../app/controllers/User/OrderController.php'
]
];
$frontendPages['user_chat_send'] = [
    'controller' => 'ChatController',
    'method' => 'send',
    'file' => '../app/controllers/User/ChatController.php'
];

$frontendPages['user_chat_save'] = [
    'controller' => 'ChatController',
    'method' => 'saveChat',
    'file' => '../app/controllers/User/ChatController.php'
];

$frontendPages['user_chat_history'] = [
    'controller' => 'ChatController',
    'method' => 'getChatHistory',
    'file' => '../app/controllers/User/ChatController.php'
];

$frontendPages['user_search_save'] = [
    'controller' => 'ChatController',
    'method' => 'saveSearch',
    'file' => '../app/controllers/User/ChatController.php'
];

$frontendPages['user_search_history'] = [
    'controller' => 'ChatController',
    'method' => 'getSearchHistory',
    'file' => '../app/controllers/User/ChatController.php'
];

$frontendPages['user_similar_products'] = [
    'controller' => 'ChatController',
    'method' => 'similarProducts',
    'file' => '../app/controllers/User/ChatController.php'
];

// JazzCash AJAX endpoints
$frontendPages['jazzcash_register'] = [
    'controller' => 'JazzCashController',
    'method' => 'register',
    'file' => '../app/controllers/User/JazzCashController.php'
];
$frontendPages['jazzcash_login'] = [
    'controller' => 'JazzCashController',
    'method' => 'login',
    'file' => '../app/controllers/User/JazzCashController.php'
];
$frontendPages['jazzcash_verify_otp'] = [
    'controller' => 'JazzCashController',
    'method' => 'verifyOtp',
    'file' => '../app/controllers/User/JazzCashController.php'
];
// Admin Pages
$adminPages = [
       'admin_login' => ['controller'=>'LoginController','method'=>'login','file'=>'../app/controllers/Admin/LoginController.php'],
       'admin_forgot_password' => ['controller'=>'LoginController','method'=>'forgotPassword','file'=>'../app/controllers/Admin/LoginController.php'],
       'admin_confirm_reset' => ['controller'=>'LoginController','method'=>'confirmReset','file'=>'../app/controllers/Admin/LoginController.php'],
    'admin_logout' => ['controller'=>'LoginController','method'=>'logout','file'=>'../app/controllers/Admin/LoginController.php'],
    'admin' => ['controller' => 'DashboardController', 'method' => 'index', 'file' => '../app/controllers/Admin/DashboardController.php'],
     'homepage' => ['controller' => 'HomeController', 'method' => 'index', 'file' => '../app/controllers/Admin/HomeController.php'],
     'banner_add' => ['controller'=>'BannerController','method'=>'add','file'=>'../app/controllers/Admin/BannerController.php'],
   'edit_banner' => ['controller'=>'BannerController','method'=>'edit','file'=>'../app/controllers/Admin/BannerController.php'],
'switch_theme' => [
    'controller' => 'HomeController',
    'method' => 'switchTheme',
    'file' => '../app/controllers/Admin/HomeController.php'
],
'delete_banner' => ['controller'=>'BannerController','method'=>'delete','file'=>'../app/controllers/Admin/BannerController.php'],
     'admin_products' => ['controller' => 'ProductController', 'method' => 'index', 'file' => '../app/controllers/Admin/ProductController.php'],
 'admin_sale_products' => ['controller' => 'ProductController', 'method' => 'saleIndex', 'file' => '../app/controllers/Admin/ProductController.php'],
 'admin_feature_products' => ['controller' => 'ProductController', 'method' => 'featureIndex', 'file' => '../app/controllers/Admin/ProductController.php'],
 'add_product' => [
'controller' => 'ProductController','method' => 'create','file' => '../app/controllers/Admin/ProductController.php'],
  'edit_product'    => ['controller'=>'ProductController','method'=>'edit','file'=>'../app/controllers/Admin/ProductController.php'],
'update_product'  => ['controller'=>'ProductController','method'=>'update','file'=>'../app/controllers/Admin/ProductController.php'],
'store_product' => ['controller' => 'ProductController','method' => 'store','file' => '../app/controllers/Admin/ProductController.php'],
 'exportJSON' => [
    'controller' => 'ProductController',
    'method' => 'exportJSON',
    'file' => '../app/controllers/Admin/ProductController.php'
],
     'delete_product'=>['controller'=>'ProductController','method'=>'delete','file'=>'../app/controllers/Admin/ProductController.php'],
     'manage_orders' => [
    'controller' => 'OrderController',
    'method' => 'manageOrders',
    'file' => '../app/controllers/User/OrderController.php'
],
'return_form' => [
    'controller' => 'OrderController',
    'method' => 'returnForm',
    'file' => '../app/controllers/User/OrderController.php'
],
'submit_return_request' => [
    'controller' => 'OrderController',
    'method' => 'submitReturnRequest',
    'file' => '../app/controllers/User/OrderController.php'
],
'customer_return_request' => [
    'controller' => 'OrderController',
    'method' => 'customerReturnRequestPage',
    'file' => '../app/controllers/User/OrderController.php'
],
'update_return_status' => [
    'controller' => 'OrderController',
    'method' => 'updateReturnStatus',
    'file' => '../app/controllers/User/OrderController.php'
],
'process_return' => [
    'controller' => 'OrderController',
    'method' => 'processReturn',
    'file' => '../app/controllers/User/OrderController.php'
],
'return_report' => [
    'controller' => 'OrderController',
    'method' => 'returnReport',
    'file' => '../app/controllers/User/OrderController.php'
],
'return_trash' => [
    'controller' => 'OrderController',
    'method' => 'returnTrash',
    'file' => '../app/controllers/User/OrderController.php'
],
'feature_product' => [
    'controller' => 'ProductController',
    'method' => 'feature',
    'file' => '../app/controllers/Admin/ProductController.php'
],
'toggle_sale_product' => [
    'controller' => 'ProductController',
    'method' => 'toggleSale',
    'file' => '../app/controllers/Admin/ProductController.php'
],
'delete_order' => [
    'controller' => 'OrderController',
    'method' => 'deleteOrder',
    'file' => '../app/controllers/User/OrderController.php'
],
'mark_delivered' => [
    'controller' => 'OrderController',
    'method' => 'markDelivered',
    'file' => '../app/controllers/User/OrderController.php'
],
'mark_processing' => [
    'controller' => 'OrderController',
    'method' => 'markProcessing',
    'file' => '../app/controllers/User/OrderController.php'
],
'mark_in_transit' => [
    'controller' => 'OrderController',
    'method' => 'markInTransit',
    'file' => '../app/controllers/User/OrderController.php'
],
'mark_out_for_delivery' => [
    'controller' => 'OrderController',
    'method' => 'markOutForDelivery',
    'file' => '../app/controllers/User/OrderController.php'
],
'mark_cancelled' => [
    'controller' => 'OrderController',
    'method' => 'markCancelled',
    'file' => '../app/controllers/User/OrderController.php'
],
'save_tracking' => [
    'controller' => 'OrderController',
    'method' => 'saveTracking',
    'file' => '../app/controllers/User/OrderController.php'
],
 
 'admin_categories' => ['controller' => 'CategoryController','method' => 'index','file' => '../app/controllers/Admin/CategoryController.php'
],

'add_category' => ['controller' => 'CategoryController','method' => 'create','file' => '../app/controllers/Admin/CategoryController.php'
],

'store_category' => ['controller' => 'CategoryController','method' => 'store','file' => '../app/controllers/Admin/CategoryController.php'
],
'edit_category' => ['controller'=>'CategoryController','method'=>'edit','file'=>'../app/controllers/Admin/CategoryController.php'
],

'update_category' => ['controller'=>'CategoryController','method'=>'update','file'=>'../app/controllers/Admin/CategoryController.php'],

'delete_category' => ['controller' => 'CategoryController','method' => 'delete','file' => '../app/controllers/Admin/CategoryController.php'
],
'pages' => [
    'controller' => 'PageController',
    'method' => 'index',
    'file' => '../app/controllers/Admin/PageController.php'
],

'add_page' => [
    'controller' => 'PageController',
    'method' => 'add',
    'file' => '../app/controllers/Admin/PageController.php'
],

'store_page' => [
    'controller' => 'PageController',
    'method' => 'store',
    'file' => '../app/controllers/Admin/PageController.php'
],

'edit_page' => [
    'controller' => 'PageController',
    'method' => 'edit',
    'file' => '../app/controllers/Admin/PageController.php'
],

'update_page' => [
    'controller' => 'PageController',
    'method' => 'update',
    'file' => '../app/controllers/Admin/PageController.php'
],

'delete_page' => [
    'controller' => 'PageController',
    'method' => 'delete',
    'file' => '../app/controllers/Admin/PageController.php'
],
    'admin_blogs' => ['controller' => 'DashboardController', 'method' => 'index', 'file' => '../app/controllers/Admin/DashboardController.php'],
    'admin_save_settings' => ['controller' => 'DashboardController', 'method' => 'saveSettings', 'file' => '../app/controllers/Admin/DashboardController.php'],
    'sales_report' => ['controller' => 'DashboardController', 'method' => 'salesReport', 'file' => '../app/controllers/Admin/DashboardController.php'],
    'wishlist_report' => ['controller' => 'DashboardController', 'method' => 'wishlistReport', 'file' => '../app/controllers/Admin/DashboardController.php'],
    'wishlist_customer_detail' => ['controller' => 'DashboardController', 'method' => 'wishlistCustomerDetail', 'file' => '../app/controllers/Admin/DashboardController.php'],
    'send_customer_voucher' => ['controller' => 'DashboardController', 'method' => 'sendWishlistVoucher', 'file' => '../app/controllers/Admin/DashboardController.php'],
    'download_report' => ['controller' => 'DashboardController', 'method' => 'downloadReport', 'file' => '../app/controllers/Admin/DashboardController.php'],
    'send_retention_email' => ['controller' => 'DashboardController', 'method' => 'sendRetentionEmail', 'file' => '../app/controllers/Admin/DashboardController.php'],
];

$csrfExemptRoutes = [
    'user_chat_send',
    'user_chat_save',
    'user_chat_history',
    'user_search_save',
    'user_search_history',
    'user_similar_products',
    'live_search',
    'send_design_inquiry',
    'jazzcash_register',
    'jazzcash_login',
    'jazzcash_verify_otp',
];

// Determine if page exists
if (isset($frontendPages[$page])) {
    $route = $frontendPages[$page];
} elseif (isset($adminPages[$page])) {
   
    // Admin pages except login can only be accessed if logged in
if ($page !== 'admin_login' && $page !== 'admin_logout' && $page !== 'admin_forgot_password' && $page !== 'admin_confirm_reset' && !isset($_SESSION['admin_logged_in'])) {
    header("Location: ".BASE_URL."index.php?page=admin_login");
    exit;
}
    $route = $adminPages[$page];
} else {
    // Treat unknown frontend routes as page slug
    require_once '../app/controllers/Admin/PageController.php';

    $controller = new PageController();
    $controller->show($page); // pass slug

    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !in_array($page, $csrfExemptRoutes, true)) {
    $submittedToken = $_POST['csrf_token'] ?? '';
    if (!is_string($submittedToken) || !hash_equals($_SESSION['csrf_token'], $submittedToken)) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        $redirectTo = trim((string)($_POST['redirect_to'] ?? ''));
        if (!empty($redirectTo)) {
            $_SESSION['csrf_error'] = 'Security token refreshed. Please try again.';
            $redirectUrl = resolveSafeRedirectUrl($redirectTo, $page);
            header('Location: ' . $redirectUrl);
            exit;
        }

        $_SESSION['csrf_error'] = 'Security token expired. Please refresh the page and try again.';
        if (strpos($page, 'admin_') === 0 || strpos($page, 'customer_') === 0 || $page === 'place_order' || $page === 'contact_send' || $page === 'subscribe_newsletter' || $page === 'product_review' || $page === 'cart_add' || $page === 'wishlist_toggle' || $page === 'toggle_wishlist') {
            header('Location: ' . BASE_URL . 'index.php?page=' . urlencode($page));
            exit;
        }

        http_response_code(403);
        echo 'Invalid security token.';
        exit;
    }
}

// Load the controller and call the method
require_once $route['file'];
$controllerName = $route['controller'];
$method = $route['method'];

$controller = new $controllerName();

// List of pages that require ID
$pagesWithId = ['product', 'edit_product', 'delete_product', 'edit_category', 
'delete_category', 'edit_banner', 'delete_banner', 'cart_remove', 'edit_page',
'update_page', 'delete_page'];

if ($page === 'page') {
    $slug = $_GET['slug'] ?? '';
    $controller->$method($slug);
} elseif (in_array($page, $pagesWithId)) {
    if (!isset($_GET['id'])) {
        die("ID missing for this action.");
    }
    $controller->$method((int)$_GET['id']);
} else {
    $controller->$method();
}

?>
