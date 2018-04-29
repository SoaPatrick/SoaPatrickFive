<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package soapatrickthree
 */

get_header(); ?>
    <div class="site-content">
	    <div class="container">
			<?php if ( have_posts() ) : ?>
				<nav class="breadcrumbs">
				    <span class="breadcrumbs--item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></span>						
				    <span class="breadcrumbs--item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>/tags/">Tags</a></span>
				    <span class="breadcrumbs--item__last"><?php the_archive_title();?></span>
				</nav>					
				<header class="page-header padding-indent">
					<h1 class="title-large"><?php the_archive_title();?></h1>
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