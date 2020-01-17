<?php
require "setup.php";

if(ph_qp_set("redirect")) {
    $redirect_to = ph_uri_resolve(ph_qp_get("redirect"));
} else {
    $redirect_to = ph_uri_resolve("admin/");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Select a project - Phantom CMS</title>
    <link rel="stylesheet" type="text/css" href="<?= ph_uri_resolve("admin/css/set-profile.css") ?>">
    <script src="<?= ph_uri_resolve("admin/js/Ajax.js") ?>"></script>
    <script src="<?= ph_uri_resolve("admin/js/Api.js") ?>"></script>
    <script src="<?= ph_uri_resolve("admin/js/build/build.js") ?>"></script>
</head>
<body>
    <h1>Select a project</h1>
    <ul>
        <?php
        $dirs_glob = glob(PH_PROJECTS . '*');
    
        foreach ($dirs_glob as $result) {
            if(is_dir($result)) {
                $proj = substr($result, strlen(PH_PROJECTS));
                ?>
                <li>
                    <a href="#" class="select-project project-item" data-set-project-to="<?= $proj ?>"><?= $proj ?></a>
                </li>
                <?php
            }
        }
        ?>
    </ul>
    <a class="logout" href="<?= ph_uri_resolve("admin/logout.php"); ?>">Log out</a>
    <script>
    
    ph._(".select-project").on("click", (e) => {
        var element = e.target;
        var project = element.dataset.setProjectTo;
        ph.Api.setCurrentWorkingProject(project).then(() => {
            window.open("<?= $redirect_to ?>", "_self");
        }).catch( () => console.error("Could not change project to " + project) );
    })
    
    </script>
</body>
</html>