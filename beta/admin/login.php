<?php
    require_once 'admin-setup.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= uri_resolve('/admin/css/login.css') ?>">
    <title>Login • Phantom CMS</title>
</head>
<body>
    <div class="illustration">
        <img src="/admin/img/ph-spooked.png" alt="Phantom illustration">
    </div>
    <div class="login-box" data-active="0">
        <form method="POST" action="<?= uri_resolve('/admin/actions/login') ?>">
            <h1>Phantom</h1>
            <input type="hidden" name="redirect" value="<?= qp_set('redirect') ? qp_get('redirect') : '/admin' ?>">
            <div class="field">
                <label for="username">Username</label>
                <input type="text" name="username" id="login-username">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" name="password" id="login-password">
            </div>
            <a href="#" class="forgot-password" data-forward="1">Forgot password?</a>
            <input type="submit" value="Login">
        </form>
    </div>

    <div class="login-box" data-active="1">
        <form method="POST">
            <h1>Password forgotten?</h1>
            <div class="field">
                <label for="forgotten-email">Email</label>
                <input type="text" name="forgotten-email" id="forgotten-email">
            </div>
            <a href="#" class="forgot-password" data-back="1">Go back to login</a>
            <input type="submit" value="Send mail">
        </form>
    </div>

    <script>
        let active = 0;

        let boxes = document.querySelectorAll('.login-box');

        setActive(active);

        document.querySelector('[data-forward="1"]').addEventListener('click', (e) => {
            setActive(active + 1);
        });

        document.querySelector('[data-back="1"]').addEventListener('click', (e) => {
            setActive(active - 1);
        });

        function setActive(act) {
            
            if(act < 0) act = 0;

            boxes.forEach(box => {
                if(box.dataset.active == act) {
                    box.style.display = "block";
                } else {
                    box.style.display = "none";
                }
            })
        }
    </script>
</body>
</html>