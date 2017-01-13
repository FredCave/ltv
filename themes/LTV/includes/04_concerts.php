<div id="concerts" class="main_content" data-slug="concerts">
	<!-- IMAGE -->
	<?php 
		$concert_query = new WP_Query( "name=concerts-intro" );
		if ( $concert_query->have_posts() ) :
		    while ( $concert_query->have_posts() ) : $concert_query->the_post(); ?> 
	        	<div class="image">
		        	<?php 
		        	$image = get_field("concert_image"); 
		        	image_object($image);
		        	?>
		        </div>
		        <?php
		    endwhile;
		    wp_reset_postdata();
		endif;
	?>
	<div class="text">
		<h2>À venir / Upcoming</h2>
		<?php get_future_concerts(); ?>
		<h2>Passés / Past</h2>
		<?php get_past_concerts(); ?>
	</div>
</div>