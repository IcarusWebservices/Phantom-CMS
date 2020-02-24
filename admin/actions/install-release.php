<?php
require_once '../admin-setup.php';
login_required();

header('Content-Type: application/json');

if(qp_set('step') && qp_set('id')) {
    $id = qp_get('id');
    if(is_numeric(qp_get('step'))) {
        switch((int) qp_get('step')) {

            case 1:
                $data = PH_Github::getReleaseInfo($id);
                if($data) {
                    echo json_decode($data);
                }
            break;

            case 2:
                $data = PH_Github::getReleaseInfo($id);
                set_time_limit(0);
                //This is the file where we save the    information
                $fp = fopen (ROOT . 'releases/zip/' . $id . '.zip', 'w+');
                //Here is the file we are downloading, replace spaces with %20
                $ch = curl_init(str_replace(" ","%20",$data->zipball_url));
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2');
                curl_setopt($ch, CURLOPT_TIMEOUT, 50);
                // write curl response to file
                curl_setopt($ch, CURLOPT_FILE, $fp); 
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                // get curl response
                curl_exec($ch); 
                curl_close($ch);
                fclose($fp);
            break;

            case 3:
                $zip = new ZipArchive;
                $file = ROOT . 'releases/zip/' . $id . '.zip';
                $res = $zip->open($file);

                if($res === TRUE) {
                    $path = ROOT . 'releases/unpacked/' . $id . '/';
                    $zip->extractTo($path);
                    $zip->close();
                }
            break;

            case 4:
                if(is_dir(ROOT . 'releases/unpacked/' . $id . '/')) {

                    $d = ROOT . 'releases/unpacked/' . $id . '/';

                    $ds = glob($d . '*');

                    if(count($ds) > 0) {
                        $r = $ds[0];
                        echo $r;

                        recursive_file_updater($r . '/', $r . '/');
                    }

                }
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