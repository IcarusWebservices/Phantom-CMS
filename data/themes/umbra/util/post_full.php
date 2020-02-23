<?php

function demo_render_post_full($post) {
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
        
        <?php
        if($post->author) {

            $author = PH_Query::admin_users([
                "==id" => $post->author
            ]);

            if(count($author) > 0) {
                $author = $author[0];
                ?><small>Written by <?= $author->username ?>. Posted on <?= $post->created_gmt ?></small><?php
            }
        }
        ?>
        
    </div>
    <?php
}

?>
