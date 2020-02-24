<?php
/**
 * The Post record type
 * 
 * Represents a post
 * 
 * @since 2.0.0
 */
class Demo_Page_Record_Type extends PH_Record_Type {

    public function processContent($content)
    {
        return $content;
    }

    public function saveRecord($rawEditorData, $previousRecord = null)
    {
        if($previousRecord) {
            $content = isset($rawEditorData["content:textfield"]) ? $rawEditorData["content:textfield"] : null;
            $previousRecord->content = $content;
            // $previousRecord->title = $rawEditorData["system:title"];

            return $previousRecord;
        } else {
            $content = isset($rawEditorData["content:textfield"]) ? $rawEditorData["content:textfield"] : null;
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

return export('demopage', [
    "class" => "Demo_Page_Record_Type",
    "displayName" => "Pages",
    "displayInAdmin" => true
]);