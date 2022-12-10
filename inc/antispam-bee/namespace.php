<?php
/**
 * Figuren_Theater Interactive Antispam_Bee.
 *
 * @package figuren-theater/interactive/antispam_bee
 */

namespace Figuren_Theater\Interactive\Antispam_Bee;

use FT_VENDOR_DIR;

use Figuren_Theater;
use Figuren_Theater\Options;
use function Figuren_Theater\get_config;

use function add_action;
use function remove_submenu_page;

const BASENAME   = 'antispam-bee/antispam_bee.php';
const PLUGINPATH = FT_VENDOR_DIR . '/wpackagist-plugin/' . BASENAME;

/**
 * Bootstrap module, when enabled.
 */
function bootstrap() {

	add_action( 'Figuren_Theater\loaded', __NAMESPACE__ . '\\filter_options', 11 );
	
	add_action( 'plugins_loaded', __NAMESPACE__ . '\\load_plugin', 9 );
}


function load_plugin() : void {

	$config = Figuren_Theater\get_config()['modules']['interactive'];
	if ( ! $config['comments'] )
		return; // early

	require_once PLUGINPATH;

	// Remove plugins menu
	add_action( 'admin_menu', __NAMESPACE__ . '\\remove_menu', 11 );

	add_action( 'wp_dashboard_setup', __NAMESPACE__ . '\\change_meta_box_title', 11 );
}


/**
 * Option-Defaults
 * 
 * @see https://github.com/pluginkollektiv/antispam-bee/blob/f1c36420b630215c0f97eb00c1e91c01e8a9612e/antispam_bee.php#L450
 */
function filter_options() : void {
	
	$_options =  [
		'regexp_check'             => 1,
		'spam_ip'                  => 1,
		'already_commented'        => 1,
		'gravatar_check'           => 0,
		'time_check'               => 0,
		'ignore_pings'             => 0,

		'dashboard_chart'          => 1,
		'dashboard_count'          => 1,

		'country_code'             => 0,
		'country_denied'           => '', # formerly 'country_black'
		'country_allowed'          => '', # formerly 'country_white'

		'translate_api'            => 0,
		'translate_lang'           => [],

		'bbcode_check'             => 1,

		'flag_spam'                => 1,
		'email_notify'             => 0,
		'no_notice'                => 0,
		'cronjob_enable'           => 1,
		'cronjob_interval'         => 30,

		'ignore_filter'            => 0,
		'ignore_type'              => 1,

		'reasons_enable'           => 1,
		'ignore_reasons'           => [ 
			0 => 'css',
		],
		'delete_data_on_uninstall' => 1,

		// 'always_allowed' => 0, # Removed by Plugin @ 2.1.0 # https://github.com/pluginkollektiv/antispam-bee/commit/c21f3f77af47422de2276c1f0176d200bd488cc3
		'cronjob_timestamp'        => time(),
	];

	new Options\Option(
		'antispam_bee',
		$_options,
		BASENAME,
	);
}

function remove_menu() : void {
	remove_submenu_page( 'options-general.php', 'antispam_bee' );
}


function change_meta_box_title() : void {

	global $wp_meta_boxes;

	$post_type  = 'dashboard'; // our screen->ID
	$context    = 'normal';
	$priority   = 'core';
	$id         = 'ab_widget';

	if (isset($wp_meta_boxes[$post_type][$context][$priority][$id]['title']))
		$wp_meta_boxes[$post_type][$context][$priority][$id]['title'] = __('Blocked Spam Comments','figurentheater');
}



