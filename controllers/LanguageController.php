<?php
/**
 * Created by Media-Store.net.
 * User: Artur
 * Date: 06.04.2018
 * Time: 00:33
 */

namespace hrf\controllers;


/**
 * Class LanguageController defined LanguagePackage
 *
 * @author Artur Voll
 * @since 1.0
 *
 * @package hrf\controllers
 */
class LanguageController {

	/**
	 * Init Plugin Text Domain
	 *
	 * @since 1.0
	 */
	public function init() {
		global $langName;

		load_plugin_textdomain( $langName, false, HRF_DIR . 'languages/' );
	}

}
