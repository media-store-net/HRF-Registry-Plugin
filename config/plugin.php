<?php

/**
 * Main Configuration File.
 * --------------------------
 */

return [

	'namespace' => 'hrf',

	'paths' => [

		'controllers' => HRF_DIR . 'controllers/',
		'views'       => HRF_DIR . 'views/',

	],

	'addons' => [],

	'cache' => [

		// Enables or disables cache
		'enabled'     => true,
		// files, sqlite, auto (files), apc, wincache, xcache, memcache, memcached
		'storage'     => 'auto',
		// Default path for files
		'path'        => HRF_DIR . 'cache/',
		// It will create a path by PATH/securityKey
		'securityKey' => '',
		// FallBack Driver
		'fallback'    => [
			'memcache' => 'files',
			'apc'      => 'sqlite',
		],
		// .htaccess protect
		'htaccess'    => true,
		// Default Memcache Server
		'server'      => [
			[ '127.0.0.1', 11211, 1 ],
		],

	],

	'log' => [

		'path' => HRF_DIR . 'logs/',

	],

	'defaultOptions' => [
		'emailHeaders' => [
			'from'      => 'HRF Registry Plugin',
			'fromEmail' => 'test@example.com',
			'replyTo'   => 'test@example.com',
			'cc'        => '',
			'recipient' => ''
		],
		'msg1'         => [
			'subject' => '',
			'body'    => ''
		],
		'msg2'         => [
			'subject' => '',
			'body'    => ''
		],
		'msg3'         => [
			'subject' => '',
			'body'    => ''
		],
		'msg4'         => [
			'subject' => '',
			'body'    => ''
		],
	],

];
