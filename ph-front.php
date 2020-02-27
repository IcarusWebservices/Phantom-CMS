<?php
/**
 * Renders the front-end application
 * 
 * Requires that ROOT and SETUP has been defined
 * 
 * @since 2.0.0
 */
defined("ROOT") && defined("SETUP") or (die("This is an illegal route, please route through index.php"));

if($config->is_multisite) {
    $uri = $request->request_uri;
    $try = explode('/', $uri);

    if(isset($try[0])) {
        $site_try = $try[0];
    } else $site_try = $try;

    $avsites = PH_Query::sites([]);

    $found = false;

    /**
     * The queried site info
     */
    $q_site = null;

    foreach ($avsites as $st) {
        if($site_try == $st->slug && !$found) {
            $found = true;
            $q_site = $st;
        }
    }

    if($found) {
        $request->applyBaseURI($site_try);
        $site = $site_try;
    } else {
        $site = null;
    }
}

// ======== Load the logic-packs ========

$______where = ["==enabled" => 1];

if($q_site) {
    $______where["==site"] = $q_site->id;
} else $______where["NLsite"] = null;

$packs = PH_Query::logic_packs($______where);

$loaded_packs = [];
$routes = [];

foreach ($packs as $pack) {
    
    $folder = $pack->folder_name;

    // Try to split it for projects
    $s = explode(':', $folder);

    // var_dump($s);

    if(count($s) > 1) {
        $project = $s[0];
        $logic_pack = $s[1];

        $path = DATA . 'projects/' . $project . '/logic-packs/' . $logic_pack . '/';
    } else {
        $path = DATA . 'logic-packs/' . $s[0] . '/';
    }

    $json = PH_Loader::loadLogicPack($path);

    if($json) {

        if(isset($json->routes)) {
            foreach ($json->routes as $pattern => $proporties) {
                $routes[$pattern] = $proporties;
            }
        }

        if(isset($json->editors)) {
            $e = $json->editors;
            if(isset($e->record_types)) {
                foreach ($e->record_types as $type => $fields) {
                    if($fields) {
                        foreach ($fields as $field_name => $field) {
                            registry()->register('editors', 'record-types/' . $type . '/' . $field_name, $field);
                        }
                    }
                }
            }
        }
        
        array_push($loaded_packs, $json);
    }
}

$t_q = PH_Query::settings([
    "==setting_key" => "appearance_theme",
    "==site" => isset($q_site->id) ? $q_site->id : null 
]);

if(count($t_q) > 0) {
    $theme_folder = $t_q[0]->value;

    // Try to split it for projects
    $s = explode(':', $theme_folder);

    // var_dump($s);

    if(count($s) > 1) {
        $project = $s[0];
        $t = $s[1];

        $path = DATA . 'projects/' . $project . '/themes/' . $t . '/';
    } else {
        $path = DATA . 'themes/' . $s[0] . '/';
    }

    $loaded = PH_Loader::loadTheme($path);

    if($loaded) {
        $theme_data = $loaded;
    } else {
        $theme_valid = false;
    }
} else {
    $theme_valid = false;
}

// die;

$front = new PH_Front_End;
$result = $front->render( 0 );

if(var_instanceof($result, 'PH_DisplayEngine_Document')) {
    $result->render();
} else if(var_inherits($result, 'PH_Template')) {

    $document = PH_DisplayEngine::generateHTML5($result);
    $document->http_response_code = 200;

    $document->render();

}