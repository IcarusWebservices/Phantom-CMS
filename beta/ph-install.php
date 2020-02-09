
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="core/pages/css/install.css">
    <title>Install Phantom</title>
</head>
<body>
    <?php
    /**
     * Installs Phantom
     * 
     * @since 2.0.0
     */

    if(!empty($_POST)) {
        
        $database = [
            "hostname" => isset($_POST["db_hostname"]) ? $_POST["db_hostname"] : null,
            "username" => isset($_POST["db_username"]) ? $_POST["db_username"] : null,
            "password" => isset($_POST["db_password"]) ? $_POST["db_password"] : null,
            "name" => isset($_POST["db_database"]) ? $_POST["db_database"] : null
        ];

        try {
            $db = new PDO('mysql:host='. $database["hostname"] .';dbname='. $database['name'] .';charset=utf8mb4', $database["username"], $database["password"]);

        } catch(PDOException $e) {
            ?>
            <div class="error">Invalid Connection (error message: <?= $e->getMessage() ?></div>
            <?php
        }

    }

    ?>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
    
        <div class="container" data-container="0">
            <div class="logo">
                <h1>Database</h1>
            </div>
            <label for="db_hostname">Database Host</label>
            <input type="text" name="db_hostname" value="<?= isset($_POST["db_hostname"]) ? $_POST["db_hostname"] : "" ?>"><br>
            <label for="db_username">Database Username</label>
            <input type="text" name="db_username" autocomplete="nope" value="<?= isset($_POST["db_username"]) ? $_POST["db_username"] : "" ?>"><br>
            <label for="db_password">Database Password</label>
            <input type="password" name="db_password" autocomplete="new-password" value="<?= isset($_POST["db_password"]) ? $_POST["db_password"] : "" ?>"><br>
            <label for="db_database">Database Name</label>
            <input type="text" name="db_database" value="<?= isset($_POST["db_database"]) ? $_POST["db_database"] : "" ?>"><br>
            <a href="#" class="next">Next</a>
        </div>

        <div class="container" data-container="1">
            <div class="logo">
                <h1>Admin User</h1>
            </div>
            <label for="admin_username">Username</label>
            <input type="text" name="admin_username" value="<?= isset($_POST["admin_username"]) ? $_POST["admin_username"] : "" ?>"><br>
            <label for="admin_password">Password</label>
            <input type="text" name="admin_password" value="<?= isset($_POST["admin_password"]) ? $_POST["admin_password"] : "" ?>"><br>
            <a href="#" class="prev">Previous</a>
            
            <input type="submit" value="Install">
        </div>
    
    </form>
    <script>
    
    let activeContainer = 0;

    showActive(activeContainer);

    document.querySelectorAll('.next').forEach((e) => e.addEventListener('click', (ev) => {

        activeContainer = activeContainer + 1;
        showActive(activeContainer);

    }))

    document.querySelectorAll('.prev').forEach((e) => e.addEventListener('click', (ev) => {

        activeContainer = activeContainer - 1;
        showActive(activeContainer);

    }))

    function showActive(acont) {
        console.log(acont);
        let selection = document.querySelectorAll('.container');
        selection.forEach(element => {
            if(element.dataset.container == acont) {
                element.style.display = "block";
            } else {
                element.style.display = "none";
            }
            
        });
    }
    
    </script>
</body>
</html>