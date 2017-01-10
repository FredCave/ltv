<div class="main_content" data-slug="links">
	<?php 
		$links_query = new WP_Query( "name=links" );
		if ( $links_query->have_posts() ) :
		    while ( $links_query->have_posts() ) : $links_query->the_post(); ?>
		        <div class="links_text text">
		        	<h2>Other Bands</h2>
		        	<!-- LOOP THROUGH CATEGORIES -->
		        	<?php 
		        	if ( have_rows( "link_cats" ) ) :
		        		while ( have_rows("link_cats") ) : the_row();
		        			// CAT TITLE ?>
		        			<h2><?php the_sub_field("link_cat_title"); ?></h2>
		        			<!-- LINKS IN CATEGORY -->
		        			<ul>
		        			<?php if( have_rows("links") ) :
		        				while ( have_rows("links") ) : the_row(); ?>
		        					<li><?php the_sub_field("link_title"); ?></li>
		        				<?php
		        				endwhile;
		        			endif; ?>
		        			</ul>
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