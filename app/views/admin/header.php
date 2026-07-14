<?php
$theme = $global_theme ?? 'theme-default';
$themeFile = ($theme === 'theme-luxury') ? 'theme-luxury.css' : 'theme-default.css';
?>
<!DOCTYPE html>
<html lang="en" class="<?php echo htmlspecialchars($theme); ?>">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>css/dashboard.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>css/admin/<?php echo htmlspecialchars($themeFile); ?>?v=<?php echo time(); ?>">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css" rel="stylesheet">     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="<?php echo htmlspecialchars($theme); ?>">
    <!-- Import same fonts for admin to match frontend theme -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
      body { font-family: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; }
      h1,h2,h3,h4,h5 { font-family: 'Playfair Display', serif; }
      header h1 { font-weight:700; }
    </style>
    <header>
        <h1>Admin Panel</h1>
        <div class="user-info">
            <span>Welcome, Admin</span>
            <a href="<?php echo url('') ?>logout">Logout</a>
        </div>
    </header>