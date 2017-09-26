var app = app || {};

app.Page = {
	
	sidebarVis: true, 

	init: function () {

		console.log("Page.init");

		var self = this;

		this.bindEvents();

		// ON LAST IMAGE LOAD
		$("#discography img").one( "load", function(){
			self.imageSizes();			
		}).each(function() {
			if(this.complete) $(this).load();
		});

	},

	bindEvents: function () {

		console.log("Page.bindEvents");

		var self = this;

		$("#newsletter_toggle").on( "click", function (e) {

			e.preventDefault();
			self.newsletterShow();

		});

		$("#newsletter_close").on( "click", function (e) {

			self.newsletterHide();

		});		

		$(window).on( "resize", _.throttle( function (){
			// RECALCULATE IMAGES
			self.imageSizes();
		}, 1000 ) );

		$("#sidebar_toggle").on("click", function(){

			if ( !self.sidebarVis ) {

				self.sidebarShow();

			} else {

				self.sidebarHide();

			}

		});

	},

	newsletterShow: function () {

		console.log("Page.newsletterShow");

		$("#newsletter_popup").show();

	},

	newsletterHide: function () {

		console.log("Page.newsletterHide");

		$("#newsletter_popup").hide();

	},

	imageSizes: function ( section ) {

		console.log("Page.imageSizes");

		var target;

		if ( target === undefined ) {
			target = $("#wrapper");
		} else {
			target = $("#" + section);
		}

		console.log( 64, target );

		target.find("img").not(".logo").each( function (){

			// GET IMG WIDTH
			var imgW = $(this).width(),
				newSrc;

			if ( $(this).hasClass("portrait") ) {
				imgW = $(this).height();
			}
		
			console.log( 72, imgW );

			if ( imgW <= 300 ) { // THUMBNAIL
				newSrc = $(this).attr("data-thm");
			} else if ( imgW > 300 && imgW <= 600 ) { // MEDIUM
				newSrc = $(this).attr("data-med");
			} else if ( imgW > 600 && imgW <= 768 ) { // MEDIUM_LARGE
				newSrc = $(this).attr("data-mdl");
			} else if ( imgW > 768 && imgW <= 900 ) { // LARGE
				newSrc = $(this).attr("data-lrg");
			} else { // EXTRALARGE
				newSrc = $(this).attr("data-xlg");
			}

			console.log( 97, newSrc );

			// IF NEWSRC NOT SAME AS CURRENT SRC
			if ( newSrc !== $(this).attr("src") ) {
				$(this).attr( "src", newSrc );
				console.log( 41, "Src changed." );				
			}

		});

	},

	sidebarShow: function () {

		console.log("Page.sidebarShow");

		$("#sidebar_wrapper").css({
			"right" : ""
		});

		$("#sidebar_toggle img").css({
			"transform" 		: "",
			"width"				: "",
			"margin-left"		: "",
			"margin-top"		: "",
		});

		$("#wrapper").css({
			"width" : "",
			"max-width" : ""
		});

		this.sidebarVis = true;

	},

	sidebarHide: function () {

		console.log("Page.sidebarHide");

		var currentW = $("#sidebar_wrapper").outerWidth();
		console.log( 145, currentW );

		$("#sidebar_wrapper").css({
			"right" : - currentW
		});

		$("#sidebar_toggle img").css({
			"transform" 		: "rotate(45deg)",
			"width"				: "60%",
			"margin-left"		: "20%",
			"margin-top"		: "20%",
		});

		$("#wrapper").css({
			"width" : "100%",
			"max-width" : "100%"
		});

		this.sidebarVis = false;

	}

}