<?php
/**
 * WordPress.com-specific functions and definitions
 *
 * @package Twenty Fifteen
 */

/**
 * Adds support for wp.com-specific theme functions.
 *
 * @global array $themecolors
 * @return void
 */
function twentyfifteen_wpcom_setup() {
	global $themecolors;
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

	// Set theme colors for third party services.
	if ( ! isset( $themecolors ) ) {

		switch( $color_scheme_option ) {
			case 'dark' :
				$themecolors = array(
					'bg'     => '202020',
					'border' => '2f2f2f',
					'text'   => 'bebebe',
					'link'   => 'bebebe',
					'url'    => 'bebebe',
				);
				break;
			case 'yellow' :
				$themecolors = array(
					'bg'     => 'ffffff',
					'border' => 'e6e6e6',
					'text'   => '111111',
					'link'   => '111111',
					'url'    => '111111',
				);
				break;
			case 'pink' :
				$themecolors = array(
					'bg'     => 'ffffff',
					'border' => 'eae8e6',
					'text'   => '352712',
					'link'   => '352712',
					'url'    => '352712',
				);
				break;
			case 'purple' :
				$themecolors = array(
					'bg'     => 'ffffff',
					'border' => 'e9e8ed',
					'text'   => '2e2256',
					'link'   => '2e2256',
					'url'    => '2e2256',
				);
				break;
			case 'blue' :
				$themecolors = array(
					'bg'     => 'ffffff',
					'border' => 'e9e8eb',
					'text'   => '22313f',
					'link'   => '22313f',
					'url'    => '22313f',
				);
				break;
			default :
				$themecolors = array(
					'bg'     => 'ffffff',
					'border' => 'eaeaea',
					'text'   => '333333',
					'link'   => '333333',
					'url'    => '333333',
				);
		}
	}
}
add_action( 'after_setup_theme', 'twentyfifteen_wpcom_setup' );

/**
 * De-queue Google fonts if custom fonts are being used instead.
 *
 * @return void
 */
function twentyfifteen_dequeue_fonts() {
	if ( class_exists( 'TypekitData' ) && class_exists( 'CustomDesign' ) && CustomDesign::is_upgrade_active() ) {
		$custom_fonts = TypekitData::get( 'families' );
		if ( $custom_fonts && $custom_fonts['headings']['id'] && $custom_fonts['body-text']['id'] )
			wp_dequeue_style( 'twentyfifteen-fonts' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_dequeue_fonts' );

/**
 * Enqueue our WP.com styles for front-end.
 * Loads after style.css so we can add overrides.
 */
function twentyfifteen_wpcom_scripts() {
	wp_enqueue_style( 'twentyfifteen-wpcom-style', get_template_directory_uri() . '/css/style-wpcom.css', array( 'twentyfifteen-style' ), '20141202' );

	wp_enqueue_script( 'twentyfifteen-wpcom-js', get_template_directory_uri() . '/js/wpcom.js', array( 'jquery' ), '20141208', true );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_wpcom_scripts' );

/**
 * Remove color scheme related stuff in favor of Custom Color in WP.com.
 */
remove_action( 'wp_enqueue_scripts', 'twentyfifteen_color_scheme_css' );
remove_action( 'customize_controls_enqueue_scripts', 'twentyfifteen_customize_control_js' );
remove_action( 'customize_controls_print_footer_scripts', 'twentyfifteen_color_scheme_css_template' );
remove_action( 'wp_enqueue_scripts', 'twentyfifteen_header_background_color_css', 11 );
remove_action( 'wp_enqueue_scripts', 'twentyfifteen_sidebar_text_color_css', 11 );