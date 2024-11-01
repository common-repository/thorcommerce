<?php 

add_action( 'woocommerce_before_order_notes', 'my_custom_checkout_field' );

function my_custom_checkout_field( $checkout ) {

    echo '<div id="my_custom_checkout_field">';

    woocommerce_form_field( 'my_field_name', array(
        'type'          => 'text',
        'class'         => array('my-field-class form-row-wide'),
        'label'         => __('Payer Wallet Address'),
        'placeholder'   => __('Enter your Wallet Address'),
        'required'  => true,
        ), $checkout->get_value( 'my_field_name' ));

    echo '</div>';

}



//validation

add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

function my_custom_checkout_field_process() {
    // Check if set, if its not set add an error.
    if ( ! $_POST['my_field_name'] )
        wc_add_notice( __( 'Please enter your  Wallet Address that you will use to pay, otherwise we can not detected its you and your money will gone for ever.' ), 'error' );
}


// update field data

add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

function my_custom_checkout_field_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['my_field_name'] ) ) {
        update_post_meta( $order_id, 'Customer Wallet Address', sanitize_text_field( $_POST['my_field_name'] ) );
    }
}


//adding the value to the admin order details/edit

add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

function my_custom_checkout_field_display_admin_order_meta($order){
    echo '<p style="color:green;"><strong style="color:red;font-weight:700;">'.__('Customer Wallet Address').':</strong> ' . get_post_meta( $order->get_id(), 'Customer Wallet Address', true ) . '</p>';
}


//adding email fiels

add_filter('woocommerce_email_order_meta_keys', 'my_custom_order_meta_keys');

function my_custom_order_meta_keys( $keys ) {
     $keys[] = 'Customer Wallet Address'; // This will look for a custom field called 'Tracking Code' and add it to emails
     return $keys;
}





 ?>