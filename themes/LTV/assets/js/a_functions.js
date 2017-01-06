/****************************************************************************
    
	FUNCTIONS
		1.	 GENERAL

		2. 	NAV



*****************************************************************************/

var winH = $(window).height(),
	winW = $(window).width();

/****************************************************************************
    
	1. GENERAL

*****************************************************************************/

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