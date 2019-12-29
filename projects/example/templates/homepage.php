<?php
/**
 * (Example)
 * 
 * The homepage template
 */
class Example_HomepageTemplate extends PH_Template {

    public function renderBody($input_data)
    {
        ?>
        <h1>What a beautiful homepage, isn't it mister <?= $input_data["name"] ?></h1>
        <?php
    }

}

ph_register("@this", "templates", "homepage", "Example_HomepageTemplate");