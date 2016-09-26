<?php
get_header();
?>

<!-- main content -->
<main id="main-content" class="main-content-padding">
  <section id="cart">
    <div class="container">

  <!-- main posts loop -->
<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
    the_content();
  }
} else {
?>
    <article class="col col12 u-alert"><?php _e('Sorry, no page matched your criteria :{'); ?></article>
<?php
} ?>
    </div>
  </section>
<!-- end main-content -->
</main>

<?php
get_footer();
?>
