<?php
/**
 * Stitch Smart — API & AJAX Routes
 *
 * Defines asynchronous endpoints for live search, AI chatbot, search history, and JazzCash payments.
 * Also exports the list of CSRF-exempt route keys.
 */

return [
    'routes' => [
        // ── Live Search & Recommendations ───────────────────────────────────
        'live_search'           => ['controller' => 'ProductController', 'method' => 'liveSearch',      'file' => '../app/controllers/User/ProductController.php'],
        'user_similar_products' => ['controller' => 'ChatController',    'method' => 'similarProducts', 'file' => '../app/controllers/User/ChatController.php'],

        // ── AI Chatbot & Search History ─────────────────────────────────────
        'user_chat_send'      => ['controller' => 'ChatController', 'method' => 'send',             'file' => '../app/controllers/User/ChatController.php'],
        'user_chat_save'      => ['controller' => 'ChatController', 'method' => 'saveChat',         'file' => '../app/controllers/User/ChatController.php'],
        'user_chat_history'   => ['controller' => 'ChatController', 'method' => 'getChatHistory',   'file' => '../app/controllers/User/ChatController.php'],
        'user_search_save'    => ['controller' => 'ChatController', 'method' => 'saveSearch',       'file' => '../app/controllers/User/ChatController.php'],
        'user_search_history' => ['controller' => 'ChatController', 'method' => 'getSearchHistory', 'file' => '../app/controllers/User/ChatController.php'],

        // ── JazzCash AJAX Payment Endpoints ─────────────────────────────────
        'jazzcash_register'   => ['controller' => 'JazzCashController', 'method' => 'register',  'file' => '../app/controllers/User/JazzCashController.php'],
        'jazzcash_login'      => ['controller' => 'JazzCashController', 'method' => 'login',     'file' => '../app/controllers/User/JazzCashController.php'],
        'jazzcash_verify_otp' => ['controller' => 'JazzCashController', 'method' => 'verifyOtp', 'file' => '../app/controllers/User/JazzCashController.php'],
    ],

    'csrf_exempt' => [
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
    ]
];
