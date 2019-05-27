<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 18.05.2019
 * Time: 14:25
 *
 */

/**
 * @var $laender []
 */

use Amostajo\LightweightMVC\Request;

?>
<form method="post" action="<?= get_permalink() ?>" class="form">
    <fieldset>
        <label for="vorname"> Vorname *</label>
        <input type="text" id="vorname" name="vorname" class="form-control"
               value="<?php echo ! empty( Request::input( 'vorname' ) ) ? Request::input( 'vorname' ) : '' ?>" required>
        <label for="nachname"> Nachname *</label>
        <input type="text" id="nachname" name="nachname" class="form-control"
               value="<?php echo ! empty( Request::input( 'nachname' ) ) ? Request::input( 'nachname' ) : '' ?>"
               required>
        <label for="titel"> Titel</label>
        <input type="text" id="titel" name="titel" class="form-control"
               value="<?php echo ! empty( Request::input( 'titel' ) ) ? Request::input( 'titel' ) : '' ?>">
        <label for="firma"> Firma *</label>
        <input type="text" id="firma" name="firma" class="form-control"
               value="<?php echo ! empty( Request::input( 'firma' ) ) ? Request::input( 'firma' ) : '' ?>" required>
        <label for="adresse"> Adresse *</label>
        <input type="text" id="adresse" name="adresse" class="form-control"
               value="<?php echo ! empty( Request::input( 'adresse' ) ) ? Request::input( 'adresse' ) : '' ?>" required>
        <label for="plz"> PLZ *</label>
        <input type="number" id="plz" name="plz" class="form-control"
               value="<?php echo ! empty( Request::input( 'plz' ) ) ? Request::input( 'plz' ) : '' ?>" required>
        <label for="ort"> Ort *</label>
        <input type="text" id="ort" name="ort" class="form-control"
               value="<?php echo ! empty( Request::input( 'ort' ) ) ? Request::input( 'ort' ) : '' ?>" required>
        <label for="land"> Land *</label>
        <select id="land" name="land" class="form-control" required>
			<?php foreach ( $laender as $code => $name ): ?>
                <option value="<?= $name ?>" <?= $code === 'DE' ? 'selected' : ''; ?>><?= $name ?></option>
			<?php endforeach; ?>
        </select>
        <label for="telefon"> Telefon *</label>
        <input type="tel" id="telefon" name="telefon" class="form-control"
               value="<?php echo ! empty( Request::input( 'telefon' ) ) ? Request::input( 'telefon' ) : '' ?>" required>
        <label for="fax"> Fax</label>
        <input type="tel" id="fax" name="fax" class="form-control"
               value="<?php echo ! empty( Request::input( 'fax' ) ) ? Request::input( 'fax' ) : '' ?>">
        <label for="email"> E-Mail *</label>
        <input type="email" id="email" name="email" class="form-control"
               value="<?php echo ! empty( Request::input( 'email' ) ) ? Request::input( 'email' ) : '' ?>" required>
        <input type="hidden" name="referrer" value="<?= get_permalink() ?>">
        <label for="pass"> Passwort *</label>
        <input type="password" id="pass" name="pass" class="form-control"
               value="<?php echo ! empty( Request::input( 'pass' ) ) ? Request::input( 'pass' ) : '' ?>" required>
        <label for="passConfirm"> Passwort wiederholen *</label>
        <input type="password" id="passConfirm" name="passConfirm" class="form-control"
               value="<?php echo ! empty( Request::input( 'passConfirm' ) ) ? Request::input( 'passConfirm' ) : '' ?>"
               required>

        <label for="message">Ihre Nachricht</label>
        <textarea id="message" name="message"
                  class="form-control"><?php echo ! empty( Request::input( 'message' ) ) ? Request::input( 'message' ) : '' ?></textarea>
		<?php wp_nonce_field( 'hrfReg', 'hrfRegForm' ); ?>
        <button type="reset" class="btn btn-default">Eingaben löschen</button>
        <button type="submit" class="btn btn-default">Konto erstellen</button>
    </fieldset>
</form>
