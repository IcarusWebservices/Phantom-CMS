<?php

function demo_render_post($post) {
    ?>
    <div>
        <h1 style="font-size: 1.5rem;"><?= $post->title ?></h1>
        <p>
            <?php
                if($post->processed_content) {
                    echo $post->processed_content;
                } elseif( var_check( TYPE_STRING, $post->content ) ) {
                    echo $post->content;
                }
            ?>
        </p>
    </div>
    <?php
}

?>
