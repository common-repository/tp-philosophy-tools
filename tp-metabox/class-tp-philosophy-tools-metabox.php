<?php
/**
 * Teams Options Metabox
 *
 * @class       TP_Philosophy_Tools_Teams_Metabox
 * @since       1.0
 * @package     TP Philosophy Tools
 * @category    Teams
 * @author      Theme Palace
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class TP_Philosophy_Tools_Teams_Metabox {

    public function __construct(){
        add_action( 'add_meta_boxes', array( $this, 'tp_philosophy_tools_teams_options_meta') );
        add_action( 'save_post', array( $this, 'tp_philosophy_tools_teams_options_save' ) );
    }

    public function tp_philosophy_tools_teams_options_meta( $post_type ){
        /**
         * Add meta box
         */
        $post_types = array( 'tp-philosophy-teams' );
        if ( in_array( $post_type, $post_types ) ) :
            add_meta_box( 'tp-philosophy-teams-class-options', esc_html__( 'Team Options', 'tp-philosophy-tools' ), array( $this, 'tp_philosophy_teams_options' ), $post_types, 'normal', 'high' );
        endif;
    }

    public function tp_philosophy_teams_options( $post ){
        /**
         * Outputs the content of the meta options
         */
        wp_nonce_field( 'tp_philosophy_teams_options_nonce', 'tp_philosophy_tools_options_nonce' );
        ?>

        <div id="tp-philosophy-tools-ui-tabs" class="ui-tabs">
            <ul class="tp-philosophy-tools-ui-tabs-nav" id="tp-philosophy-tools-ui-tabs-nav">
                <li><a href="#frag1"><?php esc_html_e( 'Designation', 'tp-philosophy-tools' ); ?></a></li>
                <li><a href="#frag2"><?php esc_html_e( 'Skills Details', 'tp-philosophy-tools' ); ?></a></li>
                <li><a href="#frag3"><?php esc_html_e( 'Social links', 'tp-philosophy-tools' ); ?></a></li>
            </ul> 
            <div id="frag1" class="catch_ad_tabhead">
                <table id="team-designation" class="form-table" width="100%">
                    <tbody>
                        <tr>
                        <?php 
                            $team_designation = get_post_meta( $post->ID, 'tp_philosophy_team_designation_value', true );
                            $team_designation = ! empty( $team_designation ) ? $team_designation : '';
                        ?>
                            <label class="tp-label" for="tp_philosophy_team_designation_value"><b><?php esc_html_e( 'Position', 'tp-philosophy-tools' ); ?>: </b></label><br>
                            <input type="text" name="tp_philosophy_team_designation_value" id="tp_philosophy_team_designation_id" placeholder="<?php esc_attr_e( 'Developer', 'tp-philosophy-tools' ); ?>" value="<?php echo esc_attr( $team_designation ); ?>" />
                        </tr>
                    </tbody>
                </table>
            </div>
           
            <div id="frag2" class="catch_ad_tabhead">
                <table id="team-skills" class="form-table" width="100%">
                    <tbody>
                        <?php
                            $team_skills_count = get_post_meta( $post->ID, 'tp_philosophy_team_skills_count_value', true );
                            $team_skills_count = ! empty( $team_skills_count ) ? $team_skills_count : 3;
                        ?>
                        <tr>
                            <td colspan="2">
                                <label class="tp-label" for="tp_philosophy_team_skills_count_value"><b><?php esc_html_e( 'Number of Skills', 'tp-philosophy-tools' ); ?>: </b></label>

                                <input type="number" name="tp_philosophy_team_skills_count_value" id="tp_philosophy_team_skills_count_value" min="1" max="10" placeholder="<?php esc_attr_e( '3', 'tp-philosophy-tools' ); ?>" value="<?php echo absint( $team_skills_count ); ?>" />&nbsp;

                                <small><i><?php esc_html_e( 'NOTE: Input number and publish/update the post to view change.', 'tp-philosophy-tools' ); ?></i></small>
                            </td>
                        </tr>
                            
                       
                        <?php 
                            for( $i=1; $i<= $team_skills_count; $i++ ){ 
                                $skills_title = get_post_meta( $post->ID, 'tp_philosophy_team_skills_title_'. $i, true );
                                $skills_title = ! empty( $skills_title ) ? $skills_title : '';

                                $team_rating = get_post_meta( $post->ID, 'tp_philosophy_team_skills_rating_'. $i, true );
                                $team_rating = ! empty( $team_rating ) ? $team_rating : 3;
                        ?>
                            <tr>
                                <td>
                                    <label class="tp-label" for="tp_philosophy_team_skills_title_<?php echo $i; ?>"><b><?php printf( esc_html__( 'Skill #%s', 'tp-philosophy-tools' ), $i ); ?>: </b></label>
                                
                                    <input type="text" name="tp_philosophy_team_skills_title_<?php echo $i; ?>" id="tp_philosophy_team_skills_title_<?php echo $i; ?>" placeholder="<?php esc_attr_e( 'Developer', 'tp-philosophy-tools' ); ?>" value="<?php echo esc_attr( $skills_title ); ?>" />
                                </td>
                                    
                                <td>
                                    <label class="tp-label" for="tp_philosophy_team_skills_rating_<?php echo $i; ?>"><b><?php printf( esc_html__( 'Rating #%s', 'tp-philosophy-tools' ), $i ); ?>: </b></label>

                                    <input type="number" min="1" max="10" name="tp_philosophy_team_skills_rating_<?php echo  $i; ?>" id="tp_philosophy_team_skills_rating_<?php echo  $i; ?>" value="<?php echo esc_attr( $team_rating ); ?>" />
                                    <span><?php esc_html_e( 'Out of 10.', 'tp-philosophy-tools' ); ?></span>
                                </td>
                            </tr>
                        <?php 
                            } 
                        ?>

                    </tbody>
                </table>        
            </div>

            <div id="frag3" class="catch_ad_tabhead">
                <table id="team-social" class="form-table" width="100%">
                    <tbody>
                    <?php
                        $social_links_count = get_post_meta( $post->ID, 'tp_philosophy_team_social_link_count_value', true );
                        $social_links_count = ! empty( $social_links_count ) ? $social_links_count : 3;
                    ?>
                        <tr>
                            <td>
                                <label class="tp-label" for="tp_philosophy_team_social_link_count_value"><b><?php esc_html_e( 'Number of social links', 'tp-philosophy-tools' ); ?>: </b></label>

                                <input type="number" name="tp_philosophy_team_social_link_count_value" id="tp_philosophy_team_social_link_count_value" min="1" max="50" placeholder="<?php esc_attr_e( '3', 'tp-philosophy-tools' ); ?>" value="<?php echo esc_attr( $social_links_count ); ?>" />&nbsp;

                                <small><i><?php esc_html_e( 'NOTE: Input number and publish/update the post to view change.', 'tp-philosophy-tools' ); ?></i></small>
                            </td>
                        </tr>
                        <?php 
                            for( $i=1; $i<= $social_links_count; $i++ ){ 
                                $social_link = get_post_meta( $post->ID, 'tp_philosophy_team_social_link_'. $i, true );
                                $social_link = ! empty( $social_link ) ? $social_link : '';
                        ?>  
                        <tr>
                            <td>
                                <label class="tp-label" for="tp_philosophy_team_social_link_<?php echo $i; ?>"><b><?php printf( esc_html__( 'Social Link #%s', 'tp-philosophy-tools' ), $i ); ?>: </b></label>
                            
                                <input type="url" name="tp_philosophy_team_social_link_<?php echo $i; ?>" id="tp_philosophy_team_social_link_<?php echo $i; ?>" placeholder="<?php echo esc_url( 'http://www.facebook.com/', 'tp-philosophy-tools' ); ?>" value="<?php echo esc_url( $social_link ); ?>" />
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


    public function tp_philosophy_tools_teams_options_save( $post_id ){
        /**
         * Saves the mata input value
         */

        // Bail if we're doing an auto save
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
         
        // if our nonce isn't there, or we can't verify it, bail
        if( !isset( $_POST['tp_philosophy_tools_options_nonce'] ) || !wp_verify_nonce( $_POST['tp_philosophy_tools_options_nonce'], 'tp_philosophy_teams_options_nonce' ) ) return;
         
        // if our current user can't edit this post, bail
        if( !current_user_can( 'edit_post' ) ) return;

        // Get skills count value
        $skills_count = get_post_meta( $post_id, 'tp_philosophy_team_skills_count_value', true );
        $skills_count = ! empty( $skills_count ) ? $skills_count : 3;

        // Get social links count value
        $social_count = get_post_meta( $post_id, 'tp_philosophy_team_social_link_count_value', true );
        $social_count = ! empty( $social_count ) ? $social_count : 3;
         
        // Make sure your data is set before trying to save it
        if( isset( $_POST['tp_philosophy_team_designation_value'] ) ) :
            $value = isset($_POST['tp_philosophy_team_designation_value']) ? $_POST['tp_philosophy_team_designation_value'] : '';
            update_post_meta( $post_id, 'tp_philosophy_team_designation_value', sanitize_text_field( $value ) );   
        endif;   

        // Make sure your data is set before trying to save it
        if( isset( $_POST['tp_philosophy_team_skills_count_value'] ) ) :
            $skills_count = isset( $_POST['tp_philosophy_team_skills_count_value'] ) ? $_POST['tp_philosophy_team_skills_count_value'] : 3;
            update_post_meta( $post_id, 'tp_philosophy_team_skills_count_value', absint( $skills_count ) );   
        endif;

        for( $i=1; $i<=$skills_count; $i++ ){
            // Update team skills title
            if( isset( $_POST['tp_philosophy_team_skills_title_'. $i ] ) ){
                $skills_title = isset($_POST['tp_philosophy_team_skills_title_'. $i ]) ? $_POST['tp_philosophy_team_skills_title_'. $i ] : '';
                update_post_meta( $post_id, 'tp_philosophy_team_skills_title_'. $i , sanitize_text_field( $skills_title ) );
            }
            
            // Update team skills rating
            if( isset( $_POST['tp_philosophy_team_skills_rating_'. $i ] ) ){
                $team_rating = isset( $_POST['tp_philosophy_team_skills_rating_'. $i ] ) ? $_POST['tp_philosophy_team_skills_rating_'. $i ] : 3;
                update_post_meta( $post_id, 'tp_philosophy_team_skills_rating_'. $i , absint( $team_rating ) );
            }
           
        }

        // Make sure your data is set before trying to save it
        if( isset( $_POST['tp_philosophy_team_social_link_count_value'] ) ) :
            $social_count = isset( $_POST['tp_philosophy_team_social_link_count_value'] ) ? $_POST['tp_philosophy_team_social_link_count_value'] : 3;
            update_post_meta( $post_id, 'tp_philosophy_team_social_link_count_value', absint( $social_count ) );   
        endif;

        for ( $i=1; $i <= $social_count; $i++ ) { 
           // Update social links
            if( isset( $_POST['tp_philosophy_team_social_link_'. $i ] ) ){
                $social_link = isset( $_POST['tp_philosophy_team_social_link_'. $i ] ) ? $_POST['tp_philosophy_team_social_link_'. $i ] : '';
                update_post_meta( $post_id, 'tp_philosophy_team_social_link_'. $i , esc_url_raw( $social_link ) );
            }
        }
    }
}

new TP_Philosophy_Tools_Teams_Metabox();
