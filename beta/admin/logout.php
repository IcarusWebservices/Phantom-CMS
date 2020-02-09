<?php
/**
 * Logs the user out
 * 
 * @since 2.0.0
 */

require_once 'admin-setup.php';

$redirect = qp_set('redirect') ? qp_get('redirect') : '/admin/login';
unset($_SESSION["username"]);
unset($_SESSION["password"]);
redirect(uri_resolve($redirect));