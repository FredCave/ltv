var app = app || {};

app.SocialMediaView = Backbone.View.extend({
	
	el: "#sidebar_social_media",

	initialize: function () {

		console.log("SocialMediaView.initialize");

		var self = this;

		this.model = new app.SocialMediaModel();

		this.model.fetch().then( function(){

			console.log( 17, self.model );

			var links = self.model.attributes[0].links;

			links.forEach( function ( link ) {

				self.getIcons( link );

			});

    		self.render();			

		});
	
	}, 

	getIcons: function ( object ) {

		console.log("SocialMediaView.returnIcon");

		// WHERE TO GET IMAGES????

		var imgSrc,
			link = object.home_social_media_link,
			theme_path = directory_uri.stylesheet_directory_uri;

		if ( link.indexOf("youtube") > -1 ) {
			console.log("youtube");
			imgSrc = theme_path + "/assets/img/youtube.svg";
		} else if ( link.indexOf("vimeo") > -1 ) {
			console.log("vimeo");
			imgSrc = theme_path + "/assets/img/vimeo.svg";
		} else if ( link.indexOf("soundcloud") > -1 ) {
			console.log("soundcloud");
			imgSrc = theme_path + "/assets/img/soundcloud.svg";
		} else if ( link.indexOf("facebook") > -1 ) {
			console.log("facebook");
			imgSrc = theme_path + "/assets/img/facebook.svg";
		}

		object.img_src = imgSrc;

	},

	render: function () {

		console.log("SocialMediaView.render");

		console.log( 61, this.model );

		var self = this;

		var links = this.model.attributes[0].links;

		links.forEach( function ( link ) {

			console.log(70);

			self.$el.append("<a target='_blank' href='" + link.home_social_media_link + "'><img src='" + link.img_src + "' /></a>");

		});

	}

});