<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <div class="grid-row">
        <div class="grid-item item-s-12 item-m-8 offset-m-2 item-l-6 offset-l-3">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>
          <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
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