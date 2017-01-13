/****************************************************************************
    
	FUNCTIONS
		1.	GENERAL

		2. 	



*****************************************************************************/

var winH = $(window).height(),
	winW = $(window).width();

/****************************************************************************
    
	1. GENERAL

*****************************************************************************/

// MAIN INIT

function mainInit () {
	console.log("mainInit");
	// ADD LOADED CLASS TO CONTENT
	$("#main_column .main_content").addClass("loaded");
}

// NAV MANAGER

function navManager ( urlQuery ) {
	console.log("navManager", urlQuery);
	// GET CURRENT LOADED SECTION
	var current = $(".loaded").attr("data-slug");
	// IF NOT ALREADY VISIBLE
	if ( current !== urlQuery ) {
		// HIDE LOADED SECTION
		$(".loaded").hide().removeClass("loaded");
		// SCROLL TO TOP
		$("html,body").animate({
			scrollTop: 0
		}, 500 );
		// AFTER SCROLL
		setTimeout( function(){
			// IF ALREADY LOADED BUT NOT VISIBLE
			if ( $("#main_column").find("[data-slug='" + urlQuery + "']").length ) {
				$("#main_column").find("[data-slug='" + urlQuery + "']").fadeIn(1000).addClass("loaded");
				// UPDATE MENU CURRENT
        		menuCurrent();
			} else {
				// LOAD NEW SECTION IN MAIN COLUMN
				ajaxLoad( urlQuery );
			}			
		}, 500 );
		// UPDATE URL
		// window.history.pushState(urlQuery, urlQuery, '?p=' + urlQuery);
		History.pushState( urlQuery, "Le Ton Vertical", '?p=' + urlQuery );
		
	} else {
		console.log( 59, "Already loaded." );
	}
}

/****************************************************************************
    
	2. SECONDARY COLUMN

*****************************************************************************/

function menuCurrent () {
	console.log("menuCurrent");
	// GET LOADED SLUG
	var slug = $("#main_column .loaded").attr("data-slug");
	console.log(71, slug);
	// HIGHLIGHT CURRENT
	$("[data-slug='" + slug + "']").find(".highlighter").css("opacity","1");
}

function secMarginTop () {
	console.log("secMarginTop");
	// GET HEIGHT OF MENU
	var menuH = $("#main_menu").outerHeight();
	// HIDE ANIMATION
	$("#secondary_column .loading").hide();
	// SET MARGIN TOP
	$("#secondary_content").css({
		"margin-top" : menuH + 50 
	}).fadeIn();	
}

/****************************************************************************
    
	3. SECTIONS

*****************************************************************************/

function imageManager ( scroll ) {
	console.log("imageManager");
	// TMP
	$(".loaded .news_post:nth-child(2) img").addClass("tester");

	// LOOP THROUGH IMAGES
	$(".loaded img").each( function(){
		// GET POSITION RELATIVE TO WINDOW
		var imgPos = $(this).offset().top - scroll,
			halfImg = $(this).height() / 2;
		// IF IMAGE IS HALF ON SCREEN
		if ( imgPos > ( 0 - halfImg ) && imgPos < ( $(window).height() - halfImg ) ) {
			// COLORIZE IMAGE
			$(this).css({
				// "-webkit-filter" : "grayscale(0%)",
    //         			"filter" : "grayscale(0%)",
            		// "transition" : "2s"
			});
			// LAZYLOAD CHECK
			if ( !$(this).hasClass("lazyloaded") ) {
				lazyLoader( $(this) );
			}
		} else {
			// LAZYLOAD CHECK
			if ( imgPos < ( $(window).height() * 1.5 ) ) {
				if ( !$(this).hasClass("lazyloaded") ) {
					lazyLoader( $(this) );
				}
			}
			// RESET IMAGE
			$(this).css({
				"-webkit-filter" : "",
            			"filter" : "", 
    				"transition" : ""   
			});			
		}
	});
}

function lazyLoader( img ) {
	console.log("lazyLoader");
	// GET CURRENT WIDTH
	var imgW = img.width();
	console.log( 136, imgW );
	// LOAD CORRECT SRC
	if ( imgW > 300 && imgW <= 600 ) {
		// MEDIUM
		img.attr( "src", img.data("med") );
	} else if ( imgW > 600 && imgW <= 900 ) {
		// LARGE
		img.attr( "src", img.data("lrg") );
	} else if ( imgW > 900 ) {
		// EXTRA LARGE	
		img.attr( "src", img.data("xlg") );	
	} else {
		// THUMB
		img.attr( "src", img.data("tmb") );
	}
	// ADD CLASS LAZYLOADED
	img.addClass("lazyloaded");
}

// BIND SOUNDCLOUD EVENTS

function mediaCheck () {
	console.log("mediaCheck");
	if ( $("#iframe").length ) {
		var iframeElem = document.querySelector('iframe'); 
			widget     = SC.Widget(iframeElem);
		widget.bind(SC.Widget.Events.PLAY, function(){
			console.log("PLAYING");
		});
		widget.bind(SC.Widget.Events.PAUSE, function(){
			console.log("PAUSED");
		});
		widget.bind(SC.Widget.Events.FINISH, function(){
			console.log("FINISHED");
		});
	}
}




