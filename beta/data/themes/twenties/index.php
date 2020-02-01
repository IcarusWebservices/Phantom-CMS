<?php
// Index Template
class IndexTemplate {

    public function template($deliveredData) {
?>
<h1></h1>

<div>

</div>
<?php
    }

}

$export = new PH_Export('index');
$export->setProperty('class', 'IndexTemplate');

return $export;