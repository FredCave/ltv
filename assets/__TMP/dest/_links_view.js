var app = app || {};

app.LinksView = Backbone.View.extend({
	
	el: "#links",

	initialize: function () {

		console.log("LinksView.initialize");

		var self = this;

		// UPCOMING SECTION
		this.model = new app.LinksModel;
		this.model.fetch().then( function(){

			self.render();

		});

	},

	template: _.template( $('#links_template').html() ),
	
	render: function () {

		console.log("LinksView.render");

		this.$el.append( this.template( this.model ) );

		return this;

	}

});
