<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include(dirname(__FILE__).'/views/mtt-back-end.php');

include(dirname(__FILE__).'/mtt-register-settings.php');

include(dirname(__FILE__).'/mtt-options-validation.php');


add_action('init','mtt_initiate');
function mtt_initiate(){
	$current_user = wp_get_current_user();
	if(current_user_can('administrator')){
		add_filter( 'wc_order_is_editable', 'mtt_make_processing_orders_editable', 10, 2 );
	}
}

function mtt_make_processing_orders_editable( $is_editable, $order ) {
	if ( $order->get_status() == 'processing' ) {
		$is_editable = true;
	}
	return $is_editable;
}

function mtt_add_individual_tracking( $item, $cart_item_key, $values, $order ) {
	$item->add_meta_data( 'tracking', '-' );
}

add_action( 'woocommerce_checkout_create_order_line_item', 'mtt_add_individual_tracking', 10, 4 );

?>