<?php
get_header();
?>

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $images = get_post_meta($post->ID, '_igv_collection_imgs', true);
    $background = get_post_meta($post->ID, '_igv_collection_bg', true);
    $vimeo_id = get_post_meta($post->ID, '_igv_collection_vimeo_id', true);
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
          $video_index = ceil(count($images) / 2);
          $i = 1;

          foreach ($images as $image) {
            echo wp_get_attachment_image( $image, 'gallery', false, array('class'=>'single-collection-item', 'data-no-lazysizes'=>''));

            if ($i == $video_index && !empty($vimeo_id)) {
              echo '<div class="single-collection-item"><iframe src="https://player.vimeo.com/video/' . $vimeo_id . '?autoplay=1&loop=1" class="single-collection-video" frameborder="0"></iframe></div>';
            }
            $i++;
          }
        }

        if (get_the_content() !== '') {
      ?>
        <div class="single-collection-text grid-column
        justify-center">
          <?php the_content(); ?>
        </div>
      <?php
        }
      ?>

      </div>
    </article>

<?php
  }
} else {
?>
    <article class="u-alert font-size-large"><?php _e('No collection'); ?></article>
<?php
} ?>

<?php
get_footer();
?>
