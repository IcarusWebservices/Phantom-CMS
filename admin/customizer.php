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
        <p class="nav-item">Wat zijn WP globals?</p>
        <p class="nav-item">Ik weet het niet eens</p>
        <p class="nav-item">Dus geen idee wat ik hier moet ontwerpen</p>
        <p class="nav-item">Maargoed, nu kan je een navigatie maken!</p>
        <p class="nav-item">Of een settings menu</p>
        <p class="nav-item">Of whatever je wilt</p>
        <p class="sub-heading">Een ander kopje</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
        <p class="nav-item">Overflow testing!</p>
    </div>
    <iframe src="<?= site_uri_resolve('/?customizer=true') ?>" frameborder="0"></iframe>

    <script src="<?= uri_resolve('/admin/js/components.js') ?>"></script>
</body>
</html>
