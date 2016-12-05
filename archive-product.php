<?php
get_header();
?>

<main id="main-content" class="main-content-padding">
  <section id="posts">
    <div class="container">
      <div class="grid-row">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $product = new WC_Product($post->ID);
    $in_stock = $product->is_in_stock();
    $availability = $product->get_availability();
    $price = $product->get_price_html();
?>

        <article <?php post_class('grid-item item-s-12 item-l-6 item-xl-4 no-gutter grid-row margin-bottom-mid'); ?> id="post-<?php the_ID(); ?>">

          <div class="grid-item item-s-6">
            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('item-l-3-3x4-crop'); ?></a>
          </div>

          <div class="grid-item item-s-4 offset-s-1">
            <h2 class="margin-bottom-small font-size-medium"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
<?php 
    if (!$in_stock) {
      echo $availability['availability'];
    } else {
      echo $price;
    }
?>
          </div>

        </article>

<?php
  }
} else {
?>
        <article class="u-alert grid-item item-s-12"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>