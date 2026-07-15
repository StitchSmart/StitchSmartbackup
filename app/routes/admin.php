<?php
/**
 * Stitch Smart — Admin Panel Routes
 *
 * Defines all administration, dashboard, management, and report routes.
 * Protected by admin authentication checks in the core Router.
 */

return [
    // ── Admin Authentication ────────────────────────────────────────────────
    'admin_login'           => ['controller' => 'LoginController', 'method' => 'login',          'file' => '../app/controllers/Admin/LoginController.php'],
    'admin_logout'          => ['controller' => 'LoginController', 'method' => 'logout',         'file' => '../app/controllers/Admin/LoginController.php'],
    'admin_forgot_password' => ['controller' => 'LoginController', 'method' => 'forgotPassword', 'file' => '../app/controllers/Admin/LoginController.php'],
    'admin_confirm_reset'   => ['controller' => 'LoginController', 'method' => 'confirmReset',   'file' => '../app/controllers/Admin/LoginController.php'],

    // ── Dashboard & Reports ─────────────────────────────────────────────────
    'admin'                    => ['controller' => 'DashboardController', 'method' => 'index',                'file' => '../app/controllers/Admin/DashboardController.php'],
    'admin_blogs'              => ['controller' => 'DashboardController', 'method' => 'index',                'file' => '../app/controllers/Admin/DashboardController.php'],
    'admin_save_settings'      => ['controller' => 'DashboardController', 'method' => 'saveSettings',         'file' => '../app/controllers/Admin/DashboardController.php'],
    'sales_report'             => ['controller' => 'DashboardController', 'method' => 'salesReport',          'file' => '../app/controllers/Admin/DashboardController.php'],
    'wishlist_report'          => ['controller' => 'DashboardController', 'method' => 'wishlistReport',       'file' => '../app/controllers/Admin/DashboardController.php'],
    'wishlist_customer_detail' => ['controller' => 'DashboardController', 'method' => 'wishlistCustomerDetail', 'file' => '../app/controllers/Admin/DashboardController.php'],
    'send_customer_voucher'    => ['controller' => 'DashboardController', 'method' => 'sendWishlistVoucher',    'file' => '../app/controllers/Admin/DashboardController.php'],
    'download_report'          => ['controller' => 'DashboardController', 'method' => 'downloadReport',       'file' => '../app/controllers/Admin/DashboardController.php'],
    'send_retention_email'     => ['controller' => 'DashboardController', 'method' => 'sendRetentionEmail',   'file' => '../app/controllers/Admin/DashboardController.php'],

    // ── Homepage & Banner Management ────────────────────────────────────────
    'homepage'       => ['controller' => 'HomeController',   'method' => 'index',       'file' => '../app/controllers/Admin/HomeController.php'],
    'admin_homepage' => ['controller' => 'HomeController',   'method' => 'index',       'file' => '../app/controllers/Admin/HomeController.php'],
    'switch_theme'  => ['controller' => 'HomeController',   'method' => 'switchTheme', 'file' => '../app/controllers/Admin/HomeController.php'],
    'banner_add'    => ['controller' => 'BannerController', 'method' => 'add',         'file' => '../app/controllers/Admin/BannerController.php'],
    'edit_banner'   => ['controller' => 'BannerController', 'method' => 'edit',        'file' => '../app/controllers/Admin/BannerController.php'],
    'delete_banner' => ['controller' => 'BannerController', 'method' => 'delete',      'file' => '../app/controllers/Admin/BannerController.php'],

    // ── Product Management ──────────────────────────────────────────────────
    'admin_products'         => ['controller' => 'ProductController', 'method' => 'index',        'file' => '../app/controllers/Admin/ProductController.php'],
    'admin_sale_products'    => ['controller' => 'ProductController', 'method' => 'saleIndex',    'file' => '../app/controllers/Admin/ProductController.php'],
    'admin_feature_products' => ['controller' => 'ProductController', 'method' => 'featureIndex', 'file' => '../app/controllers/Admin/ProductController.php'],
    'add_product'            => ['controller' => 'ProductController', 'method' => 'create',       'file' => '../app/controllers/Admin/ProductController.php'],
    'store_product'          => ['controller' => 'ProductController', 'method' => 'store',        'file' => '../app/controllers/Admin/ProductController.php'],
    'edit_product'           => ['controller' => 'ProductController', 'method' => 'edit',         'file' => '../app/controllers/Admin/ProductController.php'],
    'update_product'         => ['controller' => 'ProductController', 'method' => 'update',       'file' => '../app/controllers/Admin/ProductController.php'],
    'delete_product'         => ['controller' => 'ProductController', 'method' => 'delete',       'file' => '../app/controllers/Admin/ProductController.php'],
    'feature_product'        => ['controller' => 'ProductController', 'method' => 'feature',      'file' => '../app/controllers/Admin/ProductController.php'],
    'toggle_sale_product'    => ['controller' => 'ProductController', 'method' => 'toggleSale',   'file' => '../app/controllers/Admin/ProductController.php'],
    'exportJSON'             => ['controller' => 'ProductController', 'method' => 'exportJSON',   'file' => '../app/controllers/Admin/ProductController.php'],

    // ── Category Management ─────────────────────────────────────────────────
    'admin_categories' => ['controller' => 'CategoryController', 'method' => 'index',  'file' => '../app/controllers/Admin/CategoryController.php'],
    'add_category'     => ['controller' => 'CategoryController', 'method' => 'create', 'file' => '../app/controllers/Admin/CategoryController.php'],
    'store_category'   => ['controller' => 'CategoryController', 'method' => 'store',  'file' => '../app/controllers/Admin/CategoryController.php'],
    'edit_category'    => ['controller' => 'CategoryController', 'method' => 'edit',   'file' => '../app/controllers/Admin/CategoryController.php'],
    'update_category'  => ['controller' => 'CategoryController', 'method' => 'update', 'file' => '../app/controllers/Admin/CategoryController.php'],
    'delete_category'  => ['controller' => 'CategoryController', 'method' => 'delete', 'file' => '../app/controllers/Admin/CategoryController.php'],

    // ── Order & Return Management ───────────────────────────────────────────
    'manage_orders'           => ['controller' => 'OrderController', 'method' => 'manageOrders',            'file' => '../app/controllers/User/OrderController.php'],
    'delete_order'            => ['controller' => 'OrderController', 'method' => 'deleteOrder',             'file' => '../app/controllers/User/OrderController.php'],
    'mark_processing'         => ['controller' => 'OrderController', 'method' => 'markProcessing',          'file' => '../app/controllers/User/OrderController.php'],
    'mark_in_transit'         => ['controller' => 'OrderController', 'method' => 'markInTransit',           'file' => '../app/controllers/User/OrderController.php'],
    'mark_out_for_delivery'   => ['controller' => 'OrderController', 'method' => 'markOutForDelivery',        'file' => '../app/controllers/User/OrderController.php'],
    'mark_delivered'          => ['controller' => 'OrderController', 'method' => 'markDelivered',           'file' => '../app/controllers/User/OrderController.php'],
    'mark_cancelled'          => ['controller' => 'OrderController', 'method' => 'markCancelled',           'file' => '../app/controllers/User/OrderController.php'],
    'save_tracking'           => ['controller' => 'OrderController', 'method' => 'saveTracking',            'file' => '../app/controllers/User/OrderController.php'],
    'return_form'             => ['controller' => 'OrderController', 'method' => 'returnForm',              'file' => '../app/controllers/User/OrderController.php'],
    'update_return_status'    => ['controller' => 'OrderController', 'method' => 'updateReturnStatus',      'file' => '../app/controllers/User/OrderController.php'],
    'process_return'          => ['controller' => 'OrderController', 'method' => 'processReturn',           'file' => '../app/controllers/User/OrderController.php'],
    'return_report'           => ['controller' => 'OrderController', 'method' => 'returnReport',            'file' => '../app/controllers/User/OrderController.php'],
    'return_trash'            => ['controller' => 'OrderController', 'method' => 'returnTrash',             'file' => '../app/controllers/User/OrderController.php'],

    // ── CMS Pages Management ────────────────────────────────────────────────
    'pages'       => ['controller' => 'PageController', 'method' => 'index',  'file' => '../app/controllers/Admin/PageController.php'],
    'add_page'    => ['controller' => 'PageController', 'method' => 'add',    'file' => '../app/controllers/Admin/PageController.php'],
    'store_page'  => ['controller' => 'PageController', 'method' => 'store',  'file' => '../app/controllers/Admin/PageController.php'],
    'edit_page'   => ['controller' => 'PageController', 'method' => 'edit',   'file' => '../app/controllers/Admin/PageController.php'],
    'update_page' => ['controller' => 'PageController', 'method' => 'update', 'file' => '../app/controllers/Admin/PageController.php'],
    'delete_page' => ['controller' => 'PageController', 'method' => 'delete', 'file' => '../app/controllers/Admin/PageController.php'],
];
