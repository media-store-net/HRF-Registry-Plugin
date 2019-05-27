<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 22.05.2019
 * Time: 18:41
 */

?>
<div class="alert alert-danger">
	<?php foreach ( $errors as $key => $text ): ?>
        <p>
			<?php
			foreach ( $text as $value ):
				print $value;
			endforeach;
			?>
        </p>
	<?php endforeach; ?>
</div>

