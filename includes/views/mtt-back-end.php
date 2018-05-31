<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action("admin_menu", "mtt_add_menu");
function mtt_add_menu(){
	add_submenu_page("woocommerce", "Multiple Tracking", "Multiple Tracking", 4, "multiple-tracking", "mtt_main_page");
	add_action( 'admin_init', 'mtt_register_settings' );
}

function mtt_main_page(){
?>
<div class="wrap">
	<h1><?php _e('Multiple Tracking Numbers', 'multiple-tracking-numbers'); ?></h1>
	<?php
	if( isset( $_GET[ 'tab' ] ) ) {
		$active_tab = $_GET[ 'tab' ];
	}else{
		$active_tab = 'welcome';
	}
	?>
	<h2 class="nav-tab-wrapper">
		<a href="?page=multiple-tracking" class="nav-tab <?php echo $active_tab == 'welcome' ? 'nav-tab-active' : ''; ?>"><?php _e('Welcome', 'multiple-tracking-numbers'); ?></a>
		<a href="?page=multiple-tracking&tab=mtt-settings" class="nav-tab <?php echo $active_tab == 'mtt-settings' ? 'nav-tab-active' : ''; ?>"><?php _e('Settings', 'multiple-tracking-numbers'); ?></a>
	</h2>
	<?php
	if($active_tab === 'welcome'){
	?>
	<p><?php _e("Lets you add separate tracking numbers for order products in WooCommerce. This is perfect if you manage split shipping for products on a same order, or if you're dropshipping and need different tracking for each product.", 'multiple-tracking-numbers'); ?></p>
	<h3><?php _e('How to use?', 'multiple-tracking-numbers'); ?></h3>
	<h4>1. <?php _e('Go to order page', 'multiple-tracking-numbers'); ?></h4>

	<h4>2. <?php _e('Hover over the product you want to add tracking to and click the edit button.', 'multiple-tracking-numbers'); ?> <?php _e('You can only modify the tracking info if order is pending payment or processing.', 'multiple-tracking-numbers'); ?></h4>
	<img src="<?php echo plugins_url('/multiple-tracking-numbers/images/'); ?>step2.jpg" style="max-width: 100%" />
	<h4>3. <?php _e('Place the tracking number on the input field', 'multiple-tracking-numbers'); ?></h4>
	<img src="<?php echo plugins_url('/multiple-tracking-numbers/images/'); ?>step3.jpg" style="max-width: 100%" />
	<h4>5. <?php _e('Save the order', 'multiple-tracking-numbers'); ?></h4>
	<img src="<?php echo plugins_url('/multiple-tracking-numbers/images/'); ?>step5.jpg" style="max-width: 100%" />
	<h4>6. <?php _e('Done! Users will now see it in their order detail.', 'multiple-tracking-numbers'); ?></h4>
	<img src="<?php echo plugins_url('/multiple-tracking-numbers/images/'); ?>step6.jpg" style="max-width: 100%" />
	<?php }else if($active_tab === 'mtt-settings'){ ?>
	<?php settings_errors(); ?>
	<form method="post" action="options.php">
	    <?php settings_fields( 'mtt-settings-group' ); ?>
	    <?php do_settings_sections( 'mtt-settings-group' ); ?>
	    <?php $mtt_current_track = esc_attr( get_option('tracking_provider') ); ?>
	    <table class="form-table">
	        <tr valign="top">
	        <th scope="row"><?php _e('Tracking Provider', 'multiple-tracking-numbers'); ?></th>
	        <td>
			<select name="tracking_provider">
				<option value="none" <?php if($mtt_current_track == 'none'){ echo "selected"; } ?>><?php _e('None', 'multiple-tracking-numbers'); ?></option>
				<option value="17track" <?php if($mtt_current_track == '17track'){ echo "selected"; } ?>>17Track</option>
				<option value="aftership" <?php if($mtt_current_track == 'aftership'){ echo "selected"; } ?>>AfterShip</option>
			</select>
	        </td>
	        <td><i><?php _e("This will set the tracking service users will be redirected to when they click the tracking number in their order page. If you set it to 'None', the tracking number will appear but won't redirect anywhere.", 'multiple-tracking-numbers'); ?></i></td>
	        </tr>
	         
	        <tr valign="top">
	        <th scope="row"><?php _e('Tracking column header label', 'multiple-tracking-numbers'); ?></th>
	        <td><input type="text" name="tracking_table_label" value="<?php echo esc_attr( get_option('tracking_table_label') ); ?>" /></td>
	        <td><i><?php _e('This will set the name of the tracking column on the order page. Use it to set the label to a different language, for example.', 'multiple-tracking-numbers'); ?></i></td>
	        </tr>
	    </table>
	    
	    <?php submit_button(); ?>

	</form>
	<?php } ?>
	<p><i><?php _e('Plugin made by', 'multiple-tracking-numbers'); ?> <a href="https://jaimelozano.me" target="_blank">Jaime Lozano</a>. <?php _e('Feel free to contribute to the plugin!', 'multiple-tracking-numbers'); ?> <?php _e('Visit the', 'multiple-tracking-numbers'); ?> <a href="https://github.com/jl0zano"><?php _e('repo', 'multiple-tracking-numbers'); ?></a>.</i></p>
</div>
<?php
}
?>