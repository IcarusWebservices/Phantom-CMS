<?php
    global $request;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= uri_resolve('/data/themes/nova/css/error.css') ?>">
    <title>This page was not found - <?= get_string('website_name') ?></title>
</head>
<body>
    <main>
        <section class="error-grid">
            <div class="error-illustration">
                <img class="error-illustration-img" src="<?= uri_resolve('/data/themes/nova/img/error_illustration_512.jpg') ?>" alt="Error">
            </div>
            <div class="error">
                <h1>404</h1>
                <p>The page you requested was not found on this server (<?= $request->request_uri ?>)</p>
                <br>
                <a href="<?= uri_resolve('/wim') ?>" class="button">Take me home</a><br>
                or <a href="#" class="link">report this</a>
            </div>
        </section>
    </main>
</body>
</html>