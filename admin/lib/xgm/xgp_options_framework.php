<?php
if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	exit;
}

Class xgp_admin_modules{

	public $instance;

	public function instance(){

	}
	public function __construct() {

		add_action('admin_menu',array($this,'xgp_admin_menu'));
		add_action( 'init', array($this,'xgp_register_post_type'), 0 );
		add_filter('manage_xga-shortcode_posts_columns',array($this,'xgp_add_custom_column'));
		add_action('manage_xga-shortcode_posts_custom_column',array($this,'xgp_add_custom_column_content'));
		add_action('admin_enqueue_scripts',array($this,'xgp_admin_assets'));
		add_action('admin_init',array($this,'xgp_register_settings'));
	}
	public function xgp_admin_assets($page){
		global $post_type;


	}
	/*
	 * all admin menu and submenu register
	 * */
	public function xgp_admin_menu(){
		add_menu_page('XG Accordion','XG Accordion','manage_options','xga-accordion-page',array($this,'xga_admin_menu_display'),XGA_ACCORDION_URL.'/admin/assets/icon/icon.png',67);
		//sub menu
		$submenu = add_submenu_page('xga-accordion-page',__('Help & Support','xg-accrodion'),__('Help & Support','xg-accrodion'),'manage_options','xga-help',array($this,'xga_help_display'));
		add_action( 'admin_print_styles-' . $submenu, array($this,'admin_page_style') );
	}
	public function xgp_register_post_type(){
		$labels = array(
			'name'                => _x( 'Accordion', 'Post Type General Name', 'xg-accordion' ),
			'singular_name'       => _x( 'Accordion', 'Post Type Singular Name', 'xg-accordion' ),
			'menu_name'           => __( 'Accordion', 'xg-accordion' ),
			'all_items'           => __( 'All Accordion Shortcode', 'xg-accordion' ),
			'view_item'           => __( 'View Accordion', 'xg-accordion' ),
			'add_new_item'        => __( 'Add New Accordion', 'xg-accordion' ),
			'add_new'             => __( 'Add New', 'xg-accordion' ),
			'edit_item'           => __( 'Edit Accordion', 'xg-accordion'),
			'update_item'         => __( 'Update Accordion', 'xg-accordion' ),
			'search_items'        => __( 'Search Accordion', 'xg-accordion' ),
			'not_found'           => __( 'Not Found', 'xg-accordion' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'xg-accordion' ),
		);
		$args = array(
			'label' => __('Accordions ','xg-accordion'),
			'description' => __('Accordion Accordion','xp-product'),
			'labels' => $labels,
			'supports' => array('title'),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => 'xga-accordion-page',
			'can_export'          => true,
			'capability_type'     => 'page',
			'query_var' => false

		);
		register_post_type('xga-shortcode',$args);
	}

	public function  xga_admin_menu_display(){}

	public function  xga_help_display(){
		require_once XGA_ACCORDION_PATH .'/admin/partials/xga-help-display.php';
	}
	/*
	 * register settings for product quick view page
	 * */
	public function xgp_register_settings(){
		//register setting for quick view modal typography
		register_setting('xgp_quick_view_options','qvt_title_font_size',array('sanitize_callback','esc_attr'));
		register_setting('xgp_quick_view_options','qvt_price_font_size',array('sanitize_callback','esc_attr'));
		register_setting('xgp_quick_view_options','qvt_descr_font_size',array('sanitize_callback','esc_attr'));
		register_setting('xgp_quick_view_options','qvt_btn_font_size',array('sanitize_callback','esc_attr'));
		register_setting('xgp_quick_view_options','qvt_meta_font_size',array('sanitize_callback','esc_attr'));
		register_setting('xgp_quick_view_options','qvt_tag_font_size',array('sanitize_callback','esc_attr'));
		//register setting for quick view modal styling

	}
	/*
	 * add custom column for xg product post type
	 * @param $column (array)
	 * @return array of filter column
	 * */
	public function xgp_add_custom_column($column){
		$new_columns['cb']        = '<input type="checkbox" />';
		$new_columns['title']     = __( 'Accordion Shortcode  Title', 'xg-accordion' );
		$new_columns['shortcode'] = __( 'Accordion Shortcode', 'xg-accordion' );
		$new_columns['']          = '';
		$new_columns['date']      = __( 'Date', 'xg-accordion' );

		return $new_columns;
	}
	/*
	 * add custom column content
	 * */
	public function xgp_add_custom_column_content($column){
		global $post;
		$post_id = $post->ID;
		switch ( $column ){
			case 'shortcode':
				$column_field = '<div class="xgp-shortcode-element-field"><input class="xga_shotcode_wrapper" type="text" id="xga_shotcode_wrapper" readonly="readonly" value="[xga__accordion  ' . 'id=&quot;' . $post_id . '&quot;' . ']"/><span class="icon xgp-copy-cipboard">Copy</span></div>';
				echo $column_field;
				break;
		}
	}
	public function admin_page_style(){
		wp_enqueue_style('xga-options-css',XGA_ACCORDION_URL .'/admin/lib/xgm/assets/css/xgp-options.css',null,XGA_VERSION);
		wp_enqueue_style('xgp-flaticon-css',XGA_ACCORDION_URL .'/admin/lib/xgm/assets/css/flaticon.css',null,XGA_VERSION);
	}

}
new xgp_admin_modules();
