<div id="sidebar_wrapper">

	<div id="sidebar_toggle">
		<img src="<?php bloginfo('template_url'); ?>/assets/img/close.svg" />
	</div>

	<div id="sidebar">

		<li id="lang_toggle">
			<a class="lang_en" href="">En</a> / <a class="lang_fr selected" href="">Fr</a>
		</li>

		<!-- MENU -->
		<ul id="nav">
			<li>
				<a href="#_news">
					<span class="fr">Actualités</span>
					<span class="en">News</span>
				</a>
			</li>
			<li>
				<a href="#_about">
					<span class="fr">À propos</span>
					<span class="en">About</span>
				</a>
			</li>
			<li>
				<a id="projects_toggle" href="">
					<span class="fr">Projets</span>
					<span class="en">Projects</span>
				</a>
				<ul id="projects_hidden">
					<?php sidebar_get_projects(); ?>
				</ul>
			</li>
			<li><a href="#_concerts">Concerts</a></li>
			<li>
				<a href="#_discography">
					<span class="fr">Discographie</span>
					<span class="en">Discography</span>
				</a>
			</li>
			<li>
				<a href="#_links">
					<span class="fr">Liens</span>
					<span class="en">Links</span>
				</a>
			</li>
			<li><a href="#_links">Contact</a></li>
		</ul>

		<!-- NEWSLETTER -->
		<div>
			<a id="newsletter_toggle" href="">
				<span class="fr">Recevoir le newsletter</span>
				<span class="en">Sign up to newsletter</span>
			</a>
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

