<?php
/**
 * User profile page
 * 
 * @since 2.0.0
 */
require 'admin-setup.php';
login_required();

if(!qp_set('id')) redirect(uri_resolve('/admin/users')); 

$usr_id = qp_get('id');
if(!is_numeric($usr_id)) redirect(uri_resolve('/admin/users')); 
$usr_id = (int) $usr_id;

$user = PH_Query::admin_users([
    "==admin_user_id" => $usr_id
]);

if(count($user)>0) {
    $user = $user[0];
} else redirect(uri_resolve('/admin/users')); 

admin_template("Profile " . $user->username, $menu, function() {
    global $user;
    ?>
    <h1><?= $user->first_name . "'s profile" ?></h1>
    <?php
});
