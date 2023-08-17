<?php
/**
 * Figuren_Theater Interactive Disable_Search.
 *
 * @package figuren-theater/ft-interactive
 */

namespace Figuren_Theater\Interactive\Disable_Search;

use Figuren_Theater;

use FT_VENDOR_DIR;
use function add_action;

use function add_filter;
use function remove_action;

const BASENAME   = 'disable-search/disable-search.php';
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
	if ( $config['search'] ) {
		return;
	}

	require_once FT_VENDOR_DIR . PLUGINPATH; // phpcs:ignore WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant

	remove_action( 'init', [ 'c2c_DisableSearch', 'disable_core_search_block' ], 11 );
	remove_action( 'enqueue_block_editor_assets', [ 'c2c_DisableSearch', 'enqueue_block_editor_assets' ] );

	add_filter( 'Figuren_Theater\Admin_UI\Disable_Gutenberg_Blocks', __NAMESPACE__ . '\\disable_search_block' );
}

/**
 * Undocumented function
 *
 * @param string[] $blocks_to_disable List of (gutenberg) editor block slugs
 *
 * @return string[]
 */
function disable_search_block( array $blocks_to_disable ) :array {

	$blocks_to_disable[] = 'core/search';

	return $blocks_to_disable;
}
