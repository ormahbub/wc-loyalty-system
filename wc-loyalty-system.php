<?php
/**
 * Plugin Name: WooCommerce Loyalty System
 * Plugin URI: #
 * Description: Simple loyalty points system for WooCommerce.
 * Version: 1.0.0
 * Author: Mahbub
 * Author URI: https://orm.kesug.com/
 * Text Domain: wc-loyalty-system
 * **/

if ( ! defined( "ABSPATH" ) ) {
  exit;
}

define( "WCLS_VERSION", "1.0.0" );
define( "WCLS_PATH", plugin_dir_path(__FILE__) );
define( "WCLS_URL", plugin_dir_url(__FILE__) );

require_once WCLS_PATH . "includes/class-plugin.php";

function wcls_init() {
  \WCLS\Plugin::instance();
}
add_action( "plugins_loaded", "wcls_init" );
