<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
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
?>

<div class="shop_table woocommerce-checkout-review-order-table margin-bottom-small">
<?php
  do_action( 'woocommerce_review_order_before_cart_contents' );

  foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
    $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
      ?>
      <div class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'grid-row cart_item margin-bottom-small', $cart_item, $cart_item_key ) ); ?>">
        <div class="grid-item item-s-6 product-name">
          <span>
            <?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
            <?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
            <?php echo WC()->cart->get_item_data( $cart_item ); ?>
          </span>
        </div>
        <div class="grid-item item-s-6 product-total text-align-right">
            <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
        </div>
      </div>
      <?php
    }
  }

  do_action( 'woocommerce_review_order_after_cart_contents' );
?>

		<div class="grid-row padding-top-small padding-bottom-small table-row cart-subtotal">
      <div class="grid-item item-s-6 font-uppercase font-bold">
        <span><?php _e( 'Subtotal', 'woocommerce' ); ?></span>
      </div>
      <div class="grid-item item-s-6 text-align-right">
        <?php wc_cart_totals_subtotal_html(); ?>
      </div>
		</div>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
		<div class="grid-row padding-top-small padding-bottom-small cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
      <div class="grid-item item-s-6 font-uppercase font-bold">
				<span><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
      </div>
      <div class="grid-item item-s-6 text-align-right">
				<span><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
      </div>
    </div>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
      <div class="grid-row padding-top-small padding-bottom-small fee">
        <div class="grid-item item-s-12 item-m-6 font-uppercase font-bold">
          <span><?php echo esc_html( $fee->name ); ?></span>
        </div>
        <div class="grid-item item-s-12 item-m-6 text-align-right">
          <span><?php wc_cart_totals_fee_html( $fee ); ?></span>
        </div>
      </div>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
        <div class="grid-row table-row padding-top-small padding-bottom-small tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
          <div class="grid-item item-s-12 item-m-6 font-uppercase font-bold">
						<span><?php echo esc_html( $tax->label ); ?></span>
          </div>
          <div class="grid-item item-s-12 item-m-6 text-align-right">
						<span><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
					</div>
        </div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="grid-row table-row tax-total padding-top-small padding-bottom-small">
          <div class="grid-item item-s-12 item-m-6">
            <span><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></span>
          </div>
          <div class="grid-item item-s-12 item-m-6 text-align-right">
            <span><?php wc_cart_totals_taxes_total_html(); ?></span>
          </div>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<div class="grid-row padding-top-small padding-bottom-small table-row order-total">
      <div class="grid-item item-s-6 font-uppercase font-bold">
        <span><?php _e( 'Total', 'woocommerce' ); ?></span>
      </div>
      <div class="grid-item item-s-6 text-align-right font-size-medium">
        <span><?php wc_cart_totals_order_total_html(); ?></span>
      </div>
		</div>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

</div>
