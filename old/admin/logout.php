<?php
require "setup.php";

if(ph_qp_set("redirect")) {
    $redirect_to = ph_uri_resolve(ph_qp_get("redirect"));
} else {
    $redirect_to = "/";
}

session()->unsetUser();

ph_redirect($redirect_to);

?>