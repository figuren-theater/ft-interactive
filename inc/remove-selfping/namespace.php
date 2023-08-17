<?php
/**
 * Figuren_Theater Interactive Remove_Selfping.
 *
 * @package figuren-theater/ft-interactive
 */

namespace Figuren_Theater\Interactive\Remove_Selfping;

use function add_action;
use function get_option;

/**
 * Bootstrap module, when enabled.
 *
 * @return void
 */
function bootstrap() :void {

	add_action( 'pre_ping', __NAMESPACE__ . '\\load' );
}

/**
 * Fires just before pinging back links found in a post.
 *
 * @param string[] $links Array of link URLs to be checked (passed by reference).
 *
 * @return void
 */
function load( &$links ) :void {
	$home = '' . get_option( 'home' ); // Cast to string, the hard way.
	foreach ( $links as $l => $link ) {
		if ( 0 === strpos( $link, $home ) ) {
			unset( $links[ $l ] );
		}
	}
}
