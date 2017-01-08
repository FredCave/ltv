<div class="main_content loaded" data-slug="news">
	NEWS
	<ul>
		<?php 
		$news_query = new WP_Query( "post_type=news" );
		if ( $news_query->have_posts() ) :
		    echo "<ul>";
		    while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
		        <li class="news_post">
		        	<?php the_title(); ?>
		        	<?php 
		        	$image = get_field("news_image"); 
		        	var_dump($image);
		        	?>
		        </li>
		        <?php
		    endwhile;
		    echo "</ul>";
		    wp_reset_postdata();
		endif;
		?>	
	</ul>
</div>