<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function mtt_validate_tracking_provider($new_value, $old_value){
    if($new_value === ''){
        add_settings_error( 'tracking_provider', 'invalid-tracking_provider', __( 'Tracking provider must not be empty. Assigned default value.', 'multiple-tracking-numbers' ), 'error' );
        $new_value = 'none';
    }
    return $new_value;
}

function mtt_validate_tracking_table_label($new_value, $old_value){
    if($new_value === ''){
        add_settings_error( 'tracking_table_label', 'invalid-tracking_table_label', __( 'Tracking table label must not be empty. Assigned default value.', 'multiple-tracking-numbers' ), 'error' );
        $new_value = 'Tracking Number';
    }
    return $new_value;
}
?>