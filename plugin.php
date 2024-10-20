<?php
/**
 * Plugin Name:     figuren.theater | Interactive
 * Plugin URI:      https://github.com/figuren-theater/ft-interactive
 * Description:     Combined workflows for interactive UX using forms, comments, webmentions, etc. Code related to user generated content for a WordPress Multisite like figuren.theater.
 * Author:          figuren.theater
 * Author URI:      https://figuren.theater
 * Text Domain:     figurentheater
 * Domain Path:     /languages
 * Version:         1.2.0
 *
 * @package         figuren-theater/ft-interactive
 */

namespace Figuren_Theater\Interactive;

const DIRECTORY = __DIR__;

add_action( 'altis.modules.init', __NAMESPACE__ . '\\register' );
