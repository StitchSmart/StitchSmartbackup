<?php
/**
 * Stitch Smart — Frontend / User Web Routes
 *
 * Defines all customer-facing and shopping routes.
 * Each route maps a key/slug to a Controller, Method, and Controller File.
 */

return [
    // ── Home & General Catalog ──────────────────────────────────────────────
    'home'              => ['controller' => 'HomeController',    'method' => 'index',            'file' => '../app/controllers/User/HomeController.php'],
    'sale'              => ['controller' => 'HomeController',    'method' => 'sales',            'file' => '../app/controllers/User/HomeController.php'],
    'featured_products' => ['controller' => 'HomeController',    'method' => 'featuredProducts', 'file' => '../app/controllers/User/HomeController.php'],
    'allproducts'       => ['controller' => 'HomeController',    'method' => 'allproducts',      'file' => '../app/controllers/User/HomeController.php'],
    'products'          => ['controller' => 'HomeController',    'method' => 'allproducts',      'file' => '../app/controllers/User/HomeController.php'],

    // ── Product Details & Comparison ────────────────────────────────────────
    'product'           => ['controller' => 'ProductController', 'method' => 'show',             'file' => '../app/controllers/User/ProductController.php'],
    'product_show'      => ['controller' => 'ProductController', 'method' => 'show',             'file' => '../app/controllers/User/ProductController.php'],
    'product_compare'   => ['controller' => 'ProductController', 'method' => 'compare',          'file' => '../app/controllers/User/ProductController.php'],
    'product_review'    => ['controller' => 'ProductController', 'method' => 'saveReview',       'file' => '../app/controllers/User/ProductController.php'],
    'quick_rate'        => ['controller' => 'ProductController', 'method' => 'quickRate',        'file' => '../app/controllers/User/ProductController.php'],

    // ── Wishlist ────────────────────────────────────────────────────────────
    'wishlist_toggle'   => ['controller' => 'ProductController', 'method' => 'toggleWishlist',   'file' => '../app/controllers/User/ProductController.php'],
    'toggle_wishlist'   => ['controller' => 'ProductController', 'method' => 'toggleWishlist',   'file' => '../app/controllers/User/ProductController.php'],
    'customer_wishlist' => ['controller' => 'ProductController', 'method' => 'customerWishlist', 'file' => '../app/controllers/User/ProductController.php'],

    // ── Cart & Checkout ─────────────────────────────────────────────────────
    'cart'              => ['controller' => 'CartController',    'method' => 'index',            'file' => '../app/controllers/User/CartController.php'],
    'cart_add'          => ['controller' => 'CartController',    'method' => 'add',              'file' => '../app/controllers/User/CartController.php'],
    'cart_remove'       => ['controller' => 'CartController',    'method' => 'remove',           'file' => '../app/controllers/User/CartController.php'],
    'cart_update'       => ['controller' => 'CartController',    'method' => 'update',           'file' => '../app/controllers/User/CartController.php'],
    'checkout'          => ['controller' => 'OrderController',   'method' => 'checkout',         'file' => '../app/controllers/User/OrderController.php'],
    'place_order'       => ['controller' => 'OrderController',   'method' => 'placeOrder',       'file' => '../app/controllers/User/OrderController.php'],
    'order_success'     => ['controller' => 'OrderController',   'method' => 'success',          'file' => '../app/controllers/User/OrderController.php'],

    // ── Customer Authentication & Profile ───────────────────────────────────
    'customer_login'                   => ['controller' => 'CustomerController', 'method' => 'login',                 'file' => '../app/controllers/User/CustomerController.php'],
    'customer_register'                => ['controller' => 'CustomerController', 'method' => 'register',              'file' => '../app/controllers/User/CustomerController.php'],
    'customer_logout'                  => ['controller' => 'CustomerController', 'method' => 'logout',                'file' => '../app/controllers/User/CustomerController.php'],
    'customer_forgot_password'         => ['controller' => 'CustomerController', 'method' => 'forgotPasswordForm',    'file' => '../app/controllers/User/CustomerController.php'],
    'customer_forgot_password_process' => ['controller' => 'CustomerController', 'method' => 'processForgotPassword', 'file' => '../app/controllers/User/CustomerController.php'],
    'customer_orders'                  => ['controller' => 'OrderController',    'method' => 'customerOrders',        'file' => '../app/controllers/User/OrderController.php'],
    'customer_order_detail'            => ['controller' => 'OrderController',    'method' => 'customerOrderDetail',   'file' => '../app/controllers/User/OrderController.php'],
    'customer_order_review'            => ['controller' => 'OrderController',    'method' => 'customerOrderReview',   'file' => '../app/controllers/User/OrderController.php'],
    'save_review'                      => ['controller' => 'OrderController',    'method' => 'saveReview',            'file' => '../app/controllers/User/OrderController.php'],

    // ── Design Customizer ───────────────────────────────────────────────────
    'design'              => ['controller' => 'DesignController', 'method' => 'index',             'file' => '../app/controllers/User/DesignController.php'],
    'shopall_customizer'  => ['controller' => 'DesignController', 'method' => 'shopAllCustomizer', 'file' => '../app/controllers/User/DesignController.php'],
    'hoodie'              => ['controller' => 'DesignController', 'method' => 'hoodie',            'file' => '../app/controllers/User/DesignController.php'],
    'shorts'              => ['controller' => 'DesignController', 'method' => 'shorts',            'file' => '../app/controllers/User/DesignController.php'],
    'crewneck'            => ['controller' => 'DesignController', 'method' => 'crewneck',          'file' => '../app/controllers/User/DesignController.php'],
    'sweatpant'           => ['controller' => 'DesignController', 'method' => 'sweatpant',         'file' => '../app/controllers/User/DesignController.php'],
    'send_design_inquiry' => ['controller' => 'DesignController', 'method' => 'sendInquiry',       'file' => '../app/controllers/User/DesignController.php'],

    // ── CMS Pages & Contact ─────────────────────────────────────────────────
    'contact'              => ['controller' => 'PageController',       'method' => 'index',     'file' => '../app/controllers/User/PageController.php'],
    'contact_send'         => ['controller' => 'ContactController',    'method' => 'send',      'file' => '../app/controllers/User/ContactController.php'],
    'subscribe_newsletter' => ['controller' => 'NewsletterController', 'method' => 'subscribe', 'file' => '../app/controllers/User/NewsletterController.php'],
    'page'                 => ['controller' => 'PageController',       'method' => 'show',      'file' => '../app/controllers/Admin/PageController.php'],
];
