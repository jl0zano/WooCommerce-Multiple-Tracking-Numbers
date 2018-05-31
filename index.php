<?php
/*
* Plugin Name: WooCommerce Multiple Tracking Numbers
* Plugin URI:
* Description: Lets you add separate tracking numbers for order products in WooCommerce.
* Author: Jaime Lozano
* Author URI: https://jaimelozano.me
* Version: 0.1

Multiple Tracking Numbers is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Multiple Tracking Numbers is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action('plugins_loaded', 'mtt_check_for_woocommerce');
function mtt_check_for_woocommerce() {
    if (defined('WC_VERSION')) {
        require_once(plugin_dir_path(__FILE__).'/includes/mtt-scripts.php');
    }
}

function multiple_tracking_plugin_path() {
  return untrailingslashit( plugin_dir_path( __FILE__ ) );
}

add_filter( 'woocommerce_locate_template', 'multiple_tracking_woocommerce_locate_template', 10, 3 );
function multiple_tracking_woocommerce_locate_template( $template, $template_name, $template_path ) {
  global $woocommerce;
  $_template = $template;
  
  if ( ! $template_path ) $template_path = $woocommerce->template_url;

  $plugin_path  = multiple_tracking_plugin_path() . '/woocommerce/';
  $template = locate_template(
    array(
      $template_path . $template_name,
      $template_name
    )
  );

  if ( ! $template && file_exists( $plugin_path . $template_name ) )
    $template = $plugin_path . $template_name;

  if ( ! $template )
    $template = $_template;
    
  return $template;
}

add_action('plugins_loaded', 'mtt_load_textdomain');
function mtt_load_textdomain() {
	load_plugin_textdomain( 'multiple-tracking-numbers', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
}

?>