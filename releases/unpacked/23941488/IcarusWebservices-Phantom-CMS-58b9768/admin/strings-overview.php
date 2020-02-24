<?php
/**
 * Strings overview
 * 
 * @since 2.0.0
 */
require_once 'admin-setup.php';
login_required();

$language = qp_set('code') ? qp_get('code') : 'en';

admin_template("Strings", $menu, function() {
    global $language;
    // Hardcoded languages by default:
    $default_languages = array(
        'English (Used if string is not available in language)' => 'en',
        'Dutch (Nederlands)' => 'nl',
        'Spanish' => 'es',
        'German' => 'de'
    );

    ?>
    <div class="" id="snackbar-saved">Strings saved!</div>
    <small>Alternatively, you can also edit strings within the <a href="#" class="link">Customizer</a>.</small>
    <h1>Strings</h1> <a href="#" id="save" class="button">Save</a>
    <label for="language">Language: </label><select id="langselect">
        <?php
            foreach ($default_languages as $display => $value) {
                ?><option value="<?= $value ?>" <?php if($value == $language) echo "selected"; ?>><?= $display ?></option><?php
            }
        ?>
    </select>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>String ID</th>
                <th>Value</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <form id="stringscontainer">
            <?php

                $strings = PH_Query::strings([]);
                $values = [];

                foreach ($strings as $string) {
                    if(isset($values[$string->string_name])) {
                        if(!var_check(TYPE_STRING, $values[$string->string_name])) {
                            if($string->language_code == $language) {
                                $values[$string->string_name] = $string->string_value;
                            }
                        }
                    } else {
                        if($string->language_code == $language) {
                            $values[$string->string_name] = $string->string_value;
                        } else {
                            $values[$string->string_name] = null;
                        }
                    }
                }

                foreach ($values as $string_name => $value) {
                    ?>
                    <tr>
                        <td></td>
                        <td><?= $string_name ?></td>
                        <td><textarea class="stringbar" type="text" style="height: 100px; resize: none;" name="<?= $string_name ?>:<?= $language ?>"><?= $value ?></textarea></td>
                        <td><a href="#" class="link">Delete</a> -- <a href="#" class="link">Purge for all</a></td>
                    </tr>
                    <?php
                }

            ?>
            </form>
        </tbody>
    </table>
    <script src="<?= uri_resolve('/admin/js/ajax.js') ?>"></script>
    <script src="<?= uri_resolve('/admin/js/strings.js') ?>"></script>
    <?php
}, "collection:appearance", "strings");