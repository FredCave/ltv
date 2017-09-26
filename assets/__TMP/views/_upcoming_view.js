var app = app || {};

app.UpcomingView = Backbone.View.extend({
	
	el: "#sidebar_upcoming",

	initialize: function (){

		console.log("UpcomingView.initialize");

		var self = this;
	
		this.collection = new app.UpcomingCollection();

		this.collection.fetch().then( function (){

			console.log( 17, self.collection );

			self.render();

		});
	
	},



	// sortByDate: function( collection ){
 //    	return( collection.get( 'lastName' ) );
	// },

	filterDates: function ( posts ) {

		// console.log("UpcomingView.filterDates");

		posts.forEach( function ( post ) { 

			// GET DATE
	        var concert_date = moment(post.attributes.date),
	            formatted_date;

	    	// IF TIME IS OTHER THAN DEFAULT
	    	if ( concert_date.hour() !== 0 ) {
				formatted_date = concert_date.format("D/MM/YYYY, HH:mm").replace(/\//g , "–");
	    	} else {
				formatted_date = concert_date.format("D/MM/YYYY").replace(/\//g , "–");
	    	}

	        post.attributes.date = formatted_date;

		});

		return posts;

	},

	render: function ( concerts ) {

		// console.log("UpcomingView.Render");

		this.$el.empty();

		// FILTER DATES
		var filteredPosts = this.filterDates( this.collection );

		this.posts = {"posts": filteredPosts.toJSON() };

		this.template = _.template( $("#upcoming_template").html() );

		this.$el.append( this.template( this.posts ) );

		return this;

	}

});