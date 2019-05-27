<?php
/*

Plugin Name: HRF Registry Plugin

Plugin URI: https://media-store.net

Description: Kundenspezifischer Registrierungsablauf der User und Zugang zum geschützten Bereich einer Homepage.

Version: 1.0

Author: Artur Voll

Author URI: https://media-store.net

*/

//------------------------------------------------------------
//
// NOTE:
//
// Try NOT to add any code line in this file.
//
// Use "plugin\Main.php" to add your hooks.
//
//------------------------------------------------------------

$langName = 'hrf';
define( 'HRF_DIR', plugin_dir_path( __FILE__ ) );
define( 'HRF_VERSION', 1.0 );

require_once( HRF_DIR . 'boot/bootstrap.php' );

// Set UpdateChecker, only if Premium Plugin

/*$updateChecker = Puc_v4_Factory ::buildUpdateChecker(
	'https://bitbucket.org/pcservice-voll/...',
	__FILE__,
	'name'
);
$updateChecker -> setAuthentication( array(
	'consumer_key'    => '',
	'consumer_secret' => ''
) );
$updateChecker -> setBranch( 'master' );*/


/**********************************
 **** Uninstall Option ***********
 **********************************/

register_uninstall_hook( __FILE__, 'hrf_uninstall' );

function hrf_uninstall() {
	// Neue Options
	/*$new_options = new \wpi\controllers\OptionsController();
	$new_options -> delete();*/

	error_log( 'Plugin gelöscht' );

}
