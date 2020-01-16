<?php
require "setup.php";

$method = $_SERVER["REQUEST_METHOD"];

if(ph_qp_set("redirect")) {

    $qp = ph_qp_get("redirect");

    if(substr($qp, 0, 1) == "/") $qp = substr($qp, 1);

    $redirect_point = ph_uri_resolve($qp);
} else {
    $redirect_point = ph_uri_resolve("admin/");
}

if(session()->is_logged_in) {
    ph_redirect($redirect_point);
}

if($method == "POST") {
    $s = false;

    if(ph_fp_set(["username", "password"])) {
        $username = ph_fp_get("username");
        $password = ph_fp_get("password");

        $user = session()->authorizeUserByPassword($username, $password);

        if($user) {
            var_dump($user);
            session()->setUser($user, $password);
            $s = true;
        } else {
            $s = false;
        }

    } else {
        $s = false;
    }

    if($s) {
        ph_redirect($redirect_point);
    } else {
        ph_redirect("login.php?e=1&redirect=" . $redirect_point);
    }
} else {

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/admin/css/login.css">
    <title>Authorize</title>
</head>
<body>
    <div class="login-box">
        <form method="POST">
            <div class="field">
                <label for="username">Username</label>
                <input type="text" name="username" id="login-username">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" name="password" id="login-password">
            </div>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>