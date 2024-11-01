<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TP Philosophy Tools
 * @since 1.0
 */

get_header(); ?>
<div id="content" class="site-content background-image-properties">
		<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) : ?>
			<section id="teams" class="page-section pop-up">
		        <div class="wrapper">
		         	<header class="entry-header add-gray-border border-small border-center">
		            	<h2 class="entry-title color-white"><?php echo esc_html__( 'Testimonials', 'tp-philosophy-tools' ); ?></h2>
		         	</header><!-- entry-header -->

		          	<div class="entry-content col-4">
		            	<?php
		            		/**
		            		 * Hook - tp_philosophy_tools_archive_testimonial_content_action.
							 *
							 * @hooked tp_philosophy_tools_archive_testimonial_content -  10
							 */
		            		do_action( 'tp_philosophy_tools_archive_testimonial_content_action' );
		            	?>
		          	</div><!--.entry-content-->
		        </div><!--. wrapper -->
		    </section><!-- #team -->
		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; 
		?>

		</main><!-- #main -->

	<?php get_sidebar(); ?>
</div><!--end .site-content-->
<?php
get_footer();
