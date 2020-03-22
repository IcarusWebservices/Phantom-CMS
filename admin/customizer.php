<?php
require_once 'admin-setup.php';
login_required();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customizer Beta!</title>
    <link rel="stylesheet" href="<?= uri_resolve('/admin/css/components.css') ?>">
    <link rel="stylesheet" href="<?= uri_resolve('/admin/css/customizer.css') ?>">
    <script src="https://kit.fontawesome.com/9d8cef91c5.js"></script>
</head>
<body>
    <div class="actionbar">
        <a href="<?= uri_resolve('/admin') ?>" class="return"><i class="fas fa-arrow-left fa-lg"></i> Return to Phantom</a>
    </div>
    <div class="side-nav">
        <p class="sub-heading">Global settings</p>
        <div class="sidebar-grid">
            <div class="sidebar-item" draggable="true" data-type="text">
                <div>
                    <i class="fas fa-paragraph"></i>
                    <p>Tekst</p>
                </div>
            </div>
            
            <div class="sidebar-item" draggable="true" data-type="image">
                <div>
                    <i class="fas fa-image"></i>
                    <p>Foto</p>
                </div>
            </div>
            
            <div class="sidebar-item" draggable="true" data-type="video">
                <div>
                    <i class="fas fa-video"></i>
                    <p>Video</p>
                </div>
            </div>
            
        </div>
        <p class="sub-heading">Een ander kopje</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
    </div>
    <iframe src="<?= site_uri_resolve('/?customizer=true') ?>" frameborder="0"></iframe>

    <script src="<?= uri_resolve('/admin/js/components.js') ?>"></script>
    <script src="<?= uri_resolve('/admin/js/customizer-drag.js') ?>"></script>
</body>
</html>
