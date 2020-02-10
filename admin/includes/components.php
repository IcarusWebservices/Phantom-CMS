<?php
/**
 * The template function
 */
function admin_template($title, $menu, $content, $current_id = null, $current_subitem_id = null) {
    global $requested_body_scripts, $requested_header_scripts, $requested_stylesheets;
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
                <a href="#">Support</a>
                <a href="#">Legal &amp; Privacy</a>
            </nav>
            <p>© Icarus Webservices, 2020</p>
          </footer>
    </nav>
    <div class="actionbar">
        <div class="nav-left">
            <div class="nav-button"><span><a href="/" target="__blank">Open website</a></span></div>
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
    <script>
        console.log('%c Phantom – Javascript initiated!', 'color: #29cc8d; font-weight: bold;');

        const sidebar = document.querySelector('.menu');
        const sidebarBurger = document.querySelector('.menu-burger');
        const accordionTitles = document.querySelectorAll('.accordion-title');
	    var menuState = 1; // 1 = visible, 0 = hidden
	    
	function menuStateWidth() {
		if (window.innerWidth <= 768) {
			sidebar.classList.add('hidden');
			menuState = 0;
		} else {
			sidebar.classList.remove('hidden');
			menuState = 1;
		}
	}
	    
	menuStateWidth();
        
        sidebarBurger.onclick = () => {
	        // sidebar.classList.toggle('hidden'); // Deprecated for this purpose because the class may already exist due to the function menuStateWidth().
		if (menuState == 1) {
			sidebar.classList.add('hidden');
			menuState = 0;
			console.log('%c New menuState = ' + menuState, 'color: red;');
		} else {
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

	
	window.onresize = menuStateWidth();
    </script>
</body>
</html>
    <?php
}