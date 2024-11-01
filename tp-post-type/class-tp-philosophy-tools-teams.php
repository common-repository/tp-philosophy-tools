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
 * @category    Team
 * @author      Theme Palace
 */

class TP_Philosophy_Tools_Post_type {

    public function __construct(){
        add_action( 'init', array( $this, 'tp_philosophy_tools_post_type' ) );
    }

    public function tp_philosophy_tools_post_type() {

        $teams_labels = array(
            'name'               => esc_html_x( 'Teams', 'post type general name', 'tp-philosophy-tools' ),
            'singular_name'      => esc_html_x( 'Team', 'post type singular name', 'tp-philosophy-tools' ),
            'menu_name'          => esc_html_x( 'Teams', 'admin menu', 'tp-philosophy-tools' ),
            'name_admin_bar'     => esc_html_x( 'Team', 'add new on admin bar', 'tp-philosophy-tools' ),
            'add_new'            => esc_html_x( 'Add New', 'Team', 'tp-philosophy-tools' ),
            'add_new_item'       => esc_html__( 'Add New Team', 'tp-philosophy-tools' ),
            'new_item'           => esc_html__( 'New Team', 'tp-philosophy-tools' ),
            'edit_item'          => esc_html__( 'Edit Team', 'tp-philosophy-tools' ),
            'view_item'          => esc_html__( 'View Team', 'tp-philosophy-tools' ),
            'all_items'          => esc_html__( 'All Teams', 'tp-philosophy-tools' ),
            'search_items'       => esc_html__( 'Search Teams', 'tp-philosophy-tools' ),
            'parent_item_colon'  => esc_html__( 'Parent Teams:', 'tp-philosophy-tools' ),
            'not_found'          => esc_html__( 'No Teams Found.', 'tp-philosophy-tools' ),
            'not_found_in_trash' => esc_html__( 'No Teams Found in Trash.', 'tp-philosophy-tools' )
        );
        $teams_args = array(
            'labels'             => $teams_labels,
            'description'        => esc_html__( 'Description.', 'tp-philosophy-tools' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'tp-philosophy-teams', 'with_front' => false ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-groups',
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
        );
        register_post_type( 'tp-philosophy-teams', $teams_args );

        // Add new taxonomy for Teams
        $teams_cat_labels = array(
            'name'              => esc_html_x( 'Team Categories', 'taxonomy general name', 'tp-philosophy-tools' ),
            'singular_name'     => esc_html_x( 'Team Category', 'taxonomy singular name', 'tp-philosophy-tools' ),
            'search_items'      => esc_html__( 'Search Team Categories', 'tp-philosophy-tools' ),
            'all_items'         => esc_html__( 'All Team Categories', 'tp-philosophy-tools' ),
            'parent_item'       => esc_html__( 'Parent Team Category', 'tp-philosophy-tools' ),
            'parent_item_colon' => esc_html__( 'Parent Team Category:', 'tp-philosophy-tools' ),
            'edit_item'         => esc_html__( 'Edit Team Category', 'tp-philosophy-tools' ),
            'update_item'       => esc_html__( 'Update Team Category', 'tp-philosophy-tools' ),
            'add_new_item'      => esc_html__( 'Add New Team Category', 'tp-philosophy-tools' ),
            'new_item_name'     => esc_html__( 'New Team Category Name', 'tp-philosophy-tools' ),
            'menu_name'         => esc_html__( 'Team Category', 'tp-philosophy-tools' ),
        );

        $teams_cat_args = array(
            'hierarchical'      => true,
            'labels'            => $teams_cat_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'tp-philosophy-teams-category' ),
        );

        register_taxonomy( 'tp-philosophy-teams-category', array( 'tp-philosophy-teams' ), $teams_cat_args );
  
    }
    
}

new TP_Philosophy_Tools_Post_type();