<?php
/**
Plugin Name: JGC Twitter Tweets Widget
Description: A simple plugin that creates a widget to display your Twitter Timeline.
Version: 1.0.2
Author: GalussoThemes
Author URI: https://galussothemes.com
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: jgc-twitter-tweets-widget
Domain Path: /languages

JGC Twitter Tweets Widget is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

JGC Twitter Tweets Widget is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with JGC Twitter Tweets Widget. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'jgcwtt_load_textdomain' );
function jgcwtt_load_textdomain() {

	load_plugin_textdomain( 'jgc-twitter-tweets-widget', false, basename( dirname( __FILE__ ) ) . '/languages' );

}

require_once( plugin_dir_path( __FILE__ ) . 'inc/jgc-widget-twitter-tweets.php' );
