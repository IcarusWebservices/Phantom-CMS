<?php

function demo_render_post($post) {
    ?>
    <div>
        <h1 style="font-size: 1.5rem;"><?= $post->title ?></h1>
        <p>
            <?php
                // var_dump($post);
                if($post->processed_content) {
                    if(strlen($post->processed_content) > 1000) {
                        $sb = substr($post->processed_content, 0, 1000) . '...';
                        echo $sb;
                    } else echo $post->processed_content;
                } elseif( var_check( TYPE_STRING, $post->content ) ) {
                    if(strlen($post->content) > 1000) {
                        $sb = substr($post->content, 0, 1000) . '...';
                        echo $sb;
                    } else echo $post->content;
                }

                
            ?>
            <a href="<?= uri_resolve('/posts/' . $post->slug) . '?origin=' . uri_resolve('/posts') ?>" class="link">Read more</a>
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
    </pre>
    <?php
}

?>
