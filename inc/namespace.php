<?php
/**
 * Figuren_Theater Interactive.
 *
 * @package figuren-theater/interactive
 */

namespace Figuren_Theater\Interactive;

use Altis;
use function Altis\register_module;


/**
 * Register module.
 */
function register() {

	$default_settings = [
		'enabled'         => true, // needs to be set
		'comments'        => false,
		'search'          => false,
		'formality'       => false,
		'wp-approve-user' => false,
	];
	$options = [
		'defaults' => $default_settings,
	];

	Altis\register_module(
		'interactive',
		DIRECTORY,
		'Interactive',
		$options,
		__NAMESPACE__ . '\\bootstrap'
	);
}

/**
 * Bootstrap module, when enabled.
 */
function bootstrap() {

	// Plugins
	Antispam_Bee\bootstrap();
	Disable_Search\bootstrap();
	Formality\bootstrap();
	Remove_Comments_Absolutely\bootstrap();
	WP_Approve_User\bootstrap();
	
	// Best practices
	Remove_Selfping\bootstrap();
}
