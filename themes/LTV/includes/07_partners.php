<div class="main_content" data-slug="partners">
	<?php 
		$partners_query = new WP_Query( "name=partner" );
		if ( $partners_query->have_posts() ) :
		    while ( $partners_query->have_posts() ) : $partners_query->the_post(); ?>
		        <div class="partners_text text">
		        	<?php the_content(); ?>
		        </div>
		        <?php
		    endwhile;
		    wp_reset_postdata();
		endif;
	?>
</div>