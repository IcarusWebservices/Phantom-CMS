<?php
/**
 * The Post record type
 * 
 * Represents a post
 * 
 * @since 2.0.0
 */
class Demo_Post_Record_Type extends PH_Record_Type {

    public function processContent($content)
    {
        $json = json_decode($content);

        if($json) {

            $post_format_version = [1,0,0];

            if(isset($json->formatVersion)) {
                $post_format_version = $json->formatVersion;
            }

            $content = $json->content;

        } else {
            return false;
        }
    }

    public function saveRecord($rawEditorData, $previousRecord = null)
    {
        return $previousRecord;
    }

}

return export('demopost', [
    "class" => "Demo_Post_Record_Type",
    "displayName" => "Posts",
    "displayInAdmin" => true
]);