var app = app || {};

app.ProjectItemView = Backbone.View.extend({
	
	el: "#project_wrapper",

	initialize: function ( options ) {

		console.log("ProjectsView.initialize", options);

		// HIGHLIGHT GROUP NAME IN LIST
		this.highlightTitle( this.options.name );

		// this.$el.empty();
		// IF ALREADY LOADED
		if ( $("#project-item-" + this.options.name).length ) {
			
			// SHOW PROJECT
			console.log( 18, "Already loaded." );

			$(".project_item_wrapper").hide();
			$("#project-item-" + this.options.name).show();

			return;

		} 

		// HIDE OTHER PROJECT ITEMS
		$(".project_item_wrapper").hide();

		// ADD LOADER
		var animation = $('<div class="loader"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
		this.$el.append( animation );

		var self = this;

		// this.model = new app.ProjectModel({name:this.options.name});
		this.model = new app.ProjectModel();

		this.model.fetch({
			data : {
				name : this.options.name
			},
			processData: true
		}).then( function(){
			self.render();
		});

	},

	template: _.template( $('#project_template').html() ),

	render: function () {

		console.log("ProjectsView.render");

		this.id = this.model.attributes[0].id;

		this.$el.find(".loader").fadeOut();
		this.$el.append( this.template( this.model ) );

		// LANG
		if ( $("#wrapper").attr("data-lang") === "en" ) {
			this.$el.find(".fr").hide();
			this.$el.find(".en").show();
		}

		// LOAD SOUNDCLOUD WIDGET
		if ( this.model.attributes[0].playlist.length ) {
			this.loadSoundcloud( this.model.attributes[0].playlist );
		}

		// LOAD CONCERTS + ALBUMS	
		this.loadConcerts();
		this.loadAlbums();

		// IMAGE SIZES CALCULATED AFTER ALBUM RENDER

		return this;

	},

	highlightTitle: function ( title ) {

		console.log("ProjectsView.highlightTitle", title);

		$("#project_list li").each( function(){

			if ( $(this).find("a").attr("data-title") === title ) {

				$(this).css({
					"border-bottom" : "1px solid black"
				}).siblings().css({
					"border-bottom" : ""	
				});

			}

		});

	},

	loadConcerts: function () {

		console.log("ProjectsView.loadConcerts");

		var self = this; 

		// UPCOMING
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

		// PREVIOUS
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
		this.$el.find(".project_concerts").append("<h2 class='project_subtitle'><span>" + title + "</span></h2>");	

		this.filteredPosts = this.filterDates( input_posts );

		this.posts = {"posts": this.filteredPosts };

		this.concertsTemplate = _.template( $('#concerts_sub_template').html() );

		this.$el.find(".project_concerts").append( this.concertsTemplate( {"posts": this.filteredPosts } ) );

		return this;

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
			} else {
				// RUN IMAGE SIZES – USUALLY RUN AFTER ALBUM LOAD
				app.Page.imageSizes("projects");
			}

		});

	},
	
	renderAlbums: function () {

		console.log("ProjectsView.renderAlbums");

		// APPEND TITLE
		this.$el.find(".project_discography").append("<h2 class='project_subtitle'><span>Discography</span></h2>");

		this.filteredAlbumPosts = {"posts": this.filteredAlbums };

		this.projectAlbumTemplate = _.template( $('#project_album_template').html() );

		this.$el.find(".project_discography").append( this.projectAlbumTemplate( this.filteredAlbumPosts ) );

		// CALC IMAGE SIZES
		app.Page.imageSizes("projects");

		return this;

	}, 

	filterDates: function ( posts ) {

		console.log("ProjectItemView.filterDates");

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

	loadSoundcloud: function ( playlist ) {

		console.log("ProjectItemView.loadSoundcloud");

		if ( $("#project_soundcloud").attr("data-project") !== this.id ) {
			$("#general_soundcloud").hide();

			var parsedString = $( $.parseHTML(playlist) ),
				playlistObject;
			if ( parsedString.is("iframe") ) {
				playlistObject = parsedString;
			} else {
				playlistObject = parsedString.find("iframe");
			}

			playlistObject.attr( "height", 450 );

			$("#project_soundcloud").empty().attr("data-project", this.id );
			playlistObject.appendTo("#project_soundcloud");

		}

	}

});
