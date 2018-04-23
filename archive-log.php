<?php
/**
Template Name: Archives Change Logs
 */

get_header(); ?>
    <div class="site-content">
	    <div class="container">
			<article>	    
				<header class="page-header padding-indent">
					<h1 class="title-large">Change Log</h1>
				</header>
				<hr class="margin-extend">
				<div class="page-content page-content--changelog padding-indent">
					<?php
					$args = array(
						'post_type' => 'log',
						'posts_per_page' => 20,
						'paged' => $paged, 
					);	
			
					$wp_query   = new WP_Query( $args );	
					
					if ( have_posts() ) :					
						$day_check = '';
						while (have_posts()) : the_post();
							$day = get_the_date('j');
							if ($day != $day_check) {
								if ($day_check != '') {
									echo '</ul>';
								}
								echo '<h2>' . get_the_date() . '</h2><ul class="fa-ul changes">';
							}
							$field = get_field_object('changelog_type');
							$value = $field['value'];
							$label = $field['choices'][ $value ];?>
							<li><span class="fa-li"><i class="<?php echo $value ?>"></i></span><strong><?php echo $label ?></strong> <?php the_title(); ?></li>
							<?php $day_check = $day;
						endwhile;		
					endif; ?>
				</div>
			</article>
			<?php the_posts_pagination( ); ?> 
		</div>
	</div>
<?php
get_footer();