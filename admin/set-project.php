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
    <title>Select a project</title>

    <script src="<?= ph_uri_resolve("admin/js/Ajax.js") ?>"></script>
    <script src="<?= ph_uri_resolve("admin/js/Api.js") ?>"></script>
</head>
<body>
    <ul>
        <?php
        $dirs_glob = glob(PH_PROJECTS . '*');
    
        foreach ($dirs_glob as $result) {
            if(is_dir($result)) {
                $proj = substr($result, strlen(PH_PROJECTS));
                ?>
                <li>
                    <a href="#" class="select-project" data-set-project-to="<?= $proj ?>"><?= $proj ?></a>
                    
                </li>
                <?php
            }
        }
        ?>
    </ul>
    <script>
    
    var ApiInstance = new Api();

    document.querySelectorAll('.select-project').forEach(element => {
        element.addEventListener('click', (e) => {
            var element = e.target;

            var project = element.dataset.setProjectTo;

            ApiInstance.projectSetWorkingDirectory(project, (r) => {
                console.log("Yellow!");
                if(!r.error) {
                    window.open("<?= $redirect_to ?>", "_self");
                }
            });
        })
    })
    
    </script>
</body>
</html>