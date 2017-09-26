var app = app || {};

app.Nav = {

	projectsVisible: false, 

	init: function () {

	    $("#projects_toggle").on("click", function (e){
	    	e.preventDefault();
			app.Nav.toggleProjects();
	    });		

	}, 

	toggleProjects: function () {

		console.log("app.Nav.toggleProjects");

		if ( !this.projectsVisible ) {
			// SHOW
			$("#projects_hidden").show();
			this.projectsVisible = true;
		} else {
			// HIDE
			$("#projects_hidden").hide();
			this.projectsVisible = false;
		}

	}

}

$(function() {

	// INIT MOMENT
	moment().format();

	app.Page.init();

    var appRouter = new app.MainRouter();
    Backbone.history.start({});

	app.Nav.init();

});