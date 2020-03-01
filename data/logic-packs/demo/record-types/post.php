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
        return $content;
    }

    public function saveRecord($rawEditorData, $previousRecord = null)
    {
        if($previousRecord) {
            $content = isset($rawEditorData["content:textfield"]) ? $rawEditorData["content:textfield"] : "Geen content";
            $previousRecord->content = $content;
            $previousRecord->title = $rawEditorData["system:title"];

            return $previousRecord;
        } else {
            $content = isset($rawEditorData["content:textfield"]) ? $rawEditorData["content:textfield"] : "Geen content";
            $newRecord = new PH_Record([
                "title" => $rawEditorData["system:title"],
                "content" => $content
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