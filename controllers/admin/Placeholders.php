<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 25.05.2019
 * Time: 22:12
 */

namespace hrf\controllers\admin;


class Placeholders {

	private $referrer;

	private $user_data = [];

	private $confimLink;

	private $registrationFormData;

	private $alowUserLink;

	private $deniedUserLink;

	protected $placeholders = [];

	public function __construct() {
	}

	/**
	 * @param $text string
	 * @param \hrf\plugin\Models\User $user_data
	 * @param string $referrer
	 *
	 * @return mixed
	 */
	public function replace( $text, $user_data, $referrer = '' ) {
		$this->referrer = ! empty( $referrer ) ? $referrer : get_permalink();
		$this->setUserData( $user_data );
		$this->confimLink           = $this->setConfirmLink();
		$this->alowUserLink         = $this->setAlowUserLink();
		$this->deniedUserLink       = $this->setDeniedUserLink();
		$this->registrationFormData = $this->setRegistrationFormData();
		$this->placeholders         = $this->getPlaceholders();


		foreach ( $this->placeholders as $placeholder => $value ) {
			if ( stripos( $text, $placeholder ) ):
				$text = str_replace( $placeholder, $value, $text );
			endif;
		}

		return $text;
	}

	public function __get( $name ) {
		if ( property_exists( $this, $name ) && ! empty( $this->$name ) ):
			return $this->$name;
		endif;

		return null;
	}


	public function __set( $name, $value ) {
		if ( property_exists( $this, $name ) ):
			$this->$name = $value;
		endif;
	}

	private function getPlaceholders() {
		return [
			'{titel}'                => $this->user_data['titel'],
			'{vorname}'              => $this->user_data['vorname'],
			'{nachname}'             => $this->user_data['nachname'],
			'{email}'                => $this->user_data['email'],
			'{firma}'                => $this->user_data['firma'],
			'{adresse}'              => $this->user_data['adresse'],
			'{plz}'                  => $this->user_data['plz'],
			'{ort}'                  => $this->user_data['ort'],
			'{land}'                 => $this->user_data['land'],
			'{telefon}'              => $this->user_data['telefon'],
			'{fax}'                  => $this->user_data['fax'],
			'{message}'              => $this->user_data['message'],
			'{confirmLink}'          => $this->confimLink,
			'{alowUserLink}'         => $this->alowUserLink,
			'{deniedUserLink}'       => $this->deniedUserLink,
			'{registrationFormData}' => $this->registrationFormData,
		];
	}

	private function getUserPropertys() {
		return [
			'titel',
			'vorname',
			'nachname',
			'email',
			'firma',
			'adresse',
			'plz',
			'ort',
			'land',
			'telefon',
			'fax',
			'message'
		];
	}

	/**
	 * @param \hrf\plugin\Models\User $user
	 */
	private function setUserData( $user ) {
		foreach ( $this->getUserPropertys() as $property ):
			switch ( $property ):
				case 'email':
					$this->user_data[ $property ] = $user->user_email;
					break;
				default:
					$replace                      = preg_replace( "/{$property}/", "meta_{$property}", $property );
					$this->user_data[ $property ] = $user->$replace;
					break;
			endswitch;
		endforeach;
	}

	private function setConfirmLink() {
		$link = wp_nonce_url( $this->referrer, 'confirmMail', 'hrfConfirm' );
		$link .= sprintf( '&user_email=%s', $this->user_data['email'] );

		return $link;
	}

	private function setAlowUserLink() {
		// Link zum freischalten
		$linkSucess = wp_nonce_url( $this->referrer, 'confirmUser', 'hrfAdminLink' );
		$linkSucess .= sprintf( '&user=%s&status=%s', $this->user_data['email'], 'allowed' );

		return $linkSucess;
	}

	private function setDeniedUserLink() {
		// Link zum ablehnen
		$linkFail = wp_nonce_url( $this->referrer, 'confirmUser', 'hrfAdminLink' );
		$linkFail .= sprintf( '&user=%s&status=%s', $this->user_data['email'], 'denied' );

		return $linkFail;
	}

	private function setRegistrationFormData() {
		$str = '';
		foreach ( $this->user_data as $key => $val ) {
			$str .= ucfirst( $key ) . ': ' . $val . '<br>';
		}

		return $str;
	}

}
