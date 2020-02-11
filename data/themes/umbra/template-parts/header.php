<?php
/**
 * Twenties Theme Header.
 * 
 * Includes the Navbar and title
 */


?>
<nav class="navbar" role="navigation" aria-label="main navigation">
    <a href="<?= uri_resolve('/') ?>" class="navbar-logo"><img src="https://jezz.tech/sites/phantom/img/ph-icon-solid-light.png" alt="Phantom Icon"></a>
    <div class="navbar-buttons">
        <?php
        get_template_part('menu.php', ["active_id" => $data["active_id"]]);
        ?>
    </div>
    <div class="navbar-login"><a href="<?= uri_resolve('/admin') ?>" class="button">Go To Admin</a></div>
    <div class="navbar-burger"><i class="fas fa-bars fa-2x" aria-hidden="true"></i></div>
</nav>
