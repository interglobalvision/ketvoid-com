<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) { ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

  <div id="customer_details" class="padding-bottom-small margin-bottom-basic">

    <div class="grid-row table-row">

      <div class="grid-item item-s-12 item-m-6 offset-m-3">
        <?php do_action( 'woocommerce_checkout_billing' ); ?>
      </div>

      <div class="grid-item item-s-12 item-m-6 offset-m-3 margin-top-tiny margin-bottom-small">
        <div id="ship-to-different-address">
          <label for="ship-to-different-address-checkbox" class="checkbox font-bold font-uppercase"><?php _e( 'Ship to a different address?', 'woocommerce' ); ?></label>
          <input id="ship-to-different-address-checkbox" class="input-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" />
        </div>
      </div>

    </div>

      <?php do_action( 'woocommerce_checkout_shipping' ); ?>

      <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

    <?php } ?>
  </div>

  <div class="grid-row">
    <div class="grid-item item-s-12 item-m-6 offset-m-3 no-gutter">
      <div id="order_review_heading" class="grid-row table-row margin-bottom-small">
        <div class="grid-item item-s-12">
          <h3 class="font-size-medium"><?php _e( 'Your order', 'woocommerce' ); ?></h3>
        </div>
      </div>

      <div class="grid-row table-row margin-bottom-tiny">
        <div class="grid-item item-s-6">
          <h3 class="font-bold font-size-basic font-uppercase"><?php _e( 'Product', 'woocommerce' ); ?></h3>
        </div>
        <div class="grid-item item-s-6">
          <h3 class="font-bold font-size-basic font-uppercase text-align-right"><?php _e( 'Total', 'woocommerce' ); ?></h3>
        </div>
      </div>

    	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

    	<div id="order_review" class="woocommerce-checkout-review-order">
    		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
    	</div>

    	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
    </div>
  </div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
