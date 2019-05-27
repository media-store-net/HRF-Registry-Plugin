<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 09.12.2018
 * Time: 14:57
 */

namespace hrf\controllers\admin;


use hrf\controllers\AbstractController;
use hrf\core\Container;

/**
 * Class AdminPagesController
 * @package MediaStoreNet\controllers\admin
 */
class AdminPagesController extends AbstractController {

	/**
	 * Initialisation of Menus you will find in "plugin/Main.php"
	 */
	public function menus() {

		//create new top-level menu
		add_menu_page( 'HRF Registry', 'HRF Registry', 'manage_options', 'hrf_dashboard_page', array(
			&$this,
			'dashboard'
		), 'dashicons-id-alt' );

		//create here submenu's

		/*add_submenu_page( 'Test', 'Test', 'Test', 'manage_options', 'wpw_test_page', array(
			&$this,
			'dashboard'
		) );*/

	}

	/**
	 *   Call the View for the Dashboard Admin Page,
	 *   you find it in "views/admin/pages/dashboard.php"
	 */
	public function dashboard() {
		/**
		 * @var $optionsController \hrf\controllers\OptionsController
		 */
		$optionsController = ( Container::getContainer() )->make( 'OptionsController' );
		$options           = $optionsController->getAll();

		$this->view->show( 'admin.pages.dashboard', [ 'options' => $options ] );
	}

}
