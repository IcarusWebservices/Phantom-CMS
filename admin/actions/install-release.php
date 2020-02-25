<?php
require_once '../admin-setup.php';
login_required();

header('Content-Type: application/json');

if(qp_set('step') && qp_set('id')) {
    $id = qp_get('id');

    if(is_numeric($id)) $id = (int) $id;

    $release = PH_Query::release([
        "==id" => $id
    ]);

    if(count($release) > 0) $release = $release[0];

    if(is_numeric(qp_get('step'))) {
        switch((int) qp_get('step')) {

            case 1:
                
            break;
    
        }
    }
}

function recursive_file_updater($dir, $basedir) {
    foreach (glob($dir . '*') as $file) {
        if(is_dir($file)) {
            recursive_file_updater($file . '/', $basedir);
        } else {

            $output_file = ROOT . 'test/' . substr($file, strlen($basedir));
            
            $subdirs = substr($dir, strlen($basedir));

            $parts = explode('/', $subdirs);

            $prevdir = ROOT . 'test/';
            foreach ($parts as $dir) {
                if(!is_dir($prevdir . $dir . '/')) {
                    mkdir($prevdir . $dir . '/');
                }

                $prevdir = $prevdir . $dir . '/';
            }

            $h = fopen($output_file, 'w+');
            fwrite($h, file_get_contents($file));
        }
    }
}