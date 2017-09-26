var app = app || {};

app.Page = {
	
	sidebarVis: true, 

	iframesLoaded: false, 

	init: function () {

		console.log("Page.init");

		var self = this;

		this.bindEvents();

		// SCROLL TO TOP
		$("html,body").animate({
			scrollTop: 0
		}, 100 );

		// ON LAST IMAGE LOAD
		$("#discography img").one( "load", function(){
			// console.log( 25, "Images loaded");
			self.imageSizes();		
			// LOAD SIDEBAR PLAYLIST	
			self.sidebarPlaylistInit();
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

	    $("#lang_toggle a").on("click", function(e){

			e.preventDefault();
			self.langSelec( $(this) );

	    });	

		$(window).on("mousewheel touchmove", function(){

			if ( !self.iframesLoaded ) {
				self.iframesLoaded = true;
				self.iframesInit();
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

		console.log("Page.imageSizes", section);

		var target;

		if ( section === undefined ) {
			target = $("#wrapper");
		} else {
			target = $("#" + section);
		}

		target.find("img").not(".logo").each( function (){

			// GET IMG WIDTH
			var imgW = $(this).width(),
				newSrc;

			if ( $(this).hasClass("portrait") ) {
				imgW = $(this).height();
			}
		
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

			// IF NEWSRC NOT SAME AS CURRENT SRC
			if ( newSrc !== $(this).attr("src") ) {
				$(this).attr( "src", newSrc );
				// console.log( 41, "Src changed." );				
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
		// console.log( 145, currentW );

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

	},

	frameInit: function ( frame ) {

		console.log("Page.frameInit");

		// IF LAZYLOADABLE
		if ( frame.attr("data-src") !== undefined && !frame.hasClass("loaded") ) {
			var dataSrc = frame.attr("data-src");
			frame.attr( "src", dataSrc ).addClass("loaded");
			// IF SOUNDCLOUD && NOT IN SIDEBAR
			if ( dataSrc.indexOf("soundcloud") > -1 && frame.parents("#sidebar").length === 0 ) {
				frame.addClass("iframe_smaller");
			} 
		}

	},

	sidebarPlaylistInit: function() {

		console.log("Page.sidebarPlaylistInit");

		var playlist = $("#sidebar").find("iframe");
		this.frameInit( playlist );

	},

	iframesInit: function () {

		console.log("Page.iframesInit");

		var self = this;

		// LOOP THROUGH IFRAMES
		$("iframe").each( function(){
			// IF NOT IN SIDEBAR
			if ( $(this).parents("#sidebar").length === 0 ) {
				self.frameInit( $(this) );
			}

		});

	},

	langSelec: function ( click ) {

		console.log("Page.langSelec");

		if ( click.hasClass("lang_en") ) {

			$("#wrapper").attr("data-lang","en");

			$(".lang_fr").removeClass("selected");
			$(".lang_en").addClass("selected");
			$(".fr").hide();
			$(".en").show();

		} else if ( click.hasClass("lang_fr") ) {

			$("#wrapper").attr("data-lang","fr");

			$(".lang_en").removeClass("selected");
			$(".lang_fr").addClass("selected");
			$(".en").hide();
			$(".fr").show();

		}

	},

	printIcon: function ( url ) {

		console.log("Page.printIcon", url);

		var string = "";

		if ( url.indexOf('youtube') > -1 ) { 
			string += '<a target="_blank" href="' + url + '">';
			string += '<img src="' + TEMPLATE + '/assets/img/youtube.svg" />';
		} else if ( url.indexOf('vimeo') > -1 ) { 
			string += '<a target="_blank" href="' + url + '">';
			string += '<img src="' + TEMPLATE + '/assets/img/vimeo.svg" />';
		} else if ( url.indexOf('soundcloud') > -1 ) { 
			string += '<a target="_blank" href="' + url + '">';
			string += '<img src="' + TEMPLATE + '/assets/img/soundcloud.svg" />';
		} else if ( url.indexOf('facebook') > -1 ) {  
			string += '<a target="_blank" href="' + url + '">';
			string += '<img src="' + TEMPLATE + '/assets/img/facebook.svg" />';
		} else  { 
			string += '<a target="_blank" href="' + url + '">';
            string += url; 
		} 
        	string += "</a>";

        console.log( 289, string );
        return string;

	}

}