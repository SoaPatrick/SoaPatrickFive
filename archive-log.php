<?php
/**
Template Name: Archives Change Logs
 */

get_header(); ?>

    <div class="site-content changelog">
	    <div class="container">
			<div class="content-wrapper">		    
				<header class="page-header">
					<h1 class="page-title">Change Log</h1>
				</header>
				<hr>
				<div class="page-content">		    
		    
					<?php
					$args = array(
						'post_type' => 'log',
						'posts_per_page' => 20,
						'paged' => $paged, 
					);	
			
					$wp_query   = new WP_Query( $args );	
					
					if ( have_posts() ) : ?>					
						<?php
						$day_check = '';
						while (have_posts()) : the_post();
							$day = get_the_date('j');
							if ($day != $day_check) {
								if ($day_check != '') {
									echo '</ul>'; // close the list here
								}
								echo '<h2>' . get_the_date() . '</h2><ul class="fa-ul">';
							}
							$field = get_field_object('changelog_type');
							$value = $field['value'];
							$label = $field['choices'][ $value ];							
							?>
							<li><span class="fa-li"><i class="<?php echo $value ?>"></i></span><strong><?php echo $label ?></strong> <?php the_title(); ?></li>
							<?php
							$day_check = $day;
							endwhile; ?>
						
						<?php the_posts_navigation();			
							
					else :
						get_template_part( 'template-parts/content', 'none' );
					endif; ?>
				</div>
			</div>
		</div>
	</div>

<?php
get_footer();