<?php
get_header();
?>

<main id="main-content" class="main-content-padding">
  <section id="posts">
    <div class="container">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    global $product;
    $product_id = $product->id;
    $in_stock = $product->is_in_stock();
    $availability = $product->get_availability();
    $price = $product->get_price_html();
    $attributes = $product->get_attributes();
    $cart_text = $product->single_add_to_cart_text();
    $image_ids = $product->get_gallery_attachment_ids();
?>

        <article <?php post_class('grid-row'); ?> id="post-<?php the_ID(); ?>">

          <div class="grid-item item-s-10 offset-s-1 item-m-7 offset-m-0 item-l-6">
<?php
    if (!empty($image_ids)) {
?>
            <div id="product-gallery-container" class="swiper-container">
              <div class="swiper-wrapper">
<?php
      foreach ($image_ids as $id) {
?>
              <div class="swiper-slide grid-column justify-center align-items-center">
                <?php echo wp_get_attachment_image( $id, 'full', '', 'class=single-product-image' ); ?>
              </div>
<?php
      }
?>
              </div>
            </div>
<?php
    } else {
?>
            <?php the_post_thumbnail('full', 'class=single-product-image'); ?>
<?php
    }
?>
          </div>

          <div class="grid-item item-s-1 grid-column justify-end">
<?php
    if (!empty($image_ids)) {
?>
            <div class="slider-pagination-holder">
              <div class="slider-pagination-button slider-next">
                <?php echo url_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/icon-next.svg'); ?>
              </div>
            </div>
<?php
    }
?>
          </div>

          <div id="single-product-info" class="grid-item item-s-12 item-m-3 offset-m-1 item-l-3 offset-l-2">
            <h1 class="margin-bottom-small font-uppercase font-size-medium font-bold"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
            <?php the_content(); ?>
            <?php echo $product->get_price_html(); ?>
            <?php do_action( 'woocommerce_' . $product->product_type . '_add_to_cart' ); ?>
          </div>

        </article>

<?php
  }
} else {
?>
        <article class="u-alert grid-item item-s-12 font-size-large"><?php _e('No product'); ?></article>
<?php
} ?>
    </div>
  </section>
</main>

<?php
get_footer();
?>
