<?php

require_once XGA_ACCORDION_PATH .'/public/shortcode/class-xga-accordion-shortcode.php';

function vc_before_init_actions() {
	if ( class_exists( 'Vc_Manager' ) ) {
		require_once( XGA_ACCORDION_PATH . '/public/wpbakery/class-xga-wpbakery-param-register.php' );
		require_once( XGA_ACCORDION_PATH . '/public/wpbakery/class-xga-wpb-accordion-widget.php' );
	}
}

add_action( 'vc_before_init', 'vc_before_init_actions' );
/*
 * check elementor page builder installed or not
 * */
if ( defined( 'ELEMENTOR_VERSION' ) ) {
	add_action(
		'elementor/init', function() {
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'xgenious-accordion-addons',
			[
				'title' => __('XG Accordion','xg-accordion'),
				'icon' => '',
			],
			1
		);
	}
	);
}
add_action( 'elementor/widgets/widgets_registered', 'xga_accordion_elementor_addon' );
function xga_accordion_elementor_addon() {
	require_once XGA_ACCORDION_PATH . '/public/elementor/class-xga-el-accordion-widget.php';
}
function xga_get_accordion_el(){
	$args = array(
		'post_type' => 'xga-shortcode',
		'post_status' => 'publish',
		'posts_per_page' => -1
	);
	$allshortcode = new WP_Query($args);

	$options = array(''=>'Select Shortcode');

	while ( $allshortcode->have_posts() ){
		$allshortcode->the_post();

		$options[get_the_ID()] = get_the_title();

	}
	return $options;

}