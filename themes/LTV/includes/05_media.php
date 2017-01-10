<div class="main_content" data-slug="media">
	<?php 
		$media_query = new WP_Query( "name=media" );
		if ( $media_query->have_posts() ) :
		    while ( $media_query->have_posts() ) : $media_query->the_post(); ?>
		        <div class="media_text text">
		        	<?php the_content(); ?>
		        </div>
		        <?php
		    endwhile;
		    wp_reset_postdata();
		endif;
	?>
</div>