<?php
/**
 * GitHub Api wrapper
 */
class PH_Github {

    public static function getReleaseInfo($id) {
        $url = 'https://api.github.com/repos/IcarusWebservices/Phantom-CMS/releases/' . $id;
        $response = PH_Github::doRequest($url);
        return json_decode($response);
    }

    public static function getReleaseAssets($id) {
        $url = 'https://api.github.com/repos/IcarusWebservices/Phantom-CMS/releases/' . $id . '/assets';
        $response = PH_Github::doRequest($url);
        return json_decode($response);
    }

    public static function doRequest($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($ch);
    }

}