<?php
/**
 * Figuren_Theater Interactive Remove_Selfping.
 *
 * @package figuren-theater/interactive/remove_selfping
 */

namespace Figuren_Theater\Interactive\Remove_Selfping;

use function add_action;
use function get_option;


/**
 * Bootstrap module, when enabled.
 */
function bootstrap() {

	add_action( 'pre_ping', __NAMESPACE__ . '\\load' );
}

function load( &$links ) {
	$home = get_option( 'home' );
	foreach ( $links as $l => $link )
		if ( 0 === strpos( $link, $home ) )
			unset($links[$l]);
}
