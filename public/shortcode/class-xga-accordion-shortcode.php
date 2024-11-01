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

class xga_accordion_shotcode {
	public function __construct() {
		add_shortcode('xga__accordion',array($this,'xga_accordion_shortcode'));
	}

	public function xga_accordion_shortcode($attributes){
		extract( shortcode_atts( array(
			'id' => '',
		), $attributes, 'xga__accordion' ) );



		$post_id = isset($attributes['id']) ? $attributes['id'] : '';

		//general settings
		$xgp_category = get_post_meta($post_id,'xga_short_category',true);

		$accordion_theme = get_post_meta($post_id,'xga_short_theme',true);
		$total_product = get_post_meta($post_id,'xga_short_total',true);

		//styling settings
		$styling['title_color'] = get_post_meta($post_id,'xga_short_title_color',true);
		$styling['title_active_color'] = get_post_meta($post_id,'xga_short_title_active_color',true);
		$styling['title_bg_color'] = get_post_meta($post_id,'xga_short_title_bg_color',true);
		$styling['title_active_bg_color'] = get_post_meta($post_id,'xga_short_active_title_bg_color',true);
		$styling['border_color'] = get_post_meta($post_id,'xga_short_border_color',true);
		$styling['descr_color'] = get_post_meta($post_id,'xga_short_descr_color',true);
		$styling['descr_bg_color'] = get_post_meta($post_id,'xga_short_descr_bg_color',true);

		//typography settings
		$typography['title_font_size'] = get_post_meta($post_id,'xga_short_title_font_size',true);
		$typography['descr_font_size'] = get_post_meta($post_id,'xga_short_descr_font_size',true);

		if ( !empty($xgp_category) ){
			$args = array(
				'post_type' => 'xga_accordion',
				'post_per_page' => $total_product,
				'post_status' => 'publish',
				'order_by' => 'menu_order',
				'ignore_sticky_posts' => true,
				'order' => 'ASC',
				'tax_query' => array(
						array(
							'taxonomy'=> 'xga_accorr_cat',
							'field' => 'term_id',
							'terms' => $xgp_category,
                        )
				),
			);
		}else{
            $args = array(
                'post_type' => 'xga_accordion',
                'post_per_page' => $total_product,
                'post_status' => 'publish',
                'order_by' => 'menu_order',
                'ignore_sticky_posts' => true,
                'order' => 'ASC'
            );


		}

		$all_accordion = new WP_Query($args);
		ob_start();
		?>
		<style>
            <?php echo $this->theme_stylesheet($styling,$typography,$accordion_theme);?>
		</style>

        <?php

        ?>
        <div class="xga-accordion-wrapper-<?php echo esc_attr($accordion_theme)?>" id="xga-accrodion-<?php echo esc_attr($post_id);?>">

		<?php
		$data_parent = 'xga-accrodion-'.$post_id;
        while ($all_accordion->have_posts()):
	        $all_accordion->the_post();
        $is_open_initial = get_post_meta(get_the_ID(),'is_open_initial',true);
        $is_open_heading_class = (!empty($is_open_initial)) ? 'open' : '';
        $is_open_body_class = (!empty($is_open_initial)) ? 'show' : '';
        $aria_expanded = (!empty($is_open_initial)) ? 'true' : 'false';

        $get_theme_function = 'theme_'.$accordion_theme;
                 echo $this->$get_theme_function($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded);
        ?>

		<?php endwhile; wp_reset_query();?>

		</div>

<?php
		return ob_get_clean();
	}




	//all theme function will be here
    public function theme_stylesheet($styling,$typography,$accordion_theme){
	    ob_start();
	    //no style tag needded

        // all theme dynamic stylesheet will be here
        ?>
        <?php if ( $accordion_theme == 01):?>
            .xga-accordion-wrapper-01 .xga-accrodion .xga-accordion-heading a{
                background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
                color: <?php echo esc_attr( $styling['title_color']);?>;
                font-size: <?php echo esc_attr($typography['title_font_size']);?>
            }
            .xga-accordion-wrapper-01 .xga-accrodion .xga-accordion-heading a.open{
                color: <?php echo esc_attr($styling['title_active_color']);?>;
            }
            .xga-accordion-wrapper-01 .xga-accrodion .xga-accordion-body .xga-acc-content{
                color: <?php echo esc_attr($styling['descr_color']);?>;
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>
            }
            .xga-accordion-wrapper-01 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>
            }
        <?php elseif ($accordion_theme == 02):?>
            .xga-accordion-wrapper-02 .xga-accrodion .xga-accordion-heading a:after{
                background-color:  <?php echo esc_attr($styling['border_color']);?>;
                color: #fff;
            }
            .xga-accordion-wrapper-02 .xga-accrodion .xga-accordion-heading a{
                background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
                color: <?php echo esc_attr( $styling['title_color']);?>;
                font-size: <?php echo esc_attr($typography['title_font_size']);?>
            }
            .xga-accordion-wrapper-02 .xga-accrodion .xga-accordion-heading a.open{
                color: <?php echo esc_attr($styling['title_active_color']);?>;
            }
            .xga-accordion-wrapper-02:after{
                border-left: 2px dashed <?php echo esc_attr($styling['border_color']);?>;
            }
            .xga-accordion-wrapper-02 .xga-accrodion .xga-accordion-body .xga-acc-content{
                color: <?php echo esc_attr($styling['descr_color']);?>;
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>
            }
            .xga-accordion-wrapper-02 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>
            }
        <?php elseif ($accordion_theme == 03):?>
            .xga-accordion-wrapper-03 .xga-accrodion .xga-accordion-heading a:after{
                background-color:  <?php echo esc_attr($styling['border_color']);?>;
                color: #fff;
            }
            .xga-accordion-wrapper-03 .xga-accrodion .xga-accordion-heading a{
                background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
                color: <?php echo esc_attr( $styling['title_color']);?>;
                font-size: <?php echo esc_attr($typography['title_font_size']);?>
            }
            .xga-accordion-wrapper-03 .xga-accrodion .xga-accordion-heading a.open{
                color: <?php echo esc_attr($styling['title_active_color']);?>;
            }
            .xga-accordion-wrapper-03 .xga-accrodion .xga-accordion-body .xga-acc-content{
                color: <?php echo esc_attr($styling['descr_color']);?>;
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>
            }
            .xga-accordion-wrapper-03 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>
            }
        <?php elseif ($accordion_theme == 04):?>
            .xga-accordion-wrapper-04 .xga-accrodion .xga-accordion-heading a:after{
                background-color:  <?php echo esc_attr($styling['border_color']);?>;
                color: #fff;
            }
            .xga-accordion-wrapper-04 .xga-accrodion .xga-accordion-heading a{
                background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
                color: <?php echo esc_attr( $styling['title_color']);?>;
                font-size: <?php echo esc_attr($typography['title_font_size']);?>
            }
            .xga-accordion-wrapper-04 .xga-accrodion .xga-accordion-heading a.open{
                color: <?php echo esc_attr($styling['title_active_color']);?>;
            }
            .xga-accordion-wrapper-04 .xga-accrodion .xga-accordion-body .xga-acc-content{
                color: <?php echo esc_attr($styling['descr_color']);?>;
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>
            }
            .xga-accordion-wrapper-04 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>
            }
        <?php elseif ($accordion_theme == 05):?>
            .xga-accordion-wrapper-05 .xga-accrodion .xga-accordion-heading a:after{
                border-color:  <?php echo esc_attr($styling['title_active_color']);?>;
                color: <?php echo esc_attr($styling['title_active_color']);?>;
            }
            .xga-accordion-wrapper-05 .xga-accrodion .xga-accordion-heading a{
                background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
                color: <?php echo esc_attr( $styling['title_color']);?>;
                font-size: <?php echo esc_attr($typography['title_font_size']);?>
            }
            .xga-accordion-wrapper-05 .xga-accrodion .xga-accordion-heading a.open{
                color: <?php echo esc_attr($styling['title_active_color']);?>;
            }
            .xga-accordion-wrapper-05 .xga-accrodion .xga-accordion-body .xga-acc-content{
                color: <?php echo esc_attr($styling['descr_color']);?>;
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>
            }
            .xga-accordion-wrapper-05 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>
            }
        <?php elseif ($accordion_theme == 06):?>
            .xga-accordion-wrapper-06 .xga-accrodion .xga-accordion-heading a:after{
                border-color:  <?php echo esc_attr($styling['title_active_color']);?>;
                color: <?php echo esc_attr($styling['title_active_color']);?>;
            }
            .xga-accordion-wrapper-06 .xga-accrodion .xga-accordion-heading a{
                background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
                color: <?php echo esc_attr( $styling['title_color']);?>;
                font-size: <?php echo esc_attr($typography['title_font_size']);?>
            }
            .xga-accordion-wrapper-06 .xga-accrodion .xga-accordion-heading a.open{
                color: <?php echo esc_attr($styling['title_active_color']);?>;
                background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-06 .xga-accrodion .xga-accordion-body .xga-acc-content{
                color: <?php echo esc_attr($styling['descr_color']);?>;
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>
            }
            .xga-accordion-wrapper-06 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>
            }
        <?php elseif ($accordion_theme == 07):?>
            .xga-accordion-wrapper-07 .xga-accrodion .xga-accordion-heading a:after{
                border-color:  <?php echo esc_attr($styling['title_active_color']);?>;
                color: <?php echo esc_attr($styling['title_active_color']);?>;
            }
            .xga-accordion-wrapper-07 .xga-accrodion .xga-accordion-heading a{
                background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
                color: <?php echo esc_attr( $styling['title_color']);?>;
                font-size: <?php echo esc_attr($typography['title_font_size']);?>
            }
            .xga-accordion-wrapper-07 .xga-accrodion .xga-accordion-heading a.open{
                color: <?php echo esc_attr($styling['title_active_color']);?>;
                background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-07 .xga-accrodion .xga-accordion-body .xga-acc-content{
                color: <?php echo esc_attr($styling['descr_color']);?>;
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>
            }
            .xga-accordion-wrapper-07 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>
            }
        <?php elseif ($accordion_theme == '08'):?>
            .xga-accordion-wrapper-08 .xga-accrodion .xga-accordion-heading a:after{
                border-color:  <?php echo esc_attr($styling['title_active_color']);?>;
                color: <?php echo esc_attr($styling['title_active_color']);?>;
            }
            .xga-accordion-wrapper-08 .xga-accrodion .xga-accordion-heading a{
                background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
                color: <?php echo esc_attr( $styling['title_color']);?>;
                font-size: <?php echo esc_attr($typography['title_font_size']);?>
            }
            .xga-accordion-wrapper-08 .xga-accrodion .xga-accordion-heading a.open{
                color: <?php echo esc_attr($styling['title_active_color']);?>;
                background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-08 .xga-accrodion .xga-accordion-body .xga-acc-content{
                color: <?php echo esc_attr($styling['descr_color']);?>;
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>
            }
            .xga-accordion-wrapper-08 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>
            }
        <?php elseif ($accordion_theme == '09'):?>
            .xga-accordion-wrapper-09 .xga-accrodion .xga-accordion-heading a:after{
                border-color:  <?php echo esc_attr($styling['title_active_color']);?>;
                color: <?php echo esc_attr($styling['title_active_color']);?>;
            }
            .xga-accordion-wrapper-09 .xga-accrodion .xga-accordion-heading a{
                background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
                color: <?php echo esc_attr( $styling['title_color']);?>;
                font-size: <?php echo esc_attr($typography['title_font_size']);?>;
                border-left-color: <?php echo esc_attr($styling['border_color']);?>;
            }
            .xga-accordion-wrapper-09 .xga-accrodion .xga-accordion-heading a.open{
                color: <?php echo esc_attr($styling['title_active_color']);?>;
                background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-09 .xga-accrodion .xga-accordion-body .xga-acc-content{
                color: <?php echo esc_attr($styling['descr_color']);?>;
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
                border-left-color: <?php echo esc_attr($styling['border_color']);?>;
            }
            .xga-accordion-wrapper-09 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
        <?php elseif ($accordion_theme == '10'):?>
            .xga-accordion-wrapper-10 .xga-accrodion .xga-accordion-heading a:after{
                color: <?php echo esc_attr($styling['title_active_color']);?>;
            }
            .xga-accordion-wrapper-10 .xga-accrodion .xga-accordion-heading a{
                background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
                color: <?php echo esc_attr( $styling['title_color']);?>;
                font-size: <?php echo esc_attr($typography['title_font_size']);?>;
                border-color: <?php echo esc_attr($styling['border_color']);?>;
            }
            .xga-accordion-wrapper-10 .xga-accrodion .xga-accordion-heading a.open{
                color: <?php echo esc_attr($styling['title_active_color']);?>;
                background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-10 .xga-accrodion .xga-accordion-body .xga-acc-content{
                color: <?php echo esc_attr($styling['descr_color']);?>;
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
                border-color: <?php echo esc_attr($styling['border_color']);?>;
            }
            .xga-accordion-wrapper-10 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
        <?php elseif ($accordion_theme == '11'):?>
            .xga-accordion-wrapper-11 .xga-accrodion .xga-accordion-heading a:after{
                color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-11 .xga-accrodion .xga-accordion-heading a{
                background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
                color: <?php echo esc_attr( $styling['title_color']);?>;
                font-size: <?php echo esc_attr($typography['title_font_size']);?>;
                border-color: <?php echo esc_attr($styling['border_color']);?>;
            }
            .xga-accordion-wrapper-11 .xga-accrodion .xga-accordion-heading a.open{
                color: <?php echo esc_attr($styling['title_active_color']);?>;
                background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-11 .xga-accrodion .xga-accordion-body .xga-acc-content{
                color: <?php echo esc_attr($styling['descr_color']);?>;
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
                border-color: <?php echo esc_attr($styling['border_color']);?>;
            }
            .xga-accordion-wrapper-11 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
            <?php elseif ($accordion_theme == '12'):?>
            .xga-accordion-wrapper-12 .xga-accrodion .xga-accordion-heading a:after{
                color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-12 .xga-accrodion .xga-accordion-heading a{
                background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
                color: <?php echo esc_attr( $styling['title_color']);?>;
                font-size: <?php echo esc_attr($typography['title_font_size']);?>;
                border-color: <?php echo esc_attr($styling['border_color']);?>;
            }
            .xga-accordion-wrapper-12 .xga-accrodion .xga-accordion-heading a.open{
                color: <?php echo esc_attr($styling['title_active_color']);?>;
                background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-12 .xga-accrodion .xga-accordion-body .xga-acc-content{
                color: <?php echo esc_attr($styling['descr_color']);?>;
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
                border-color: <?php echo esc_attr($styling['border_color']);?>;
            }
            .xga-accordion-wrapper-12 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }

	    <?php elseif ($accordion_theme == '13'):?>

            .xga-accordion-wrapper-13 .xga-accrodion .xga-accordion-heading a{
                background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
                color: <?php echo esc_attr( $styling['title_color']);?>;
                font-size: <?php echo esc_attr($typography['title_font_size']);?>;
            }
            .xga-accordion-wrapper-13 .xga-accrodion .xga-accordion-heading a.open{
                color: <?php echo esc_attr($styling['title_active_color']);?>;
                background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-13 .xga-accrodion .xga-accordion-body .xga-acc-content{
                color: <?php echo esc_attr($styling['descr_color']);?>;
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
            .xga-accordion-wrapper-13 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
	    <?php elseif ($accordion_theme == '14'):?>

            .xga-accordion-wrapper-14 .xga-accrodion .xga-accordion-heading a{
            background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
            color: <?php echo esc_attr( $styling['title_color']);?>;
            font-size: <?php echo esc_attr($typography['title_font_size']);?>;
            }
            .xga-accordion-wrapper-14 .xga-accrodion .xga-accordion-heading a.open{
            color: <?php echo esc_attr($styling['title_active_color']);?>;
            background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-14 .xga-accrodion .xga-accordion-body .xga-acc-content{
            color: <?php echo esc_attr($styling['descr_color']);?>;
            font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
            .xga-accordion-wrapper-14 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
        <?php elseif ($accordion_theme == '15'):?>
            .xga-accordion-wrapper-15 .xga-accrodion .xga-accordion-heading a:after {
             background-color: <?php echo esc_attr($styling['title_active_color']);?>;
            }
            .xga-accordion-wrapper-15 .xga-accrodion .xga-accordion-heading a{
            background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
            color: <?php echo esc_attr( $styling['title_color']);?>;
            font-size: <?php echo esc_attr($typography['title_font_size']);?>;
            border-color:  <?php echo esc_attr($styling['border_color']);?>;
            }
            .xga-accordion-wrapper-15 .xga-accrodion .xga-accordion-heading a.open{
            color: <?php echo esc_attr($styling['title_active_color']);?>;
            background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-15 .xga-accrodion .xga-accordion-body .xga-acc-content{
            color: <?php echo esc_attr($styling['descr_color']);?>;
            font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
            .xga-accordion-wrapper-15 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
        <?php elseif ($accordion_theme == '16'):?>
            .xga-accordion-wrapper-16 .xga-accrodion .xga-accordion-heading a:after {
             background-color: <?php echo esc_attr($styling['title_active_color']);?>;
            }
            .xga-accordion-wrapper-16 .xga-accrodion .xga-accordion-heading a{
            background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
            color: <?php echo esc_attr( $styling['title_color']);?>;
            font-size: <?php echo esc_attr($typography['title_font_size']);?>;
            border-color:  <?php echo esc_attr($styling['border_color']);?>;
            }
            .xga-accordion-wrapper-16 .xga-accrodion .xga-accordion-heading a.open{
            color: <?php echo esc_attr($styling['title_active_color']);?>;
            background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-16 .xga-accrodion .xga-accordion-body .xga-acc-content{
            color: <?php echo esc_attr($styling['descr_color']);?>;
            font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
            .xga-accordion-wrapper-16 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
        <?php elseif ($accordion_theme == '17'):?>
            .xga-accordion-wrapper-17 .xga-accrodion .xga-accordion-heading a:after {
             background-color: <?php echo esc_attr($styling['title_active_color']);?>;
            }
            .xga-accordion-wrapper-17 .xga-accrodion .xga-accordion-heading a{
            background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
            color: <?php echo esc_attr( $styling['title_color']);?>;
            font-size: <?php echo esc_attr($typography['title_font_size']);?>;
            border-color:  <?php echo esc_attr($styling['border_color']);?>;
            }
            .xga-accordion-wrapper-17 .xga-accrodion .xga-accordion-heading a.open{
            color: <?php echo esc_attr($styling['title_active_color']);?>;
            background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-17 .xga-accrodion .xga-accordion-body .xga-acc-content{
            color: <?php echo esc_attr($styling['descr_color']);?>;
            font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
            .xga-accordion-wrapper-17 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
        <?php elseif ($accordion_theme == '18'):?>
            .xga-accordion-wrapper-18 .xga-accrodion .xga-accordion-heading a:after {
             color: <?php echo esc_attr($styling['title_active_color']);?>;
            }
            .xga-accordion-wrapper-18 .xga-accrodion .xga-accordion-heading a{
            background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
            color: <?php echo esc_attr( $styling['title_color']);?>;
            font-size: <?php echo esc_attr($typography['title_font_size']);?>;
            border-color:  <?php echo esc_attr($styling['border_color']);?>;
            }
            .xga-accordion-wrapper-18 .xga-accrodion .xga-accordion-heading a.open{
            color: <?php echo esc_attr($styling['title_active_color']);?>;
            background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-18 .xga-accrodion .xga-accordion-body .xga-acc-content{
            color: <?php echo esc_attr($styling['descr_color']);?>;
            font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
            .xga-accordion-wrapper-18 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
            .xga-accordion-wrapper-18 .xga-accrodion .xga-accordion-heading a:before{
                background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
                border-color: <?php echo esc_attr($styling['border_color']);?>;

            }
            .xga-accordion-wrapper-18 .xga-accrodion .xga-accordion-heading a.open:before{
                background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
        <?php elseif ($accordion_theme == '19'):?>
            .xga-accordion-wrapper-19 .xga-accrodion .xga-accordion-heading a:after {
             color: <?php echo esc_attr($styling['title_active_color']);?>;
            }
            .xga-accordion-wrapper-19 .xga-accrodion .xga-accordion-heading a{
            background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
            color: <?php echo esc_attr( $styling['title_color']);?>;
            font-size: <?php echo esc_attr($typography['title_font_size']);?>;
            border-color:  <?php echo esc_attr($styling['border_color']);?>;
            }
            .xga-accordion-wrapper-19 .xga-accrodion .xga-accordion-heading a.open{
            color: <?php echo esc_attr($styling['title_active_color']);?>;
            background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-19 .xga-accrodion .xga-accordion-body .xga-acc-content{
            color: <?php echo esc_attr($styling['descr_color']);?>;
            font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
            .xga-accordion-wrapper-19 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
        <?php elseif ($accordion_theme == '20'):?>

            .xga-accordion-wrapper-20 .xga-accrodion .xga-accordion-heading a{
            background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
            color: <?php echo esc_attr( $styling['title_color']);?>;
            font-size: <?php echo esc_attr($typography['title_font_size']);?>;
            border-color:  <?php echo esc_attr($styling['border_color']);?>;
            }
            .xga-accordion-wrapper-20 .xga-accrodion .xga-accordion-heading a.open{
            color: <?php echo esc_attr($styling['title_active_color']);?>;
            background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-20 .xga-accrodion .xga-accordion-body .xga-acc-content{
            color: <?php echo esc_attr($styling['descr_color']);?>;
            font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
            .xga-accordion-wrapper-20 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
            .xga-accordion-wrapper-20 .xga-accrodion .xga-accordion-heading a.open:after {
            color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            background-color: #fff;
            }
            .xga-accordion-wrapper-20 .xga-accrodion .xga-accordion-heading a:after {
            background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            color:#fff;
            }
        <?php elseif ($accordion_theme == '21'):?>

            .xga-accordion-wrapper-21 .xga-accrodion .xga-accordion-heading a{
            background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
            color: <?php echo esc_attr( $styling['title_color']);?>;
            font-size: <?php echo esc_attr($typography['title_font_size']);?>;
            border-color:  <?php echo esc_attr($styling['border_color']);?>;
            }
            .xga-accordion-wrapper-21 .xga-accrodion .xga-accordion-heading a.open{
            color: <?php echo esc_attr($styling['title_active_color']);?>;
            background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-21 .xga-accrodion .xga-accordion-body .xga-acc-content{
            color: <?php echo esc_attr($styling['descr_color']);?>;
            font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
            .xga-accordion-wrapper-21 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
            .xga-accordion-wrapper-21 .xga-accrodion .xga-accordion-heading a.open:after {
            color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            background-color: #fff;
            }
            .xga-accordion-wrapper-21 .xga-accrodion .xga-accordion-heading a:after {
            background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            color:#fff;
            }
        <?php elseif ($accordion_theme == '22'):?>

            .xga-accordion-wrapper-22 .xga-accrodion .xga-accordion-heading a{
                background-color: <?php echo esc_attr($styling['title_bg_color']);?>;
                color: <?php echo esc_attr( $styling['title_color']);?>;
                font-size: <?php echo esc_attr($typography['title_font_size']);?>;
            }
            .xga-accordion-wrapper-22 .xga-accrodion .xga-accordion-heading a.open{
                color: <?php echo esc_attr($styling['title_active_color']);?>;
                background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-22 .xga-accrodion .xga-accordion-body .xga-acc-content{
                color: <?php echo esc_attr($styling['descr_color']);?>;
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
                background-color: <?php echo esc_attr($styling['descr_bg_color']);?>;
            }
            .xga-accordion-wrapper-22 .xga-accrodion .xga-accordion-body .xga-acc-content p{
                font-size: <?php echo esc_attr($typography['descr_font_size']);?>;
            }
            .xga-accordion-wrapper-22 .xga-accrodion .xga-accordion-heading a.open{
                border-top-color: <?php echo esc_attr($styling['descr_bg_color']);?>;
            }
            .xga-accordion-wrapper-22 .xga-accrodion .xga-accordion-heading a.open:after{
            background-color: <?php echo esc_attr($styling['title_active_bg_color']);?>;
            }
            .xga-accordion-wrapper-22 .xga-accrodion .xga-accordion-body .xga-acc-content{
            border-bottom-color: <?php echo esc_attr($styling['descr_bg_color']);?>
            }
        <?php endif;?>


        <?php

        return ob_get_clean();
    }


    public function theme_01($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }


    public function theme_02($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }

    public function theme_03($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }

    public function theme_04($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }

    public function theme_05($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }


    public function theme_06($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }

    public function theme_07($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }


    public function theme_08($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }

    public function theme_09($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }
    public function theme_10($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }
    public function theme_11($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }
    public function theme_12($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }
    public function theme_13($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }
    public function theme_14($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }
    public function theme_15($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }
    public function theme_16($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }
    public function theme_17($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }

    public function theme_18($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }
    public function theme_19($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }
    public function theme_20($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }
    public function theme_21($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }
    public function theme_22($data_parent,$is_open_heading_class,$is_open_body_class,$aria_expanded){
	    ob_start();
	    ?>
        <div class="xga-accrodion">
            <div class="xga-accordion-heading">
                <a href="" role="button" class="xga-collapse <?php echo esc_attr($is_open_heading_class);?>"  aria-expanded="<?php echo esc_attr($aria_expanded);?>" > <?php the_title();?></a>
            </div>
            <div class="xga-accordion-body <?php echo esc_attr($is_open_body_class);?>" data-parent="<?php echo esc_attr($data_parent); ?>">
                <div class="xga-acc-content">
<!--                    --><?php $content = get_the_content();?>
                    <?php echo apply_filters('the_content', $content);;?>
                </div>
            </div>
        </div>
<?php
        return ob_get_clean();
    }


}
new xga_accordion_shotcode();
