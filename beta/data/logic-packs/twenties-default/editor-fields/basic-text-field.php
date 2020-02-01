<?php

class EditorField {

    public $exportData = [
        "main" => "main.innerHTML"
    ];

    public $linkHeaderJavascript = [];
    public $linkBodyJavascript = [];
    public $linkStylesheet = [];

    public function render($field_name) {
        // return html_to_string(["instance"], function($data) {
        // ?>
            <textarea data-element-name="main" data-field-name=""></textarea>
        <?php
        // });   
    }

}

$export = new PH_Export('Basic_editor_field');
$export->setProperty('class', 'EditorFields');

return $export;