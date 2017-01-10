<div class="main_content loaded" data-slug="news">
	
	<!-- TITLE -->
	<h1>Le Ton Vertical</h1>

	<ul>
		<?php 
		$news_query = new WP_Query( "post_type=news" );
		if ( $news_query->have_posts() ) :
		    echo "<ul>";
		    while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
		        <li class="news_post">
		        	<!-- IMAGE -->
		        	<div class="news_image">
			        	<?php 
			        	$image = get_field("news_image"); 
			        	image_object($image);
			        	?>
			        </div>
					<!-- META INFO – IN LEFT MARGIN -->
					<div class="news_left_margin">
						<div class="news_image_meta">
							<?php the_field("news_image_credits"); ?>
						</div>
					</div>
		        	<div class="news_text text">
			        	<!-- TITLE -->
			        	<?php the_title(); ?>
			        	<!-- MAIN TEXT -->
			        	<?php the_field("news_text"); ?>
			        </div>
		        </li>
		        <?php
		    endwhile;
		    echo "</ul>";
		    wp_reset_postdata();
		endif;
		?>	
	</ul>
</div>