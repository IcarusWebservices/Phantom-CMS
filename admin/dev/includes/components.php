<?php
function ph_dev_navbar($active_item_id) {
    ?>
    <h1>Phantom Dev</h1>
    <ul>
        <li><a href="<?= ph_uri_resolve("admin/dev/") ?>">Project Browser</a></li>
    </ul>
    <?php
}

function ph_dev_header($title) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?= ph_uri_resolve("admin/dev/css/style.css") ?>">
        <title><?= $title ?></title>
    </head>
    <body>
    <?php
}
?>