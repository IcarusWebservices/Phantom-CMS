<?php
/**
 * Twenties Theme Header.
 * 
 * Includes the Navbar and title
 */


?>
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="<?= uri_resolve('/') ?>">
            <h1 style="font-size: 20px; font-weight: bold;"><?= get_string('website_name') ?></h1>
        </a>

        <a id="hamburger-expand" role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        
        <div class="navbar-start">

        <?php
        get_template_part('menu.php', ["active_id" => $data["active_id"]]);
        ?>
        </div>

        <div class="navbar-end">
        <div class="navbar-item">
            <div class="buttons">
            <a class="button is-primary" href="<?= uri_resolve('/admin') ?>">
                <strong>Go to admin</strong>
            </a>
            </div>
        </div>
        </div>
    </div>
</nav>