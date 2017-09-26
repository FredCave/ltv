<?php get_header(); ?>

<?php get_sidebar(); ?>

<div id="wrapper" data-lang="fr">

	<div id="logo_wrapper">
		<img class="logo" src="<?php bloginfo('template_url'); ?>/assets/img/logo.png" />
	</div>

	<!-- NEWS -->
	<section id="news">
		<?php ltv_get_news(); ?>
	</section>

	<!-- ABOUT -->
	<section id="about">
		<?php ltv_get_about(); ?>		
	</section>

	<!-- PROJECTS -->
	<section id="projects">
		<?php ltv_get_projects(); ?>	
	</section>

	<!-- CONCERTS -->
	<section id="concerts">
		<?php ltv_get_concerts(); ?>		
	</section>

	<!-- DISCOGRAPHY -->
	<section id="discography">
		<?php ltv_get_discography(); ?>		
	</section>

	<!-- LINKS -->
	<section id="links">
		<?php ltv_get_links(); ?>	
	</section>

	<!-- CONTACT -->
	<section id="contact">
		<?php ltv_get_contact(); ?>
	</section>

</div>

<?php get_footer(); ?>