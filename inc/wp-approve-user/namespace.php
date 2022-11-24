<?php
/**
 * Figuren_Theater Interactive WP_Approve_User.
 *
 * @package figuren-theater/interactive/wp_approve_user
 */

namespace Figuren_Theater\Interactive\WP_Approve_User;

use FT_VENDOR_DIR;

use function add_action;

const BASENAME   = 'wp-approve-user/wp-approve-user.php';
const PLUGINPATH = FT_VENDOR_DIR . '/wpackagist-plugin/' . BASENAME;

/**
 * Bootstrap module, when enabled.
 */
function bootstrap() {

	add_action( 'plugins_loaded', __NAMESPACE__ . '\\load_plugin', 0 );
}

function load_plugin() {

	require_once PLUGINPATH;
}
