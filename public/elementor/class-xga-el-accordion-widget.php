<?php
/**
 * @package Xgenious Accordion Elementor addon
 * @version 1.0
 *
 **/
/******************************************
Register Elementor accordion Addon
 *******************************************/

namespace Elementor;

if(!defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Define accordion elementor addon
 */
class xg_accordion_elementor_addon extends Widget_Base
{
	/**
	 * Define our get_name settings.
	 */
	public function get_name(){
		return 'xg-accordion';
	}
	/**
	 * Define our get_title settings
	 */
	public function get_title(){
		return __('Xg Accordion', 'xg-accordion');
	}
	/**
	 * Define our get_icon settings
	 */
	public function get_icon(){
		return 'fa fa-list-alt';
	}
	/**
	 * Define Our get_categories settings
	 */
	public function get_categories(){
		return ['xgenious-accordion-addons'];
	}
	/**
	 * Define our _register_controls settings
	 */
	protected function _register_controls(){
		/**
		 * Price Plan Title and Price Section
		 */
		$this->start_controls_section(
			'section_my_custom',
			[
				'label' => esc_html__( 'XG Accordion', 'xg-accordion' ),
			]
		);
		$this->add_control(
			'select_shotcode',
			[
				'label' => __('Select Accordion Shortcode','xg-accordion'),
				'type' => Controls_manager::SELECT,
				'default' => '',
				'options' => xga_get_accordion_el(),
				'placeholder' => __('select which xg accordion you want to show.','xg-accordion')
			]
		);

		/**
		 * End Title Section
		 */
		$this->end_controls_section();

	}

	/**
	 * Define our Content Display Settings
	 */
	protected function render(){
		$settings = $this->get_settings();
		/**
		 * main part
		 */
		$id = $settings['select_shotcode'];
		$shortcode = '[xga__accordion  id="'.$id.'"]';
		$render_shortcode = do_shortcode( shortcode_unautop( $shortcode ) );
		?>
		<div class="elementor-shortcode"><?php echo $render_shortcode; ?></div>
		<?php
	}

}
/*=============Call this every widget ====================*/
Plugin::instance()->widgets_manager->register_widget_type( new xg_accordion_elementor_addon() );
