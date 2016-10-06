<?php
function mobilefirst_get_option_defaults()
{
$defaults = array(
'social' => '',
'description' => '',
'search' => '',
'crumbs' => '',
'slider' => '',
'twitter' => '',
'share' => '',
'customstyles' => '',
'logo' => '',
'facebookurl' => '',
'twitterurl' => '',
'linkedinurl' => '',
'googleurl' => '',
'gfont1' => '',
'twitname' => '',
'pfont' => '',
'plfont' => '',
'hfont' => '',
'psize' => '',
'plsize' => '',
'navtrans' => '',
'navbg' => '',
'textcolor' => '',
'linkcolor' => '',
'hovercolor' => '',
'pcolor' => '',
'plcolor' => '',
'hcolor' => '',
'hlcolor' => '',
);
return $defaults;
}
add_action( 'admin_init', 'mobilefirst_options_init' );
function mobilefirst_options_init()
{
register_setting( 'mobilefirst_options', 'mobilefirst_options', 'mobilefirst_options_validate' );
}
add_action( 'admin_menu', 'mobilefirst_options_add_page' );
function mobilefirst_options_add_page()
{
global $mobilefirst_theme_page;
$mobilefirst_theme_page = add_theme_page( __( 'Mobile First Options', 'mobilefirst' ), __( 'Mobile First Options', 'mobile-first' ), 'edit_theme_options', 'theme_options', 'mobilefirst_options_do_page' );
add_action( 'admin_print_scripts-' . $mobilefirst_theme_page, 'mobilefirst_enqueue_admin_scripts' );
}
function mobilefirst_options_do_page()
{
global $select_options;
$options = wp_parse_args( get_option( 'mobilefirst_options', array() ), mobilefirst_get_option_defaults() );
if ( ! isset( $_REQUEST['settings-updated'] ) )
$_REQUEST['settings-updated'] = false;
?>
<div class="wrap">
<?php global $mobilefirst_theme_page; ?>
<?php $current_theme = wp_get_theme(); ?>
<?php echo "<h2>" . sprintf( __( 'Mobile First Options', 'mobile-first' ) ) . "</h2>"; ?>
<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
<div class="updated fade"><p><strong><?php _e( 'Options Saved', 'mobile-first' ); ?></strong></p></div>
<?php endif; ?>
<p><?php printf( __( 'Thank you for choosing Mobile First and WordPress as the solution for building your website. If you need help please consider %1$supgrading to Plus%2$s.', 'mobile-first' ), '<a href="http://cyberchimps.com/plus/" target="_blank">', '</a>' ); ?></p>
<p><?php printf( __( 'Manage previously uploaded images under the %1$sMedia%2$s tab.', 'mobile-first' ), '<a href="' . admin_url() . 'upload.php" target="_blank">', '</a>' ); ?></p>
<form method="post" action="options.php">
<p class="submit">
<input type="reset" value="<?php _e( 'Undo', 'mobile-first' ); ?>" style="margin-left:10px;float:right" />
<input type="button" value="<?php _e( 'Clear All Settings', 'mobile-first' ); ?>" style="float:right" onclick="clearForm(this.form)" />
<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'mobile-first' ); ?>" />
</p>
<p style="text-align:right"><?php printf( __( 'After clicking either %1$s Clear All Settings %2$s or %1$s Undo %2$s you must then click %1$s Save Options %2$s to confirm.', 'mobile-first' ), '<em>', '</em>' ); ?><br /><?php printf( __( '%1$s Undo %2$s only restores your settings to the previous saved state before saving again after clearing all settings.', 'mobile-first' ), '<em>', '</em>' ); ?></p>
<?php settings_fields( 'mobilefirst_options' ); ?>
<table class="form-table">
<?php
?>
<tr valign="top"><th scope="row"><?php _e( 'Turn On/Off Features', 'mobile-first' ); ?><br /><em>(<?php _e( 'check to turn on', 'mobile-first' ); ?>)</em></th>
<td>
<input id="mobilefirst_options[social]" name="mobilefirst_options[social]" type="checkbox" value="1" <?php checked( '1', $options['social'] ); ?> />
<label class="description" for="mobilefirst_options[social]"><?php _e( 'Social Profile Icons', 'mobile-first' ); ?> <em>(<?php _e( 'set further settings below in social profile settings', 'mobile-first' ); ?>)</em></label>
<br />
<input id="mobilefirst_options[description]" name="mobilefirst_options[description]" type="checkbox" value="1" <?php checked( '1', $options['description'] ); ?> />
<label class="description" for="mobilefirst_options[description]"><?php _e( 'Site Description', 'mobile-first' ); ?> <em>(<?php _e( 'set under settings > general from the main wp admin', 'mobile-first' ); ?>)</em></label>
<br />
<input id="mobilefirst_options[search]" name="mobilefirst_options[search]" type="checkbox" value="1" <?php checked( '1', $options['search'] ); ?> />
<label class="description" for="mobilefirst_options[search]"><?php _e( 'Menu Search Field', 'mobile-first' ); ?> <em>(<?php _e( 'search box appears on right side of menu - allows users to search the contents of your site', 'mobile-first' ); ?>)</em></label>
<br />
<input id="mobilefirst_options[crumbs]" name="mobilefirst_options[crumbs]" type="checkbox" value="1" <?php checked( '1', $options['crumbs'] ); ?> />
<label class="description" for="mobilefirst_options[crumbs]"><?php _e( 'Breadcrumbs', 'mobile-first' ); ?> <em>(<?php _e( 'shows your visitors where they are in relation to the homepage', 'mobile-first' ); ?>)</em></label>
<br />
<input id="mobilefirst_options[slider]" name="mobilefirst_options[slider]" type="checkbox" value="1" <?php checked( '1', $options['slider'] ); ?> />
<label class="description" for="mobilefirst_options[slider]"><?php _e( 'Universal Slider', 'mobile-first' ); ?> <em>(<?php printf(__( 'important: you must create a slider first after installing %1$sWP Nivo Slider%2$s - for best results set slider to and prepare images at 1000px wide [or whatever you have set your max display width to] and 200px high - all slides need to be consistent in size - set category to pull featured images from in plugin settings', 'mobile-first' ), '<a href="plugin-install.php?tab=search&s=WP+Nivo+Slider" target="_blank">', '</a>' ); ?>)</em></label>
<br />
<input id="mobilefirst_options[twitter]" name="mobilefirst_options[twitter]" type="checkbox" value="1" <?php checked( '1', $options['twitter'] ); ?> />
<label class="description" for="mobilefirst_options[twitter]"><?php _e( 'Twitter Feed', 'mobile-first' ); ?> <em>(<?php _e( 'set further settings below in social profile settings', 'mobile-first' ); ?>)</em></label>
<br />
<input id="mobilefirst_options[share]" name="mobilefirst_options[share]" type="checkbox" value="1" <?php checked( '1', $options['share'] ); ?> />
<label class="description" for="mobilefirst_options[share]"><?php _e( 'Single Post Sharing', 'mobile-first' ); ?> <em>(<?php _e( 'sets like, tweet and +1 buttons on single posts view', 'mobile-first' ); ?>)</em></label>
<br />
<input id="mobilefirst_options[customstyles]" name="mobilefirst_options[customstyles]" type="checkbox" value="1" <?php checked( '1', $options['customstyles'] ); ?> />
<label class="description" for="mobilefirst_options[customstyles]"><?php _e( 'Custom Styles', 'mobile-first' ); ?> <em>(<?php _e( 'set further settings below', 'mobile-first' ); ?>)</em></label>
</td>
</tr>
<?php
?>
<tr valign="top"><th scope="row"><?php _e( 'Image URLs', 'mobile-first' ); ?><br /><em>(<?php _e( 'enter full image urls or click the "Select/Upload Image" button to select/upload an image from the Media Manager and then click "Insert into Post"', 'mobile-first' ); ?>)</em></th>
<td>
<p class="mobilefirst-options-logo">
<label class="description" for="mobilefirst_options[logo]"><?php _e( 'Logo Image URL', 'mobile-first' ); ?></label><br />
<input id="mobilefirst_options[logo]" class="logo-upload-url" type="text" name="mobilefirst_options[logo]" value="<?php echo esc_attr( $options['logo'] ); ?>" />
<input id="mobilefirst_options_logo_button" type="button" value="Select/Upload Image" />
</p>
</td>
</tr>
<?php
?>
<tr valign="top"><th scope="row"><?php _e( 'Social Profile Settings', 'mobile-first' ); ?><br /><em>(<?php _e( 'enter full urls', 'mobile-first' ); ?>)</em></th>
<td>
<input id="mobilefirst_options[facebookurl]" class="regular-text" type="text" name="mobilefirst_options[facebookurl]" value="<?php echo esc_attr( $options['facebookurl'] ); ?>" />
<label class="description" for="mobilefirst_options[facebookurl]"><?php _e( 'Facebook Profile URL', 'mobile-first' ); ?> <em>(<?php printf( __( 'example: %s', 'mobile-first' ), '<strong>https://www.facebook.com/yourusername</strong>' ); ?>)</em></label>
<br />
<input id="mobilefirst_options[twitterurl]" class="regular-text" type="text" name="mobilefirst_options[twitterurl]" value="<?php echo esc_attr( $options['twitterurl'] ); ?>" />
<label class="description" for="mobilefirst_options[twitterurl]"><?php _e( 'Twitter Profile URL', 'mobile-first' ); ?> <em>(<?php printf( __( 'example: %s', 'mobile-first' ), '<strong>https://twitter.com/yourusername</strong>' ); ?>)</em></label>
<br />
<input id="mobilefirst_options[linkedinurl]" class="regular-text" type="text" name="mobilefirst_options[linkedinurl]" value="<?php echo esc_attr( $options['linkedinurl'] ); ?>" />
<label class="description" for="mobilefirst_options[linkedinurl]"><?php _e( 'LinkedIn Profile URL', 'mobile-first' ); ?> <em>(<?php printf( __( 'example: %s', 'mobile-first' ), '<strong>https://www.linkedin.com/in/yourusername</strong>' ); ?>)</em></label>
<br />
<input id="mobilefirst_options[googleurl]" class="regular-text" type="text" name="mobilefirst_options[googleurl]" value="<?php echo esc_attr( $options['googleurl'] ); ?>" />
<label class="description" for="mobilefirst_options[googleurl]"><?php _e( 'Google+ Profile URL', 'mobile-first' ); ?> <em>(<?php printf( __( 'example: %s', 'mobile-first' ), '<strong>https://plus.google.com/yourusernumber</strong>' ); ?>)</em></label>
<br />
<input id="mobilefirst_options[twitname]" class="regular-text" type="text" name="mobilefirst_options[twitname]" value="<?php echo esc_attr( $options['twitname'] ); ?>" />
<label class="description" for="mobilefirst_options[twitname]"><?php _e( 'Twitter Profile Username', 'mobile-first' ); ?> <em>(<?php _e( 'username only - no @ needed', 'mobile-first' ); ?>)</em></label>
</td>
</tr>
<?php
?>
<tr valign="top"><th scope="row"><?php _e( 'Google Fonts', 'mobile-first' ); ?><br /><em>(<?php printf( __( 'enter one google font from a %1$sselection of over six hundred%2$s, use proper capitalization and %3$s for spaces, example: %4$s.', 'mobile-first' ), '<a href="https://www.google.com/fonts/" target="_blank">', '</a>', '<strong>+</strong>', '<strong>Open+Sans</strong>' ); printf( __( 'Then add the font name in the "Headers Font" field below or with CSS in a child theme stylesheet, example: %s', 'mobile-first' ), '<code>h1, h2, h3, h4, h5, h6{font-family:&#39;Open Sans&#39;}</code>' ); ?>)</em></th>
<td>
<input id="mobilefirst_options[gfont1]" class="regular-text" type="text" name="mobilefirst_options[gfont1]" value="<?php echo esc_attr( $options['gfont1'] ); ?>" />
<label class="description" for="mobilefirst_options[gfont1]"><?php _e( 'Google Font One', 'mobile-first' ); ?></label>
</td>
</tr>
<?php
?>
<tr valign="top"><th scope="row"><?php _e( 'Custom Styles', 'mobile-first' ); ?><br /><em>(<?php printf( __( 'no %1$s for colors or %2$s or %3$s for sizes', 'mobile-first' ), '<strong>#</strong>', '<strong>px</strong>', '<strong>%</strong>' ); ?>)</em></th>
<td>
<input id="mobilefirst_options[navbg]" class="regular-text color {required:false}" type="text" name="mobilefirst_options[navbg]" value="<?php echo esc_attr( $options['navbg'] ); ?>" />
<label class="description" for="mobilefirst_options[navbg]"><?php _e( 'Navigation Menu Background Color', 'mobile-first' ); ?></label>
<br />
<input id="mobilefirst_options[navtrans]" class="regular-text" type="text" name="mobilefirst_options[navtrans]" value="<?php echo esc_attr( $options['navtrans'] ); ?>" />
<label class="description" for="mobilefirst_options[navtrans]"><?php _e( 'Navigation Menu Dropdown Opacity Level', 'mobile-first' ); ?> <em>(<?php printf( __( 'default is %1$s - %2$s is fully transparent and %3$s is fully solid', 'mobile-first' ), '<strong>0.95</strong>', '<strong>0</strong>', '<strong>1</strong>' ); ?>)</em></label>
<br />
<input id="mobilefirst_options[textcolor]" class="regular-text color {required:false}" type="text" name="mobilefirst_options[textcolor]" value="<?php echo esc_attr( $options['textcolor'] ); ?>" />
<label class="description" for="mobilefirst_options[textcolor]"><?php _e( 'Body Text Color', 'mobile-first' ); ?></label>
<br />
<input id="mobilefirst_options[linkcolor]" class="regular-text color {required:false}" type="text" name="mobilefirst_options[linkcolor]" value="<?php echo esc_attr( $options['linkcolor'] ); ?>" />
<label class="description" for="mobilefirst_options[linkcolor]"><?php _e( 'Link Color', 'mobile-first' ); ?> <em>(<?php printf( __( 'will not universally change %1$s all %2$s link colors - use custom css for in-depth style management', 'mobile-first' ), '<strong>', '</strong>' ); ?>)</em></label>
<br />
<input id="mobilefirst_options[hovercolor]" class="regular-text color {required:false}" type="text" name="mobilefirst_options[hovercolor]" value="<?php echo esc_attr( $options['hovercolor'] ); ?>" />
<label class="description" for="mobilefirst_options[hovercolor]"><?php _e( 'Link Hover Color', 'mobile-first' ); ?></label>
<br />
<input id="mobilefirst_options[pfont]" class="regular-text" type="text" name="mobilefirst_options[pfont]" value="<?php echo esc_attr( $options['pfont'] ); ?>" />
<label class="description" for="mobilefirst_options[pfont]"><?php _e( 'Page/Post Paragraph Font', 'mobile-first' ); ?></label>
<br />
<input id="mobilefirst_options[psize]" class="regular-text" type="text" name="mobilefirst_options[psize]" value="<?php echo esc_attr( $options['psize'] ); ?>" />
<label class="description" for="mobilefirst_options[psize]"><?php _e( 'Page/Post Paragraph Font Size', 'mobilefirst' ); ?></label>
<br />
<input id="mobilefirst_options[pcolor]" class="regular-text color {required:false}" type="text" name="mobilefirst_options[pcolor]" value="<?php echo esc_attr( $options['pcolor'] ); ?>" />
<label class="description" for="mobilefirst_options[pcolor]"><?php _e( 'Page/Post Paragraph Font Color', 'mobile-first' ); ?></label>
<br />
<input id="mobilefirst_options[plfont]" class="regular-text" type="text" name="mobilefirst_options[plfont]" value="<?php echo esc_attr( $options['plfont'] ); ?>" />
<label class="description" for="mobilefirst_options[plfont]"><?php _e( 'Page/Post Paragraph Link Font', 'mobile-first' ); ?></label>
<br />
<input id="mobilefirst_options[plsize]" class="regular-text" type="text" name="mobilefirst_options[plsize]" value="<?php echo esc_attr( $options['plsize'] ); ?>" />
<label class="description" for="mobilefirst_options[plsize]"><?php _e( 'Page/Post Paragraph Link Font Size', 'mobile-first' ); ?></label>
<br />
<input id="mobilefirst_options[plcolor]" class="regular-text color {required:false}" type="text" name="mobilefirst_options[plcolor]" value="<?php echo esc_attr( $options['plcolor'] ); ?>" />
<label class="description" for="mobilefirst_options[plcolor]"><?php _e( 'Page/Post Paragraph Link Font Color', 'mobile-first' ); ?></label>
<br />
<input id="mobilefirst_options[hfont]" class="regular-text" type="text" name="mobilefirst_options[hfont]" value="<?php echo esc_attr( $options['hfont'] ); ?>" />
<label class="description" for="mobilefirst_options[hfont]"><?php _e( 'Headers Font', 'mobile-first' ); ?></label>
<br />
<input id="mobilefirst_options[hcolor]" class="regular-text color {required:false}" type="text" name="mobilefirst_options[hcolor]" value="<?php echo esc_attr( $options['hcolor'] ); ?>" />
<label class="description" for="mobilefirst_options[hcolor]"><?php _e( 'Headers Color', 'mobile-first' ); ?></label>
<br />
<input id="mobilefirst_options[hlcolor]" class="regular-text color {required:false}" type="text" name="mobilefirst_options[hlcolor]" value="<?php echo esc_attr( $options['hlcolor'] ); ?>" />
<label class="description" for="mobilefirst_options[hlcolor]"><?php _e( 'Headers Link Color', 'mobile-first' ); ?></label>
</td>
</tr>
</table>
<p class="submit">
<input type="reset" value="<?php _e( 'Undo', 'mobile-first' ); ?>" style="margin-left:10px;float:right" />
<input type="button" value="<?php _e( 'Clear All Settings', 'mobile-first' ); ?>" style="float:right" onclick="clearForm(this.form)" />
<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'mobile-first' ); ?>" />
</p>
<p style="text-align:right"><?php printf( __( 'After clicking either %1$s Clear All Settings %2$s or %1$sUndo%2$s you must then click %1$s Save Options %2$s to confirm.', 'mobile-first' ), '<em>', '</em>' ); ?><br /><?php printf( __( '%1$s Undo %2$s only restores your settings to the previous saved state before saving again after clearing all settings.', 'mobile-first' ), '<em>', '</em>' ); ?></p>
</form>
</div>
<?php
?>
<?php
}
function mobilefirst_options_validate( $input )
{
$valid_input = wp_parse_args( get_option( 'mobilefirst_options', array() ), mobilefirst_get_option_defaults() );
$valid_input['social'] = ( isset( $input['social'] ) && true == $input['social'] ? true : false );
$valid_input['description'] = ( isset( $input['description'] ) && true == $input['description'] ? true : false );
$valid_input['search'] = ( isset( $input['search'] ) && true == $input['search'] ? true : false );
$valid_input['crumbs'] = ( isset( $input['crumbs'] ) && true == $input['crumbs'] ? true : false );
$valid_input['slider'] = ( isset( $input['slider'] ) && true == $input['slider'] ? true : false );
$valid_input['twitter'] = ( isset( $input['twitter'] ) && true == $input['twitter'] ? true : false );
$valid_input['share'] = ( isset( $input['share'] ) && true == $input['share'] ? true : false );
$valid_input['customstyles'] = ( isset( $input['customstyles'] ) && true == $input['customstyles'] ? true : false );
$valid_input['logo'] = ( isset( $input['logo'] ) ? esc_url_raw( $input['logo'] ) : $valid_input['logo'] );
$valid_input['facebookurl'] = ( isset( $input['facebookurl'] ) ? esc_url_raw( $input['facebookurl'] ) : $valid_input['facebookurl'] );
$valid_input['twitterurl'] = ( isset( $input['twitterurl'] ) ? esc_url_raw( $input['twitterurl'] ) : $valid_input['twitterurl'] );
$valid_input['linkedinurl'] = ( isset( $input['linkedinurl'] ) ? esc_url_raw( $input['linkedinurl'] ) : $valid_input['linkedinurl'] );
$valid_input['googleurl'] = ( isset( $input['googleurl'] ) ? esc_url_raw( $input['googleurl'] ) : $valid_input['googleurl'] );
$valid_input['gfont1'] = ( isset( $input['gfont1'] ) ? wp_filter_nohtml_kses( $input['gfont1'] ) : $valid_input['gfont1'] );
$valid_input['twitname'] = ( isset( $input['twitname'] ) ? wp_filter_nohtml_kses( $input['twitname'] ) : $valid_input['twitname'] );
$valid_input['pfont'] = ( isset( $input['pfont'] ) ? wp_filter_nohtml_kses( $input['pfont'] ) : $valid_input['pfont'] );
$valid_input['plfont'] = ( isset( $input['plfont'] ) ? wp_filter_nohtml_kses( $input['plfont'] ) : $valid_input['plfont'] );
$valid_input['hfont'] = ( isset( $input['hfont'] ) ? wp_filter_nohtml_kses( $input['hfont'] ) : $valid_input['hfont'] );
$valid_input['psize'] = ( isset( $input['psize'] ) && is_int( intval( $input['psize'] ) ) ? $input['psize'] : $valid_input['psize'] );
$valid_input['plsize'] = ( isset( $input['plsize'] ) && is_int( intval( $input['plsize'] ) ) ? $input['plsize'] : $valid_input['plsize'] );
if ( ! isset( $input['navtrans'] ) || '' == $input['navtrans'] ) {
$valid_input['navtrans'] = '';
} else {
$valid_input['navtrans'] = ( isset( $input['navtrans'] ) && is_numeric( $input['navtrans'] ) && 0 <= $input['navtrans'] && 1 >= $input['navtrans'] ? round( $input['navtrans'], 2 ) : $valid_input['navtrans'] );
}
if ( ! isset( $input['navbg'] ) || '' == $input['navbg'] ) {
$valid_input['navbg'] = '';
} else {
$input['navbg'] = ltrim( trim( $input['navbg' ] ), '#' );
$input['navbg'] = ( 6 == strlen( $input['navbg'] ) || 3 == strlen( $input['navbg'] ) ? $input['navbg'] : false );
$valid_input['navbg'] = ( ctype_xdigit( $input['navbg'] ) ? $input['navbg'] : $valid_input['navbg'] );
}
if ( ! isset( $input['textcolor'] ) || '' == $input['textcolor'] ) {
$valid_input['textcolor'] = '';
} else {
$input['textcolor'] = ltrim( trim( $input['textcolor' ] ), '#' );
$input['textcolor'] = ( 6 == strlen( $input['textcolor'] ) || 3 == strlen( $input['textcolor'] ) ? $input['textcolor'] : false );
$valid_input['textcolor'] = ( ctype_xdigit( $input['textcolor'] ) ? $input['textcolor'] : $valid_input['textcolor'] );
}
if ( ! isset( $input['linkcolor'] ) || '' == $input['linkcolor'] ) {
$valid_input['linkcolor'] = '';
} else {
$$input['linkcolor'] = ltrim( trim( $input['linkcolor' ] ), '#' );
$input['linkcolor'] = ( 6 == strlen( $input['linkcolor'] ) || 3 == strlen( $input['linkcolor'] ) ? $input['linkcolor'] : false );
$valid_input['linkcolor'] = ( ctype_xdigit( $input['linkcolor'] ) ? $input['linkcolor'] : $valid_input['linkcolor'] );
}
if ( ! isset( $input['hovercolor'] ) || '' == $input['hovercolor'] ) {
$valid_input['hovercolor'] = '';
} else {
$input['hovercolor'] = ltrim( trim( $input['hovercolor' ] ), '#' );
$input['hovercolor'] = ( 6 == strlen( $input['hovercolor'] ) || 3 == strlen( $input['hovercolor'] ) ? $input['hovercolor'] : false );
$valid_input['hovercolor'] = ( ctype_xdigit( $input['hovercolor'] ) ? $input['hovercolor'] : $valid_input['hovercolor'] );
}
if ( ! isset( $input['pcolor'] ) || '' == $input['pcolor'] ) {
$valid_input['pcolor'] = '';
} else {
$input['pcolor'] = ltrim( trim( $input['pcolor' ] ), '#' );
$input['pcolor'] = ( 6 == strlen( $input['pcolor'] ) || 3 == strlen( $input['pcolor'] ) ? $input['pcolor'] : false );
$valid_input['pcolor'] = ( ctype_xdigit( $input['pcolor'] ) ? $input['pcolor'] : $valid_input['pcolor'] );
}
if ( ! isset( $input['plcolor'] ) || '' == $input['plcolor'] ) {
$valid_input['plcolor'] = '';
} else {
$input['plcolor'] =ltrim( trim( $input['plcolor' ] ), '#' );
$input['plcolor'] = ( 6 == strlen( $input['plcolor'] ) || 3 == strlen( $input['plcolor'] ) ? $input['plcolor'] : false );
$valid_input['plcolor'] = ( ctype_xdigit( $input['plcolor'] ) ? $input['plcolor'] : $valid_input['plcolor'] );
}
if ( ! isset( $input['hcolor'] ) || '' == $input['hcolor'] ) {
$valid_input['hcolor'] = '';
} else {
$input['hcolor'] = ltrim( trim( $input['hcolor' ] ), '#' );
$input['hcolor'] = ( 6 == strlen( $input['hcolor'] ) || 3 == strlen( $input['hcolor'] ) ? $input['hcolor'] : false );
$valid_input['hcolor'] = ( ctype_xdigit( $input['hcolor'] ) ? $input['hcolor'] : $valid_input['hcolor'] );
}
if ( ! isset( $input['hlcolor'] ) || '' == $input['hlcolor'] ) {
$valid_input['hlcolor'] = '';
} else {
$input['hlcolor'] = ltrim( trim( $input['hlcolor' ] ), '#' );
$input['hlcolor'] = ( 6 == strlen( $input['hlcolor'] ) ? $input['hlcolor'] : $valid_input['hlcolor'] );
$valid_input['hlcolor'] = ( ctype_xdigit( $input['hlcolor'] ) ? $input['hlcolor'] : $valid_input['hlcolor'] );
}
return $valid_input;
}
