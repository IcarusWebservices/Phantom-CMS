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
        if($previousRecord) {
            $content = isset($rawEditorData["content:textfield"]) ? $rawEditorData["content:textfield"] : null;
            $previousRecord->content = $content;
            $previousRecord->title = $rawEditorData["system:title"];

            return $previousRecord;
        } else {
            $newRecord = new PH_Record([
                "title" => $rawEditorData["system:title"]
            ]);
            return $newRecord;
        }

    }

    public function provideEditordata($content) {
        return [
            "content" => $content
        ];
    }

}

return export('demopost', [
    "class" => "Demo_Post_Record_Type",
    "displayName" => "Posts",
    "displayInAdmin" => true
]);