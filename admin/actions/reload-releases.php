<?php
require_once '../admin-setup.php';
login_required();

header('Content-Type: application/json');

// Get the releases from github
$releases = PH_Github::getReleases();

// Delete all rows within the releases table
database()->delete('ph_releases', []);

// Insert the releases into the database
// var_dump($releases);
foreach ($releases as $release) {

    $is_current_version = 0;

    if($release->tag_name == RELEASE_VERSION) {
        $is_current_version = 1;
    }

    database()->insert('ph_releases', [
        "id" => $release->id,
        "version_string" => $release->tag_name,
        "name" => $release->name,
        "is_current_version" => $is_current_version,
        "zipball" => $release->zipball_url,
        "released_at" => $release->published_at
    ]);
}

