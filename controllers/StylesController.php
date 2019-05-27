<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 25.05.2019
 * Time: 16:39
 */

namespace hrf\controllers;


class StylesController {

	/**
	 * Enqueue CSS File of Admin Pages
	 */
	public function set_admin_styles() {
		if ( strpos( $_SERVER['REQUEST_URI'], 'page=hrf_' ) ):

			//wp_register_script('jquery3', WPI_PLUGIN_URL . 'js/jquery3.min.js');
			//wp_enqueue_script( 'jquery3' );
			wp_deregister_script('jquery');
			wp_deregister_script('jquery-migrate');
			wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js');
			wp_register_script('jquery-migrate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.1/jquery-migrate.min.js', ['jquery']);

			// Thickbox
			wp_enqueue_style( 'thickbox' );
			// CodeMirror
			//wp_enqueue_style( 'codemirror_css', WPI_PLUGIN_URL . 'vendor/codemirror/lib/codemirror.css' );
			// Own Styles
			wp_enqueue_style( 'hrf_bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' );

			// Load Media Upload an Thickbox JS Files
			wp_enqueue_script( 'media-upload' );
			wp_enqueue_script( 'thickbox' );
			// CodeMirror JS Files
			//wp_enqueue_script( 'codemirror_js', WPI_PLUGIN_URL . 'vendor/codemirror/lib/codemirror.js', 'jquery3', '1.0', 'true' );
			//wp_enqueue_script( 'codemirror_css_mode', WPI_PLUGIN_URL . 'vendor/codemirror/mode/css/css.js', 'jquery3', '1.0', 'true' );

			//Bootstrap JS
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-migrate');
			wp_enqueue_script( 'popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', [ 'jquery' ], null, true );
			wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', [ 'jquery' ], null, true );

			// Own JS Files
			//wp_enqueue_script( 'wpi_admin_js', WPI_PLUGIN_URL . 'js/admin/main.js', 'jquery3', '1.0', 'true' );

		endif;
	}

}
