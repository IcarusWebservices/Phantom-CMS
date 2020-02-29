<?php
/**
 * Nova Theme Header.
 * 
 * Includes the Navbar and title
 */


?>
<nav class="navbar" role="navigation" aria-label="main navigation">
    <a class="nav-icon" href="<?= uri_resolve('/wim') ?>"><img src="http://wimsteenbakker.nl/wp-content/uploads/2012/08/logo_wim_steenbakker-e1344252229717-300x110.png" alt="Wim Steenbakker"></a>
    <div class="nav-buttons">
        <div class="nav-btn"><a href="<?= uri_resolve('/wim') ?>">Home</a></div>
        <div class="nav-btn"><a href="<?= uri_resolve('/wim/contact') ?>">Contact</a></div>
        <?php
        get_template_part('menu.php', ["active_id" => $data["active_id"]]);
        ?>
    </div>
    <div class="nav-search"><i id="search-button" class="fas fa-search" aria-hidden="true"></i><input id="search-input" type="text" name="search"></div>
    <div class="nav-burger"><i class="fas fa-bars fa-2x" aria-hidden="true"></i></div>
</nav>