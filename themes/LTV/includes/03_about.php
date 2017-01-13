<div class="main_content" data-slug="about">
	<?php 
		$about_query = new WP_Query( "name=about" );
		if ( $about_query->have_posts() ) :
		    while ( $about_query->have_posts() ) : $about_query->the_post(); ?>
		        <!-- IMAGE -->
	        	<div class="image">
		        	<?php 
		        	$image = get_field("about_image"); 
		        	image_object($image);
		        	?>
		        </div>
		        <!-- TEXT -->
		        <div class="about_text text">
		        	<?php the_content(); ?>
		        </div>
		        <?php
		    endwhile;
		    wp_reset_postdata();
		endif;
	?>
</div>
