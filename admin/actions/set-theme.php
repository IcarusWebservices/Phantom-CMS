<?php
require_once '../admin-setup.php';
login_required();

if(qp_set('theme')) {

    $test = PH_Query::settings([
        "==setting_key" => "appearance_theme"
    ]);

    $setting = new PH_Setting([]);
    $setting->key = "appearance_theme";
    $setting->value = qp_get('theme');

    if(count($test) > 0) {
        $setting->exists_on_db = true;
    } else $setting->exists_on_db = false;

    PH_Save::setting($setting);

    redirect(uri_resolve('/admin/set-theme'));

}