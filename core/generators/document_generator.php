<?php
/**
 * Generates a document from a Template
 * 
 * @param object $template The template to render. Must inherit PH_Template
 * 
 * @since 1.0.0
 */
function ph_document_generator($template) {
    global $project_runner;

    $referenceID = $template->reference_id;

    if($referenceID) {
        $project = $project_runner->running_project;

        $metaTags = PH_Query::get_meta_tags_by_reference($referenceID, $project);

        
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $template->title ?></title>
    </head>
    <body>
        <?= $template->renderBody( $template->getData() ) ?>
    </body>
    </html>
    <?php
}