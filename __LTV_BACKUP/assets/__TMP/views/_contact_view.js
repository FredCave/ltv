var app = app || {};

app.ContactView = Backbone.View.extend({

	el: "#contact",

	initialize: function (){

		console.log("ContactView.initialize");

		var self = this;

		// UPCOMING SECTION
		this.model = new app.ContactModel;
		this.model.fetch().then( function(){

			self.render();

		});

	},

	template: _.template( $('#contact_template').html() ),
	
	render: function () {

		console.log("ContactView.render");

		this.$el.append( this.template( this.model ) );

		return this;

	}

});