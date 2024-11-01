<?php
/**
 * Testimonials Options Metabox
 *
 * @class       TP_Philosophy_Tools_Testimonial_Metabox
 * @since       1.0
 * @package     TP Philosophy Tools
 * @category    Testimonial
 * @author      Theme Palace
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class TP_Philosophy_Tools_Testimonial_Metabox {

    public function __construct(){
        add_action( 'add_meta_boxes', array( $this, 'tp_philosophy_tools_testimonial_options_meta') );
        add_action( 'save_post', array( $this, 'tp_philosophy_tools_testimonial_options_save' ) );
    }

    public function tp_philosophy_tools_testimonial_options_meta( $post_type ){
        /**
         * Add meta box
         */
        $post_types = array( 'tp-philosophy-testi' );
        if ( in_array( $post_type, $post_types ) ) :
            add_meta_box( 'tp-philosophy-testimonial-class-options', esc_html__( 'Testimonial Options', 'tp-philosophy-tools' ), array( $this, 'tp_philosophy_testimonial_options' ), $post_types, 'normal', 'high' );
        endif;
    }

    public function tp_philosophy_testimonial_options( $post ){
        /**
         * Outputs the content of the meta options
         */
        wp_nonce_field( 'tp_philosophy_testimonial_options_nonce', 'tp_philosophy_tools_options_nonce' );
        ?>

        <div id="tp-philosophy-tools-ui-tabs" class="ui-tabs">
            <ul class="tp-philosophy-tools-ui-tabs-nav" id="tp-philosophy-tools-ui-tabs-nav">
                <li><a href="#frag1"><?php esc_html_e( 'Rating', 'tp-philosophy-tools' ); ?></a></li>
                <li><a href="#frag2"><?php esc_html_e( 'Social links', 'tp-philosophy-tools' ); ?></a></li>
            </ul> 
                       
            <div id="frag1" class="catch_ad_tabhead">
                <table id="Testimonial-skills" class="form-table" width="100%">
                    <tbody>
                        <?php
                            $testimonial_designation = get_post_meta( $post->ID, 'tp_philosophy_testimonial_designation', true );
                            $testimonial_designation = ! empty( $testimonial_designation ) ? $testimonial_designation : '';
                            $testimonial_rating = get_post_meta( $post->ID, 'tp_philosophy_testimonial_rating', true );
                            $testimonial_rating = ! empty( $testimonial_rating ) ? $testimonial_rating : 2;
                        ?>
                        <tr>
                            <td colspan="2">
                                <label class="tp-label" for="tp_philosophy_testimonial_designation"><b><?php esc_html_e( 'Testimonial Designation', 'tp-philosophy-tools' ); ?>: </b></label>

                                    <input type="text" name="tp_philosophy_testimonial_designation" id="tp_philosophy_testimonial_designation_id" placeholder="<?php esc_attr_e( 'Celebrity', 'tp-philosophy-tools' ); ?>" value="<?php echo esc_attr( $testimonial_designation ); ?>" />
                                    <br>
                                    <span><?php esc_html_e( 'Input the position of the reviewer.', 'tp-philosophy-tools' ); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label class="tp-label" for="tp_philosophy_testimonial_rating"><b><?php esc_html_e( 'Testimonial Rating', 'tp-philosophy-tools' ); ?>: </b></label>

                                    <input type="number" min="1" max="5" name="tp_philosophy_testimonial_rating" id="tp_philosophy_testimonial_rating_id" value="<?php echo absint( $testimonial_rating ); ?>" />
                                    <br>
                                    <span><?php esc_html_e( 'Out of 5.', 'tp-philosophy-tools' ); ?></span>
                            </td>
                        </tr>
                            
                       
                    </tbody>
                </table>        
            </div>

            <div id="frag2" class="catch_ad_tabhead">
                <table id="Testimonial-social" class="form-table" width="100%">
                    <tbody>
                    <?php
                        $social_links_count = get_post_meta( $post->ID, 'tp_philosophy_testimonial_social_link_count_value', true );
                        $social_links_count = ! empty( $social_links_count ) ? $social_links_count : 3;
                    ?>
                        <tr>
                            <td>
                                <label class="tp-label" for="tp_philosophy_testimonial_social_link_count_value"><b><?php esc_html_e( 'Number of social links', 'tp-philosophy-tools' ); ?>: </b></label>

                                <input type="number" name="tp_philosophy_testimonial_social_link_count_value" id="tp_philosophy_testimonial_social_link_count_value" min="1" max="50" placeholder="<?php esc_attr_e( '3', 'tp-philosophy-tools' ); ?>" value="<?php echo esc_attr( $social_links_count ); ?>" />&nbsp;
                                <br>
                                <small><i><?php esc_html_e( 'NOTE: Input number and publish/update the post to view change.', 'tp-philosophy-tools' ); ?></i></small>
                            </td>
                        </tr>
                        <?php 
                            for( $i=1; $i<= $social_links_count; $i++ ){ 
                                $social_link = get_post_meta( $post->ID, 'tp_philosophy_testimonial_social_link_'. $i , true );
                                $social_link = ! empty( $social_link ) ? $social_link : '';
                                ?>  
                                <tr>
                                    <td>
                                        <label class="tp-label" for="tp_philosophy_testimonial_social_link_<?php echo $i; ?>"><b><?php printf( esc_html__( 'Social Link #%s', 'tp-philosophy-tools' ), $i ); ?>: </b></label>
                                    
                                        <input type="url" name="tp_philosophy_testimonial_social_link_<?php echo $i; ?>" id="tp_philosophy_testimonial_social_link_<?php echo $i; ?>" placeholder="<?php esc_attr_e( 'http://www.facebook.com/', 'tp-philosophy-tools' ); ?>" value="<?php echo esc_url( $social_link ); ?>" />
                                    </td>
                                </tr>
                            <?php 
                            } 
                        ?>
                            
                    </tbody>
                </table>
            </div>
        </div>

        <?php    
    }


    public function tp_philosophy_tools_testimonial_options_save( $post_id ){
        /**
         * Saves the mata input value
         */

        // Bail if we're doing an auto save
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
         
        // if our nonce isn't there, or we can't verify it, bail
        if( !isset( $_POST['tp_philosophy_tools_options_nonce'] ) || !wp_verify_nonce( $_POST['tp_philosophy_tools_options_nonce'], 'tp_philosophy_testimonial_options_nonce' ) ) return;
         
        // if our current user can't edit this post, bail
        if( !current_user_can( 'edit_post' ) ) return;


        // Get social links count value
        $social_count = get_post_meta( $post_id, 'tp_philosophy_testimonial_social_link_count_value', true );
        $social_count = ! empty( $social_count ) ? $social_count : 3;  

         // Make sure your data is set before trying to save it
        if( isset( $_POST['tp_philosophy_testimonial_designation'] ) ) :
            $value = isset( $_POST['tp_philosophy_testimonial_designation'] ) ? $_POST['tp_philosophy_testimonial_designation'] : '';
            update_post_meta( $post_id, 'tp_philosophy_testimonial_designation', sanitize_text_field( $value ) );   
        endif;

        // Make sure your data is set before trying to save it
        if( isset( $_POST['tp_philosophy_testimonial_rating'] ) ) :
            $value = isset( $_POST['tp_philosophy_testimonial_rating'] ) ? $_POST['tp_philosophy_testimonial_rating'] : '';
            update_post_meta( $post_id, 'tp_philosophy_testimonial_rating', absint( $value ) );   
        endif;

        // Make sure your data is set before trying to save it
        if( isset( $_POST['tp_philosophy_testimonial_social_link_count_value'] ) ) :
            $value = isset( $_POST['tp_philosophy_testimonial_social_link_count_value'] ) ? $_POST['tp_philosophy_testimonial_social_link_count_value'] : 3;
            update_post_meta( $post_id, 'tp_philosophy_testimonial_social_link_count_value', absint( $value ) );   
        endif;

        for ( $i=1; $i <= $social_count; $i++ ) { 
           // Update social links
            if( isset( $_POST['tp_philosophy_testimonial_social_link_'. $i ] ) ){
                $value = isset( $_POST['tp_philosophy_testimonial_social_link_'.$i ] ) ? $_POST['tp_philosophy_testimonial_social_link_'.$i ] : '';
                update_post_meta( $post_id, 'tp_philosophy_testimonial_social_link_'. $i, esc_url_raw( $value ) );
            }
        }
    }
}

new TP_Philosophy_Tools_Testimonial_Metabox();
