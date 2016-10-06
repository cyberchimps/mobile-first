<?php
add_action( 'after_setup_theme', 'mobilefirst_setup' );
function mobilefirst_setup()
{
load_theme_textdomain( 'mobile-first', get_template_directory() . '/languages' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-background' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'mobile-first' ) )
);
add_theme_support( 'title-tag' );
}
require_once ( get_template_directory() . '/setup/options.php' );
add_action( 'wp_enqueue_scripts', 'mobilefirst_load_scripts' );
function mobilefirst_load_scripts()
{
wp_enqueue_script( 'jquery' );
wp_register_script( 'twitter', 'https://platform.twitter.com/widgets.js' );
wp_enqueue_script( 'twitter' );
wp_register_script( 'gplus', 'https://apis.google.com/js/plusone.js' );
wp_enqueue_script( 'gplus' );
wp_register_script( 'mobilefirst-videos', get_template_directory_uri() . '/scripts/videos.js' );
wp_enqueue_script( 'mobilefirst-videos' );
}
function mobilefirst_enqueue_admin_scripts()
{
global $mobilefirst_theme_page;
if ( $mobilefirst_theme_page != get_current_screen()->id ) { return; }
wp_enqueue_script( 'mobilefirst-admin-script', get_template_directory_uri() . '/scripts/admin.js', array( 'jquery', 'media-upload', 'thickbox' ) );
wp_enqueue_script( 'mobilefirst-admin-color', get_template_directory_uri() . '/scripts/color-picker/color.js' );
wp_enqueue_style( 'mobilefirst-admin-style', get_template_directory_uri() . '/scripts/admin.css' );
wp_enqueue_style( 'thickbox' );
}
add_action( 'wp_enqueue_scripts', 'mobilefirst_load_styles' );
function mobilefirst_load_styles()
{
wp_enqueue_style( 'mobilefirst-open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:300' );
$options = get_option( 'mobilefirst_options' );
if ( $options['gfont1'] ){ wp_enqueue_style( 'mobilefirst-gfont1', 'https://fonts.googleapis.com/css?family=' . sanitize_text_field( $options['gfont1'] ) ); }
}
add_action( 'wp_head', 'mobilefirst_print_custom_styles' );
function mobilefirst_print_custom_styles()
{
if ( !is_admin() ) {
$options = get_option( 'mobilefirst_options' );
if ( false != $options['customstyles'] ) { 
$custom_css = '<style type="text/css">';
$custom_css .= 'body{';
if ( '' != $options['textcolor'] ) { $custom_css .= 'color:#' . sanitize_text_field( $options['textcolor'] ) . ''; }
$custom_css .= '}';
if ( '' != $options['linkcolor'] ) { $custom_css .= 'a{color:#' . sanitize_text_field( $options['linkcolor'] ) . '}'; }
if ( '' != $options['hovercolor'] ) { $custom_css .= 'a:hover{color:#' . sanitize_text_field( $options['hovercolor'] ) . '}'; }
$custom_css .= '.entry-content p{';
if ( '' != $options['pfont'] ) { $custom_css .= 'font-family:' . sanitize_text_field( $options['pfont'] ) . ';'; }
if ( '' != $options['psize'] ) { $custom_css .= 'font-size:' . sanitize_text_field( $options['psize'] ) . 'px;'; }
if ( '' != $options['pcolor'] ) { $custom_css .= 'color:#' . sanitize_text_field( $options['pcolor'] ) . ''; }
$custom_css .= '}';
$custom_css .= '.entry-content a{';
if ( '' != $options['plfont'] ) { $custom_css .= 'font-family:' . sanitize_text_field( $options['plfont'] ) . ';'; }
if ( '' != $options['plsize'] ) { $custom_css .= 'font-size:' . sanitize_text_field( $options['plsize'] ) . 'px;'; }
if ( '' != $options['plcolor'] ) { $custom_css .= 'color:#' . sanitize_text_field( $options['plcolor'] ) . ''; }
$custom_css .= '}';
$custom_css .= 'h1, h2, h3, h4, h5, h6{';
if ( '' != $options['hfont'] ) { $custom_css .= 'font-family:' . sanitize_text_field( $options['hfont'] ) . ';'; }
if ( '' != $options['hcolor'] ) { $custom_css .= 'color:#' . sanitize_text_field( $options['hcolor'] ) . ''; }
$custom_css .= '}';
$custom_css .= 'h1 a, h2 a, h3 a, h4 a, h5 a, h6 a{';
if ( '' != $options['hlcolor'] ) { $custom_css .= 'color:#' . sanitize_text_field( $options['hlcolor'] ) . ''; }
$custom_css .= '}';
if ( '' != $options['navbg'] ) { $custom_css .= '#menu{background-color:#' . sanitize_text_field( $options['navbg'] ) . '}'; }
if ( '' != $options['navtrans'] ) { $custom_css .= '#menu li ul{opacity:' . sanitize_text_field( $options['navtrans'] ) . '}'; }
$custom_css .= '</style>';
echo $custom_css; }
}
}
add_action( 'wp_head', 'mobilefirst_print_custom_scripts', 99 );
function mobilefirst_print_custom_scripts()
{
if ( !is_admin() ) {
$options = get_option( 'mobilefirst_options' );
?>
<script type="text/javascript">
jQuery(document).ready(function($){
$("#wrapper").vids();
});
</script>
<?php
}
}
add_action( 'comment_form_before', 'mobilefirst_enqueue_comment_reply_script' );
function mobilefirst_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'mobilefirst_title' );
function mobilefirst_title( $title )
{
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'mobilefirst_filter_wp_title' );
function mobilefirst_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
function mobilefirst_breadcrumbs()
{
if ( !is_home() ) {
echo '<div id="breadcrumbs"><a href="' . home_url() . '/">' . __( 'Home', 'mobile-first' ) . '</a> &rarr; ';
if ( is_category() || is_single() ) {
the_category( ', ' );
if ( is_single() ) {
echo " &rarr; ";
the_title();
}
} 
elseif ( is_page() ) { the_title(); }
elseif ( is_tag() ) { _e( 'Tag Page for ', 'mobile-first' ); single_tag_title(); }
elseif ( is_day() ) { _e( 'Archives for ', 'mobile-first' ); the_time( 'F jS, Y' ); }
elseif ( is_month() ) { _e( 'Archives for ', 'mobile-first' ); the_time( 'F, Y' ); }
elseif ( is_year() ) { _e( 'Archives for ', 'mobile-first' ); the_time( 'Y' ); }
elseif ( is_author() ) { _e( 'Author Archives', 'mobile-first' ); }
elseif ( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) { _e( 'Blog Archives', 'mobile-first' ); }
elseif ( is_search() ) { _e( 'Search Results', 'mobile-first' ); }
elseif ( is_404() ) { _e( 'Page Not Found', 'mobile-first' ); }
echo '</div>';
}
}
add_action( 'init', 'mobilefirst_add_shortcodes' );
function mobilefirst_add_shortcodes()
{
add_filter( 'widget_text', 'do_shortcode' );
}
add_action( 'widgets_init', 'mobilefirst_widgets_init' );
function mobilefirst_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'mobile-first' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
register_sidebar( array (
'name' => __( 'Left Sidebar Widget Area', 'mobile-first' ),
'id' => 'lsidebar-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
register_sidebar( array (
'name' => __( 'Right Sidebar Widget Area', 'mobile-first' ),
'id' => 'rsidebar-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
function mobilefirst_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter( 'get_comments_number', 'mobilefirst_comments_number' );
function mobilefirst_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}
