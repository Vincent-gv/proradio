<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.1.4
*/

//since 1.1.4
require_once get_theme_file_path( '/inc/proradio-core-setup/theme-functions/helpers/get-terms-array.php' );


function proradio_vc_query_fields( $items_per_page_std = 10 ){

	
	$postTypes = get_post_types( array() );
	$postTypesList = array();
	$excludedPostTypes = array(
		'revision',
		'nav_menu_item',
		'custom_css',
		'customize_changeset',
		'vc_grid_item',
		'oembed_cache',
		'attachment',
	);
	if ( is_array( $postTypes ) && ! empty( $postTypes ) ) {
		foreach ( $postTypes as $postType ) {
			if ( ! in_array( $postType, $excludedPostTypes ) ) {
				$label = ucfirst( $postType );
				$postTypesList[] = array(
					$postType,
					$label,
				);
			}
		}
	}
	$postTypesList[] = array(
		'custom',
		esc_html__( 'Custom query', 'proradio' ),
	);
	$postTypesList[] = array(
		'ids',
		esc_html__( 'List of IDs', 'proradio' ),
	);

	$taxonomiesForFilter = array();

	if ( 'vc_edit_form' === vc_post_param( 'action' ) ) {
		$vcTaxonomiesTypes = vc_taxonomies_types();
		if ( is_array( $vcTaxonomiesTypes ) && ! empty( $vcTaxonomiesTypes ) ) {
			foreach ( $vcTaxonomiesTypes as $t => $data ) {
				if ( 'post_format' !== $t && is_object( $data ) ) {
					$taxonomiesForFilter[ $data->labels->name . '(' . $t . ')' ] = $t;
				}
			}
		}
	}
	$fields = array(
		array(
		   "type" => "textfield",
		   'group' => esc_html__( 'Data Settings', 'proradio' ),
		   "heading" => esc_html__( "Posts by ID", "proradio" ),
		   "description" => esc_html__( "Display only the contents with these IDs. All other parameters will be ignored.", "proradio" ),
		   "param_name" => "include_by_id",
		   'value' => ''
		),

		array(
			'group' => esc_html__( 'Data Settings', 'proradio' ),
			'type' => 'textfield',
			'heading' => esc_html__( 'Total items', 'proradio' ),
			'admin_label' => true,
			'param_name' => 'items_per_page',
			'std' => $items_per_page_std,
			'param_holder_class' => 'vc_not-for-custom',
			'description' => esc_html__( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).', 'proradio' ),
			'dependency' => array(
				'element' => 'post_type',
				'value_not_equal_to' => array(
					'ids',
					'custom',
				),
			),
		),
		// Category filtering ===================================================================================================
		array(
			'group' => esc_html__( 'Data Settings', 'proradio' ),
			'type' 			=> 'autocomplete',
			'heading' => esc_html__( 'Narrow data source', 'proradio' ),
			'description' => esc_html__( 'Enter categories, tags, formats or custom taxonomies.', 'proradio' ),
			'param_name' 	=> 'tax_filter',
			'admin_label' => true,
			'settings'		=> array( 
				'values' 		 => proradio_get_terms_array() ,
				'multiple'       => true,
				'sortable'       => true,
	      		'min_length'     => 1,
	      		'groups'         => false,  // In UI show results grouped by groups
	      		'unique_values'  => true,  // In UI show results except selected. NB! You should manually check values in backend
	      		'display_inline' => true, // In UI show results inline view),
			),
			'dependency' => array(
				'element' => 'post_type',
				'value_not_equal_to' => array(
					'ids',
					'custom',
				),
			),
		),

		// Custom query tab ===================================================================================================
		array(
			'group' => esc_html__( 'Data Settings', 'proradio' ),
			'type' => 'textarea_safe',
			'heading' => esc_html__( 'Custom query', 'proradio' ),
			'param_name' => 'custom_query',
			'description' => esc_html__( 'Build custom query according to WordPress.', 'proradio' ).' <a href="http://codex.wordpress.org/Function_Reference/query_posts" target="_blank">'.esc_html__( 'WordPress Codex', 'proradio' ).'</a>.',
			'dependency' => array(
				'element' => 'post_type',
				'value' => array( 'custom' ),
			),
		),


		// Data settings ===================================================================================================
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order by', 'proradio' ),
			'param_name' => 'orderby',
			'group' => esc_html__( 'Data Settings', 'proradio' ),
			'value' => array(
				esc_html__( 'Date', 'proradio' ) => 'date',
				esc_html__( 'Order by post ID', 'proradio' ) => 'ID',
				esc_html__( 'Author', 'proradio' ) => 'author',
				esc_html__( 'Title', 'proradio' ) => 'title',
				esc_html__( 'Last modified date', 'proradio' ) => 'modified',
				esc_html__( 'Post/page parent ID', 'proradio' ) => 'parent',
				esc_html__( 'Number of comments', 'proradio' ) => 'comment_count',
				esc_html__( 'Menu order/Page Order', 'proradio' ) => 'menu_order',
				esc_html__( 'Meta value', 'proradio' ) => 'meta_value',
				esc_html__( 'Random order', 'proradio' ) => 'rand',
			),
			'description' => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required. Meta value = alphabetical order. Meta value number = numerical order.', 'proradio' ),
			'group' => esc_html__( 'Data Settings', 'proradio' ),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
			'dependency' => array(
				'element' => 'post_type',
				'value_not_equal_to' => array(
					'ids',
					'custom',
				),
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Sort order', 'proradio' ),
			'param_name' => 'order',
			'group' => esc_html__( 'Data Settings', 'proradio' ),
			'value' => array(
				esc_html__( 'Descending', 'proradio' ) => 'DESC',
				esc_html__( 'Ascending', 'proradio' ) => 'ASC',
			),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
			'description' => esc_html__( 'Select sorting order.', 'proradio' ),
			'dependency' => array(
				'element' => 'post_type',
				'value_not_equal_to' => array(
					'ids',
					'custom',
				),
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Meta key', 'proradio' ),
			'group' => esc_html__( 'Data Settings', 'proradio' ),
			'param_name' => 'meta_key',
			'description' => esc_html__( 'Input meta key for grid ordering.', 'proradio' ),
			'group' => esc_html__( 'Data Settings', 'proradio' ),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
			'dependency' => array(
				'element' => 'orderby',
				'value' => array(
					'meta_value',
					'meta_value_num',
				),
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Offset', 'proradio' ),
			'group' => esc_html__( 'Data Settings', 'proradio' ),
			'param_name' => 'offset',
			'description' => esc_html__( 'Number of grid elements to displace or pass over.', 'proradio' ),
			'group' => esc_html__( 'Data Settings', 'proradio' ),
			'param_holder_class' => 'vc_grid-data-type-not-ids',
			'dependency' => array(
				'element' => 'post_type',
				'value_not_equal_to' => array(
					'ids',
					'custom',
				),
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Exclude', 'proradio' ),
			'group' => esc_html__( 'Data Settings', 'proradio' ),
			'param_name' => 'exclude',
			'description' => esc_html__( 'Exclude posts, pages, etc. by ID.', 'proradio' ),
			'group' => esc_html__( 'Data Settings', 'proradio' ),
			'dependency' => array(
				'element' => 'post_type',
				'value_not_equal_to' => array(
					'ids',
					'custom',
				),
				'callback' => 'vc_grid_exclude_dependency_callback',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'proradio' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'proradio' ),
		),
		array(
			'type' => 'el_id',
			'heading' => esc_html__( 'Container ID', 'proradio' ),
			'param_name' => 'el_id',
			'description' => sprintf( esc_html__( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'proradio' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'vc_grid_id',
			'param_name' => 'grid_id',
		),
	);


	return $fields;
}