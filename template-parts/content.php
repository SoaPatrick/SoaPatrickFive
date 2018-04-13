<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package soapatrickfive
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post' ); ?>>
	<header class="blog-post-header">
		<?php if (has_post_format('quote')) :
	    	the_title( '<h1 class="blog-post-quote">', '</h1>' ); ?>
			<p class="quote-author">
				<?php echo get_post_meta($post->ID, '_format_quote_source_name', true); ?>
			</p>						
		<?php elseif (has_post_format('link')) :
			the_title( '<h1 class="blog-post-link">', '</h1>' );
			$link_url = get_post_meta($post->ID, '_format_link_url', true);
			echo '<p><a href="'.$link_url.'" class="link" target="_blank">' .$link_url. '</a></p>';
		elseif (has_post_format('status')): ?>
	        <div class="blog-post-status">
		    	<?php if (get_field( "font-awesome_icon" )) : ?>
				    <i class="<?php echo get_field( "font-awesome_icon" ) ?>"></i>
				<?php else : ?>
					<i class="fal fa-bullhorn"></i>		
				<?php endif; ?>				        
		        <?php the_content(); ?>
		    </div>
	    <?php else :
			the_title( '<h1 class="blog-post-title">', '</h1>' );
		endif; ?>				
	</header>		
	<div class="featured-image">
		<?php 
			if (has_post_format('video')) :
				echo get_post_meta($post->ID, '_format_video_embed', true);
			elseif (has_post_thumbnail()) :							
				the_post_thumbnail( );
			else :
				?><hr class="title-line"><?php
			endif;
		?>				
	</div>	
	<div class="blog-post-meta">
		<div class="meta-wrapper">
			<?php soapatrickfive_posted_on(); ?>
			<?php the_tags('<span class="tags"><i class="fal fa-tags fa-fw"></i>',', ','</span>'); ?>
			<?php edit_post_link('Edit', '<span class="edit"><i class="fal fa-pencil fa-fw"></i>','</span>'); ?>			
		</div>
	</div>			
	<?php if (!has_post_format('quote') && !has_post_format('link') && !has_post_format('status')) : ?>
		<div class="blog-post-content">
			<?php the_content('<strong>Continue Reading...</strong>'); ?>
		</div>
	<?php endif; ?>

</article>
