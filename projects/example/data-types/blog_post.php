<?php
/**
 * (Example)
 * 
 * Blogpost datatype
 */
class Example_BlogPostDataType extends PH_Data_Type {

    public function process_content($content) {
        return [
            "content" => $content
        ];
    }

}

ph_register("@this", "datatypes", "blogpost", [
    "class" => "Example_BlogPostDataType",
    "displayTitle" => "Blog Posts"
]);