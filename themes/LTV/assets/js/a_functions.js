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
		// IF LOADED
		if ( $("#main_column").find("[data-slug='" + urlQuery + "']").length ) {
			$("#main_column").find("[data-slug='" + urlQuery + "']").fadeIn(1000).addClass("loaded");
		} else {
			// LOAD NEW SECTION IN MAIN COLUMN
			ajaxLoad( urlQuery );
		}
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