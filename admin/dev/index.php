<?php
require "dev-setup.php";

ph_dev_header("Editor");

ph_dev_navbar(null);
?>

<hr>
<h2>Projects</h2>
<ul>
    <?php

    $dirs_glob = glob(PH_PROJECTS . '*');
    
    foreach ($dirs_glob as $result) {
        if(is_dir($result)) {
            $proj = substr($result, strlen(PH_PROJECTS));
            ?>
            <li>
                <a href="<?= ph_uri_resolve("admin/dev/editor.php?proj=" . $proj) ?>"><?= $proj ?></a>
                
            </li>
            <?php
        }
    }

    ?>
</ul>
</body>
</html>