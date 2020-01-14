<?php
require dirname(dirname(__FILE__)) . '/setup.php';

if(!session()->is_logged_in) {
    ph_redirect("admin/login.php");
    die("You need to be logged-in");
}

ph_autoload(PH_ROOT . 'admin/dev/includes/');
?>