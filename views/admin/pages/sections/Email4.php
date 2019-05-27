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
	<label for="subject4">Betreff der Nachricht</label>
	<input type="text" id="subject4" name="msg4[subject]" class="form-control"
	       value="<?= ! empty( $options['msg4']['subject'] ) ? $options['msg4']['subject'] : '' ?>">
	<br>
	<label for="body4"><?php echo __( 'Inhalt für die Email an Administrator', 'hrf' ); ?></label>
	<?php
	wp_editor( html_entity_decode( $options['msg4']['body'] ), 'body4', $settings =
		array( 'textarea_name' => 'msg4[body]' ) );
	?>
</div>
<div class="">
	<?= submit_button( __( 'Speichern', 'hrf' ) ); ?>
</div>
