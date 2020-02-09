<?php
require_once 'admin-setup.php';
login_required();

admin_template("Dashboard", $menu, function() {
?>

    <div class="widget">
        <h1>Views</h1>
        <p>
            <?php

                // Try to query for a record named SYSTEM_VIEWS for record type SYSTEM
                $views = PH_Query::records([
                    "==record_type" => "SYSTEM",
                    "==record_slug" => "SYSTEM_VIEWS"
                ]);

                if(count($views) > 0 ) {
                    $data = $views[0];

                    $content = $data->processed_content;
                    $content = json_decode($content);

                    ?>
                    <span>Total page loads: <b><?= $content->total ?></b></span>
                    <?php
                } else {
                    database()->insert('ph_records', [
                        'record_type',
                        'record_status',
                        'record_slug',
                        'record_title',
                        'record_content',
                        'record_created_gmt',
                        'record_author'
                    ], [
                        'SYSTEM',
                        'SYSTEM',
                        'SYSTEM_VIEWS',
                        'SYSTEM_VIEWS',
                        '{ "total": 0 }',
                        date("Y-m-d H:i:s"),
                        '0'
                    ]);
                }

            ?>
        </p>
    </div>

<?php
}, "item:dashboard", null);