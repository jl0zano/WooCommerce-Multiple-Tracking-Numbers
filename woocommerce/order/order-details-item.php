<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
?>
<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order ) ); ?>">

	<td class="woocommerce-table__product-name product-name">
		<?php
			$is_visible        = $product && $product->is_visible();
			$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );

			echo apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible );
			echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item->get_quantity() ) . '</strong>', $item );
		?>
	</td>

	<td class="woocommerce-table__product-total product-total">
		<?php echo $order->get_formatted_line_subtotal( $item ); ?>
	</td>

	<td class="woocommerce-table__product-total">
		<?php
			$mtt_tracking_number = wc_get_order_item_meta($item_id, 'tracking');
			if($mtt_tracking_number != "-"){
				$mtt_tracking_provider = get_option('tracking_provider');

				if($mtt_tracking_provider=="none"){
					echo $mtt_tracking_number;
				}else{

				

				if($mtt_tracking_provider == "aftership"){
					$mtt_tracking_url="https://track.aftership.com/";
				}else if($mtt_tracking_provider == "17track"){
					$mtt_tracking_url="https://t.17track.net/en#nums=";
				}
		?>
		<a href="<?php echo $mtt_tracking_url.$mtt_tracking_number; ?>" target="_blank"><?php echo $mtt_tracking_number; ?></a>
		<?php
	}
			}else{ echo "-"; } 

		?>
	</td>

</tr>

<?php if ( $show_purchase_note && $purchase_note ) : ?>

<tr class="woocommerce-table__product-purchase-note product-purchase-note">

	<td colspan="2"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>

</tr>

<?php endif; ?>
