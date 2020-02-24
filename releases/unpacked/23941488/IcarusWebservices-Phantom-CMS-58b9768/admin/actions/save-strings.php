<?php
require_once '../admin-setup.php';
login_required();

header('Content-Type: application/json');

$successes = 0;

foreach ($_POST as $id => $value) {
    $try_explode = explode(':', $id);

    if(count($try_explode) == 2) {
        $field = $try_explode[0];
        $lang = $try_explode[1];

        $exists = PH_Query::strings([
            "==string_name" => $field,
            "==language_code" => $lang
        ]);


        if(count($exists) > 0) {
            $r = database()->update("ph_strings", [
                "string_value" => $value
            ], [
                "==string_name" => $field,
                "==language_code" => $lang
            ]);

            if($r->hasResult()) $successes++;
        } else {
            $r = database()->insert("ph_strings", [
                "language_code" => $lang,
                "string_name" => $field,
                "string_value" => $value
            ]);

            if($r->hasResult()) $successes++;
        }
    }
}

echo json_encode([
    "s" => $successes
]);
