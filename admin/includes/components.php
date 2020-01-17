<?php
function ph_admin_template($title, $menu, $content, $current_id = null, $current_subitem_id = null) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/admin.css">
    <title><?= $title ?> • Phantom CMS</title>
</head>
<body>
    <div class="menu">
        <ul>
            <?php

            foreach ($menu as $id => $value) {
                
                $splitted = explode(":", $id);

                $type = $splitted[0];

                $a = "";

                if($id == $current_id ) {
                    $a = "active";
                }


                switch($type) {

                    case "item":
                        ?>
                        <li><a class="menu-item <?= $a ?>" href="<?= ph_uri_resolve("admin/" . $value["url_to"]) ?>"><?= $value["display"] ?></a></li>
                        <?php
                    break;

                    case "collection":
                        ?>
                        <li class="menu-item <?= $a ?>"><?= $value["display"] ?> ↓</li>
                        <ul>
                    
                        <?php
                        foreach ($value["items"] as $id => $value2) {
                            // var_dump($value2);

                            $a2 = null;

                            if($current_subitem_id == $id) {
                                $a2 = "active";
                            }

                            ?>
                            <li><a class="menu-sub-item <?= $a2 ?>" href="<?= ph_uri_resolve("admin/" . $value2["url_to"]) ?>"><?= $value2["display"] ?></a></li>
                            <?php
                        }
                        ?>

                        </ul>
                        <?php
                    break;

                }

            }

            ?>
        </ul>
    </div>
    <div class="content">
    <?php
    $content();
    ?>
    </div>
</body>
</html>
    <?php
}