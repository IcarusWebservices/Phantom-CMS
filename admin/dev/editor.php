<?php
    require "dev-setup.php";

    if(!ph_qp_set("proj")) {
        ph_redirect("admin/dev/");
    }

    $proj = ph_qp_get("proj");

    $project_files = ph_createdirtree(PH_PROJECTS . $proj . '/');

    ph_dev_header("Editor");

    ph_dev_navbar(null);
    ?>
    <hr>
    <b>Files:</b>
    <ul>
    <?php
    function recursiveArrayWalker($array, $basedir) {
        foreach ($array as $name => $items) {
            if($name == "__FILES__") {
                foreach ($items as $file) {
                    ?>
                    <li><a href="#" class="file-selector" data-file-path="<?= $file ?>"><?= substr($file, strlen($basedir)) ?></a></li>
                    <?php
                }
            } else {
                ?>
                <li>
                    <?= substr($name, strlen($basedir)) ?>
                    <ul>
                    <?php
                    recursiveArrayWalker($items, $basedir . substr($name, strlen($basedir)) . '/');
                    ?>
                    </ul>
                </li>
                <?php
            }
        }
    }

    recursiveArrayWalker($project_files, PH_PROJECTS . $proj . '/');
    ?>
    </ul>
    <hr>
    <div id="editor"></div>
    <script src="<?= ph_uri_resolve("admin/dev/js/ace/ace.js"); ?>"></script>
    <script src="<?= ph_uri_resolve("admin/dev/js/ace/theme-twilight.js"); ?>"></script>
    <script src="<?= ph_uri_resolve("admin/dev/js/ace/mode-php.js"); ?>"></script>
    <script src="<?= ph_uri_resolve("admin/dev/js/editor.js"); ?>"></script>
</body>
</html>