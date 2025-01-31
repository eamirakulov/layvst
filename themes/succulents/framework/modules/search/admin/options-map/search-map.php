<?php

if ( ! function_exists( 'succulents_qodef_get_search_types_options' ) ) {
    function succulents_qodef_get_search_types_options() {
        $search_type_options = apply_filters( 'succulents_qodef_search_type_global_option', $search_type_options = array() );

        return $search_type_options;
    }
}

if ( ! function_exists( 'succulents_qodef_search_options_map' ) ) {
	function succulents_qodef_search_options_map() {
		
		succulents_qodef_add_admin_page(
			array(
				'slug'  => '_search_page',
				'title' => esc_html__( 'Search', 'succulents' ),
				'icon'  => 'fa fa-search'
			)
		);
		
		$search_page_panel = succulents_qodef_add_admin_panel(
			array(
				'title' => esc_html__( 'Search Page', 'succulents' ),
				'name'  => 'search_template',
				'page'  => '_search_page'
			)
		);
		
		succulents_qodef_add_admin_field(
			array(
				'name'          => 'search_page_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Layout', 'succulents' ),
				'default_value' => 'in-grid',
				'description'   => esc_html__( 'Set layout. Default is in grid.', 'succulents' ),
				'parent'        => $search_page_panel,
				'options'       => array(
					'in-grid'    => esc_html__( 'In Grid', 'succulents' ),
					'full-width' => esc_html__( 'Full Width', 'succulents' )
				)
			)
		);
		
		succulents_qodef_add_admin_field(
			array(
				'name'          => 'search_page_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'succulents' ),
				'description'   => esc_html__( "Choose a sidebar layout for search page", 'succulents' ),
				'default_value' => 'no-sidebar',
				'options'       => succulents_qodef_get_custom_sidebars_options(),
				'parent'        => $search_page_panel
			)
		);
		
		$succulents_custom_sidebars = succulents_qodef_get_custom_sidebars();
		if ( count( $succulents_custom_sidebars ) > 0 ) {
			succulents_qodef_add_admin_field(
				array(
					'name'        => 'search_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display', 'succulents' ),
					'description' => esc_html__( 'Choose a sidebar to display on search page. Default sidebar is "Sidebar"', 'succulents' ),
					'parent'      => $search_page_panel,
					'options'     => $succulents_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		$search_panel = succulents_qodef_add_admin_panel(
			array(
				'title' => esc_html__( 'Search', 'succulents' ),
				'name'  => 'search',
				'page'  => '_search_page'
			)
		);
		
		succulents_qodef_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Search Icon Pack', 'succulents' ),
				'description'   => esc_html__( 'Choose icon pack for search icon', 'succulents' ),
				'options'       => succulents_qodef_icon_collections()->getIconCollectionsExclude( array( 'linea_icons' ) )
			)
		);

        succulents_qodef_add_admin_field(
            array(
                'type'          => 'image',
                'name'          => 'search_logo',
                'parent'        => $search_panel,
                'label'         => esc_html__( 'Upload The Search Logo', 'succulents' ),
                'description'   => esc_html__( 'The logo uploaded here will be shown once you open a search area', 'succulents' ),
            )
        );

        succulents_qodef_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'search_sidebar_columns',
                'parent'        => $search_panel,
                'default_value' => '3',
                'label'         => esc_html__( 'Search Sidebar Columns', 'succulents' ),
                'description'   => esc_html__( 'Choose number of columns for FullScreen search sidebar area', 'succulents' ),
                'options'       => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                )
            )
        );
		
		succulents_qodef_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'search_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Grid Layout', 'succulents' ),
				'description'   => esc_html__( 'Set search area to be in grid. (Applied for Search covers header and Slide from Window Top types.', 'succulents' ),
			)
		);
		
		succulents_qodef_add_admin_section_title(
			array(
				'parent' => $search_panel,
				'name'   => 'initial_header_icon_title',
				'title'  => esc_html__( 'Initial Search Icon in Header', 'succulents' )
			)
		);
		
		succulents_qodef_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'text',
				'name'          => 'header_search_icon_size',
				'default_value' => '',
				'label'         => esc_html__( 'Icon Size', 'succulents' ),
				'description'   => esc_html__( 'Set size for icon', 'succulents' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$search_icon_color_group = succulents_qodef_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__( 'Icon Colors', 'succulents' ),
				'description' => esc_html__( 'Define color style for icon', 'succulents' ),
				'name'        => 'search_icon_color_group'
			)
		);
		
		$search_icon_color_row = succulents_qodef_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row'
			)
		);
		
		succulents_qodef_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_color',
				'label'  => esc_html__( 'Color', 'succulents' )
			)
		);
		
		succulents_qodef_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'succulents' )
			)
		);
		
		succulents_qodef_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'enable_search_icon_text',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Search Icon Text', 'succulents' ),
				'description'   => esc_html__( "Enable this option to show 'Search' text next to search icon in header", 'succulents' )
			)
		);
		
		$enable_search_icon_text_container = succulents_qodef_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'enable_search_icon_text_container',
				'dependency' => array(
					'show' => array(
						'enable_search_icon_text' => 'yes'
					)
				)
			)
		);
		
		$enable_search_icon_text_group = succulents_qodef_add_admin_group(
			array(
				'parent'      => $enable_search_icon_text_container,
				'title'       => esc_html__( 'Search Icon Text', 'succulents' ),
				'name'        => 'enable_search_icon_text_group',
				'description' => esc_html__( 'Define style for search icon text', 'succulents' )
			)
		);
		
		$enable_search_icon_text_row = succulents_qodef_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row'
			)
		);
		
		succulents_qodef_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color',
				'label'  => esc_html__( 'Text Color', 'succulents' )
			)
		);
		
		succulents_qodef_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color_hover',
				'label'  => esc_html__( 'Text Hover Color', 'succulents' )
			)
		);
		
		succulents_qodef_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_font_size',
				'label'         => esc_html__( 'Font Size', 'succulents' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		succulents_qodef_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_line_height',
				'label'         => esc_html__( 'Line Height', 'succulents' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$enable_search_icon_text_row2 = succulents_qodef_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row2',
				'next'   => true
			)
		);
		
		succulents_qodef_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_text_transform',
				'label'         => esc_html__( 'Text Transform', 'succulents' ),
				'default_value' => '',
				'options'       => succulents_qodef_get_text_transform_array()
			)
		);
		
		succulents_qodef_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_icon_text_google_fonts',
				'label'         => esc_html__( 'Font Family', 'succulents' ),
				'default_value' => '-1',
			)
		);
		
		succulents_qodef_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_style',
				'label'         => esc_html__( 'Font Style', 'succulents' ),
				'default_value' => '',
				'options'       => succulents_qodef_get_font_style_array(),
			)
		);
		
		succulents_qodef_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_weight',
				'label'         => esc_html__( 'Font Weight', 'succulents' ),
				'default_value' => '',
				'options'       => succulents_qodef_get_font_weight_array(),
			)
		);
		
		$enable_search_icon_text_row3 = succulents_qodef_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row3',
				'next'   => true
			)
		);
		
		succulents_qodef_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row3,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'succulents' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
	}
	
	add_action( 'succulents_qodef_options_map', 'succulents_qodef_search_options_map', 16 );
}