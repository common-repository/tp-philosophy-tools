<?php
/**
 * Functions & Hooks
 *
 * @since       1.0
 * @package     TP Philosophy Tools
 * @category    Teams
 * @author      Theme Palace
 */

// Hooks
add_action( 'tp_philosophy_tools_team_designation_action', 'tp_philosophy_tools_team_designation', 10 );
add_action( 'tp_philosophy_tools_team_skills_details_action', 'tp_philosophy_tools_team_skills_details', 10 );
add_action( 'tp_philosophy_tools_team_social_links_action', 'tp_philosophy_tools_team_social_links', 10 );

add_action( 'tp_philosophy_tools_testimonial_rating_action', 'tp_philosophy_testimonial_rating', 10 );
add_action( 'tp_philosophy_tools_testimonial_designation_action', 'tp_philosophy_testimonial_designation', 10 );
add_action( 'tp_philosophy_tools_testimonial_social_links_action', 'tp_philosophy_testimonial_social_links', 10 );

if ( ! function_exists( 'tp_philosophy_tools_team_designation' ) ) :
	function tp_philosophy_tools_team_designation( $post_id = '' ) {
		/*
		 * Output team designation
		 */
		if ( empty( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
		}
		$tp_philosophy_team_designation = get_post_meta( $post_id, 'tp_philosophy_team_designation_value', true );
        $tp_philosophy_team_designation = !empty( $tp_philosophy_team_designation ) ? $tp_philosophy_team_designation : '';
        echo esc_html( $tp_philosophy_team_designation );

	}
endif;

if ( ! function_exists( 'tp_philosophy_tools_team_skills_details' ) ) :
	function tp_philosophy_tools_team_skills_details( $post_id = '' ) {
		/*
		 * Output team skill details
		 */
		if ( empty( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
		}

		$number_of_skills = get_post_meta( $post_id, 'tp_philosophy_team_skills_count_value', true );
		$number_of_skills = ! empty( $number_of_skills ) ? $number_of_skills : 3;

		echo '<ul>';
		for ( $i=1; $i <= $number_of_skills; $i++ ) { 
			// Get skills title
			$skills_title = get_post_meta( $post_id, 'tp_philosophy_team_skills_title_'. $i, true );
			$skills_title = !empty( $skills_title ) ? $skills_title : '';

			// Get skills rating
			$skills_rating = get_post_meta( $post_id, 'tp_philosophy_team_skills_rating_'. $i, true );
			$skills_rating = !empty( $skills_rating ) ? $skills_rating : 3;
		?>
			<?php if ( ! empty( $skills_title ) ) : ?>
            	<li>
	            	<span><?php echo esc_html( $skills_title ); ?></span>
	                <small>
	               		<?php 
	               			for( $a=1; $a<=10; $a++ ){
	               				$dot_class = ( $a<= $skills_rating ) ? 'dot fill' : 'dot';
	                    		echo '<span class="'. esc_attr( $dot_class ) .'"></span>';
	               			} ?>
	                </small>
            	</li>
        	<?php endif; ?>
        <?php
		}
		echo '</ul>';
	}
endif;

if ( ! function_exists( 'tp_philosophy_tools_team_social_links' ) ) :
	function tp_philosophy_tools_team_social_links( $post_id = '' ) {
		/*
		 * Output team social links
		 */
		if ( empty( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
		}
		// Get no of social links
		$number_of_social_links = get_post_meta( $post_id, 'tp_philosophy_team_social_link_count_value', true );
		$number_of_social_links = ! empty( $number_of_social_links ) ? $number_of_social_links : 1;

		echo '<ul class="social-icons">';
		for ( $i=1; $i <= $number_of_social_links; $i++ ) { 
			// Get  social profile link
			$social_link = get_post_meta( $post_id, 'tp_philosophy_team_social_link_'. $i, true );
			$social_link = !empty( $social_link ) ? $social_link : '';

			if( !empty( $social_link ) ){
				echo '<li><a href="'. esc_url( $social_link ) .'"></a></li>';
			}
		}
		echo '</ul>';
	}
endif;


/*
 * Testimonial Details
 */

if( ! function_exists( 'tp_philosophy_testimonial_rating' ) ):
	// Testimonial ratings
	function tp_philosophy_testimonial_rating( $post_id = '' ) {
		if ( empty( $post_id ) ) {
			GLOBAL $post;
			$post_id = $post->ID;
		}
		
		$tp_testimonail_rating = get_post_meta( $post_id, 'tp_philosophy_testimonial_rating', true );
		echo '<div class="star-rating">';
		for( $i=1; $i <= 5; $i++ ){
			if( $i <= $tp_testimonail_rating ) {
				$rating_class = 'fa-star';
			} else {
				$rating_class = 'fa-star-o';
			}
			echo '<i class="fa '. esc_attr( $rating_class ). '"></i>';
		}
		echo '</div>';
	}
endif;

if( ! function_exists( 'tp_philosophy_testimonial_designation' ) ):
	// Testimonial Designation
	function tp_philosophy_testimonial_designation( $post_id = '' ) {
		if ( empty( $post_id ) ) {
			GLOBAL $post;
			$post_id = $post->ID;
		}
		$tp_testimonial_designation = get_post_meta( $post_id, 'tp_philosophy_testimonial_designation', true );
		if ( ! empty( $tp_testimonial_designation ) ) {
			echo esc_html( $tp_testimonial_designation );
		}
	}
endif;

if ( ! function_exists( 'tp_philosophy_testimonial_social_links' ) ) :
	function tp_philosophy_testimonial_social_links( $post_id = '' ) {
		/*
		 * Output testimonial social links
		 */
		if ( empty( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
		}
		// Get no of social links
		$number_of_social_links = get_post_meta( $post_id, 'tp_philosophy_testimonial_social_link_count_value', true );
		$number_of_social_links = ! empty( $number_of_social_links ) ? $number_of_social_links : 3;

		echo '<ul class="social-icons">';
		for ( $i=1; $i <= $number_of_social_links; $i++ ) { 
			// Get  social profile link
			$social_link = get_post_meta( $post_id, 'tp_philosophy_testimonial_social_link_'. $i, true );
			$social_link = !empty( $social_link ) ? $social_link : '';

			if( !empty( $social_link ) ){
				echo '<li><a href="'. esc_url( $social_link ) .'"></a></li>';
			}
		}
		echo '</ul>';
	}
endif;