<?php
/**
 * Generates a default template if there is a problem with a project or a problem with the routing.
 * 
 * @param int    $code              The error code to display.
 * @param string $code_description  The error code's description. 
 * 
 * @since 1.0.0
 */
function ph_default_code_generator($code, $code_description) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $code ?> - Phantom</title>
</head>
<body>
    <small>Phantom version <?= PH_VERSION ?></small>
    <hr>
    <h1>Phantom responded with code <?= $code ?></h1>
    <p><?= $code_description ?></p>
</body>
</html>
<?php
}