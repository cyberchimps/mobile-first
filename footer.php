<?php $options = get_option( 'mobilefirst_options' ); ?>
<div class="clear"></div>
</div>
<footer id="footer" role="contentinfo">
<div id="copyright">
<?php echo sprintf( __( '%1$s %2$s %3$s. All Rights Reserved.', 'mobile-first' ), '&copy;', date( 'Y' ), esc_html( get_bloginfo( 'name' ) ) ); echo sprintf( __( ' Built with %1$s and %2$s.', 'mobile-first' ), '<a href="http://cyberchimps.com/mobile-first/">Mobile First WordPress Theme</a>', '<a href="http://wordpress.org/">WordPress</a>' ); ?>
</div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
