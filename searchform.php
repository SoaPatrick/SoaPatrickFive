<form class="search-form" action="<?php echo home_url( '/' ); ?>" method="get">
	<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Find stuff..." />
</form>