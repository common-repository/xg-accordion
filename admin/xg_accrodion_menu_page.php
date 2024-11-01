<?php
/**
 * Created by PhpStorm.
 * User: dvrob
 * Date: 9/23/2018
 * Time: 1:05 AM
 */
require_once XGA_ACCORDION_PATH .'/admin/lib/xgm/xgp_options_framework.php';
class xg_accrodion_menu_page {
	function __construct() {
		add_action('admin_enqueue_scripts',array($this,'load_scripts'));
		add_action('wp_ajax_xga_accordion_sorting',array($this,'xga_accordion_sorting'));
		add_action('pre_get_posts', array($this, 'xga_accordion_pre_get_posts'));
	}

	public function load_scripts($screen){
		global $post_type;
		if ('xga_accordion' == $post_type){
			wp_enqueue_style('xga-admin-cs', XGA_ACCORDION_URL . '/admin/assets/css/xga-admin.css', array(), null);
			wp_enqueue_script('xga-admin-js', XGA_ACCORDION_URL . '/admin/assets/js/xga-admin.js', array('jquery','jquery-ui-sortable','jquery-ui-core'), null, true);
		}
	}
	public function xga_accordion_sorting(){
		global $wpdb;

		parse_str($_POST['order'], $data);

		if (!is_array($data)){
			return false;
		}


		$id_arr = array();
		foreach ($data as $key => $values) {
			foreach ($values as $position => $id) {
				$id_arr[] = $id;
			}
		}

		$menu_order_arr = array();
		foreach ($id_arr as $key => $id) {
			$results = $wpdb->get_results("SELECT menu_order FROM $wpdb->posts WHERE ID = " . intval($id));
			foreach ($results as $result) {
				$menu_order_arr[] = $result->menu_order;
			}
		}

		sort($menu_order_arr);

		foreach ($data as $key => $values) {
			foreach ($values as $position => $id) {
				$wpdb->update($wpdb->posts, array('menu_order' => $menu_order_arr[$position]), array('ID' => intval($id)));
			}
		}
		wp_die();
	}

	function xga_accordion_pre_get_posts($wp_query) {
		$objects = array('xga_accordion');
		if (empty($objects)){
			return false;
		}

		if (is_admin()) {

			if (isset($wp_query->query['post_type']) && !isset($_GET['orderby'])) {
				if (in_array($wp_query->query['post_type'], $objects)) {
					$wp_query->set('orderby', 'menu_order');
					$wp_query->set('order', 'ASC');
				}
			}
		} else {

			$active = false;

			if (isset($wp_query->query['post_type'])) {
				if (!is_array($wp_query->query['post_type'])) {
					if (in_array($wp_query->query['post_type'], $objects)) {
						$active = true;
					}
				}
			} else {
				if (in_array('post', $objects)) {
					$active = true;
				}
			}

			if (!$active)
				return false;

			if (isset($wp_query->query['suppress_filters'])) {
				if ($wp_query->get('orderby') == 'date')
					$wp_query->set('orderby', 'menu_order');
				if ($wp_query->get('order') == 'DESC')
					$wp_query->set('order', 'ASC');
			} else {
				if (!$wp_query->get('orderby'))
					$wp_query->set('orderby', 'menu_order');
				if (!$wp_query->get('order'))
					$wp_query->set('order', 'ASC');
			}
		}
	}

}

new xg_accrodion_menu_page();