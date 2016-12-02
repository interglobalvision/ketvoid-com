  <footer id="footer">
    <nav class="grid-row justify-between align-items-end font-uppercase font-size-h2">
      <div>
        <a class="menu-item" href="<?php echo home_url('/collection'); ?>">Collections</a>
      </div>
      <div class="grid-row">
        <a class="footer-cart" href="<?php echo home_url('/cart'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/dist/cart.png"></a><br>
        <a class="menu-item" href="<?php echo home_url('/shop'); ?>">Shop</a>
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