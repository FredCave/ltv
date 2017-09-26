var app = app || {};

app.ProjectItemView = Backbone.View.extend({
	
	el: "#project_wrapper",

	initialize: function () {

		console.log("ProjectsView.initialize");

		var self = this;

		this.model = new app.ProjectModel({id:this.id});

		this.model.fetch().then( function(){

			self.render();

		});

	},

	loadConcerts: function () {

		console.log("ProjectsView.loadConcerts");

		// NEED TO LOAD UPCOMING AND PREVIOUS

		var self = this; 

		this.upcoming = new app.UpcomingCollection();
		this.upcoming.fetch().then( function(){

			// RETURNS ARRAY OF OBJECTS
			self.filteredUpcoming = self.upcoming.filter( function(item) { 
				// GET GROUP FROM ATTRIBUTES
				var group = item.get("group")[0];
				return group.ID === parseInt(self.id);
			});

			if ( self.filteredUpcoming.length ) {
				self.renderConcerts("upcoming");
			}
			
		});

		this.previous =  new app.PreviousCollection;
		this.previous.fetch().then( function (){

			// RETURNS ARRAY OF OBJECTS
			self.filteredPrevious = self.previous.filter( function(item) { 
				// GET GROUP FROM ATTRIBUTES
				var group = item.get("group")[0];
				return group.ID === parseInt(self.id);
			});

			if ( self.filteredPrevious.length ) {
				self.renderConcerts("previous");
			}

		});

	}, 

	loadAlbums: function () {

		console.log("ProjectsView.loadAlbums");

		var self = this; 

		this.albums = new app.DiscographyCollection;
		this.albums.fetch().then( function(){

			// RETURNS ARRAY OF OBJECTS
			self.filteredAlbums = self.albums.filter( function(item) { 
				// GET GROUP FROM ACF RELATIONSHIP OBJECT
				var group = item.get("group")[0];
				return group.ID == self.id;
			});

			if ( self.filteredAlbums.length ) {
				self.renderAlbums();
			}

		});

	},

	template: _.template( $('#project_template').html() ),
	
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

	imageCalc: function () {

		console.log("ProjectItemView.imageCalc");		

		console.log( 120, this.model );

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

		console.log("ProjectsView.render");

		this.$el.empty();

		this.imageCalc();

		this.$el.append( this.template( this.model ) );

		// LOAD CONCERTS + ALBUMS	
		this.loadConcerts();
		this.loadAlbums();

		return this;

	},

	renderConcerts: function ( time ) {

		console.log("ProjectsView.renderConcerts", time );

		var title,
			input_posts;

		if ( time === "upcoming" ) {
			title = "Upcoming Concerts";
			input_posts = this.filteredUpcoming;
		} else {
			title = "Previous Concerts";
			input_posts = this.filteredPrevious;
		}

		// APPEND TITLE
		this.$el.append("<h1>" + title + "</h1>");	

		this.filteredPosts = this.filterDates( input_posts );

		this.posts = {"posts": this.filteredPosts };

		this.concertsTemplate = _.template( $('#concerts_sub_template').html() );

		this.$el.append( this.concertsTemplate( {"posts": this.filteredPosts } ) );

		return this;

	},

	renderAlbums: function () {

		console.log("ProjectsView.renderAlbums");

		console.log( 168, this.filteredAlbums );

		// APPEND TITLE
		this.$el.append("<h1>Discography</h1>");

		this.filteredAlbumPosts = {"posts": this.filteredAlbums };

		this.projectAlbumTemplate = _.template( $('#project_album_template').html() );

		this.$el.append( this.projectAlbumTemplate( this.filteredAlbumPosts ) );

		return this;

	}

});
