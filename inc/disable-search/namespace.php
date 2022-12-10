<?php
/**
 * Figuren_Theater Interactive Disable_Search.
 *
 * @package figuren-theater/interactive/disable_search
 */

namespace Figuren_Theater\Interactive\Disable_Search;

use FT_VENDOR_DIR;

use Figuren_Theater;
use function Figuren_Theater\get_config;

use function add_action;
use function add_filter;
use function remove_action;

const BASENAME   = 'disable-search/disable-search.php';
const PLUGINPATH = FT_VENDOR_DIR . '/wpackagist-plugin/' . BASENAME;

/**
 * Bootstrap module, when enabled.
 */
function bootstrap() {

	add_action( 'plugins_loaded', __NAMESPACE__ . '\\load_plugin', 0 );
}

function load_plugin() {

	$config = Figuren_Theater\get_config()['modules']['interactive'];
	if ( $config['search'] )
		return; // early

	require_once PLUGINPATH;

	remove_action( 'init', [ 'c2c_DisableSearch', 'disable_core_search_block' ], 11 );
	remove_action( 'enqueue_block_editor_assets', [ 'c2c_DisableSearch', 'enqueue_block_editor_assets' ] );

	add_filter( 'Figuren_Theater\Admin_UI\Disable_Gutenberg_Blocks', __NAMESPACE__ . '\\disable_search_block'	);
}

function disable_search_block( array $blocks_to_disable ) : array {
	
	$blocks_to_disable[] = 'core/search';
	
	return $blocks_to_disable;
}
