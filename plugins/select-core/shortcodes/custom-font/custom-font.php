<?php

namespace QodeCore\CPT\Shortcodes\CustomFont;

use QodeCore\Lib;

class CustomFont implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'qodef_custom_font';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Select Custom Font', 'select-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by SELECT', 'select-core' ),
					'icon'                      => 'icon-wpb-custom-font extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'select-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title Text', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle',
							'heading'    => esc_html__( 'Subtitle Text', 'select-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type_out_effect',
							'heading'     => esc_html__( 'Enable Type Out Effect', 'select-core' ),
							'description' => esc_html__( 'Adds a type out effect inside custom font content', 'select-core' ),
							'value'       => array_flip( succulents_qodef_get_yes_no_select_array( false ) )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'type_out_position',
							'heading'     => esc_html__( 'Position of Type Out Effect', 'select-core' ),
							'description' => esc_html__( 'Enter the position of the word after which you would like to display type out effect (e.g. if you would like the type out effect after the 3rd word, you would enter "3")', 'select-core' ),
							'dependency'  => array( 'element' => 'type_out_effect', 'value' => array( 'yes' ) )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'typed_color',
							'heading'    => esc_html__( 'Typed Color', 'select-core' ),
							'dependency' => array( 'element' => 'type_out_effect', 'value' => array( 'yes' ) )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'typed_ending_1',
							'heading'    => esc_html__( 'Typed Ending Number 1', 'select-core' ),
							'dependency' => Array( 'element' => 'type_out_effect', 'value' => array( 'yes' ) )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'typed_ending_2',
							'heading'    => esc_html__( 'Typed Ending Number 2', 'select-core' ),
							'dependency' => array( 'element' => 'typed_ending_1', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'typed_ending_3',
							'heading'    => esc_html__( 'Typed Ending Number 3', 'select-core' ),
							'dependency' => array( 'element' => 'typed_ending_2', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'typed_ending_4',
							'heading'    => esc_html__( 'Typed Ending Number 4', 'select-core' ),
							'dependency' => array( 'element' => 'typed_ending_3', 'not_empty' => true )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_break_words',
							'heading'     => esc_html__( 'Position of Line Break', 'select-core' ),
							'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break (e.g. if you would like the line break after the 3rd and 8th words, you would enter "3,8")', 'select-core' ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'disable_break_words',
							'heading'     => esc_html__( 'Disable Line Break for Smaller Screens', 'select-core' ),
							'value'       => array_flip( succulents_qodef_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title_break_words', 'not_empty' => true )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'select-core' ),
							'value'       => array_flip( succulents_qodef_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'font_family',
							'heading'    => esc_html__( 'Font Family', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'font_size',
							'heading'    => esc_html__( 'Font Size (px or em)', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle_font_size',
							'heading'    => esc_html__( 'Font Size (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Subtitle Style', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'line_height',
							'heading'    => esc_html__( 'Line Height (px or em)', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'subtitle_line_height',
							'heading'    => esc_html__( 'Line Height (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Subtitle Style', 'select-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'font_weight',
							'heading'     => esc_html__( 'Font Weight', 'select-core' ),
							'value'       => array_flip( succulents_qodef_get_font_weight_array( true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'subtitle_font_weight',
							'heading'     => esc_html__( 'Font Weight', 'select-core' ),
							'value'       => array_flip( succulents_qodef_get_font_weight_array( true ) ),
							'save_always' => true,
							'group'      => esc_html__( 'Subtitle Style', 'select-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'font_style',
							'heading'     => esc_html__( 'Font Style', 'select-core' ),
							'value'       => array_flip( succulents_qodef_get_font_style_array( true ) ),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'letter_spacing',
							'heading'    => esc_html__( 'Letter Spacing (px or em)', 'select-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_transform',
							'heading'     => esc_html__( 'Text Transform', 'select-core' ),
							'value'       => array_flip( succulents_qodef_get_text_transform_array( true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_decoration',
							'heading'     => esc_html__( 'Text Decoration', 'select-core' ),
							'value'       => array_flip( succulents_qodef_get_text_decorations( true ) ),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'color',
							'heading'    => esc_html__( 'Color', 'select-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'subtitle_color',
							'heading'    => esc_html__( 'Subtitle Color', 'select-core' ),
							'group'      => esc_html__( 'Subtitle Style', 'select-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_align',
							'heading'     => esc_html__( 'Text Align', 'select-core' ),
							'value'       => array(
								esc_html__( 'Default', 'select-core' ) => '',
								esc_html__( 'Left', 'select-core' )    => 'left',
								esc_html__( 'Center', 'select-core' )  => 'center',
								esc_html__( 'Right', 'select-core' )   => 'right',
								esc_html__( 'Justify', 'select-core' ) => 'justify'
							),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'margin',
							'heading'     => esc_html__( 'Margin (px or %)', 'select-core' ),
							'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'font_size_1280',
							'heading'    => esc_html__( 'Font Size (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Small Laptops', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'line_height_1280',
							'heading'    => esc_html__( 'Line Height (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Small Laptops', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'font_size_1024',
							'heading'    => esc_html__( 'Font Size (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Tablets Landscape', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'line_height_1024',
							'heading'    => esc_html__( 'Line Height (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Tablets Landscape', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'font_size_768',
							'heading'    => esc_html__( 'Font Size (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Tablets Portrait', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'line_height_768',
							'heading'    => esc_html__( 'Line Height (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Tablets Portrait', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'font_size_680',
							'heading'    => esc_html__( 'Font Size (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Mobiles', 'select-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'line_height_680',
							'heading'    => esc_html__( 'Line Height (px or em)', 'select-core' ),
							'group'      => esc_html__( 'Mobiles', 'select-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'        => '',
			'title'               => '',
			'subtitle'            => '',
			'type_out_effect'     => 'no',
			'type_out_position'   => '',
			'typed_color'         => '',
			'typed_ending_1'      => '',
			'typed_ending_2'      => '',
			'typed_ending_3'      => '',
			'typed_ending_4'      => '',
			'title_break_words'   => '',
			'disable_break_words' => '',
			'title_tag'           => 'h2',
			'font_family'         => '',
			'font_size'           => '',
			'subtitle_font_size'  => '',
			'line_height'         => '',
			'subtitle_line_height'=> '',
			'font_weight'         => '',
			'subtitle_font_weight'=> '',
			'font_style'          => '',
			'letter_spacing'      => '',
			'text_transform'      => '',
			'text_decoration'     => '',
			'color'               => '',
			'subtitle_color'      => '',
			'text_align'          => '',
			'margin'              => '',
			'font_size_1280'      => '',
			'line_height_1280'    => '',
			'font_size_1024'      => '',
			'line_height_1024'    => '',
			'font_size_768'       => '',
			'line_height_768'     => '',
			'font_size_680'       => '',
			'line_height_680'     => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_rand_class'] = 'qodef-cf-' . mt_rand( 1000, 10000 );
		$params['holder_classes']    = $this->getHolderClasses( $params );
		$params['holder_styles']     = $this->getHolderStyles( $params );
		$params['subtitle_styles']     = $this->getSubtitleStyles( $params );
		$params['holder_data']       = $this->getHolderData( $params );
		
		$params['title']     = $this->getModifiedTitle( $params );
		$params['title_tag'] = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		
		$html = qodef_core_get_shortcode_module_template_part( 'templates/custom-font', 'custom-font', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['holder_rand_class'] ) ? esc_attr( $params['holder_rand_class'] ) : '';
		$holderClasses[] = $params['type_out_effect'] === 'yes' ? 'qodef-cf-has-type-out' : '';
		$holderClasses[] = $params['disable_break_words'] === 'yes' ? 'qodef-disable-title-break' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( $params['font_family'] !== '' ) {
			$styles[] = 'font-family: ' . $params['font_family'];
		}
		
		if ( ! empty( $params['font_size'] ) ) {
			if ( succulents_qodef_string_ends_with( $params['font_size'], 'px' ) || succulents_qodef_string_ends_with( $params['font_size'], 'em' ) ) {
				$styles[] = 'font-size: ' . $params['font_size'];
			} else {
				$styles[] = 'font-size: ' . $params['font_size'] . 'px';
			}
		}
		
		if ( ! empty( $params['line_height'] ) ) {
			if ( succulents_qodef_string_ends_with( $params['line_height'], 'px' ) || succulents_qodef_string_ends_with( $params['line_height'], 'em' ) ) {
				$styles[] = 'line-height: ' . $params['line_height'];
			} else {
				$styles[] = 'line-height: ' . $params['line_height'] . 'px';
			}
		}
		
		if ( ! empty( $params['font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['font_weight'];
		}
		
		if ( ! empty( $params['font_style'] ) ) {
			$styles[] = 'font-style: ' . $params['font_style'];
		}
		
		if ( ! empty( $params['letter_spacing'] ) ) {
			if ( succulents_qodef_string_ends_with( $params['letter_spacing'], 'px' ) || succulents_qodef_string_ends_with( $params['letter_spacing'], 'em' ) ) {
				$styles[] = 'letter-spacing: ' . $params['letter_spacing'];
			} else {
				$styles[] = 'letter-spacing: ' . $params['letter_spacing'] . 'px';
			}
		}
		
		if ( ! empty( $params['text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['text_transform'];
		}
		
		if ( ! empty( $params['text_decoration'] ) ) {
			$styles[] = 'text-decoration: ' . $params['text_decoration'];
		}
		
		if ( ! empty( $params['text_align'] ) ) {
			$styles[] = 'text-align: ' . $params['text_align'];
		}
		
		if ( ! empty( $params['color'] ) ) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		if ( $params['margin'] !== '' ) {
			$styles[] = 'margin: ' . $params['margin'];
		}
		
		return implode( ';', $styles );
	}

	private function getSubtitleStyles( $params ) {
		$styles = array();


		if ( ! empty( $params['subtitle_font_size'] ) ) {
			if ( succulents_qodef_string_ends_with( $params['subtitle_font_size'], 'px' ) || succulents_qodef_string_ends_with( $params['subtitle_font_size'], 'em' ) ) {
				$styles[] = 'font-size: ' . $params['subtitle_font_size'];
			} else {
				$styles[] = 'font-size: ' . $params['subtitle_font_size'] . 'px';
			}
		}

		if ( ! empty( $params['subtitle_line_height'] ) ) {
			if ( succulents_qodef_string_ends_with( $params['subtitle_line_height'], 'px' ) || succulents_qodef_string_ends_with( $params['subtitle_line_height'], 'em' ) ) {
				$styles[] = 'line-height: ' . $params['subtitle_line_height'];
			} else {
				$styles[] = 'line-height: ' . $params['subtitle_line_height'] . 'px';
			}
		}

		if ( ! empty( $params['subtitle_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['subtitle_font_weight'];
		}



		if ( ! empty( $params['subtitle_color'] ) ) {
			$styles[] = 'color: ' . $params['subtitle_color'];
		}

		return implode( ';', $styles );
	}
	
	private function getHolderData( $params ) {
		$data                    = array();
		$data['data-item-class'] = $params['holder_rand_class'];
		
		if ( $params['font_size_1280'] !== '' ) {
			if ( succulents_qodef_string_ends_with( $params['font_size_1280'], 'px' ) || succulents_qodef_string_ends_with( $params['font_size_1280'], 'em' ) ) {
				$data['data-font-size-1280'] = $params['font_size_1280'];
			} else {
				$data['data-font-size-1280'] = $params['font_size_1280'] . 'px';
			}
		}
		
		if ( $params['font_size_1024'] !== '' ) {
			if ( succulents_qodef_string_ends_with( $params['font_size_1024'], 'px' ) || succulents_qodef_string_ends_with( $params['font_size_1024'], 'em' ) ) {
				$data['data-font-size-1024'] = $params['font_size_1024'];
			} else {
				$data['data-font-size-1024'] = $params['font_size_1024'] . 'px';
			}
		}
		
		if ( $params['font_size_768'] !== '' ) {
			if ( succulents_qodef_string_ends_with( $params['font_size_768'], 'px' ) || succulents_qodef_string_ends_with( $params['font_size_768'], 'em' ) ) {
				$data['data-font-size-768'] = $params['font_size_768'];
			} else {
				$data['data-font-size-768'] = $params['font_size_768'] . 'px';
			}
		}
		
		if ( $params['font_size_680'] !== '' ) {
			if ( succulents_qodef_string_ends_with( $params['font_size_680'], 'px' ) || succulents_qodef_string_ends_with( $params['font_size_680'], 'em' ) ) {
				$data['data-font-size-680'] = $params['font_size_680'];
			} else {
				$data['data-font-size-680'] = $params['font_size_680'] . 'px';
			}
		}
		
		if ( $params['line_height_1280'] !== '' ) {
			if ( succulents_qodef_string_ends_with( $params['line_height_1280'], 'px' ) || succulents_qodef_string_ends_with( $params['line_height_1280'], 'em' ) ) {
				$data['data-line-height-1280'] = $params['line_height_1280'];
			} else {
				$data['data-line-height-1280'] = $params['line_height_1280'] . 'px';
			}
		}
		
		if ( $params['line_height_1024'] !== '' ) {
			if ( succulents_qodef_string_ends_with( $params['line_height_1024'], 'px' ) || succulents_qodef_string_ends_with( $params['line_height_1024'], 'em' ) ) {
				$data['data-line-height-1024'] = $params['line_height_1024'];
			} else {
				$data['data-line-height-1024'] = $params['line_height_1024'] . 'px';
			}
		}
		
		if ( $params['line_height_768'] !== '' ) {
			if ( succulents_qodef_string_ends_with( $params['line_height_768'], 'px' ) || succulents_qodef_string_ends_with( $params['line_height_768'], 'em' ) ) {
				$data['data-line-height-768'] = $params['line_height_768'];
			} else {
				$data['data-line-height-768'] = $params['line_height_768'] . 'px';
			}
		}
		
		if ( $params['line_height_680'] !== '' ) {
			if ( succulents_qodef_string_ends_with( $params['line_height_680'], 'px' ) || succulents_qodef_string_ends_with( $params['line_height_680'], 'em' ) ) {
				$data['data-line-height-680'] = $params['line_height_680'];
			} else {
				$data['data-line-height-680'] = $params['line_height_680'] . 'px';
			}
		}
		
		return $data;
	}
	
	private function getModifiedTitle( $params ) {
		$title             = $params['title'];
		$type_out_effect   = $params['type_out_effect'];
		$type_out_position = str_replace( ' ', '', $params['type_out_position'] );
		$title_break_words = str_replace( ' ', '', $params['title_break_words'] );
		
		if ( ! empty( $title ) && ( $type_out_effect === 'yes' || ! empty( $title_break_words ) ) ) {
			$split_title = explode( ' ', $title );
			
			if ( $type_out_effect === 'yes' && ! empty( $type_out_position ) ) {
				$typed_styles   = $this->getTypedStyles( $params );
				$typed_ending_1 = $params['typed_ending_1'];
				$typed_ending_2 = $params['typed_ending_2'];
				$typed_ending_3 = $params['typed_ending_3'];
				$typed_ending_4 = $params['typed_ending_4'];
				
				$typed_html = '<span class="qodef-cf-typed-wrap" ' . succulents_qodef_get_inline_style( $typed_styles ) . '><span class="qodef-cf-typed">';
				if ( ! empty( $typed_ending_1 ) ) {
					$typed_html .= '<span class="qodef-cf-typed-1">' . esc_html( $typed_ending_1 ) . '</span>';
				}
				if ( ! empty( $typed_ending_2 ) ) {
					$typed_html .= '<span class="qodef-cf-typed-2">' . esc_html( $typed_ending_2 ) . '</span>';
				}
				if ( ! empty( $typed_ending_3 ) ) {
					$typed_html .= '<span class="qodef-cf-typed-3">' . esc_html( $typed_ending_3 ) . '</span>';
				}
				if ( ! empty( $typed_ending_4 ) ) {
					$typed_html .= '<span class="qodef-cf-typed-4">' . esc_html( $typed_ending_4 ) . '</span>';
				}
				$typed_html .= '</span></span>';
				
				if ( ! empty( $split_title[ $type_out_position - 1 ] ) ) {
					$split_title[ $type_out_position - 1 ] = $split_title[ $type_out_position - 1 ] . ' ' . $typed_html;
				}
			}
			
			if ( ! empty( $title_break_words ) ) {
				$break_words = explode( ',', $title_break_words );
				
				if ( ! empty( $split_title[ $title_break_words - 1 ] ) ) {
					foreach ( $break_words as $value ) {
						if ( ! empty( $split_title[ $value - 1 ] ) ) {
							$split_title[ $value - 1 ] = $split_title[ $value - 1 ] . '<br />';
						}
					}
				}
			}
			
			$title = implode( ' ', $split_title );
		}
		
		return $title;
	}
	
	private function getTypedStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['typed_color'] ) ) {
			$styles[] = 'color: ' . $params['typed_color'];
		}
		
		return implode( ';', $styles );
	}
}