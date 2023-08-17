<?php
/**
 * Figuren_Theater Interactive Disable_Comments.
 *
 * @package figuren-theater/ft-interactive
 */

namespace Figuren_Theater\Interactive\Disable_Comments;

use Figuren_Theater;

use FT_VENDOR_DIR;
use function add_action;

const BASENAME   = 'disable-comments/disable-comments.php';
const PLUGINPATH = '/inpsyde/' . BASENAME;

/**
 * Bootstrap module, when enabled.
 *
 * @return void
 */
function bootstrap() :void {
	add_action( 'plugins_loaded', __NAMESPACE__ . '\\load_plugin', 9 );
}

/**
 * Conditionally load the plugin itself and its modifications.
 *
 * @return void
 */
function load_plugin() :void {

	$config = Figuren_Theater\get_config()['modules']['interactive'];
	if ( $config['comments'] ) {
		return;
	}

	require_once FT_VENDOR_DIR . PLUGINPATH; // phpcs:ignore WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant

}

