<?php
/**
 * Figuren_Theater Interactive Formality.
 *
 * @package figuren-theater/interactive/formality
 */

namespace Figuren_Theater\Interactive\Formality;

use FT_VENDOR_DIR;

use Figuren_Theater;
use function Figuren_Theater\get_config;

use function add_action;

const BASENAME   = 'formality/formality.php';
const PLUGINPATH = FT_VENDOR_DIR . '/wpackagist-plugin/' . BASENAME;

/**
 * Bootstrap module, when enabled.
 */
function bootstrap() {

	add_action( 'plugins_loaded', __NAMESPACE__ . '\\load_plugin', 0 );
}

function load_plugin() {

	$config = Figuren_Theater\get_config()['modules']['interactive'];
	if ( ! $config['formality'] )
		return; // early

	require_once PLUGINPATH;
}
