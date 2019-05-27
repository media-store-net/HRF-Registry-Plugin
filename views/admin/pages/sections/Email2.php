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
    <label for="subject2">Betreff der Nachricht</label>
    <input type="text" id="subject2" name="msg2[subject]" class="form-control"
           value="<?= ! empty( $options['msg2']['subject'] ) ? $options['msg2']['subject'] : '' ?>">
    <br>
    <label for="body2"><?php echo __( 'Inhalt für die Email an Administrator', 'hrf' ); ?></label>
	<?php
	wp_editor( html_entity_decode( $options['msg2']['body'] ), 'body2', $settings =
		array( 'textarea_name' => 'msg2[body]' ) );
	?>
</div>
<div class="">
	<?= submit_button( __( 'Speichern', 'hrf' ) ); ?>
</div>
