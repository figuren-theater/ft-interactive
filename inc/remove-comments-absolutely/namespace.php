<?php
/**
 * Figuren_Theater Interactive Remove_Comments_Absolutely.
 *
 * @package figuren-theater/interactive/remove_comments_absolutely
 */

namespace Figuren_Theater\Interactive\Remove_Comments_Absolutely;

use FT_VENDOR_DIR;

use Figuren_Theater;
use function Figuren_Theater\get_config;

use Remove_Comments_Absolute;

use function add_action;
use function add_filter;
use function remove_action;

const BASENAME   = 'remove-comments-absolutely/remove-comments-absolute.php';
const PLUGINPATH = FT_VENDOR_DIR . '/bueltge/' . BASENAME;

/**
 * Bootstrap module, when enabled.
 */
function bootstrap() {

	add_action( 'Figuren_Theater\loaded', __NAMESPACE__ . '\\filter_blocks', 0 );

	add_action( 'plugins_loaded', __NAMESPACE__ . '\\load_plugin', 9 );
}

function load_plugin() {

	$config = Figuren_Theater\get_config()['modules']['interactive'];
	if ( $config['comments'] )
		return; // early

	require_once PLUGINPATH;

	add_action( 'load-profile.php', __NAMESPACE__ . '\\patch__remove_profile_items' );

}

function filter_blocks(){
	add_filter( 'Figuren_Theater\Admin_UI\Disable_Gutenberg_Blocks', __NAMESPACE__ . '\\disable_blocks' );
}

function patch__remove_profile_items() {
	
	$rca = Remove_Comments_Absolute::get_object();
	
	// this removes the admin-color-scheme select (by accident)
	// so, we need to disable this
	remove_action( 'personal_options', [ $rca, 'remove_profile_items' ] );
	// and add this as a correction
	add_action( 'personal_options', function ()	{
		?>
		<script type="text/javascript">
			//<![CDATA[
			jQuery( document ).ready( function( $ ) {
				$( '#your-profile' ).find( '.form-table' ).first().find( 'tr.user-comment-shortcuts-wrap' ).remove();
			} );
			//]]>
		</script>
		<?php
	} );
}

function disable_blocks( array $blocks_to_disable ) : array {
	
	$blocks_to_disable[] = 'core/comment-author-name';
	$blocks_to_disable[] = 'core/comment-content';
	$blocks_to_disable[] = 'core/comment-date';
	$blocks_to_disable[] = 'core/comment-edit-link';
	$blocks_to_disable[] = 'core/comment-reply-link';
	$blocks_to_disable[] = 'core/comment-template';
	
	$blocks_to_disable[] = 'core/comments-pagination';
	$blocks_to_disable[] = 'core/comments-pagination-next';
	$blocks_to_disable[] = 'core/comments-pagination-numbers';
	$blocks_to_disable[] = 'core/comments-pagination-previous';
	$blocks_to_disable[] = 'core/comments-query-loop';
	$blocks_to_disable[] = 'core/comments-title';

	$blocks_to_disable[] = 'core/latest-comments';
	$blocks_to_disable[] = 'core/post-comments';
	$blocks_to_disable[] = 'core/post-comments-form';
	$blocks_to_disable[] = 'core/post-comments-count';
	$blocks_to_disable[] = 'core/post-comments-link';

	$blocks_to_disable[] = 'core/avatar';
	
	return $blocks_to_disable;
}
