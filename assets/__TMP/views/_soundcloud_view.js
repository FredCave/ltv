var app = app || {};

app.SoundcloudView = Backbone.View.extend({
	
	el: "#soundcloud",

	initialize: function () {

		// console.log("SoundcloudView.initialize");

		// GET EVENTS FROM PARENT
		_.extend( this.events, app.Widget.prototype.events );

		var self = this;

		// GET PLAYIST FROM HOME MODEL
		this.model = new app.HomeModel();
		this.model.fetch().then( function(){

			self.playlist = self.model.attributes.acf.home_playlist;
			self.render();

		});

	},

	render: function () {

		// console.log("SoundcloudView.render");

		this.template = _.template( $("#playlist_template").html() );

		this.$el.append( this.template( this.playlist ) );

		// FADE IN
		this.$el.find(".widget").fadeIn().css("display","inline-block");
	
	}

});