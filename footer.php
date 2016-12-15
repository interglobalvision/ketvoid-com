  <footer id="footer" class="text-shadow">
    <nav class="grid-row justify-between align-items-end font-uppercase font-size-medium font-bold">
      <div>
        <a class="menu-item" href="<?php echo home_url('/collection'); ?>">Collections</a>
      </div>
      <div class="grid-row">
        <a class="menu-item" href="<?php echo home_url('/shop'); ?>">Shop</a>
<?php
  $cart_count = WC()->cart->get_cart_contents_count();

  if ($cart_count > 0) {
?>
        <a class="footer-cart menu-item" href="<?php echo home_url('/cart'); ?>"><?php echo url_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/icon-cart.svg'); ?><span>&nbsp;<?php echo $cart_count; ?></span></a>
<?php
  }
?>
      </div>
    </nav>
  </footer>

</section>

<?php
  get_template_part('partials/scripts');
  get_template_part('partials/schema-org');
?>

</body>
</html>