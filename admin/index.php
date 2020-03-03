<?php
require_once 'admin-setup.php';
login_required();


admin_template("Dashboard", $menu, function() {
global $config, $site, $session;

$dashboard_welcome_text = ['Welcome back', 'Hi', 'Good to see you again', 'Hello', 'Welcome'];
$random = rand(0,count($dashboard_welcome_text) - 1);
// echo $dashboard_welcome_text[$random]
?>

<h1>Welcome back, <span style="color: #1f996a;"><?= $session->user->username ?></span>!</h1>

<section class="card full">
    <h2>Look! It's a container!</h2>
    <p>This dashboard will be container-based, to help the user distinguish between the different areas of the dashboard.</p>
</section>

<section class="card">
    <h2>New UI elements</h2>
    <p><i>New buttons for use in Phantom&trade; CMS</i></p>
    <br>
    <p>These buttons use classes to change their appearance. You can control the size, shape, color and state of the button. The top left button is default.</p>
    <br>
    <p><strong>Syntax example:</strong></p>
    <p>&lt;a class="button rounded small purple outline"&gt;Button&lt;/a&gt;</p>
    <br><br>
    <a href="#" style="margin-right: 8px" class="button">Button</a>
    <a href="#" style="margin-right: 8px" class="button semi-rounded">Button</a>
    <a href="#" style="margin-right: 8px" class="button rounded">Button</a>
    <br><br>
    <a href="#" style="margin-right: 8px" class="button red">Button</a>
    <a href="#" style="margin-right: 8px" class="button red semi-rounded">Button</a>
    <a href="#" style="margin-right: 8px" class="button red rounded">Button</a>
    <br><br>
    <a href="#" style="margin-right: 8px" class="button orange">Button</a>
    <a href="#" style="margin-right: 8px" class="button orange semi-rounded">Button</a>
    <a href="#" style="margin-right: 8px" class="button orange rounded">Button</a>
    <br><br>
    <a href="#" style="margin-right: 8px" class="button blue">Button</a>
    <a href="#" style="margin-right: 8px" class="button blue semi-rounded">Button</a>
    <a href="#" style="margin-right: 8px" class="button blue rounded">Button</a>
    <br><br>
    <a href="#" style="margin-right: 8px" class="button purple">Button</a>
    <a href="#" style="margin-right: 8px" class="button purple semi-rounded">Button</a>
    <a href="#" style="margin-right: 8px" class="button purple rounded">Button</a>
    <br><br>
    <a href="#" style="margin-right: 8px" class="button purple outline">Button</a>
    <a href="#" style="margin-right: 8px" class="button purple outline semi-rounded">Button</a>
    <a href="#" style="margin-right: 8px" class="button purple outline rounded">Button</a>
    <br><br>
    <a href="#" style="margin-right: 8px" class="button disabled">Button</a>
    <a href="#" style="margin-right: 8px" class="button semi-rounded disabled">Button</a>
    <a href="#" style="margin-right: 8px" class="button rounded disabled">Button</a>
</section>

<?php
}, "item:dashboard", null);