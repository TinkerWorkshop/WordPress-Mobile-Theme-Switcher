<?php
/*
	Plugin Name: WordPress Mobile Theme Switcher
	Description: Detection and switching to mobile-dedicated theme.
	Version: 1
	Author: TinkerWorkshop
	Plugin URI: https://github.com/TinkerWorkshop/WordPress-Mobile-Theme-Switcher
*/

define('TW_MTS__MOBILE_THEME', 'MYTHEME-mobile');

function tw_mts__is_mobile() {
	$is_mobile = false;

	if ( function_exists( 'jetpack_is_mobile' ) ) {
		$is_mobile = jetpack_is_mobile();
	} else {
		// case for manual detection
	}

	return apply_filters( 'tw_mts__is_mobile', $is_mobile );
} // tw_mts__is_mobile

add_filter( 'setup_theme', function(){
	if ( !tw_mts__is_mobile() ) return;

	add_filter( 'template', 'tw_mts__template' );
	add_filter( 'option_template', 'tw_mts__template' );
	add_filter( 'option_stylesheet', 'tw_mts__template' );
}, 1 ); // setup theme

function tw_mts__template( $theme ) {
	if ( is_dir( ABSPATH . '/wp-content/themes/' . TW_MTS__MOBILE_THEME ) ) {
		$theme = TW_MTS__MOBILE_THEME;
	}
	return $theme;
} // tw_mts__template

// End of file. Do not put code after this point, or face the wrath of GIT Conflicts