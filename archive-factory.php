<?php
/**
Template Name: Archives Facrtory Items
 */

get_header(); ?>
    <div class="site-content">
	    <div class="container">
			<article>	    
				<nav class="breadcrumbs">
				    <span class="breadcrumbs--item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></span>						
				    <span class="breadcrumbs--item__last">Factory</span>
				</nav>					
				<header class="page-header padding-indent">
					<h1 class="title-large">Factory</h1>
				</header>
				<hr class="margin-extend">
				<div class="page-content page-content--factory">
					<?php						
					if ( have_posts() ) : 
						while ( have_posts() ) : the_post();	
							get_template_part( 'template-parts/content', 'factory' );
						endwhile; 
					endif; ?>
				</div>
			</article>
			<?php the_posts_pagination( ); ?> 
		</div>
	</div>

<?php
get_footer();