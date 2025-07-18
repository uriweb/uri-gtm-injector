<?php
/**
 * Plugin Name: URI GTM Injector
 * Plugin URI: http://github.com/uriweb/uri-gtm-injector
 * Description: A GTM injector for WordPress sites
 * Version: 1.0.0
 * Author: URI Web Communications
 * Author URI: https://www.uri.edu/wordpress
 *
 * @author: Brandon Fuller <bjcfuller@uri.edu>
 * @package uri-gtm-injector
 */

// Block direct requests
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

define( 'URI_GTM_INJECTOR_DIR_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Returns version from package.json to be used for cache busting
 *
 * @return str
 */
function uri_gtm_injector_cache_buster() {
	static $cache_buster;
	if ( empty( $cache_buster ) && function_exists( 'get_plugin_data' ) ) {
		$values = get_plugin_data( URI_GTM_INJECTOR_DIR_PATH . 'uri-gtm-injector.php', false );
		$cache_buster = $values['Version'];
	} else {
		$cache_buster = gmdate( 'Ymd', strtotime( 'now' ) );
	}
	return $cache_buster;
}

// Include settings
include( URI_GTM_INJECTOR_DIR_PATH . 'inc/uri-gtm-injector-settings.php' );

// Include actions
include( URI_GTM_INJECTOR_DIR_PATH . 'inc/uri-gtm-injector-actions.php' );