<?php
/**
 * @package Product Carusel
 * @version 1.0.0
 *
 **/
if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	exit;
}

// Element Class
class xgp_accordion extends WPBakeryShortCode {

	// Element Init
	function __construct() {
		add_action( 'init', array( $this, 'xgp_accordion_mapping' ) );
		add_shortcode( 'xgp_accordion_shortcode', array( $this, 'xgp_accordion_shortcode' ) );
	}


	// Element Mapping
	public function xgp_accordion_mapping() {

		// Stop all if VC is not enabled
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			return;
		}

		// Map the block with vc_map()
		vc_map(
			array(
				'name'        => __( 'xg Accordion', 'xg-accordion' ),
				'base'        => 'xgp_accordion_shortcode',
				'description' => __( 'Accordion layout collection by xgenious.', 'xg-accordion' ),
				'category'    => __( 'Xp Accordion', 'xg-accordion' ),
				'icon'        => XGA_ACCORDION_URL . '/assets/icon/icon.jpg',
				'controls'    => 'full',
				'params'      => array(

					array(
						'type' => 'xg_accordion',
						'heading'     => __( 'Select Xg Accordion Shortcode', 'xg-accordion' ),
						'param_name'  => 'id',
						'description' => __( 'select which xg accordion you want to show ', 'xg-product' ),
						'group'       => __( 'General', 'xg-product' ),
					),

				),
			)
		);

	}


	// Element HTML
	public function xgp_accordion_shortcode( $atts, $content = null ) {

		// Params extraction
		extract(
			shortcode_atts(
				array(
					'id'           => '',
				),
				$atts
			)
		);

		$content   = wpb_js_remove_wpautop( $content, true ); // YOU CAN DELETE IF YOU DON'T USE TEXTAREA HTML
		// Design your element with data
		ob_start();
		?>

		<?php echo do_shortcode('[xga__accordion  id="'.$atts['id'].'"]')?>

		<?php
		return ob_get_clean();
	}

} // End Element Class


// Element Class Init
new xgp_accordion();


