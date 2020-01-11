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

<h1>My blog</h1>

<h3>Featured post:</h3>
<?php var_dump($input_data) ?>

        <?php
    }

    public $title = "Home";

}

ph_register("@this", "templates", "homepage", "Example_HomepageTemplate");