<?php

if ( ! function_exists( 'succulents_qodef_mobile_header_general_styles' ) ) {
	/**
	 * Generates general custom styles for mobile header
	 */
	function succulents_qodef_mobile_header_general_styles() {
		$item_styles      = array();
		$height           = succulents_qodef_options()->getOptionValue( 'mobile_header_height' );
		$background_color = succulents_qodef_options()->getOptionValue( 'mobile_header_background_color' );
		$border_color     = succulents_qodef_options()->getOptionValue( 'mobile_header_border_bottom_color' );
		
		if ( ! empty( $height ) ) {
			$item_styles['height'] = succulents_qodef_filter_px( $height ) . 'px';
		}
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $border_color ) ) {
			$item_styles['border-color'] = $border_color;
		}
		
		echo succulents_qodef_dynamic_css( '.qodef-mobile-header .qodef-mobile-header-inner', $item_styles );
	}
	
	add_action( 'succulents_qodef_style_dynamic', 'succulents_qodef_mobile_header_general_styles' );
}

if ( ! function_exists( 'succulents_qodef_mobile_navigation_styles' ) ) {
	/**
	 * Generates styles for mobile navigation
	 */
	function succulents_qodef_mobile_navigation_styles() {
		$mobile_nav_styles = array();
		$background_color  = succulents_qodef_options()->getOptionValue( 'mobile_menu_background_color' );
		$border_color      = succulents_qodef_options()->getOptionValue( 'mobile_menu_border_bottom_color' );
		
		if ( ! empty( $background_color ) ) {
			$mobile_nav_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $border_color ) ) {
			$mobile_nav_styles['border-color'] = $border_color;
		}
		
		echo succulents_qodef_dynamic_css( '.qodef-mobile-header .qodef-mobile-nav', $mobile_nav_styles );
		
		$nav_item_styles          = array();
		$nav_border_color         = succulents_qodef_options()->getOptionValue( 'mobile_menu_separator_color' );
		$mobile_nav_item_selector = array(
			'.qodef-mobile-header .qodef-mobile-nav ul li a',
			'.qodef-mobile-header .qodef-mobile-nav ul li h6'
		);
		
		if ( ! empty( $nav_border_color ) ) {
			$nav_item_styles['border-bottom-color'] = $nav_border_color;
		}
		
		echo succulents_qodef_dynamic_css( $mobile_nav_item_selector, $nav_item_styles );
		
		
		// mobile dropdown 1st level menu style
		
		$mobile_menu_style = succulents_qodef_get_typography_styles( 'mobile_text' );
		
		$mobile_menu_selector = array(
			'.qodef-mobile-header .qodef-mobile-nav .qodef-grid > ul > li > a',
			'.qodef-mobile-header .qodef-mobile-nav .qodef-grid > ul > li > h6'
		);
		
		echo succulents_qodef_dynamic_css( $mobile_menu_selector, $mobile_menu_style );
		
		
		$mobile_nav_item_hover_styles = array();
		$mobile_text_hover_color      = succulents_qodef_options()->getOptionValue( 'mobile_text_hover_color' );
		
		if ( ! empty( $mobile_text_hover_color ) ) {
			$mobile_nav_item_hover_styles['color'] = $mobile_text_hover_color;
		}
		
		$mobile_nav_item_selector_hover = array(
			'.qodef-mobile-header .qodef-mobile-nav .qodef-grid > ul > li.qodef-active-item > a',
			'.qodef-mobile-header .qodef-mobile-nav .qodef-grid > ul > li.qodef-active-item > h6',
			'.qodef-mobile-header .qodef-mobile-nav .qodef-grid > ul > li > a:hover',
			'.qodef-mobile-header .qodef-mobile-nav .qodef-grid > ul > li > h6:hover'
		);
		
		echo succulents_qodef_dynamic_css( $mobile_nav_item_selector_hover, $mobile_nav_item_hover_styles );
		
		// mobile dropdown deeper levels menu style
		
		$mobile_dropdown_style = succulents_qodef_get_typography_styles( 'mobile_dropdown_text' );
		
		$mobile_dropdown_selector = array(
			'.qodef-mobile-header .qodef-mobile-nav ul ul li a',
			'.qodef-mobile-header .qodef-mobile-nav ul ul li h6'
		);
		
		echo succulents_qodef_dynamic_css( $mobile_dropdown_selector, $mobile_dropdown_style );
		
		
		$mobile_nav_dropdown_item_hover_styles = array();
		$mobile_nav_dropdown_hover_color       = succulents_qodef_options()->getOptionValue( 'mobile_dropdown_text_hover_color' );
		
		if ( ! empty( $mobile_nav_dropdown_hover_color ) ) {
			$mobile_nav_dropdown_item_hover_styles['color'] = $mobile_nav_dropdown_hover_color;
		}
		
		$mobile_nav_dropdown_item_selector_hover = array(
			'.qodef-mobile-header .qodef-mobile-nav ul ul li.current-menu-ancestor > a',
			'.qodef-mobile-header .qodef-mobile-nav ul ul li.current-menu-item > a',
			'.qodef-mobile-header .qodef-mobile-nav ul ul li.current-menu-ancestor > h6',
			'.qodef-mobile-header .qodef-mobile-nav ul ul li.current-menu-item > h6',
			'.qodef-mobile-header .qodef-mobile-nav ul ul li a:hover',
			'.qodef-mobile-header .qodef-mobile-nav ul ul li h6:hover'
		);
		
		echo succulents_qodef_dynamic_css( $mobile_nav_dropdown_item_selector_hover, $mobile_nav_dropdown_item_hover_styles );
	}
	
	add_action( 'succulents_qodef_style_dynamic', 'succulents_qodef_mobile_navigation_styles' );
}

if ( ! function_exists( 'succulents_qodef_mobile_logo_styles' ) ) {
	/**
	 * Generates styles for mobile logo
	 */
	function succulents_qodef_mobile_logo_styles() {
		$logo_height          = succulents_qodef_options()->getOptionValue( 'mobile_logo_height' );
		$mobile_logo_height   = succulents_qodef_options()->getOptionValue( 'mobile_logo_height_phones' );
		$mobile_header_height = succulents_qodef_options()->getOptionValue( 'mobile_header_height' );
		
		if ( ! empty( $logo_height ) ) { ?>
			@media only screen and (max-width: 1024px) {
			<?php echo succulents_qodef_dynamic_css(
				'.qodef-mobile-header .qodef-mobile-logo-wrapper a',
				array( 'height' => succulents_qodef_filter_px( $logo_height ) . 'px !important' )
			); ?>
			}
		<?php }
		
		if ( ! empty( $mobile_logo_height ) ) { ?>
			@media only screen and (max-width: 480px) {
			<?php echo succulents_qodef_dynamic_css(
				'.qodef-mobile-header .qodef-mobile-logo-wrapper a',
				array( 'height' => succulents_qodef_filter_px( $mobile_logo_height ) . 'px !important' )
			); ?>
			}
		<?php }
		
		if ( ! empty( $mobile_header_height ) ) {
			echo succulents_qodef_dynamic_css( '.qodef-mobile-header .qodef-mobile-logo-wrapper a', array( 'max-height' => succulents_qodef_filter_px( $mobile_header_height ) . 'px' ) ); ?>
			@media only screen and (max-width: 1024px) {
				<?php echo succulents_qodef_dynamic_css(
					'.error404 .qodef-content',
					array( 'margin-top' => '-' . succulents_qodef_filter_px( $mobile_header_height ) . 'px !important' )
				); ?>
			}
			<?php
			
		}
	}
	
	add_action( 'succulents_qodef_style_dynamic', 'succulents_qodef_mobile_logo_styles' );
}

if ( ! function_exists( 'succulents_qodef_mobile_icon_styles' ) ) {
	/**
	 * Generates styles for mobile icon opener
	 */
	function succulents_qodef_mobile_icon_styles() {
		$icon_color       = succulents_qodef_options()->getOptionValue( 'mobile_icon_color' );
		$icon_hover_color = succulents_qodef_options()->getOptionValue( 'mobile_icon_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo succulents_qodef_dynamic_css( '.qodef-mobile-header .qodef-mobile-menu-opener a', array( 'color' => $icon_color ) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo succulents_qodef_dynamic_css( '.qodef-mobile-header .qodef-mobile-menu-opener a:hover, .qodef-mobile-header .qodef-mobile-menu-opener.qodef-mobile-menu-opened a', array( 'color' => $icon_hover_color ) );
		}
	}
	
	add_action( 'succulents_qodef_style_dynamic', 'succulents_qodef_mobile_icon_styles' );
}