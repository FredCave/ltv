var app = app || {};

app.NewsItemView = Backbone.View.extend({

	className: "main_item",

	initialize: function () {

		console.log("NewsItemView.initialize");

	},

	template: _.template( $('#news_item_template').html() ),

	imageCalc: function () {

		console.log("NewsItemView.imageCalc");		

		// GET IMAGE RATIO
		var imgRatio = this.model.attributes.image.height / this.model.attributes.image.width,
			imgClass;

        if ( imgRatio >= 0.5 && imgRatio < 1 ) {
            imgClass = "two_thirds";
        } else if ( imgRatio >= 1 ) {
        	imgClass = "one_third";
        } else {
            imgClass = "full_width"; 
        }		

		this.model.set({ img_class: imgClass });		

	},

	render: function(){

		console.log("NewsItemView.render");

		this.imageCalc();

		this.$el.html( this.template( this.model.attributes ) );

		return this;

	}

});