var app = app || {};

app.AppView = Backbone.View.extend({

	el: "#wrapper",

	initialize: function () {

		console.log("AppView.initialize");
		
		console.log( "app_view", ROOT );
		
		// LOAD SIDEBAR
		new app.UpcomingView();

		new app.SocialMediaView();

		// LOAD MAIN SECTION
		this.loadMainSection();

	},

	loadMainSection: function () {

		console.log("AppView.loadMainSection");

		// NEWS
		new app.NewsView();

		// ABOUT
		new app.AboutView();

		// PROJECTS
		new app.ProjectsView();

		// CONCERTS
		new app.ConcertsView();

		// LINKS
		new app.LinksView();

		// CONTACT
		new app.ContactView();

		// PARTNERS
		// new app.PartnersView();

	},

	render: function () {

		console.log("AppView.render");

	}

});