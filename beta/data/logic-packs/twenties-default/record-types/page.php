<?php

class PageRecordType {

    public function processContent($content) {

        /*
            $object = PH_Parsed_Content;
            $js = $content->to_json();
            $object->set("Components", $components);
        */

    }

    public function saveRecord($rawEditorData) {

    }

}

$export = new PH_Export('page');
$export->setProperty('class', 'PageRecordType');

return $export;