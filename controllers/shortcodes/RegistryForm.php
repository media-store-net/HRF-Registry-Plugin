<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 18.05.2019
 * Time: 14:21
 */

namespace hrf\controllers\shortcodes;


use Amostajo\LightweightMVC\Request;
use hrf\controllers\AbstractController;
use hrf\controllers\admin\WpMailer;
use hrf\core\Container;
use hrf\plugin\Models\User;


class RegistryForm extends AbstractController {

	private $options = [];

	/**
	 * @var \hrf\controllers\admin\Placeholders $placeholders
	 */
	private $placeholders;

	public function __construct() {
		parent::__construct();
		$container = Container::getContainer();
		/**
		 * @var \hrf\controllers\OptionsController $optionsController
		 */
		$optionsController = $container->make( 'OptionsController' );
		$this->options     = $optionsController->getAll();

		$this->placeholders = $container->make( 'Placeholders' );
	}

	public function registryForm( $atts ) {
		// Standardparameter übergeben
		extract( shortcode_atts( array(), $atts ) );

		// $_POST nach Registrierung des Kunden
		if (
			null !== Request::input( 'hrfRegForm' )
			&& wp_verify_nonce( Request::input( 'hrfRegForm' ), 'hrfReg' )
		) {
			if ( Request::input( 'pass' ) !== Request::input( 'passConfirm' ) ):
				$this->view->show( 'messages.PassConfirmFailed' );
			elseif ( $this->validateData( $_POST ) ):
				$_POST = null;
				$this->view->show( 'messages.RegistrationFormSendSuccess' );
			else:
				$this->view->show( 'messages.RegistrationFormSendFailed' );
			endif;
		}

		// $_GET nach bestätigung der Email...
		if (
			null !== Request::input( 'hrfConfirm' )
			&& wp_verify_nonce( Request::input( 'hrfConfirm' ), 'confirmMail' )
		) {

			// Email an Admin...
			if ( $this->sendAdminEmail( Request::input( 'user_email' ), get_permalink() ) ):
				// Message an Kunden...
				return $this->view->show( 'messages.ConfirmSuccess', [ 'email' => Request::input( 'user_email' ) ] );
			else:
				return $this->view->get( 'messages.RegistrationFormSendFaildes' );
			endif;
		}

		// $_GET vom Admin...
		if (
			null !== Request::input( 'hrfAdminLink' )
			&& wp_verify_nonce( Request::input( 'hrfAdminLink' ), 'confirmUser' )
		) {

			if ( null !== Request::input( 'user' ) && Request::input( 'status' ) === 'allowed' ):
				//Wenn User allowed -> Role ändern, Email an Kunden...

				$user = User::findBy( 'email', Request::input( 'user' ) );
				if ( ! is_a( $user, 'hrf\plugin\Models\User' ) || ! $user->has_prop( 'user_email' ) ):
					return $this->view->show( 'messages.RegistrationFormSendFailed' );
				else:
					//Userrolle ändern, Spam auf 0,
					$user->spam = 0;
					$user->set_role( 'um_member' );
					if ( $user->save() ):
						//Email an Kunden mit Zugangslink
						if ( $this->sendUserConfirmedEmail( $user ) ):

							return $this->view->show( 'messages.UserConfirmed', [ 'email' => $user->user_email ] );
						endif;
					endif;
				endif;
			elseif ( null !== Request::input( 'user' ) && Request::input( 'status' ) === 'denied' ):
				//Wenn User denied -> email an Kunden Denied...

				$user = User::findBy( 'email', Request::input( 'user' ) );
				if ( ! is_a( $user, 'hrf\plugin\Models\User' ) || ! $user->has_prop( 'user_email' ) ):
					return $this->view->show( 'messages.RegistrationFormSendFailed' );
				else:
					if ( $user->delete() ):
						// Email an Kunden der Ablehnung...
						$this->sendUserDeniedEmail( $user );

						return $this->view->show( 'messages.UserDeleted', [ 'email' => $user->user_email ] );
					endif;
				endif;
			endif;

			return false;
		}

		$laender = array(
			"AD" => "Andorra",
			"AE" => "Vereinigte Arabische Emirate",
			"AF" => "Afghanistan",
			"AG" => "Antigua und Barbuda",
			"AI" => "Anguilla",
			"AL" => "Albanien",
			"AM" => "Armenien",
			"AN" => "Niederländische Antillen",
			"AO" => "Angola",
			"AQ" => "Antarktis",
			"AR" => "Argentinien",
			"AS" => "Amerikanisch-Samoa",
			"AT" => "Österreich (Austria)",
			"AU" => "Australien",
			"AW" => "Aruba",
			"AZ" => "Azerbaijan",
			"BA" => "Bosnien-Herzegovina",
			"BB" => "Barbados",
			"BD" => "Bangladesh",
			"BE" => "Belgien",
			"BF" => "Burkina Faso",
			"BG" => "Bulgarien",
			"BH" => "Bahrain",
			"BI" => "Burundi",
			"BJ" => "Benin",
			"BM" => "Bermudas",
			"BN" => "Brunei Darussalam",
			"BO" => "Bolivien",
			"BR" => "Brasilien",
			"BS" => "Bahamas",
			"BT" => "Bhutan",
			"BV" => "Bouvet Island",
			"BW" => "Botswana",
			"BY" => "Weißrußland (Belarus)",
			"BZ" => "Belize",
			"CA" => "Canada",
			"CC" => "Cocos (Keeling) Islands",
			"CD" => "Demokratische Republik Kongo",
			"CF" => "Zentralafrikanische Republik",
			"CG" => "Kongo",
			"CH" => "Schweiz",
			"CI" => "Elfenbeinküste (Cote D'Ivoire)",
			"CK" => "Cook Islands",
			"CL" => "Chile",
			"CM" => "Kamerun",
			"CN" => "China",
			"CO" => "Kolumbien",
			"CR" => "Costa Rica",
			"CS" => "Tschechoslowakei (ehemalige)",
			"CU" => "Kuba",
			"CV" => "Kap Verde",
			"CX" => "Christmas Island",
			"CY" => "Zypern",
			"CZ" => "Tschechische Republik",
			"DE" => "Deutschland",
			"DJ" => "Djibouti",
			"DK" => "Dänemark",
			"DM" => "Dominica",
			"DO" => "Dominikanische Republik",
			"DZ" => "Algerien",
			"EC" => "Ecuador",
			"EE" => "Estland",
			"EG" => "Ägypten",
			"EH" => "Westsahara",
			"ER" => "Eritrea",
			"ES" => "Spanien",
			"ET" => "Äthiopien",
			"FI" => "Finnland",
			"FJ" => "Fiji",
			"FK" => "Falkland-Inseln (Malvinas)",
			"FM" => "Micronesien",
			"FO" => "Faröer-Inseln",
			"FR" => "Frankreich",
			"FX" => "France, Metropolitan",
			"GA" => "Gabon",
			"GD" => "Grenada",
			"GE" => "Georgien",
			"GF" => "Französisch Guiana",
			"GH" => "Ghana",
			"GI" => "Gibraltar",
			"GL" => "Grönland",
			"GM" => "Gambia",
			"GN" => "Guinea",
			"GP" => "Guadeloupe",
			"GQ" => "Äquatorialguinea",
			"GR" => "Griechenland",
			"GS" => "Südgeorgien und Südliche Sandwich-Inseln",
			"GT" => "Guatemala",
			"GU" => "Guam",
			"GW" => "Guinea-Bissau",
			"GY" => "Guyana",
			"HK" => "Kong Hong",
			"HM" => "Heard und Mc Donald Islands",
			"HN" => "Honduras",
			"HT" => "Haiti",
			"HU" => "Ungarn",
			"ID" => "Indonesien",
			"IE" => "Irland",
			"IL" => "Israel",
			"IN" => "Indien",
			"IO" => "British Indian Ocean Territory",
			"IQ" => "Irak",
			"IR" => "Iran (Islamische Republik)",
			"IS" => "Island",
			"IT" => "Italien",
			"JM" => "Jamaica",
			"JO" => "Jordanien",
			"JP" => "Japan",
			"KE" => "Kenya",
			"KG" => "Kirgisien",
			"KH" => "Königreich Kambodscha",
			"KI" => "Kiribati",
			"KM" => "Komoren",
			"KN" => "Saint Kitts und Nevis",
			"KP" => "Korea, Volksrepublik",
			"KR" => "Korea",
			"KW" => "Kuwait",
			"KY" => "Kayman Islands",
			"KZ" => "Kasachstan",
			"LA" => "Laos",
			"LB" => "Libanon",
			"LC" => "Saint Lucia",
			"LI" => "Liechtenstein",
			"LK" => "Sri Lanka",
			"LR" => "Liberia",
			"LS" => "Lesotho",
			"LT" => "Littauen",
			"LU" => "Luxemburg",
			"LV" => "Lettland",
			"LY" => "Libyen",
			"MA" => "Marokko",
			"MC" => "Monaco",
			"MD" => "Moldavien",
			"MG" => "Madagaskar",
			"MH" => "Marshall-Inseln",
			"MK" => "Mazedonien, ehem. Jugoslawische Republik",
			"ML" => "Mali",
			"MM" => "Myanmar",
			"MN" => "Mongolei",
			"MO" => "Macao",
			"MP" => "Nördliche Marianneninseln",
			"MQ" => "Martinique",
			"MR" => "Mauretanien",
			"MS" => "Montserrat",
			"MT" => "Malta",
			"MU" => "Mauritius",
			"MV" => "Malediven",
			"MW" => "Malawi",
			"MX" => "Mexico",
			"MY" => "Malaysien",
			"MZ" => "Mozambique",
			"NA" => "Namibia",
			"NC" => "Neu Kaledonien",
			"NE" => "Niger",
			"NF" => "Norfolk Island",
			"NG" => "Nigeria",
			"NI" => "Nicaragua",
			"NL" => "Niederlande",
			"NO" => "Norwegen",
			"NP" => "Nepal",
			"NR" => "Nauru",
			"NU" => "Niue",
			"NZ" => "Neuseeland",
			"OM" => "Oman",
			"PA" => "Panama",
			"PE" => "Peru",
			"PF" => "Französisch Polynesien",
			"PG" => "Papua Neuguinea",
			"PH" => "Philippinen",
			"PK" => "Pakistan",
			"PL" => "Polen",
			"PM" => "St. Pierre und Miquelon",
			"PN" => "Pitcairn",
			"PR" => "Puerto Rico",
			"PT" => "Portugal",
			"PW" => "Palau",
			"PY" => "Paraguay",
			"QA" => "Katar",
			"RE" => "Reunion",
			"RO" => "Rumänien",
			"RU" => "Russische Föderation",
			"RW" => "Ruanda",
			"SA" => "Saudi Arabien",
			"SB" => "Salomonen",
			"SC" => "Seychellen",
			"SD" => "Sudan",
			"SE" => "Schweden",
			"SG" => "Singapur",
			"SH" => "St. Helena",
			"SI" => "Slovenien",
			"SJ" => "Svalbard und Jan Mayen Islands",
			"SK" => "Slowakei",
			"SL" => "Sierra Leone",
			"SM" => "San Marino",
			"SN" => "Senegal",
			"SO" => "Somalia",
			"SR" => "Surinam",
			"ST" => "Sao Tome und Principe",
			"SV" => "El Salvador",
			"SY" => "Syrien, Arabische Republik",
			"SZ" => "Swaziland",
			"TC" => "Turk und Caicos-Inseln",
			"TD" => "Tschad",
			"TF" => "Französisches Südl.Territorium",
			"TG" => "Togo",
			"TH" => "Thailand",
			"TJ" => "Tadschikistan",
			"TK" => "Tokelau",
			"TM" => "Turkmenistan",
			"TN" => "Tunesien",
			"TO" => "Tonga",
			"TP" => "Ost-Timor",
			"TR" => "Türkei",
			"TT" => "Trinidad und Tobago",
			"TV" => "Tuvalu",
			"TW" => "Taiwan",
			"TZ" => "Tansania, United Republic of",
			"UA" => "Ukraine",
			"UG" => "Uganda",
			"GB" => "Großbritannien",
			"US" => "Vereinigte Staaten",
			"UM" => "Vereinigte Staaten, Minor Outlying Islands",
			"UY" => "Uruguay",
			"UZ" => "Usbekistan",
			"VA" => "Vatikanstaat",
			"VC" => "Saint Vincent und Grenadines",
			"VE" => "Venezuela",
			"VG" => "Virgin Islands (Britisch)",
			"VI" => "Virgin Islands (U.S.)",
			"VN" => "Vietnam",
			"VU" => "Vanuatu",
			"WF" => "Wallis und Futuna Islands",
			"WS" => "Samoa",
			"YE" => "Jemen",
			"YT" => "Mayotte",
			"YU" => "Jugoslawien",
			"ZA" => "Südafrika",
			"ZM" => "Sambia",
			"ZW" => "Zimbabwe"
		);
		asort( $laender );

		return $this->view->get( 'shortcodes.RegistryForm', [ 'laender' => $laender ] );
	}

	private function validateData( $data ) {

		unset( $data['hrfRegForm'] );
		unset( $data['_wp_http_referer'] );

		$newData = array();
		foreach ( $data as $key => $value ) :
			switch ( $key ):
				case ( 'email' ):
					if ( ! $this->validate_email( $value ) ):
						return false;
					endif;
					$newData[ $key ] = $value;
					break;
				default:
					$newData[ $key ] = filter_var( $value, FILTER_SANITIZE_FULL_SPECIAL_CHARS );
					break;
			endswitch;
		endforeach;

		if ( false !== $this->addUser( $newData ) ):
			return true;
		endif;

		return false;
	}

	private function validate_email( $email ) {
		if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
			return true;
		}

		return false;
	}

	private function addUser( $data ) {
		// New User Instance
		$user = new User();
		/*// If User allready exists, exit...
		if ( $new = User::findBy( 'email', $data['email'] ) ) {
			//$this->view->show( 'messages.UserAllreadyExists', [ 'email' => $new->user_email ] );
			//var_dump( $new->has_cap('member'));
			$new->delete();
			//return false;
		}*/

		$user->user_login = sprintf( '%s-%s', $data['vorname'], $data['nachname'] );
		$user->user_pass  = $data['pass'];
		$user->user_email = $data['email'];
		$user->set_role( 'subscriber' );

		$user_id = $user->save();
		if ( is_a( $user_id, 'WP_Error' ) ):
			$this->view->show( 'messages.WpErrors', [ 'errors' => $user_id->errors ] );

			return false;
		else:
			$user                = User::find( $user_id );
			$user->spam          = 1;
			$user->meta_titel    = $data['titel'];
			$user->meta_vorname  = $data['vorname'];
			$user->meta_nachname = $data['nachname'];
			$user->meta_firma    = $data['firma'];
			$user->meta_adresse  = $data['adresse'];
			$user->meta_plz      = $data['plz'];
			$user->meta_ort      = $data['ort'];
			$user->meta_land     = $data['land'];
			$user->meta_telefon  = $data['telefon'];
			$user->meta_fax      = $data['fax'];
			$user->meta_message  = $data['message'];

			//@return User confirm email
			return $this->sendUserConfirmEmail( $data );

		endif;

	}

	private function sendUserConfirmEmail( $data ) {
		$user = User::findBy( 'email', $data['email'] );

		$mailBody = nl2br( html_entity_decode( $this->placeholders->replace( $this->options['msg1']['body'], $user, $data['referrer'] ) ) );

		$mail = new WpMailer();
		$mail->setTo( $data['email'] );
		$mail->setHeaders( [
			sprintf( 'From: %s <%s>', $this->options['emailHeaders']['from'], $this->options['emailHeaders']['fromEmail'] ),
			sprintf( 'Reply-To: %s', $this->options['emailHeaders']['replyTo'] ),
			sprintf( 'Content-type: %s', 'text/html' )
		] );
		$mail->setSubject( $this->placeholders->replace( $this->options['msg1']['subject'], $user ) );
		$mail->setMessage( $mailBody );

		if ( $mail->send() ):
			return true;
		else:
			return false;
		endif;
	}

	private function sendAdminEmail( $user_email, $referrer ) {
		$user = User::findBy( 'email', $user_email );
		if ( ! is_a( $user, 'hrf\plugin\Models\User' ) || ! $user->has_prop( 'user_email' ) ):
			//TODO evtl. admin benachrichtigen das etwas mit der Email nicht stimmt und User nicht gefunden wurde
			return false;
		else:
			//Email an Admin mit 2 Links...

			// MailBody aus Options...
			$mailBody = nl2br( html_entity_decode( $this->placeholders->replace( $this->options['msg2']['body'], $user, $referrer ) ) );

			// New Mailer Instance
			$mail = new WpMailer();
			//Admin-Email aus Options
			$mail->setTo( $this->options['emailHeaders']['recipient'] );
			$mail->setHeaders( [
				sprintf( 'From: %s <%s>', $this->options['emailHeaders']['from'], $this->options['emailHeaders']['fromEmail'] ),
				sprintf( 'CC: %s', $this->options['emailHeaders']['cc'] ),
				sprintf( 'Reply-To: %s', $user->user_email ),
				sprintf( 'Content-type: %s', 'text/html' )
			] );
			// Subject aus Options
			$mail->setSubject( $this->placeholders->replace( $this->options['msg2']['subject'], $user ) );
			$mail->setMessage( $mailBody );

			if ( $mail->send() ):
				return true;
			else:
				return false;
			endif;

		endif;
	}

	private function sendUserConfirmedEmail( $user ) {

		$mail = new WpMailer();
		$mail->setTo( $user->user_email );
		$mail->setHeaders( [
			sprintf( 'From: %s <%s>', $this->options['emailHeaders']['from'], $this->options['emailHeaders']['fromEmail'] ),
			sprintf( 'Reply-To: %s', $this->options['emailHeaders']['replyTo'] ),
			sprintf( 'Content-type: %s', 'text/html' )
		] );
		$mail->setSubject( $this->placeholders->replace( $this->options['msg3']['subject'], $user ) );
		$mail->setMessage( nl2br( html_entity_decode( $this->placeholders->replace( $this->options['msg3']['body'], $user, get_permalink() ) ) ) );

		return $mail->send();
	}


	private function sendUserDeniedEmail( $user ) {
		$mail = new WpMailer();
		$mail->setTo( $user->user_email );
		$mail->setHeaders( [
			sprintf( 'From: %s', 'HRF Kundencenter <info@hrf.com>' ),
			sprintf( 'Reply-To: %s', $this->options['emailHeaders']['replyTo'] ),
			sprintf( 'Content-type: %s', 'text/html' )
		] );
		$mail->setSubject( $this->placeholders->replace( $this->options['msg4']['subject'], $user ) );
		$mail->setMessage( nl2br( html_entity_decode( $this->placeholders->replace( $this->options['msg3']['body'], $user, get_permalink() ) ) ) );

		return $mail->send();

	}
}
