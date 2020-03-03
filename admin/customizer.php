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
    <style>
        body {
            margin: 0;
        }
        iframe {
            position:fixed; 
            top:0; 
            bottom:0; 
            right:0; 
            width:calc(100% - 200px); 
            height:100%; 
            border:none; 
            margin:0; 
            padding:0; 
            overflow:hidden; 
            z-index:999999;
        }

        .side-nav {
            position:fixed; 
            top:0; 
            bottom:0; 
            left:0; 
            width:200px; 
            height:100%; 
            border:none; 
            margin:0; 
            padding:0; 
            overflow:hidden; 
            z-index:999999;
            background-color: yellow;
        }
    </style>
</head>
<body>
    <div class="side-nav">

    </div>
    <iframe src="<?= site_uri_resolve('/?customizer=true') ?>" frameborder="0"></iframe>
</body>
</html>
