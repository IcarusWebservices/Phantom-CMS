<?php
/**
 * The routes.
 * [:route] = ":controller_class/:method"
 */
$routes["/"] = "homepage_controller/main";

$routes["/posts"] = "blog/overview";

$routes['/posts/:post_slug'] = "blog/single";