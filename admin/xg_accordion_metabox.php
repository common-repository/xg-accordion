<?php

require_once XGA_ACCORDION_PATH .'/admin/lib/xgm/xg_metabox_framework.php';


$options[] = array(
	'id' => 'xga_accordion_metabox',
	'title' => esc_html__('Accordion Metabox','xg-accordion'),
	'post_type' => 'xga_accordion',
	'context' => 'normal',
	'priority' => 'high',
	'sections' => array(
		array(
			'name' => 'xga_accordion_meta_name',
			'title' => esc_html__('General','xg-accordion'),
			'fields' => array(
				array(
					'id' => 'is_open_initial',
					'title' => esc_html__('Open First Time','xg-accordion'),
					'type' => 'switcher',
					'description' => esc_html__('Enable/Disable open this accordion initially','xg-accordion')
				)
			)
		)
	)
);

$options[] = array(
	'id' => 'xga_accordion_shortcode_metabox',
	'title' => esc_html__('Accordion Shortcode Metabox','xg-accordion'),
	'post_type' => 'xga-shortcode',
	'context' => 'normal',
	'priority' => 'high',
	'sections' => array(
		array(
			'name' => 'xga_shortcode_general_meta',
			'title' => esc_html__('General','xg-accordion'),
			'fields' => array(
				array(
					'id' => 'xga_short_category',
					'title' => esc_html__('Select Category','xg-accordion'),
					'type' => 'cat_select',
					'taxonomy' => 'xga_accorr_cat', //var_dump(xga_all_accordion_category()),
					'description' => esc_html__('Select category . which one you want.','xg-accordion')
				),
				array(
					'id' => 'xga_short_theme',
					'title' => esc_html__('Select Theme','xg-accordion'),
					'type' => 'pro_select',
					'options' => array(
						'01' => esc_html__('Theme One' ,'xg-accordion'),
						'02' => esc_html__('Theme Two' ,'xg-accordion'),
						'03' => esc_html__('Theme Three' ,'xg-accordion'),
						'04' => esc_html__('Theme Four' ,'xg-accordion'),
						'05' => esc_html__('Theme Five' ,'xg-accordion'),
					),
					'description' => esc_html__('Select theme . which one you want.','xg-accordion')
				),
				array(
					'id' => 'xga_short_total',
					'title' => esc_html__('Total Accordion','xg-accordion'),
					'type' => 'text',
					'default' => '-1',
					'description' => esc_html__('Enter how many accordion you want to show , enter -1 for unlimited')
				)
			)
		),
		array(
			'name' => 'xga_shortcode_styling_meta',
			'title' => esc_html__('Styling','xg-accordion'),
			'fields' => array(
				array(
					'id' => 'xga_short_title_color',
					'title' => esc_html__('Title Color','xg-accordion'),
					'type' => 'color_picker',
					'default' => '#2a384c',
					'description' => esc_html__('Select Color for accordion title','xg-accordion')
				),array(
					'id' => 'xga_short_title_active_color',
					'title' => esc_html__('Title Active Color','xg-accordion'),
					'type' => 'color_picker',
					'default' => '#197BEB',
					'description' => esc_html__('Select title active color for accordion ','xg-accordion')
				),
				array(
					'id' => 'xga_short_title_bg_color',
					'title' => esc_html__('Title Background Color','xg-accordion'),
					'type' => 'color_picker',
					'default' => '#E7EEFE',
					'description' => esc_html__('Select title background color for accordion ','xg-accordion')
				),
				array(
					'id' => 'xga_short_active_title_bg_color',
					'title' => esc_html__('Active Title Background Color','xg-accordion'),
					'type' => 'color_picker',
					'default' => '#fff',
					'description' => esc_html__('Select active title background color for accordion ','xg-accordion')
				),
				array(
					'id' => 'xga_short_border_color',
					'title' => esc_html__('Border Color','xg-accordion'),
					'type' => 'color_picker',
					'default' => '#197BEB',
					'description' => esc_html__('Select border color for accordion ','xg-accordion')
				),
				array(
					'id' => 'xga_short_descr_color',
					'title' => esc_html__('Description Color','xg-accordion'),
					'type' => 'color_picker',
					'default' => '#3b3b3b',
					'description' => esc_html__('Select description color for accordion ','xg-accordion')
				),array(
					'id' => 'xga_short_descr_bg_color',
					'title' => esc_html__('Description Background Color','xg-accordion'),
					'type' => 'color_picker',
					'default' => '#fff',
					'description' => esc_html__('Select description background color for accordion ','xg-accordion')
				)
			)
		),
		array(
			'name' => 'xga_shortcode_typo_meta',
			'title' => esc_html__('Typgraphy','xg-accordion'),
			'fields' => array(
				array(
					'id' => 'xga_short_title_font_size',
					'title' => esc_html__('Title Font Size','xg-accordion'),
					'type' => 'text',
					'default' => '18px',
					'description' => esc_html__('Enter title font size','xg-accordion')
				),
				array(
					'id' => 'xga_short_descr_font_size',
					'title' => esc_html__('Description Font Size','xg-accordion'),
					'type' => 'text',
					'default' => '16px',
					'description' => esc_html__('Enter description font size','xg-accordion')
				)
			)
		)
	)
);

new xgmf_metabox($options);
