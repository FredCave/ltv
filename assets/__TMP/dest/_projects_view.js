var app = app || {};

app.ProjectsView = Backbone.View.extend({
	
	el: "#projects",

	initialize: function () {

		console.log("ProjectsView.initialize");

		this.renderWrapper();

	},

	template: _.template( $('#project_wrapper_template').html() ),
	
	renderWrapper: function () {

		console.log("ProjectsView.renderWrapper");

		this.$el.append( this.template( this.model ) );

		return this;

	}

});
