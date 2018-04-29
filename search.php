<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package SoaPatrick_Four
 */

get_header(); ?>
    <div class="site-content blog-post-list">
	    <div class="container">
			<?php if ( have_posts() ) : ?>					
				<header class="page-header padding-indent">
					<h1 class="title-large">Search: <?php echo get_search_query(); ?></h1>
				</header>
				<hr class="margin-extend">
				<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', 'list' );
					endwhile;
					the_posts_navigation(); 
				?>
			<?php else :
				get_template_part( 'template-parts/content', 'none' );
			endif; ?> 
		</div>
	</div>
<?php
get_footer();