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
    <label for="subject1">Betreff der Nachricht</label>
    <input type="text" id="subject1" name="msg1[subject]" class="form-control"
           value="<?= ! empty( $options['msg1']['subject'] ) ? $options['msg1']['subject'] : '' ?>">
    <br>
    <label for="body1"><?php echo __( 'Inhalt für die erste Email an Kunden', 'hrf' ); ?></label>
	<?php wp_editor( html_entity_decode( $options['msg1']['body'] ), 'body1', $settings =
		array( 'textarea_name' => 'msg1[body]' ) ); ?>
</div>
<div class="">
	<?= submit_button( __( 'Speichern', 'hrf' ) ); ?>
</div>
