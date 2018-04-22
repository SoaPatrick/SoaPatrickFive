<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package soapatrickfive
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post condensed' ); ?>>
	<div class="list-wrapper padding-indent">
		<div class="list-icon">
			<?php if (has_post_format('quote')) : ?>
				<i class="fal fa-quote-right"></i>	
			<?php elseif (has_post_format('link')) : ?>
				<i class="fal fa-link"></i>	
		    <?php else : ?>
				<?php if (has_post_thumbnail()) : ?>	
					<?php the_post_thumbnail( 'list-featured-image' ); ?>						
				<?php else : ?>		    
			    	<?php if (get_field( "font-awesome_icon" )) : ?>
					    <i class="<?php echo get_field( "font-awesome_icon" ) ?>"></i>
					<?php else : ?>
						<i class="fal fa-pencil"></i>	
					<?php endif; ?>
				<?php endif; ?>
			<? endif; ?>			
		</div>
		<div>
			<header class="blog-post-header">
				<?php the_title( '<h1 class="list-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>
			</header>
			<div class="blog-post-meta">
				<ul class="meta-wrapper fa-ul">
					<?php soapatrickfive_posted_on(); ?>
					<?php the_tags('<li><span class="fa-li"><i class="fal fa-tags fa-fw"></i></span>',', ','</li>'); ?>
					<?php edit_post_link('Edit', '<li><span class="fa-li"><i class="fal fa-pencil fa-fw"></i></span>','</li>'); ?>			
				</ul>
			</div>			
		</div>
	</div>
</article>