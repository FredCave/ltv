<div id="media" class="main_content" data-slug="media">
	<?php 
		$media_query = new WP_Query( "name=media" );
		if ( $media_query->have_posts() ) :
		    while ( $media_query->have_posts() ) : $media_query->the_post(); ?>
		        <!-- AUDIO -->
		        <div class="media_audio text">
		        	<?php 
		        	if ( have_rows("media_audio") ) : 
		        		while ( have_rows("media_audio") ) : the_row("media_audio"); ?>
		        			<div class="media_single">
		        				<?php 
								$iframe = get_sub_field("media_single");
								// ADD EXTRA ATTRIBUTES TO IFRAME HTML
								$attributes = 'id="iframe"';
								$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
								// ECHO $IFRAME
								echo $iframe;
		        				?></div>
		        		<?php
		        		endwhile;
		        	endif; 
		        	?>
		        </div>
		        <!-- VIDEO -->
		        <div class="media_video text">
		        	<?php 
		        	if ( have_rows("media_video") ) : 
		        		while ( have_rows("media_video") ) : the_row("media_video"); ?>
		        			<div class="media_single"><?php the_sub_field("media_single"); ?></div>
		        		<?php
		        		endwhile;
		        	endif; 
		        	?>
		        </div>
		        <?php
		    endwhile;
		    wp_reset_postdata();
		endif;
	?>
</div>