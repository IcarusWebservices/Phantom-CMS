<?php
/**
 * Nova Theme Header.
 * 
 * Includes the Navbar and title
 */


?>
<nav class="js-navbar" id="">
    <a class="nav-icon" href="/wim"><img src="http://wimsteenbakker.nl/wp-content/uploads/2012/08/logo_wim_steenbakker-e1344252229717-300x110.png"></a>
    <div class="nav-buttons">
        <div class="nav-btn active"><a href="<?= uri_resolve('/wim') ?>">Home</a></div>
        <?php
        get_template_part('menu.php', ["active_id" => $data["active_id"]]);
        ?>
        <div class="nav-search"><i id="search-button" class="fas fa-search" aria-hidden="true"></i><input id="search-input" type="text" name="search"></div>
    </div>
    <div class="nav-burger"><i class="fas fa-bars fa-2x" aria-hidden="true"></i></div>
</nav>