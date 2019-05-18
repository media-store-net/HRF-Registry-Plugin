<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 09.12.2018
 * Time: 13:47
 */

namespace hrf\controllers;

use Amostajo\LightweightMVC\Controller;

/**
 * Class AbstractController
 * extends LightweightMVC\Controller and set default $view to config->view
 *
 * @author  Artur Voll
 *
 * @since   1.0
 *
 * @package MediaStoreNet\controllers
 */
class AbstractController extends Controller {

	/**
	 * View class object.
	 * @var View
	 */
	protected $view;

	/**
	 * @var \WP_User
	 */
	protected $user;

	/**
	 * AbstractController constructor.
	 */
	public function __construct() {
		$config = include( HRF_DIR . 'config/plugin.php' );
		parent::__construct( $config['paths']['views'] );
		$hrfContainer = new \hrf\core\Container();

		$this->view = $hrfContainer->make( 'View' );
		$this->user = $hrfContainer->make( 'currentUser' );
	}
}
