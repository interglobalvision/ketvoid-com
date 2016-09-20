<?php
get_header();
?>

<main id="main-content" class="main-content-padding">
  <section id="posts">
    <div class="container">
      <div class="grid-row">
        <div class="grid-item item-s-12 item-m-8 offset-m-2 item-l-6 offset-l-3 margin-top-large">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>
          <article <?php post_class('archive-collection-item'); ?> id="post-<?php the_ID(); ?>">
            <h2><a href="<?php the_permalink() ?>" class="archive-collection-link"><?php the_title(); ?></a></h2>
            <div class="archive-collection-image-holder grid-row">
              <?php the_post_thumbnail('item-l-3-4x3'); ?>
            </div>
          </article>
<?php
  }
} else {
?>
          <article class="u-alert"><?php _e('no collections'); ?></article>
<?php
} ?>
        </div>
      </div>
    </div>
  </section>

  <?php get_template_part('partials/pagination'); ?>

</main>

<?php
get_footer();
?>