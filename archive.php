<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package SoaPatrick_Four
 */

get_header(); ?>
    <div class="site-content">
	    <div class="container">		
			<?php			
			$args = array(
				'post_type' => 'factory',
				'posts_per_page' => 20,
				'paged' => $paged, 
			);			       
			$wp_query   = new WP_Query( $args );		        
			if ( have_posts() ) : ?>
				<header class="page-header padding-indent">
					<h1 class="title-large"><a href="<?php echo esc_url( home_url( '/' ) ); ?>/storage/">Storage:</a> <span class="no-wrap"><?php the_archive_title();?></span></h1>
				</header>
				<hr class="margin-extend">
				<?php 
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', 'list' );
					endwhile;
					the_posts_navigation();	
				?>
			<?php endif; ?>			
		</div>
	</div>
<?php
get_footer();