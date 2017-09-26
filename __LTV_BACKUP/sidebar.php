<div id="sidebar_wrapper">

	<div id="sidebar_toggle">
		<img src="<?php bloginfo('template_url'); ?>/assets/img/close.svg" />
	</div>

	<div id="sidebar">

		<div id="lang_toggle">
			En / Fr
		</div>

		<!-- MENU -->
		<ul id="nav">
			<li><a href="#_news">News</a></li>
			<li><a href="#_about">About</a></li>
			<li>
				<a id="projects_toggle" href="">Projects</a>
				<ul id="projects_hidden">
					<?php sidebar_get_projects(); ?>
				</ul>
			</li>
			<li><a href="#_concerts">Concerts</a></li>
			<li><a href="#_media">Discography</a></li>
			<li><a href="#_links">Links</a></li>
			<li><a href="#_links">Contact</a></li>
		</ul>

		<!-- NEWSLETTER -->
		<div>
			<a id="newsletter_toggle" href="">Sign up to newsletter</a>
		</div>

		<div id="sidebar_social_media">
			<?php ltv_social_media(); ?>
		</div>

		<!-- SOUNDCLOUD PLAYLIST -->
		<div id="soundcloud_playlist">
			<div id="general_soundcloud"><?php ltv_get_playlist(); ?></div>	
			<div id="project_soundcloud"></div>
		</div>

		<!-- CONTACT -->
		<div><?php get_email(); ?></div>

		<!-- UPCOMING CONCERTS -->
		<div id="sidebar_upcoming"></div>

	</div>

</div>

<!-- NEWSLETTER POPUP -->

<div id="newsletter_popup">
	<div id="newsletter_close">
		<img src="<?php bloginfo('template_url'); ?>/assets/img/close.svg" />
	</div>
	<?php echo do_shortcode("[newsletter]"); ?>
</div>

