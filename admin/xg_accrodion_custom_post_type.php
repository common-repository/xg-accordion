<?php

class xg_accrodion_custom_post_type {
	public function __construct() {
		add_action('init',array($this,'custom_post_type_register'));
	}
	public function custom_post_type_register(){

		/**
		 * Post Type: Accordions.
		 */

		$labels = array(
			"name" => __( "Accordions", "storefront" ),
			"singular_name" => __( "Accordion", "storefront" ),
			"menu_name" => __( "Accordion", "storefront" ),
			"all_items" => __( "All Accordion", "storefront" ),
			"add_new" => __( "New Accordion", "storefront" ),
			"add_new_item" => __( "Add New Accordion Item", "storefront" ),
			"edit_item" => __( "Edit Accordion", "storefront" ),
			"new_item" => __( "New Accordion", "storefront" ),
			"view_item" => __( "View Accordion", "storefront" ),
			"view_items" => __( "View Accordion", "storefront" ),
		);

		$args = array(
			"label" => __( "Accordions", "storefront" ),
			"labels" => $labels,
			"description" => "",
			"public" => false,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => false,
			"rest_base" => "",
			"has_archive" => false,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"rewrite" => false,
			"query_var" => true,
			'menu_icon' => XGA_ACCORDION_URL.'/admin/assets/icon/icon.png',
			"supports" => array( "title", "editor" ),
		);
		register_post_type( "xga_accordion", $args );

		/**
		 * Taxonomy: Portfolio Category.
		 */

		$tax_labels = array(
			"name" => esc_html__( "Accordion Category", 'xg-accordion' ),
			"singular_name" => esc_html__( "Accordion Category", 'xg-accordion' ),
			"menu_name" => esc_html__( "Accordion Category", 'xg-accordion' ),
			"all_items" => esc_html__( "All Accordion Category", 'xg-accordion' ),
			"add_new_item" => esc_html__( "Add New Accordion Category", 'xg-accordion' ),
		);

		$tax_args = array(
			"label" => __( "Accordion Category", 'xg-accordion' ),
			"labels" => $tax_labels,
			"public" => false,
			"hierarchical" => true,
			"label" => esc_html__("Accordion Category",'xg-accordion'),
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"query_var" => true,
			"rewrite" => array( 'slug' => 'xga_accorr_cat', 'with_front' => true, ),
			"show_admin_column" => false,
			"show_in_rest" => false,
			"rest_base" => "xga_accorr_cat",
			"show_in_quick_edit" => false,
		);
		register_taxonomy( "xga_accorr_cat", array( "xga_accordion" ), $tax_args );

	}
}

new xg_accrodion_custom_post_type();

