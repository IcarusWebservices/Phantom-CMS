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
    <title>This page is under construction - <?= get_template_record('website_name') ?></title>
</head>
<body>
    <main>
        <section class="construction">
            <h1>Under construction</h1>
            <p>This page is currently under construction. Please return later!</p>
        </section>
        <div class="construction-bar"></div>
    </main>
</body>
</html>