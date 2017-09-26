var app = app || {};

app.PartnersView = Backbone.View.extend({

	el: "#partners",

	initialize: function () {

		console.log("PartnersView.initialize");

		var self = this;

		// this.model = new app.PartnersModel();

		// this.model.fetch().then( function(){

		// 	self.render();

		// });

	}, 

	// template: _.template( $('#about_template').html() )

});