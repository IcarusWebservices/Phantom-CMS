<?php
require_once '../admin-setup.php';
login_required();

if(fd_set('enabled')) {
    $packs = fd_get('enabled');
} else {
    $packs = [];
}

// First, delete all existing records for page
database()->delete('ph_logic_packs', [
    "==site" => isset($q_site->id) ? $q_site->id : null
]);

if(count($packs) > 0) {

    foreach ($packs as $pack) {
        database()->insert('ph_logic_packs', [
            "folder_name" => $pack,
            "enabled" => 1,
            "site" => isset($q_site->id) ? $q_site->id : null
        ]);
    }

}