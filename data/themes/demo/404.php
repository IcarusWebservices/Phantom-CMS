<?php
    global $request;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= uri_resolve('/core/pages/css/landing.css') ?>">
    <title>This page was not found - <?= get_template_record('website_name') ?></title>
</head>
<body>
    <div id="container">
        <div id="logo">
            <h1>...!</h1>
        </div>
        <h1>This page was not found on this server</h1>
        <p>
            The uri that you entered was not found on this server (/<?= $request->request_uri ?>)
        </p>
    </div>
    <span id="version">Twenties theme</span>
</body>
</html>