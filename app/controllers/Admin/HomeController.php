<?php
require_once __DIR__ . '/../../models/settings.php';

class HomeController {
    public function index() {
        $settingsModel = new Settings();  
        $webSettings = $settingsModel->getWebSettings();

       

 $bannerModel = new Banner();
        $banners = $bannerModel->getAllBanners();
         $data = [
        'title' => 'Website Settings',
        'theme' => $_SESSION['theme'] ?? 'theme-default',
        'view' => 'admin/homepage.php',

        'webname' => $webSettings['web_name'] ?? '',
        'webmail' => $webSettings['web_mail'] ?? '',
        'webcontact' => $webSettings['web_contact'] ?? '',
        'facebook' => $webSettings['facebook'] ?? '',
        'instagram' => $webSettings['instagram'] ?? '',
        'pinterest' => $webSettings['pinterest'] ?? '',
        'linkdin' => $webSettings['linkdin'] ?? '',
        'meta_title' => $webSettings['meta_title'] ?? '',
        'meta_description' => $webSettings['meta_description'] ?? '',
        'meta_keywords' => $webSettings['meta_keywords'] ?? '',
        'banners' => $banners
    ];

    extract($data);

    require BASE_PATH . '/app/views/admin/layout.php';
      
    }
    public function saveSettings()
{
    require_once BASE_PATH . '/config/database.php';

    $database = new Database();
    $conn = $database->connect();



   

    }
    public function switchTheme()
    {
        if (isset($_GET['theme'])) {
            $newTheme = $_GET['theme'];
            
            // Save admin panel theme preference to session only.
            // Do NOT write to web_settings.theme — that column is for the
            // customer-facing storefront theme and should not change when the
            // admin toggles their own panel appearance.
            $_SESSION['theme'] = $newTheme;
        }

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}


