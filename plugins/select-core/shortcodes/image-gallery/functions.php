<?php

if ( ! function_exists( 'qodef_core_add_image_gallery_shortcodes' ) ) {
	function qodef_core_add_image_gallery_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'QodeCore\CPT\Shortcodes\ImageGallery\ImageGallery'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'qodef_core_filter_add_vc_shortcode', 'qodef_core_add_image_gallery_shortcodes' );
}

if ( ! function_exists( 'qodef_core_set_image_gallery_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for image gallery shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function qodef_core_set_image_gallery_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-image-gallery';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'qodef_core_filter_add_vc_shortcodes_custom_icon_class', 'qodef_core_set_image_gallery_icon_class_name_for_vc_shortcodes' );
}

if ( ! function_exists( 'qodef_core_add_image_gallery_attachment_custom_field' ) ) {
	function qodef_core_add_image_gallery_attachment_custom_field( $form_fields, $post = null ) {
		if ( wp_attachment_is_image( $post->ID ) ) {
			$field_value = get_post_meta( $post->ID, 'image_gallery_masonry_image_size', true );
			
			$form_fields['image_gallery_masonry_image_size'] = array(
				'input' => 'html',
				'label' => esc_html__( 'Image Size', 'select-core' ),
				'helps' => esc_html__( 'Choose image size for Image Gallery shortcode item - Masonry layout', 'select-core' )
			);
			
			$form_fields['image_gallery_masonry_image_size']['html'] = "<select name='attachments[{$post->ID}][image_gallery_masonry_image_size]'>";
			$form_fields['image_gallery_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'qodef-default-masonry-item', false ) . ' value="qodef-default-masonry-item">' . esc_html__( 'Default Size', 'select-core' ) . '</option>';
			$form_fields['image_gallery_masonry_image_size']['html'] .= '<option ' . selected( $field_value, 'qodef-large-masonry-item', false ) . ' value="qodef-large-masonry-item">' . esc_html__( 'Large Size', 'select-core' ) . '</option>';
			$form_fields['image_gallery_masonry_image_size']['html'] .= '</select>';
		}
		
		return $form_fields;
	}
	
	add_filter( 'attachment_fields_to_edit', 'qodef_core_add_image_gallery_attachment_custom_field', 10, 2 );
}

if ( ! function_exists( 'qodef_core_save_image_gallery_attachment_fields' ) ) {
	/**
	 * @param array $post
	 * @param array $attachment
	 *
	 * @return array
	 */
	function qodef_core_save_image_gallery_attachment_fields( $post, $attachment ) {
		
		if ( isset( $attachment['image_gallery_masonry_image_size'] ) ) {
			update_post_meta( $post['ID'], 'image_gallery_masonry_image_size', $attachment['image_gallery_masonry_image_size'] );
		}
		
		return $post;
	}
	
	add_filter( 'attachment_fields_to_save', 'qodef_core_save_image_gallery_attachment_fields', 10, 2 );
}