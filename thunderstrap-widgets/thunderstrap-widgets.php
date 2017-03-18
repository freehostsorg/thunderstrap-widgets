<?php

/**
 * Thunderstrap Widgets
 *
 * WordPress plugin for adding Bootstrap 4 widgets to Understrap based themes.
 *
 * @link              https://github.com/radixmo/thunderstrap-widgets
 * @since             0.0.1
 * @package           Thunderstrap_Widgets
 *
 * @wordpress-plugin
 * Plugin Name:       Thunderstrap Widgets
 * Plugin URI:        https://github.com/radixmo/thunderstrap-widgets
 * Description:       This plugin creates Bootstrap 4 widgets for Understrap based themes.
 * Version:           0.0.1
 * Author:            Len Johnson
 * Author URI:        https://radixmo.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       thunderstrap-widgets
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) .'inc/class-jumbotron.php';
require_once plugin_dir_path( __FILE__ ) .'inc/functions.php';

add_action( 'widgets_init', 'thunderstrap_register_widgets' );
function thunderstrap_register_widgets() {
	register_widget( 'thunderstrap_jumbotron' );
}
