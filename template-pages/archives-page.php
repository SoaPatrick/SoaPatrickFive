<?php
/*
Template Name: Archives Page
*/

get_header(); ?>

    <div class="site-content">
	    <div class="container">
			<article>		    
				<header class="page-header padding-inden">		
					<h1 class="title-large">Storage</h1>
				</header>
				<hr class="margin-extend">
				<div class="page-content page-content--month-archive padding-indent">			
					<?php while ( have_posts() ) : the_post(); ?>
		
					<?php
					    $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date)
					    FROM $wpdb->posts WHERE post_status = 'publish'
					    AND post_type = 'post' ORDER BY post_date DESC");
					 
					    foreach($years as $year): ?>
					    	<div class="month-archive">
						        <h2><?php echo $year; ?></h2>
						        <ul class="month-archive--list list-style-none">
							        <?php
							            $months = $wpdb->get_col("SELECT DISTINCT MONTH(post_date)
							            FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post'
							            AND YEAR(post_date) = '".$year."' ORDER BY post_date DESC");
							 
							            foreach($months as $month): ?>
									        <li><a href="<?php echo get_month_link($year, $month); ?>">
									            <?php echo date('F', mktime(0, 0, 0, $month));?></a>
									        </li>
										<?php endforeach;?>
						        </ul>
					    	</div>
						<?php endforeach; ?>
		
					<?php endwhile; // End of the loop. ?>
				</div>				
			</article>
		</div>
		
	</div>

<?php
get_footer();