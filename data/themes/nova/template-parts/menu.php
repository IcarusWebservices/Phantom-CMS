<?php
if(isset($data["active_id"])) {
    $active_id = $data["active_id"];
} else $active_id = null;

// var_dump($active_id);

$menu = get_menu('main');

foreach ($menu as $item) {

    if($item->hasSubItems()) {
        ?>
        <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link" href="<?= ph_pattern($item->links_to) ?>">
                <?= $item->display_text ?>
            </a>

            <div class="navbar-dropdown">
            <?php
                $subs = $item->sub_items;
                foreach ($subs as $sub) {
                    ?>

                    <div class="nav-btn">
                        <a href="<?= ph_pattern($sub->links_to) ?>"><?= $sub->display_text ?></a>
                    </div>

                    <?php
                }
            ?>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="nav-btn">
            <a href="<?= ph_pattern($item->links_to) ?>"><?= $item->display_text ?></a>
        </div>
        <?php
    }

}
?>

