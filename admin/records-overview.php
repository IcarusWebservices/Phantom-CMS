<?php
/**
 * Records overview page
 */
require_once 'admin-setup.php';
login_required();

if(!qp_set('type')) {
    redirect(uri_resolve('/admin/index'));
}

$type = qp_get('type');

echo $type;