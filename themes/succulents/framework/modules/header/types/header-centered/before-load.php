<?php

if ( ! function_exists( 'succulents_qodef_set_header_centered_type_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function succulents_qodef_set_header_centered_type_global_option( $header_types ) {
		$header_types['header-centered'] = array(
			'image' => QODE_FRAMEWORK_HEADER_TYPES_ROOT . '/header-centered/assets/img/header-centered.png',
			'label' => esc_html__( 'Centered', 'succulents' )
		);
		
		return $header_types;
	}
	
	add_filter( 'succulents_qodef_header_type_global_option', 'succulents_qodef_set_header_centered_type_global_option' );
}

if ( ! function_exists( 'succulents_qodef_set_header_centered_type_meta_boxes_option' ) ) {
	/**
	 * This function set header type value for header meta boxes map
	 */
	function succulents_qodef_set_header_centered_type_meta_boxes_option( $header_type_options ) {
		$header_type_options['header-centered'] = esc_html__( 'Centered', 'succulents' );
		
		return $header_type_options;
	}
	
	add_filter( 'succulents_qodef_header_type_meta_boxes', 'succulents_qodef_set_header_centered_type_meta_boxes_option' );
}

if ( ! function_exists( 'succulents_qodef_set_hide_dep_options_header_centered' ) ) {
	/**
	 * This function is used to hide all containers/panels for admin options when this header type is selected
	 */
	function succulents_qodef_set_hide_dep_options_header_centered( $hide_dep_options ) {
		$hide_dep_options[] = 'header-centered';
		
		return $hide_dep_options;
	}
	
	// header types panel options
	add_filter( 'succulents_qodef_full_screen_menu_hide_global_option', 'succulents_qodef_set_hide_dep_options_header_centered' );
	add_filter( 'succulents_qodef_header_standard_hide_global_option', 'succulents_qodef_set_hide_dep_options_header_centered' );
	add_filter( 'succulents_qodef_header_vertical_hide_global_option', 'succulents_qodef_set_hide_dep_options_header_centered' );
	add_filter( 'succulents_qodef_header_vertical_menu_hide_global_option', 'succulents_qodef_set_hide_dep_options_header_centered' );
	add_filter( 'succulents_qodef_header_vertical_closed_hide_global_option', 'succulents_qodef_set_hide_dep_options_header_centered' );
	add_filter( 'succulents_qodef_header_vertical_sliding_hide_global_option', 'succulents_qodef_set_hide_dep_options_header_centered' );
	
	// header types panel meta boxes
	add_filter( 'succulents_qodef_header_standard_hide_meta_boxes', 'succulents_qodef_set_hide_dep_options_header_centered' );
	add_filter( 'succulents_qodef_header_vertical_hide_meta_boxes', 'succulents_qodef_set_hide_dep_options_header_centered' );
	
	// header types panel - widgets area meta boxes
	add_filter( 'succulents_qodef_header_menu_area_widgets_hide_meta_boxes', 'succulents_qodef_set_hide_dep_options_header_centered' );
	add_filter( 'succulents_qodef_header_logo_area_widgets_hide_meta_boxes', 'succulents_qodef_set_hide_dep_options_header_centered' );
}