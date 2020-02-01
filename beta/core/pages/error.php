
<?php 
function do_error_page($title = '', $message = '') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?= uri_resolve('core/pages/css/landing.css') ?>">
        <title><?= $title ?> - Phantom</title>
    </head>
    <body>
        <div id="container">
            <div id="logo">
                <h1>...?</h1>
            </div>
            <h1><?= $title ?></h1>
            <p><?= $message ?></p>
        </div>
        <span id="version">Phantom v. <?= VERSION ?></span>
        <span id="go_to_admin"><a href="<?= uri_resolve("admin/") ?>">Go to admin →</a></span>
    </body>
    </html>
    <?php
}
?>
