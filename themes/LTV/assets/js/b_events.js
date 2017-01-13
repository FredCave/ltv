/*****************************************************************************
    
	EVENTS

		4. 	WINDOW EVENTS
			4.1. MAIN WINDOW EVENTS
			4.2. MANUAL SCROLL EVENTS
			4.3. MEDIA QUERIES


*****************************************************************************/

$( document ).ready(function() {

//	1. GENERAL

	// NAVIGATION

	$("#main_menu a").on("click", function(e){
		e.preventDefault();
		// GET URL QUERY
		var urlQuery = $(this).attr("href").split("?p=")[1];
		if ( urlQuery === undefined ) {
			urlQuery = "news";
		}
		// navManager( urlQuery );
		History.pushState( urlQuery, "Le Ton Vertical", '?p=' + urlQuery );
		// HIDE ANY HIGHLIGHTED LIs
		$("#main_menu .highlighter").css("opacity","0");
	});

//	4. WINDOW EVENTS

	$(window).on( "load", function(){
		// CALCULATE SEC. MARGIN TOP
		secMarginTop();
		// MAIN COLUMN INIT
		mainInit();
		// console.log( 34, History.getState() ); 
		// MENU CURRENT
		menuCurrent();
		// LOAD VISIBLE IMAGES
		imageManager(0);
		// MEDIA CHECK
		mediaCheck();
	}).on("scroll", _.throttle(function() {
		var winScroll = $(window).scrollTop();
		imageManager( winScroll );
	}, 500 ));

// URL CHANGE

	$(window).bind( "statechange", function(){
		// GET SLUG
		var slug = History.getState().hash.split("?p=")[1];
		slug = slug.split("&")[0];
		// console.log( 43, slug );
		navManager( slug );
	});

});