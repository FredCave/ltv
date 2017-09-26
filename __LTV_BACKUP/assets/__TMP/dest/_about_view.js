var app = app || {};

app.AboutView = Backbone.View.extend({
	
	el: "#about",

	initialize: function () {

		console.log("AboutView.initialize");

		var self = this;

		this.model = new app.AboutModel();

		this.model.fetch().then( function(){

			self.render();

		});

	}, 

	template: _.template( $('#about_template').html() ),

	imageCalc: function () {

		console.log("AboutView.imageCalc");		

		console.log( 29, this.model );

		// GET IMAGE RATIO
		var imgRatio = this.model.attributes[0].image.height / this.model.attributes[0].image.width,
			imgClass;

        if ( imgRatio >= 0.5 && imgRatio < 1 ) {
            imgClass = "two_thirds";
        } else if ( imgRatio >= 1 ) {
        	imgClass = "one_third";
        } else {
            imgClass = "full_width"; 
        }		

		this.model.attributes[0].img_class = imgClass;		

	},

	render: function () {

		console.log("AboutView.render");

		this.imageCalc();

		this.$el.append( this.template( this.model.attributes ) );

		return this;

	}

});
