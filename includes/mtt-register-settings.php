<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function mtt_register_settings() {
	register_setting('mtt-settings-group', 'tracking_provider', array(
		'type' => 'string',
		'default' => 'none',
		'sanitize_callback' => 'mtt_validate_tracking_provider'
	));
	
	register_setting('mtt-settings-group', 'tracking_table_label', array(
		'type' => 'string',
		'default' => 'Tracking Number',
		'sanitize_callback' => 'mtt_validate_tracking_table_label'
	));
}
?>