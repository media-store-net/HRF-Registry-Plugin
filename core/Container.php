<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 17.05.2019
 * Time: 12:52
 */

namespace hrf\core;


use hrf\controllers\admin\Placeholders;
use hrf\controllers\LanguageController;
use hrf\controllers\OptionsController;
use hrf\controllers\PostTypeController;
use hrf\controllers\View;
use hrf\plugin\Models\OptionsModel;
use hrf\plugin\Models\Post;
use hrf\plugin\Models\PostTypeModel;

class Container {

	private static $selfInstance;

	private $config;

	private $aliases = [];

	private $instances = [];

	public static function getContainer() {
		// Initialize the service if it's not already set.
		if ( self::$selfInstance === null ) {
			self::$selfInstance = new Container();
		}

		// Return the instance.
		return self::$selfInstance;
	}

	public function __construct() {

		global $config;
		$this->config  = $config;
		$this->aliases = $this->getObjectAliases();

	}

	public function make( $objectName ) {
		if ( ! empty( $this->instances[ $objectName ] ) ) {
			return $this->instances[ $objectName ];
		}

		try {
			if ( isset( $this->aliases[ $objectName ] ) ) {
				$this->instances[ $objectName ] = $this->aliases[$objectName]();

				return $this->instances[ $objectName ];
			} else {
				throw new \InvalidArgumentException( sprintf( 'Alias "%s" konnte nicht gefunden werden', $objectName ) );
			}
		} catch ( \InvalidArgumentException $e ) {
			echo sprintf( '%s in %s on line %s', $e->getMessage(), $e->getFile(), $e->getLine() );
		}
	}

	private function getObjectAliases() {
		return [
			'OptionsModel'       => function () {
				return new OptionsModel( 'hrf_options', 'hrf_group', $this->config['defaultOptions'] );
			},
			'PostTypeModel'      => function () {
				return new PostTypeModel();
			},
			'Post'               => function () {
				return new Post();
			},
			'OptionsController'  => function () {
				return new OptionsController();
			},
			'LanguageController' => function () {
				return new LanguageController();
			},
			'PostTypeController' => function () {
				return new PostTypeController();
			},
			'Placeholders'       => function () {
				return new Placeholders();
			},
			'currentUser'        => function () {
				if ( ! function_exists( 'wp_get_current_user' ) ) {
					include( ABSPATH . "wp-includes/pluggable.php" );
				}
				$current_user = wp_get_current_user();

				return $current_user;
			},
			'View'               => function () {
				return new View( $this->config['paths']['views'] );
			}
		];
	}

}
