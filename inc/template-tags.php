<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package soapatrickfive
 */

if ( ! function_exists( 'soapatrickfive_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function soapatrickfive_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		$posted_on = sprintf(
			esc_html_x( '%s', 'post date', 'soapatrickfive' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
		
		echo '<li><span class="fa-li"><i class="fal fa-calendar fa-fw"></i></span>' . $posted_on . '</li>';

	}
endif;
