<?php
/**
 * This function renders a template
 * 
 * @param PH_Template $template The template to render
 * 
 * @since 2.0.0
 */
function render_template($template) {
    ob_start();
    $data = $template->__get_data();
    $string_output = $template->render($data);
    $output = ob_get_clean();
    if($string_output) {
        $output = $string_output;
    }
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
        $stylesheets = $template->requested_stylesheets;
        foreach ($stylesheets as $stylesheet) {
            if(var_instanceof($stylesheet, 'PH_Requested_Stylesheet')) {
                $stylesheet->render();
            }
        }
    ?>
    <title><?= $template->requested_title ?></title>
</head>
<body>
    <?= $output ?>
</body>
</html>
<?php
$full = ob_get_clean();

$document = new PH_Document($full, 200);
return $document;
}