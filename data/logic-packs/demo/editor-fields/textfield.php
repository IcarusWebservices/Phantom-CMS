<?php
/**
 * Demo text field editor
 * 
 * @since 2.0.0
 */
class Demo_Textfields extends PH_Editor_Field {

    public function render($export_id, $predata, $required = false) {
        global $requested_header_scripts;

        array_push($requested_header_scripts, request_script('https://cdn.tiny.cloud/1/i08egnb6jplk781bjqpoonahbcijqkmz83dqbf4x4ci7amh7/tinymce/5/tinymce.min.js', null, 'referrerpolicy="origin"'))
        ?>
        <textarea name="<?= $export_id ?>:textfield" height="500px" <?php 
            if($required) {
                echo 'required';
            }
        ?> id="<?= $export_id ?>">
            <?php
                if($predata) {
                    echo($predata);
                }
            ?>
        </textarea>
        <script>
            tinymce.init({
            selector: 'textarea',
            plugins: 'a11ychecker advcode casechange formatpainter linkchecker lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
            toolbar_drawer: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            height: "500",
            setup: function(editor) {
                editor.on('input', function(e) {
                    isInUnsavedState = true;
                    // console.log(tinymce.activeEditor.getContent());
                    document.getElementById('<?= $export_id ?>').innerHTML = tinymce.activeEditor.getContent();
                })
            }
            });
        </script>
        <?php
    }

    public function processRawInputData($inputData) {

        $text_field = $inputData["textfield"];

        return $text_field;

    }

}

return new PH_Export('demotextfield', [
    "class" => "Demo_Textfields"
]);