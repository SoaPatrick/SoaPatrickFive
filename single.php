<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package soapatrickfive
 */

get_header(); ?>
    <div class="site-content blog-post-single">
	    <div class="container">
			<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', get_post_type() );
					the_post_navigation();
				endwhile;
			?>
		</div>
	</div>

<?php
get_footer();
