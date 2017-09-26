var app = app || {};

app.DiscographyView = Backbone.View.extend({

	el: "#discography",
	
	initialize: function () {

		console.log("DiscographyView.initialize");

		// GET EVENTS FROM PARENT
		_.extend( this.events, app.Widget.prototype.events );

		var self = this;

		// UPCOMING SECTION
		this.collection = new app.DiscographyCollection;
		this.collection.fetch().then( function(){

			self.render();

		});

	},

	template: _.template( $('#discography_template').html() ),
	
	render: function () {

		console.log("DiscographyView.render");

		this.$el.append( this.template( this.collection ) );

		// FADE IN
		this.$el.find(".widget").fadeIn().css("display","inline-block");

		return this;

	}

});
