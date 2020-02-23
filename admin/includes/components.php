<?php
/**
 * The template function
 */
function admin_template($title, $menu, $content, $current_id = null, $current_subitem_id = null) {
    global $requested_body_scripts, $requested_header_scripts, $requested_stylesheets, $site, $config;
    global $session;
    
    // Render the body before the rest, so that certain scripts & stylesheets can be registered
    ob_start();
    $content();
    $c = ob_get_clean();
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
        foreach ($requested_header_scripts as $script) {
            $script->render();
        }
    ?>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/forms.css">
    <title><?= $title ?> • Phantom CMS</title>
</head>
<body>
    <nav class="menu">
	    <div class="menu-burger"></div>
        <ul>
            <?php

            foreach ($menu as $id => $value) {
                
                $splitted = explode(":", $id);

                $type = $splitted[0];

                $a = "";

                if($id == $current_id ) {
                    $a = "active";
                }


                switch($type) {

                    case "item":
                        ?>
                        <li><a class="menu-item <?= $a ?>" href="<?= uri_resolve("/admin/" . $value["url_to"]) ?>"><?= $value["display"] ?></a></li>
                        <?php
                    break;

                    case "collection":
                        ?>
                        <li class="accordion"><span class="accordion-title <?= $a ?>"><?= $value["display"] ?></span>
                        <ul>
                    
                        <?php
                        foreach ($value["items"] as $id => $value2) {
                            // var_dump($value2);

                            $a2 = null;

                            if($current_subitem_id == $id) {
                                $a2 = "active";
                            }

                            ?>
                            <li><a class="accordion-item <?= $a2 ?>" href="<?= uri_resolve("/admin/" . $value2["url_to"]) ?>"><?= $value2["display"] ?></a></li>
                            <?php
                        }
                        ?>

                        </ul>
                        </li>
                        <?php
                    break;

                }

            }

            ?>
        </ul>
        <footer class="sub-footer">
            <nav class="sub-sidebar">
                <a href="#">FAQ</a>
                <a href="<?= uri_resolve('/admin/docs.php') ?>">Documentation</a>
                <a href="#">Support</a>
                <a href="#">Legal &amp; Privacy</a>
            </nav>
            <p>© Icarus Webservices, 2020</p>
          </footer>
    </nav>
    <div class="actionbar">
        <div class="nav-left">
            <div class="nav-button"><span><a href="/<?= $site ?>" target="__blank">Open website</a></span></div>
            <?php if($config->is_multisite) {
                $sites = PH_Query::sites([]);
                ?>
                <select id="siteselect">
                <option value="__def" <?php if(!$site) echo 'selected'; ?>>-- Main --</option>
                <?php
                    foreach ($sites as $st) {
                        ?><option value="<?= $st->slug ?>" <?php
                            if($st->slug == $site) {
                                echo 'selected';
                            }
                        ?>><?= $st->name ?></option><?php
                    }
                ?>
            </select>
                <?php
            }
            ?>
            
        </div>
        <div class="nav-right">
            <span>Logged in as <span class="username"><?= $session->user->username ?></span></span>
            <div class="nav-button"><span><a href="logout.php">Logout</a></span></div>
        </div>
    </div>
    <div class="content">
    <?php
    echo $c;
    ?>
    </div>
    <?php
    // Request URI filtering for site selection
    $uri = $_SERVER["REQUEST_URI"];

    $site_uri = null;

    $q = explode('?', $uri);

    if(count($q)>1) {
        $site_uri = $uri . '&';
    } else {
        $site_uri = $uri . '?';
    }
    ?>
    <script>
        console.log('%c Phantom – Javascript initiated!', 'color: #29cc8d; font-weight: bold;');

        const actionbar = document.querySelector('.actionbar');
        const sidebar = document.querySelector('.menu');
        const sidebarBurger = document.querySelector('.menu-burger');
        const accordionTitles = document.querySelectorAll('.accordion-title');
	    var menuState = 1; // 1 = visible, 0 = hidden
	    
	function menuStateWidth() {
		if (window.innerWidth <= 768) {
            actionbar.classList.add('full');
			sidebar.classList.add('hidden');
			menuState = 0;
		} else {
            actionbar.classList.remove('full');
			sidebar.classList.remove('hidden');
			menuState = 1;
		}
	}
	    
	menuStateWidth();
        
    sidebarBurger.onclick = () => {
        if (menuState == 1) {
            actionbar.classList.add('full');
            sidebar.classList.add('hidden');
            menuState = 0;
            console.log('%c New menuState = ' + menuState, 'color: red;');
        } else {
            actionbar.classList.remove('full');
            sidebar.classList.remove('hidden');
            menuState = 1;
            console.log('%c New menuState = ' + menuState, 'color: green;');
        }
    }

    accordionTitles.forEach(acc => {
        acc.addEventListener('click', (e) => {
            if (!event.target.classList.contains('active')) {
                event.target.classList.toggle('clicked');
            }
        })
    });

    let select = document.getElementById("siteselect");
    if(select) {
        select.addEventListener('change', (e) => {
            let lang = select.options[select.selectedIndex].value;
            window.open('<?= $site_uri ?>site=' + lang, '_self');
        })
    }


	
	window.onresize = menuStateWidth();
    </script>
</body>
</html>
    <?php
}