<?php
/**
 * (Example)
 * 
 * Blogpost datatype
 */
class Example_BlogPostDataType extends PH_Data_Type {

    public function processContent($content) {
        return [
            "content" => $content
        ];
    }

    public function editorDataToRecord($input) {
        var_dump($input);
    }

}

ph_register("@this", "datatypes", "blogpost", [
    "class" => "Example_BlogPostDataType",
    "displayTitle" => "Blog Posts"
]);