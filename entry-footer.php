<?php $options = get_option( 'mobilefirst_options' ); ?>
<footer class="entry-footer">
<?php if ( $options['share'] && is_single() ) { echo '<div id="share"><div data-layout="button_count" class="fb-like"></div><a href="//twitter.com/share" class="twitter-share-button">Tweet</a><div data-size="medium" class="g-plusone"></div></div>'; } ?>
<span class="cat-links"><?php _e( 'Categories: ', 'mobile-first' ); ?><?php the_category( ', ' ); ?></span>
<span class="tag-links"><?php the_tags(); ?></span>
<?php if ( comments_open() ) {
echo '<span class="meta-sep">|</span> <span class="comments-link"><a href="' . get_comments_link() . '">' . sprintf(  _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'mobile-first' ), number_format_i18n( get_comments_number() ) ) . '</a></span>';
} ?>
</footer>
