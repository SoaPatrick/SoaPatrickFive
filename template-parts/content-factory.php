<?php
/**
 * Template part for displaying Factory Items.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package soapatrickfive
 */

?>

<article id="post-<?php the_ID(); ?>">
	<?php if( has_post_thumbnail() ) :
		the_post_thumbnail( 'full-width' );				
	endif; ?>				
</article>