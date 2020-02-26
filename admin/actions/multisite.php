<?php
require_once '../admin-setup.php';
login_required();

if(qp_set('mode')) {

    $mode = qp_get('mode');

    switch($mode) {

        case 'edit':
            if(fd_set('name', 'slug', 'id')) {
                $name = fd_get('name');
                $slug = fd_get('slug');
                $id = fd_get('id');

                if(is_numeric($id) && $name != '' && $slug != '') {

                    $id = (int) $id;

                    $site = PH_Query::sites([
                        "==site_id" => $id
                    ]);

                    if(count($site) > 0) {

                        $site = $site[0];

                        $site->name = $name;
                        $site->slug = $slug;

                        $r = PH_Save::site($site);

                        if($r) redirect(uri_resolve('/admin/multisite-site?id=' . $id));
                        else redirect(uri_resolve('/admin/multisite-site?error=true&id=' . $id));

                    }

                } else {
                    redirect(uri_resolve('/admin/multisite-site?error=true&id=' . $id));
                }
            }
        break;

        case 'new':
            if(fd_set('name', 'slug')) {
                $name = fd_get('name');
                $slug = fd_get('slug');

                if($name != '' && $slug != '') {

                    $site = new PH_Site([
                        "name" => $name,
                        "slug" => $slug
                    ]);

                    $r = PH_Save::site($site);

                    if($r) redirect(uri_resolve('/admin/multisite-site?id=' . $id));
                    else redirect(uri_resolve('/admin/multisite-site?error=true&id=' . $id));

                } else {
                    redirect(uri_resolve('/admin/multisite-site?error=true&id=' . $id));
                }
            }
        break;

        case 'delete':

            if(qp_set('id')) {
                $id = qp_get('id');
                if(is_numeric($id)) {

                    $id = (int) $id;

                    $r = database()->delete('ph_sites', [
                        "==site_id" => $id
                    ]);

                    if($r) redirect(uri_resolve('/admin/multisite'));
                    else redirect(uri_resolve('/admin/multisite?error=true'));

                }

            }

        break;

    }

}