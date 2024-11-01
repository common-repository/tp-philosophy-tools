<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TP Philosophy Tools
 * @since 1.0
 */

function tp_philosophy_testimonial_article() {
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header blog-header">
			<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				// rating details
				tp_philosophy_testimonial_rating( get_the_ID() );
				
				// designation details
				tp_philosophy_testimonial_designation( get_the_ID() );
				
				// social links
				tp_philosophy_testimonial_social_links( get_the_ID() );
								
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'tp-philosophy-tools' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tp-philosophy-tools' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

	</article><!-- #post-## -->
<?php 
}
add_action( 'tp_philosophy_testimonial_article_hook', 'tp_philosophy_testimonial_article', 10 );
