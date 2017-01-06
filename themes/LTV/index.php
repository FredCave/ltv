<?php get_header(); ?>

	<div id="wrapper">

		<div id="main_column">
			<?php 
			// GET QUERY
			$query = $_GET['p']; 
			page_redirect($query);		
			?>
		</div>

		<div id="secondary_column">
			<!-- MENU -->
			<?php include("includes/00_menu.php"); ?>
			<!-- SECONDARY CONTENT -->
			<?php include("includes/01_secondary_content.php"); ?>
		</div>		

	</div><!-- END OF #WRAPPER -->

<?php get_footer(); ?>