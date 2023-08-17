<?php
/**
 * Figuren_Theater Interactive.
 *
 * @package figuren-theater/ft-interactive
 */

namespace Figuren_Theater\Interactive;

use Altis;

/**
 * Register module.
 *
 * @return void
 */
function register() :void {

	$default_settings = [
		'enabled'         => true, // Needs to be set.
		'comments'        => false,
		'search'          => false,
		'formality'       => false,
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
 *
 * @return void
 */
function bootstrap() :void {

	// Plugins.
	Antispam_Bee\bootstrap();
	Disable_Comments\bootstrap();
	Disable_Search\bootstrap();
	Formality\bootstrap();

	// Best practices.
	Remove_Selfping\bootstrap();
}
