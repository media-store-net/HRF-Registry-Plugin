<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 25.05.2019
 * Time: 20:44
 *
 * @var $options array
 */
?>
<div class="form-group">
	<label for="subject3">Betreff der Nachricht</label>
	<input type="text" id="subject3" name="msg3[subject]" class="form-control"
	       value="<?= ! empty( $options['msg3']['subject'] ) ? $options['msg3']['subject'] : '' ?>">
	<br>
	<label for="body3"><?php echo __( 'Inhalt für die Email an Administrator', 'hrf' ); ?></label>
	<?php
	wp_editor( html_entity_decode( $options['msg3']['body'] ), 'body3', $settings =
		array( 'textarea_name' => 'msg3[body]' ) );
	?>
</div>
<div class="">
	<?= submit_button( __( 'Speichern', 'hrf' ) ); ?>
</div>
