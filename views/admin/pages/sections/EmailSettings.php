<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 25.05.2019
 * Time: 19:46
 *
 * @var $options array
 */
?>
<div class="form-group">
    <label for="from">Email Von</label>
    <input type="text" id="from" name="emailHeaders[from]" class="form-control"
           value="<?= ! empty( $options['emailHeaders']['from'] ) ? $options['emailHeaders']['from'] : '' ?>"
           aria-describedby="emailHelp">
    <small id="fromHelp"> Hier kommt der Name von Wem die Email ist</small>
</div>
<div class="form-group">
    <label for="fromEmail">Email Von (Email-Adresse)</label>
    <input type="text" id="fromEmail" name="emailHeaders[fromEmail]" class="form-control"
           value="<?= ! empty( $options['emailHeaders']['fromEmail'] ) ? $options['emailHeaders']['fromEmail'] : '' ?>"
           aria-describedby="fromEmailHelp">
    <small id="fromEmailHelp"> Hier kommt die Email-Adresse von Wem die Email ist</small>
</div>
<div class="form-group">
    <label for="replyTo">ReplyTo</label>
    <input type="text" id="replyTo" name="emailHeaders[replyTo]" class="form-control"
           value="<?= ! empty( $options['emailHeaders']['replyTo'] ) ? $options['emailHeaders']['replyTo'] : '' ?>"
           aria-describedby="replyToHelp">
    <small id="replyToHelp">Email-Adresse, wenn der User auf Antworten in der Email klickt</small>
</div>
<div class="form-group">
    <label for="recipient">Empfänger der Nachricht</label>
    <input type="text" id="recipient" name="emailHeaders[recipient]" class="form-control"
           value="<?= ! empty( $options['emailHeaders']['recipient'] ) ? $options['emailHeaders']['recipient'] : '' ?>"
           aria-describedby="recipientHelp">
    <small id="recipientHelp">Empfänger der Administrator-Nachrichten</small>
</div>
<div class="form-group">
    <label for="cc">CC: Empfänger der Nachricht</label>
    <input type="text" id="cc" name="emailHeaders[cc]" class="form-control"
           value="<?= ! empty( $options['emailHeaders']['cc'] ) ? $options['emailHeaders']['cc'] : '' ?>"
           aria-describedby="cctHelp">
    <small id="ccHelp">CC "optional": Zweite Empfänger der Administrator-Nachrichten</small>
</div>
<div class="">
	<?= submit_button( __( 'Speichern', 'hrf' ) ); ?>
</div>
