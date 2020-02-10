<?php
/**
 * View the documentation!
 */
require_once 'admin-setup.php';
login_required();

array_push($requested_header_scripts, request_script('https://cdn.jsdelivr.net/npm/showdown@1.9.1/dist/showdown.min.js'));

admin_template("Documentation", $menu, function() {
    ?>
    <h1>Documentation</h1>
    <script>
        let converter = new showdown.Converter();
        console.log(converter);
    </script>
    <?php
}, "item:documentation");