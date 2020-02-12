<?php
/**
 * View the documentation!
 */
require_once 'admin-setup.php';
login_required();

$location = 'index';

if(qp_set('location')) $location = qp_get('location');

// array_push($requested_header_scripts, request_script('https://cdn.jsdelivr.net/npm/showdown@1.9.1/dist/showdown.min.js'));

admin_template("Documentation", $menu, function() {
    global $location;

    $map = loaddocmaprecurs(ROOT . 'admin/docs');

    // var_dump($map);

    ?>
    <h1>Documentation</h1>

    <ul style="all:unset;">
        <?php

            function render($map) {
                foreach ($map as $folder => $val) {
                    if(is_string($val)) {
                        ?><li><?= $val ?></li><?php
                    } else if(is_array($val)) {
                        ?><li><?= $folder ?><ul><?php render($val) ?></ul></li><?php
                    }
                }
            }

            render($map);
            
        ?>
    </ul>

    <?php

    if(file_exists(ROOT . 'admin/docs/' . $location . '.md')) {

    } else {
        ?><h1>This document was not found...</h1><?php
    }

    ?>
    <?php
}, "item:documentation");

function loaddocmaprecurs($dir) {

    $map = [];

    foreach (glob($dir . '/*') as $f) {
        $p = explode('/', $f);
        $name = $p[count($p) - 1];
        if(is_dir($f)) {
            $map[$name] = loaddocmaprecurs($f);
        } else {
            array_push($map, $name);
        }
    }

    return $map;

}