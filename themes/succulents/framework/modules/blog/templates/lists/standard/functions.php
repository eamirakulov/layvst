<?php

if ( ! function_exists( 'succulents_qodef_register_blog_standard_template_file' ) ) {
	/**
	 * Function that register blog standard template
	 */
	function succulents_qodef_register_blog_standard_template_file( $templates ) {
		$templates['blog-standard'] = esc_html__( 'Blog: Standard', 'succulents' );
		
		return $templates;
	}
	
	add_filter( 'succulents_qodef_register_blog_templates', 'succulents_qodef_register_blog_standard_template_file' );
}

if ( ! function_exists( 'succulents_qodef_set_blog_standard_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function succulents_qodef_set_blog_standard_type_global_option( $options ) {
		$options['standard'] = esc_html__( 'Blog: Standard', 'succulents' );
		
		return $options;
	}
	
	add_filter( 'succulents_qodef_blog_list_type_global_option', 'succulents_qodef_set_blog_standard_type_global_option' );
}