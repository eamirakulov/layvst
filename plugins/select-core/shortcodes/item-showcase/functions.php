<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Qodef_Item_Showcase extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'qodef_core_add_item_showcase_shortcodes' ) ) {
	function qodef_core_add_item_showcase_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'QodeCore\CPT\Shortcodes\ItemShowcase\ItemShowcase',
			'QodeCore\CPT\Shortcodes\ItemShowcase\ItemShowcaseItem'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'qodef_core_filter_add_vc_shortcode', 'qodef_core_add_item_showcase_shortcodes' );
}

if ( ! function_exists( 'qodef_core_set_item_showcase_custom_style_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom css style for item showcase shortcode
	 */
	function qodef_core_set_item_showcase_custom_style_for_vc_shortcodes( $style ) {
		$current_style = '.wpb_content_element.wpb_qodef_item_showcase_item > .wpb_element_wrapper { 
			background-color: #f4f4f4; 
		}';
		
		$style .= $current_style;
		
		return $style;
	}
	
	add_filter( 'qodef_core_filter_add_vc_shortcodes_custom_style', 'qodef_core_set_item_showcase_custom_style_for_vc_shortcodes' );
}

if ( ! function_exists( 'qodef_core_set_item_showcase_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for item showcase shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function qodef_core_set_item_showcase_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-item-showcase';
		$shortcodes_icon_class_array[] = '.icon-wpb-item-showcase-item';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'qodef_core_filter_add_vc_shortcodes_custom_icon_class', 'qodef_core_set_item_showcase_icon_class_name_for_vc_shortcodes' );
}