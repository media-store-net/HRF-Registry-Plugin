<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 25.05.2019
 * Time: 20:08
 */

namespace hrf\controllers;


use hrf\core\Container;

class ActionController {

	public function StoreAdminOptions() {
		$optionsClass = ( Container::getContainer() )->make( 'OptionsController' );
		$options      = $optionsClass->getAll();

		if (
			isset( $_POST['settings_send'] )
			&& wp_verify_nonce( $_POST['settings_send'], 'hrf_settings_form' )
		) {
			// Set Data to $options
			foreach ( $_POST as $key => $value ):
				if ( array_key_exists( $key, $options ) ):
					foreach ( $value as $k => $v ):
						switch ( $k ) {
							case 'body':
								$value[ $k ] = htmlentities( $v, ENT_QUOTES );
								break;
							default:
								$value[ $k ] = sanitize_text_field( $v );
						}
					endforeach;
					$options[ $key ] = $value;
				endif;
			endforeach;
			$optionsClass->saveAll( $options );
		}
	}

}
