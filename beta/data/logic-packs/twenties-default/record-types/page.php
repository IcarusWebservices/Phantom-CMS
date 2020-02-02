<?php

class PageRecordType extends PH_Record_Type {

    public function processContent($content) {

        /*
            $object = PH_Parsed_Content;
            $js = $content->to_json();
            $object->set("Components", $components);
        */

    }

    public function saveRecord($rawEditorData, $previousRecord = null) {

    }

}

$export = new PH_Export('page');
$export->setProperty('class', 'PageRecordType');

return $export;