<?php
/**
 * Created by Media-Store.net
 * User: Artur
 * Date: 20.05.2019
 * Time: 21:09
 */

namespace hrf\plugin\Models;


use WP_User;

class User extends WP_User {

	/**
	 * Default user status.
	 * @var string
	 */
	//protected $status = 0;

	/**
	 * Attributes in model.
	 * @var WP_User
	 */
	//protected $attributes;

	/**
	 * Field aliases.
	 * @var array
	 */
	//protected $aliases = array(
	//'nicename'  => 'user_nicename',
	//'email'     => 'user_email',
	//'firstname' => 'user_firstname',
	//'lastname'  => 'user_lastname',
	//);

	/**
	 * Attributes and aliases hidden from print.
	 * @var array
	 */
	//protected $hidden = []; // = array( 'user_pass' );

	public static function find( $id ) {
		if ( ! empty( $id ) ) {
			$user = new User( $id );
			$user->load_meta();

			return $user;
		}

		//return new WP_User();
	}

	public static function findBy( $field, $value ) {
		$user     = get_user_by( $field, $value );
		$new_user = new User( $user );
		$new_user->load_meta();

		return $new_user;
	}

	public static function from( $id ) {
		// Implement from() method.
	}


	/**
	 * Loads meta values into object.
	 * @since 1.0.0
	 */
	public function load_meta() {
		if ( empty( $this->ID ) ) {
			return;
		}

		//var_dump(get_user_meta($this->ID));

		/*foreach ( get_user_meta( $this->ID ) as $key => $value ) {
			if ( ! preg_match( '/_wp_/', $key )
			     || in_array( 'meta_' . $key, $this->aliases )
			) {
				$value = $value[0];

				$this->meta[ $key ] = is_string( $value )
					? ( preg_match( '/_wp_/', $key )
						? $value
						: json_decode( $value )
					)
					: ( is_integer( $value )
						? intval( $value )
						: floatval( $value )
					);
			}
		}*/
	}

	/**
	 * Saves current model in the db.
	 *
	 * @return mixed.
	 */
	public function save() {
		/*if ( ! $this->is_loaded() ) {
			return false;
		}
		$user = null;
-
		$this->fill_defaults();*/
		if ( $this->ID > 0 ):
			$user = wp_update_user( $this );

			return $user;
		else:
			$user = wp_insert_user( $this );

			return $user;
		endif;

	}

	/**
	 * Deletes current model in the db.
	 *
	 * @return mixed.
	 */
	public function delete() {
		if ( ! $this ) {
			return false;
		}
		if ( is_multisite() ):
			require_once( ABSPATH . 'wp-admin/includes/ms.php' );

			return wpmu_delete_user( $this->ID );
		else:
			require_once( ABSPATH . 'wp-admin/includes/user.php' );

			return wp_delete_user( $this->ID );
		endif;
	}

	/**
	 * Returns flag indicating if object is loaded or not.
	 *
	 * @return bool
	 */
	public function is_loaded() {
		return ! empty( $this );
	}

	/**
	 * Getter function.
	 *
	 * @param string $property
	 *
	 * @return mixed
	 */
	public function __get( $key ) {

		if ( preg_match( '/meta_/', $key ) ) {

			return get_user_meta( $this->ID, preg_replace( '/meta_/', '', $key ), true );

		}

		if ( preg_match( '/func_/', $key ) ) {

			$function_name = preg_replace( '/func_/', '', $key );

			return $this->$function_name();
		}

		if ( property_exists( $this->data, $key ) ) {

			return $this->data->$key;

		} else {
			$user = new WP_User( $this->ID );

			return $user->$key;
		}

	}

	/**
	 * Setter function.
	 *
	 * @param string $property
	 * @param mixed $value
	 *
	 * @return object
	 */
	public
	function __set(
		$key, $value
	) {
		parent::__set( $key, $value );

		if ( preg_match( '/meta_/', $key ) ) {

			return update_user_meta( $this->ID, preg_replace( '/meta_/', '', $key ), $value );

		} else {

			$this->$key = $value;

		}
	}

	/**
	 * Returns object converted to array.
	 *
	 * @param array.
	 *
	 * @return array
	 */
	/*public function to_array() {
		$output = array();

		// Attributes
		foreach ( $this as $property => $value ) {
			$output[ $this->get_alias( $property ) ] = $value;
		}

		// Meta
		foreach ( $this->load_meta() as $key => $value ) {
			$alias = $this->get_alias( 'meta_' . $key );
			if ( $alias != 'meta_' . $key ) {
				$output[ $alias ] = $value;
			}
		}

		// Functions
		foreach ( $this->aliases as $alias => $property ) {
			if ( preg_match( '/func_/', $property ) ) {
				$function_name    = preg_replace( '/func_/', '', $property );
				$output[ $alias ] = $this->$function_name();
			}
		}

		// Hidden
		foreach ( $this->hidden as $key ) {
			unset( $output[ $key ] );
		}

		return $output;
	}*/

	/**
	 * Returns json string.
	 *
	 * @param string
	 */
	public
	function to_json() {
		return json_encode( $this );
	}

	/**
	 * Returns string.
	 *
	 * @param string
	 */
	public
	function __toString() {
		return $this->to_json();
	}

	/**
	 * Fills default when about to create object
	 */
	/*private function fill_defaults() {
		if ( ! property_exists( $this, 'ID' ) ) {

			$this->attributes['post_type'] = $this->type;

			$this->attributes['post_status'] = $this->status;

		}
	}*/

	/**
	 * Returns property mapped to alias.
	 *
	 * @param string $alias Alias.
	 *
	 * @return string
	 */
	/*private function get_alias_property( $alias ) {
		if ( array_key_exists( $alias, $this->aliases ) ) {

			return $this->aliases[ $alias ];
		}

		return $alias;
	}*/

	/**
	 * Returns alias name mapped to property.
	 *
	 * @param string $property Property.
	 *
	 * @return string
	 */
	/*private function get_alias( $property ) {
		if ( in_array( $property, $this->aliases ) ) {
			return array_search( $property, $this->aliases );
		}

		return $property;
	}*/


}
