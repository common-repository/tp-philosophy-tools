<?php
/**
 * The template for displaying single pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TP Philosophy Tools
 * @since 1.0
 */

get_header(); ?>
	<div class="wrapper page-section">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();
				/**
				 * tp_philosophy_team_article_hook hook.
				 *
				 * @hooked tp_philosophy_team_article - 10
				 */
				do_action( 'tp_philosophy_team_article_hook' );

				the_post_navigation();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .wrapper/.page-section-->
<?php
get_footer();
