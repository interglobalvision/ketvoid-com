<?php
get_header();

$images = get_post_meta($post->ID, '_igv_home_imgs', true);
$video = get_post_meta($post->ID, '_igv_home_video', true);
?>

<main id="main-content">
<?php
if (!empty($images)) {
  if (count($images) == 4) {
?>
  <div class="home-image home-image-top">
    <div class="home-image-bg home-image-bg-top" style="background-image: url('<?php echo wp_get_attachment_image_src($images[0], 'full')[0]; ?>')"></div>
  </div>
  
  <div class="home-image home-image-right">
    <div class="home-image-bg home-image-bg-right" style="background-image: url('<?php echo wp_get_attachment_image_src($images[1], 'full')[0]; ?>')"></div>
  </div>

  <div class="home-image home-image-bottom">
    <div class="home-image-bg home-image-bg-bottom" style="background-image: url('<?php echo wp_get_attachment_image_src($images[2], 'full')[0]; ?>')"></div>
  </div>

  <div class="home-image home-image-left">
    <div class="home-image-bg home-image-bg-left" style="background-image: url('<?php echo wp_get_attachment_image_src($images[3], 'full')[0]; ?>')"></div>
  </div>
<?php 
  }
}

if (!empty($video)) {
?>
  <div class="home-video">
    <video id="home-video-player" class="video-js"></video>
  </div>
<?php
}
?>
</main>

<?php
get_footer();
?>