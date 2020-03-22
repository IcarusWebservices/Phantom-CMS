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
    <link rel="stylesheet" href="css/components.css">
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
                        <ul class="accordion-dropdown collapse">
                    
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

            <?php if($config->is_multisite) {
                $sites = PH_Query::sites([]);
                $site_still_exists = false;
                ?>

                <div id="siteselect" class="ph-dropdown">
                    <button id="dropdownSiteSelect" type="button" class="dropdown-toggle">
                        <i class="fas fa-globe"></i><p><?php
                            // Get name of current site
                            foreach ($sites as $st) {
                                if($st->slug == $site) {
                                    echo $st->name;
                                }
                            }
                        ?></p>
                    </button>
                    <ul aria-labelledby="dropdownSiteSelect" class="dropdown-menu" x-placement="bottom-start">
                        <li><a class="dropdown-item<?php if (!$site) { echo ' selected'; $site_still_exists = true; } ?>" data-value="__def" role="button">-- Main --</a></li>
                        <?php
                            foreach ($sites as $st) {
                                ?>
                                <li>
                                    <a class="dropdown-item<?php
                                        if($st->slug == $site) {
                                            echo ' selected';
                                            $site_still_exists = true;
                                        }
                                    ?>" data-value="<?= $st->slug ?>" role="button"><?= $st->name ?></a>
                                </li>
                                <?php
                            }
                        ?>
                    </ul>
                </div>
                <a class="button semi-rounded" href="?site=<?php
                    if($site_still_exists) {
                        echo $site;
                    } else {
                        echo "__def";
                    }
                ?>">↻</a>
                <?php
            }
            ?>
            
            <div class="nav-button"><span><a href="/<?= $site ?>" target="__blank">Open website</a></span></div>
            
        </div>
        <div class="nav-right">
            <div class="nav-button dropdown-button notification-ddb"><i class="far fa-bell badge" data-count="3"></i></div>
            <ul class="notification-dropdown dropdown">
                <h2 style="margin: 4px 0 4px 18px;">Notifications</h2>
                <?php
                if($config->is_multisite) {
                    ?>
                    <li class="new">
                        <a href="#">
                            <span>Multisite network enabled!</span>
                            <span class="date-time">now</span>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li class="new">
                    <a href="#">
                        <span>New buttons added</span>
                        <span class="date-time">1 hour ago</span>
                    </a>
                </li>
                <li class="new">
                    <a href="#">
                        <span>Notification area added</span>
                        <span class="date-time">7 hours ago</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span>New Phantom update available</span>
                        <span class="date-time">2 days ago</span>
                    </a>
                </li>
            </ul>
            <div class="nav-button dropdown-button action-ddb"><i class="fas fa-ellipsis-v"></i></div>
            <ul class="action-dropdown dropdown">
                <li><a href="#"><i class="fas fa-user"></i>Account</a></li>
                <li><a href="logout.php"><i class="fas fa-power-off"></i>Logout</a></li>
            </ul>

        </div>
    </div>
    <div class="content">
    
        <div id="app">
            <p>{{ message }}</p>
        </div>
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
    <script src="/admin/js/front.js"></script>
    <script src="https://kit.fontawesome.com/9d8cef91c5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="/admin/js/vue/core/vue.js"></script>
    <script src="/admin/js/vue/core/vue-router.js"></script>
    <script src="/admin/js/vue/vue.js"></script>
    <script>
        // Site Selector
        let siteOptions = document.querySelectorAll('#siteselect a.dropdown-item');

        if (siteOptions) {
            siteOptions.forEach((el) => {
                el.addEventListener('click', () => {
                    let lang = el.dataset.value;
                    window.open('<?= $site_uri ?>site=' + lang, '_self');
                });
            });
        }
    </script>
</body>
</html>
    <?php
}