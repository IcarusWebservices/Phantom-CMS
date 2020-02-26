<?php
/**
 * Saves a setting
 * 
 * @since 2.0.0
 */
require_once '../admin-setup.php';
login_required();

header('Content-Type: application/json');

if(fd_set('setting_id', 'setting_value')) {

    $id = fd_get('setting_id');
    $value = fd_get('setting_value');

    $existing = PH_Query::settings([
        "==setting_key" => $id
    ]);

    $setting = new PH_Setting([
        "key" => $id,
        "value" => $value,
        "site" => $site_id
    ]);

    if(count($existing) > 0) {
        $setting->exists_on_db = true;
    } else {
        $setting->exists_on_db = false;
    }

    // var_dump($setting);

    $r = PH_Save::setting($setting);

    if($r->hasResult()) {
        echo json_encode([
            "error" => false
        ]);
    } else {
        echo json_encode([
            "error" => true
        ]);
    }

}