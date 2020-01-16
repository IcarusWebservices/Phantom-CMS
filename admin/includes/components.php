<?php
function ph_admin_template($title, $menu, $content) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?> - Phantom CMS</title>
</head>
<body>
    <ul>
    <?php
        var_dump($menu);
        foreach ($menu as $key => $item) {
            ?>
            <li>
            <?php
            if(is_array($item)) {
                ?>
                <ul>
                <?php
                foreach ($item as $key => $value) {
                    ?>
                    <li><?= $key ?></li>
                    <?php
                }
                ?>
                </ul>
                <?php
            } elseif( is_string($item) ) {
                echo $item;
            }
            ?>
            </li>
            <?php
        }
    ?>
    </ul>
    <?php

    $content();
    ?>
</body>
</html>
    <?php
}