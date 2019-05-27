<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 25.05.2019
 * Time: 17:42
 *
 * @var $ids | array
 */
?>
<nav id="navbar" class="navbar nav-pills navbar-light bg-light" style="position: fixed; right: 0; width: calc(100% / 12 * 2.5);">
	<?php foreach ( $ids as $id => $text ) { ?>
        <a class="nav-link" href="#<?= $id ?>"><?= $text ?></a>
	<?php } ?>
</nav>
