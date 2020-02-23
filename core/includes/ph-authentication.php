<?php
/**
 * Authenticates a user by username and password
 * 
 * @param string $username The username of the user
 * @param string $password The password of the user
 * 
 * @since 2.0.0
 * 
 * @return PH_User|null
 */
function authenticate_user($username, $password) {

    $userselection = PH_Query::admin_users([
        "==admin_user_username" => $username
    ]);

    if(count($userselection) > 0) {

        $user = $userselection[0];

        $password_hash = $user->password_hash;

        $r = password_verify($password, $password_hash);

        if($r) return $user;
        else return null;

    } else return null;

}

/**
 * If the user is not logged in, will automatically redirect to /admin/login
 * 
 * @since 2.0.0
 */
function login_required() {
    if(session()->issetVars("username", "password")) {
        $u = authenticate_user(session()->getVar("username"), session()->getVar("password"));
        if(!$u || !var_instanceof($u, 'PH_Admin_User')) {
            $uri = uri_self();
            redirect(uri_resolve('/admin/login?redirect=' . '/' .$uri));
        } else {
            session()->user = $u;
        }
    } else {
        $uri = uri_self();
        redirect(uri_resolve('/admin/login?redirect=' . '/' .$uri));
    }
}