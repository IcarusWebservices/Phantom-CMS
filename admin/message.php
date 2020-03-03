<?php
require 'admin-setup.php';
login_required();
if(!qp_set('id')) redirect(uri_resolve('/admin'));
$id = qp_get('id');

$record = PH_Query::records([
    "==record_id" => $id
]);

if(count($record) == 0) {
    redirect(uri_resolve('/admin'));
}

$record = $record[0];
$type = $record->type;

if(!registry()->has(CAT_RECORD_MESSAGES, $type)) redirect(uri_resolve('/admin'));

admin_template($record->title, $menu, function() {
global $record, $type;

$type_data = registry()->get(CAT_RECORD_MESSAGES, $type);
// var_dump($type_data);

if(!$type_data->hasProperty('class')) die("INVALID RECORD TYPE");
$class = $type_data->getProperty('class');

if(!class_exists($class)) die("INVALID RECORD TYPE CLASS");

$type_class = new $class;
$record->applyRecordType();
?>
<h1><?= $record->title ?></h1>
<?php

$type_class->renderAdminPanel($record);

}, 'collection:messages', $type);
