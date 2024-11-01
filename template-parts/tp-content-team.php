<?php
/**
 * Team Content.
 *
 * @package TP Philosophy Tools
 * @since 1.0
 */

function tp_philosophy_tools_archive_team_content() {
	?>
	<div class="column-wrapper active">
  		<div class="featured-image">
  			<?php
	           if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) );
				} else {
					echo '<img src="' . TP_PHILOSOPHY_TOOLS_URL_PATH . '/assets/images/demo-300x200.jpg" alt="' . the_title_attribute( array( 'echo' => false ) ) . '">';
				}
			?>
            <div class="team-content">
            	<span><?php esc_html_e( 'Developer', 'tp-philosophy-tools' ); ?></span>
            	<span class="team-member-name"><?php the_title(); ?></a>
            </div><!-- .team-content -->
  		</div><!-- .featured-image -->
	</div><!-- .team-member -->
<?php
}
add_action( 'tp_philosophy_tools_archive_team_content_action', 'tp_philosophy_tools_archive_team_content', 10 );
