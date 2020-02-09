<?php

class TestEditorField extends PH_Editor_Field {

    public function renderField($fieldID, $preData)
    {
        ?>
        <textarea style="width: 95%; height: 500px;" class="testEditorField" id="testeditorfield<?= $fieldID ?>"><?php if($preData) echo $preData["text"] ?></textarea>
        <export exportid="<?= $fieldID ?>" keyname="main" datafrom="testeditorfield<?= $fieldID ?>@innerHTML" />
        <?php
    }

}

ph_register("@global", "editorfields", "test-editor", "TestEditorField");