<?php
/**
 * @package Accordion
 * @version 1.0.0
 *
 **/
if(!defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}




function xg_accordion_vc_map_register_callback($settings,$value){
	$args = array(
		'post_type' =>  'xga-shortcode',
		'post_status' => 'publish',
		'posts_per_page' => -1
	);
	$allshortcode = new WP_Query($args);


	$markup = '<div class="xportfolio-category-select-options">'
	          .'<select name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-input wpb-select' .
	          esc_attr( $settings['param_name'] ) . ' ' .
	          esc_attr( $settings['type'] ) . '_field">'.
	          '<option value="">'.esc_html('Select Shortcode','xg-accordion').'</option>';
	if ($allshortcode) {
		while ($allshortcode->have_posts()){
			$allshortcode->the_post();
			$selected = (!empty($value) && ($value == get_the_ID())) ? 'selected' : '';
			$markup.='<option value="'.esc_attr(get_the_ID()).'" '.$selected.' >'.esc_html(get_the_title()).'</option>';
		}
	}

	$markup .= '</select></div>';
	return $markup;

}
vc_add_shortcode_param( 'xg_accordion' , 'xg_accordion_vc_map_register_callback' );
