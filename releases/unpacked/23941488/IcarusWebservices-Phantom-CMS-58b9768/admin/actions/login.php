<?php
/**
 * Log-in action
 * 
 * @since 2.0.0
 */

require_once '../admin-setup.php';

if(request_method_is(POST)) {
    echo "Please wait...";
    $redirect = '/admin';
    if(fd_set('redirect')) $redirect = fd_get('redirect');

    if(fd_set('username', 'password')) {

        $username = fd_get("username");
        $password = fd_get("password");

        $u = authenticate_user($username, $password);

        if($u) {

            $u->password = $password;

            session()->setUser($u);
            redirect(uri_resolve($redirect));

        } else {
            redirect(uri_resolve('/admin/login?error=invalid'));
        }

    } else redirect(uri_resolve('/admin/login?error=insuf'));

} else {
    redirect(uri_resolve('/admin/login'));
}