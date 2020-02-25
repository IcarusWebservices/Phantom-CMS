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

    if(count($release) > 0) {
        $release = $release[0];

        if(is_numeric(qp_get('step'))) {
            switch((int) qp_get('step')) {

                case 1:
                    $url = $release->zipball;
                    set_time_limit(0);
                    //This is the file where we save the    information
                    $fp = fopen (ROOT . 'releases/zip/' . $release->id . '.zip', 'w+');
                    //Here is the file we are downloading, replace spaces with %20
                    $ch = curl_init(str_replace(" ","%20",$url));
                    curl_setopt($ch, CURLOPT_TIMEOUT, 50);
                    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2');
                    // write curl response to file
                    curl_setopt($ch, CURLOPT_FILE, $fp); 
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                    // get curl response
                    curl_exec($ch); 
                    curl_close($ch);
                    fclose($fp);
                break;

                case 2:
                    if(!is_dir(ROOT . 'releases/unpacked/' . $release->id . '/')) {
                        if(file_exists(ROOT . 'releases/zip/' . $release->id . '.zip')) {
                            $zip = new ZipArchive;
                            $res = $zip->open(ROOT . 'releases/zip/' . $release->id . '.zip');
                            if($res === TRUE) {
                                if(!is_dir(ROOT . 'releases/unpacked/' . $release->id . '/')) {
                                    mkdir(ROOT . 'releases/unpacked/' . $release->id . '/');
                                }
                                $zip->extractTo(ROOT . 'releases/unpacked/' . $release->id . '/');
                            }
                        }
                    }

                    $f = glob(ROOT . 'releases/unpacked/' . $release->id . '/*');

                    if(count($f) > 0) {
                        if(is_dir($f[0])) {

                            // Install this directory
                            install_unpacked($f[0] . '/');

                        }
                    }
                break;
        
            }
        }
    } 
}

function install_unpacked($dir) {
    recursive_file_updater($dir, $dir);
}

function recursive_file_updater($dir, $basedir) {
    foreach (glob($dir . '*') as $file) {
        if(is_dir($file)) {
            recursive_file_updater($file . '/', $basedir);
        } else {

            $output_file = ROOT . substr($file, strlen($basedir));
            
            $subdirs = substr($dir, strlen($basedir));

            $parts = explode('/', $subdirs);

            $prevdir = ROOT;
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