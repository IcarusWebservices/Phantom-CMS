
<?php 
function do_error_page($title = '', $message = '') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?= uri_resolve('/core/pages/css/error.css') ?>">
        <title><?= $title ?> - Phantom</title>
    </head>
    <body>
        <main>
            <section class="error-grid">
                <div class="error-illustration">
                    <img class="error-illustration-img" src="<?= uri_resolve('/core/pages/img/error_illustration_512.jpg') ?>" alt="Error">
                </div>
                <div class="error">
                    <h1><?= $title ?></h1>
                    <p><?= $message ?></p>
                    <br>
                    <a href="<?= uri_resolve('/admin') ?>" class="button">Go to admin</a>
                </div>
            </section>
        </main>
    </body>
    </html>
    <?php
}
?>
