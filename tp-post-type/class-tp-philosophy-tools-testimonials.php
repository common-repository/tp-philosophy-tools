<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Team Post Type
 *
 * @class       TP_Philosophy_Tools_Post_type
 * @since       1.0
 * @package     TP Philosophy Tools
 * @category    Testimonial
 * @author      Theme Palace
 */

class TP_Philosophy_Tools_Testimonial {

    public function __construct(){
        add_action( 'init', array( $this, 'tp_philosophy_tools_testimonial' ) );
    }

    public function tp_philosophy_tools_testimonial() {

        $testimonial_labels = array(
            'name'               => esc_html_x( 'Testimonials', 'post type general name', 'tp-philosophy-tools' ),
            'singular_name'      => esc_html_x( 'Testimonial', 'post type singular name', 'tp-philosophy-tools' ),
            'menu_name'          => esc_html_x( 'Testimonials', 'admin menu', 'tp-philosophy-tools' ),
            'name_admin_bar'     => esc_html_x( 'Testimonial', 'add new on admin bar', 'tp-philosophy-tools' ),
            'add_new'            => esc_html_x( 'Add New', 'Testimonial', 'tp-philosophy-tools' ),
            'add_new_item'       => esc_html__( 'Add New Testimonial', 'tp-philosophy-tools' ),
            'new_item'           => esc_html__( 'New Testimonial', 'tp-philosophy-tools' ),
            'edit_item'          => esc_html__( 'Edit Testimonial', 'tp-philosophy-tools' ),
            'view_item'          => esc_html__( 'View Testimonial', 'tp-philosophy-tools' ),
            'all_items'          => esc_html__( 'All Testimonials', 'tp-philosophy-tools' ),
            'search_items'       => esc_html__( 'Search Testimonials', 'tp-philosophy-tools' ),
            'parent_item_colon'  => esc_html__( 'Parent Testimonials:', 'tp-philosophy-tools' ),
            'not_found'          => esc_html__( 'No Testimonials Found.', 'tp-philosophy-tools' ),
            'not_found_in_trash' => esc_html__( 'No Testimonials Found in Trash.', 'tp-philosophy-tools' )
        );
        $testimonial_args = array(
            'labels'             => $testimonial_labels,
            'description'        => esc_html__( 'Description.', 'tp-philosophy-tools' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'tp-philosophy-testi', 'with_front' => false ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-format-quote',
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
        );
        register_post_type( 'tp-philosophy-testi', $testimonial_args );  
    }
    
}

new TP_Philosophy_Tools_Testimonial();