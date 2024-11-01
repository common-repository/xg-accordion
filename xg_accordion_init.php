<?php
/********************************

Plugin Name: XG Accordion
Plugin URI: https://profiles.wordpress.org/xgenious
Description:  wp accordion Is a Plugin of accordion collection for WordPress , it's lightweight and high efficiency to help you build any accordion design quickly.
Version: 1.0.0
Author: Xgenious
Author URI: https://codecanyon.net/user/xgenious/
Text-Domain: xg-accordion

 *********************************/
/**
 * @package Xgenious Accordion
 * @version 1.0.0
 *
 **/
if(!defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/*-------------------------------------------
Define the base path of plugins
--------------------------------------------*/
define( 'XGA_VERSION', '1.0.0' );
define( 'XGA_ACCORDION_URL', plugins_url( '/', __FILE__ ) );
define( 'XGA_ACCORDION_PATH', plugin_dir_path( __FILE__ ) );

class xga_accordion {
	public function __construct() {
		add_action('plugins_loaded',array($this,'load_text_domain'));
		add_action('wp_enqueue_scripts',array($this,'public_assets'));
		$this->load_plugin_dependency_file();
	}


	public function load_text_domain(){
		load_plugin_textdomain('languages',false,XGA_ACCORDION_PATH .'/languages');
	}

	public function public_assets(){
		wp_enqueue_style('font-awesome-5',XGA_ACCORDION_URL.'/assets/css/font-awesome.css',null,'5.3');
		wp_enqueue_style('xga-accordion-css',XGA_ACCORDION_URL.'/assets/css/accordion.css',null,XGA_VERSION);

		//enqueue scripts
		wp_enqueue_script('xga-accordion-js',XGA_ACCORDION_URL.'/assets/js/xga.accrodion.js',array(),'1.0.0',true);
	}

	public function load_plugin_dependency_file(){
		require_once  XGA_ACCORDION_PATH .'/public/xga-helpers.php';
		require_once XGA_ACCORDION_PATH .'/admin/xg_accrodion_custom_post_type.php';
		require_once XGA_ACCORDION_PATH .'/admin/xg_accordion_metabox.php';
		require_once XGA_ACCORDION_PATH .'/admin/xg_accrodion_menu_page.php';
	}

}
new xga_accordion();



