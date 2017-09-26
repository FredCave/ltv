var app = app || {};

app.NewsView = Backbone.View.extend({

	el: "#news",

	initialize: function () {

		console.log("NewsView.initialize");

		var self = this;

		this.newsCollection = new app.NewsCollection();
		this.newsCollection.fetch().then( function(){

			self.renderItem( self.newsCollection );

		}); 

	},

	renderItem: function ( elems ) {

		// console.log("NewsView.renderItem");

		var self = this;
		// LOOP THROUGH ELEMS
		elems.forEach( function ( model ) {
			
			var newsItemView = new app.NewsItemView({model:model});
			self.$el.append( newsItemView.render().$el );	

		});

	}

});