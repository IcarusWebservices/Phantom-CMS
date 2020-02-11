<?php
require_once '../admin-setup.php';
login_required();

header('Content-Type: application/json');

if(qp_set('action')) {

    switch(qp_get('action')) {

        case 'delete':
            if(qp_set('id')) {

                $id = (int) qp_get('id');

                $r = database()->delete('ph_users', [
                    "==id" => $id
                ]);


                if($r->hasResult()) {
                    echo json_encode([
                        "error" => false
                    ]);
                } else {
                    echo json_encode([
                        "error" => true
                    ]);
                }
                

            } else {
                echo json_encode([
                    "error" => true
                ]);
            }
        break;

        case 'create':
            if(fd_set('username', 'email', 'password')) {
                $username = fd_get('username');
                $email = fd_get('email');
                $password = fd_get('password');

                $hashed = password_hash($password, PASSWORD_DEFAULT);

                $r = database()->insert('ph_users', [
                    "user_username" => $username,
                    "user_password" => $hashed,
                    "user_email" => $email
                ]);

                if($r->hasResult()) {
                    echo json_encode([
                        "error" => false
                    ]);
                } else {
                    echo json_encode([
                        "error" => true
                    ]);
                }
            } else {
                echo json_encode([
                    "error" => true
                ]);
            }
        break;

    }

}