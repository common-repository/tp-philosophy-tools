<?php
/**
 * Plugin Name: TP Philosophy Tools
 * Plugin URI: http://www.themepalace.com/plugins/tp-philosophy-tools
 * Description: TP Philosophy Tools is Lightweight & Responsive Plugin to adds team members profiles information  with team metabox and social link meta fields.
 * Version: 1.1.4
 * Author: Theme Palace
 * Author URI: http://themepalace.com
 * Requires at least: 4.5
 * Tested up to: 6.0
 *
 * Text Domain: tp-philosophy-tools
 * Domain Path: /languages/
 *
 * @package TP Philosophy Tools
 * @category Core
 * @author Theme Palace
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'TP_Philosophy_Tools' ) ) :

	final class TP_Philosophy_Tools {

		public function __construct()
		{
			$this->tp_philosophy_tools_constant();
			$this->tp_philosophy_tools_includes();
			$this->tp_philosophy_tools_hooks();
		}

		public function tp_philosophy_tools_constant() 
		{
			define( 'TP_PHILOSOPHY_TOOLS_BASE_PATH', dirname(__FILE__ ) );
			define( 'TP_PHILOSOPHY_TOOLS_URL_PATH', plugin_dir_url(__FILE__ ) );
			define( 'TP_PHILOSOPHY_TOOLS_PLUGIN_BASE_PATH', plugin_basename(__FILE__) );
		}

		public function tp_philosophy_tools_hooks() 
		{
			add_action( 'admin_enqueue_scripts', array( $this, 'tp_philosophy_tools_enqueue_scripts' ) );

			// custom template
			add_filter( 'template_include', array( $this,'tp_philosophy_tools_set_template' ) );
		}

		public function tp_philosophy_tools_enqueue_scripts( $hook ) 
		{
			/*
			 * Enqueue scripts
			 */
			//CSS Styles
	        wp_enqueue_style( 'tp-philosophy-tools-style', TP_PHILOSOPHY_TOOLS_URL_PATH . 'assets/css/tp-philosophy-tools.css' );
	        
	        if( $hook == 'post.php' || $hook == 'post-new.php'  ){
	            //Scripts
	            wp_enqueue_script( 'tp-philosophy-tools-a', TP_PHILOSOPHY_TOOLS_URL_PATH . 'assets/js/metabox.js', array( 'jquery', 'jquery-ui-tabs' ), '' , true ); 

	            //CSS Styles
	            wp_enqueue_style( 'tp-philosophy-tools-b-tabs', TP_PHILOSOPHY_TOOLS_URL_PATH . 'assets/css/metabox.css' );
	        }
	        return;
	    }

	    public function tp_philosophy_tools_set_template( $template ){
	    	if ( is_post_type_archive( 'tp-philosophy-teams' ) || is_tax( 'tp-philosophy-teams-category' ) ) :
				if ( locate_template( 'tp-philosophy-tools/tp-archive-team.php' ) != '' )
					$template = locate_template( 'tp-philosophy-tools/tp-archive-team.php' );
				else
					$template = TP_PHILOSOPHY_TOOLS_BASE_PATH . '/templates/tp-archive-team.php';
			endif;

			if ( is_post_type_archive( 'tp-philosophy-testi' ) ) :
				if ( locate_template( 'tp-philosophy-tools/tp-archive-testimonial.php' ) != '' )
					$template = locate_template( 'tp-philosophy-tools/tp-archive-testimonial.php' );
				else
					$template = TP_PHILOSOPHY_TOOLS_BASE_PATH . '/templates/tp-archive-testimonial.php';
			endif;

			if( is_singular( 'tp-philosophy-teams' ) ) :
				if ( locate_template( 'tp-philosophy-tools/tp-single-team.php' ) != '' )
					$template = locate_template( 'tp-philosophy-tools/tp-single-team.php' );
				else
					$template = TP_PHILOSOPHY_TOOLS_BASE_PATH . '/templates/tp-single-team.php';
			endif;

			if( is_singular( 'tp-philosophy-testi' ) ) :
				if ( locate_template( 'tp-philosophy-tools/tp-single-testimonial.php' ) != '' )
					$template = locate_template( 'tp-philosophy-tools/tp-single-testimonial.php' );
				else
					$template = TP_PHILOSOPHY_TOOLS_BASE_PATH . '/templates/tp-single-testimonial.php';
			endif;

			return $template;
	    }

	    public function tp_philosophy_tools_includes()
		{
			/*
			 * Include files
			 */
			require_once( 'tp-post-type/class-tp-philosophy-tools-teams.php' );
			require_once( 'tp-metabox/class-tp-philosophy-tools-metabox.php' );
			require_once( 'include/tp-philosophy-tools-functions.php' );

			require_once( 'tp-post-type/class-tp-philosophy-tools-testimonials.php' );
			require_once( 'tp-metabox/class-tp-philosophy-tools-testimonial-metabox.php' );
			/*
			 * Template Parts 
			 */
			require_once( 'template-parts/tp-content-team.php' );
			require_once( 'template-parts/tp-content-testimonial.php' );
			require_once( 'template-parts/tp-content-team-single.php' );
			require_once( 'template-parts/tp-content-testimonial-single.php' );
			
		}
 
	}

	new TP_Philosophy_Tools();

endif;
