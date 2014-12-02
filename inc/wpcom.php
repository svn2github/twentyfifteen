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
function twentyfifteen_wpcom_styles() {
	wp_enqueue_style( 'twentyfifteen-wpcom-style', get_template_directory_uri() . '/css/style-wpcom.css', array( 'twentyfifteen-style' ), '20141202' );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_wpcom_styles' );