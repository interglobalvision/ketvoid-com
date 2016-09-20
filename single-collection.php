<?php
get_header();
?>

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $images = get_post_meta($post->ID, '_igv_collection_imgs', true);
    $background = get_post_meta($post->ID, '_igv_collection_bg', true);
?>
    <?php 
      if (!empty($background)) {
    ?>
    <div class="single-collection-background" style="background-image:url('<?php echo $background ?>')"></div>
    <?php
      } 
    ?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
      <div class="grid-row single-collection-row align-items-center">

      <?php 
        if (!empty($images)) {
          foreach ($images as $image) {
            echo wp_get_attachment_image( $image, 'full', false, array('class'=>'single-collection-item'));
          }
        }
      ?>

      </div>
      <div class="single-collection-title font-uppercase"><h1><?php the_title(); ?></h1></div>
    </article>

<?php
  }
} else {
?>
    <article class="u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>

<?php
get_footer();
?>