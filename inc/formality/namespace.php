<?php
/**
 * Figuren_Theater Interactive Formality.
 *
 * @package figuren-theater/ft-interactive
 */

namespace Figuren_Theater\Interactive\Formality;

use Figuren_Theater;

use FT_VENDOR_DIR;
use function add_action;

const BASENAME   = 'formality/formality.php';
const PLUGINPATH = '/wpackagist-plugin/' . BASENAME;

/**
 * Bootstrap module, when enabled.
 *
 * @return void
 */
function bootstrap() :void {

	add_action( 'plugins_loaded', __NAMESPACE__ . '\\load_plugin', 0 );
}

/**
 * Conditionally load the plugin itself and its modifications.
 *
 * @return void
 */
function load_plugin() :void {

	$config = Figuren_Theater\get_config()['modules']['interactive'];
	if ( ! $config['formality'] ) {
		return;
	}

	require_once FT_VENDOR_DIR . PLUGINPATH; // phpcs:ignore WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant
}
