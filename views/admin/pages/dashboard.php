<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 09.12.2018
 * Time: 15:00
 *
 * @var $options array
 */
?>

<div class="wrap container-fluid">
    <div class="row">
        <div class="col">
            <h2 class="h">HRF Custom Registration Plugin - Version <?= HRF_VERSION ?></h2>
        </div>
    </div>
    <div class="row">
        <form action="" method="post" class="form col-md-9" data-spy="scroll" data-target="#navbar" data-offset="0">
            <div id="content">
                <div id="emailSettings">
                    <h4>Email Einstellungen Allgemein</h4>
					<?php $this->show( 'admin.pages.sections.EmailSettings', [ 'options' => $options ] ); ?>
                </div>
                <div id="email1">
                    <h4>Texte - Email 1 an den Kunden</h4>
					<?php $this->show( 'admin.pages.sections.Email1', [ 'options' => $options ] ); ?>
                </div>
                <div id="email2">
                    <h4>Texte - Email an Administrator</h4>
					<?php $this->show( 'admin.pages.sections.Email2', [ 'options' => $options ] ); ?>
                </div>
                <div id="email3">
                    <h4>Texte - Email Kunde genehmigt</h4>
					<?php $this->show( 'admin.pages.sections.Email3', [ 'options' => $options ] ); ?>
                </div>
                <div id="email4">
                    <h4>Texte - Email Kunde abgelehnt</h4>
					<?php $this->show( 'admin.pages.sections.Email4', [ 'options' => $options ] ); ?>
                </div>
            </div>
			<?php wp_nonce_field( 'hrf_settings_form', 'settings_send' ); ?>
            <div id="platzhalter">
	            <?php $this->show( 'admin.pages.sections.Placeholders', [ 'options' => $options ] ); ?>
            </div>
        </form>

        <div class="col-md-3 col-sm-none">
			<?= $this->show( 'admin.pages.sections.section-navigation',
				[
					'ids' => array(
						'emailSettings' => 'Email Einstellungen',
						'email1'        => 'Email 1 an Kunden',
						'email2'        => 'Email an Admin',
						'email3'        => 'Email - Kunde genehmigt',
						'email4'        => 'Email - Kunde abgelehnt',
						'platzhalter'   => 'Platzhalter Übersicht'
					)
				]
			); ?>
        </div>
    </div>

</div>
