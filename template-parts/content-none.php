<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package SoaPatrick_Four
 */

?>

<header class="page-header padding-indent">
	<h1 class="title-large"><?php esc_html_e( 'Nothing Found', 'soapatrickfour' ); ?></h1>
</header>
<hr class="margin-extend">
<div class="page-content padding-indent">
	<?php if ( is_search() ) : ?>
		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'soapatrickfour' ); ?></p>
		<?php get_search_form(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'soapatrickfour' ); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</div>