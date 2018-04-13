<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package soapatrickfive
 */

get_header(); ?>

    <div class="site-content error-page">
	    <div class="container">
			<div class="content-wrapper">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'This is not the Page you were looking for!', 'soapatrickfive' ); ?></h1>
				</header>
	
				<hr>
				
				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'soapatrickfive' ); ?></p>
	
					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
	
				</div>				
			</div>
		</div>
	</div>

<?php
get_footer();
