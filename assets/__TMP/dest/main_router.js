var app = app || {};

app.MainRouter = Backbone.Router.extend({

	routes: {

        // "_news" : "showLatestNews",

        // "_news/:id" : "showNewsItem",

        // "_about" : "showAbout",

        // "_projects/:id" : "showProjectItem",

        // "_concerts" : "showConcerts",

        // "_discography" : "showDiscography",        

        // "_media" : "showMedia",

        // "_links" : "showLinks",

        // "_contact" : "showContact",     

        "*other"    : "showHome"

    },

    exists: function ( section ) {

        // console.log("Router.exists");

        return $("#" + section).length;

    },

    navTo: function ( section ) {

        console.log("Router.navTo", section);
        
        var target = $("#" + section).offset().top;

        $('html, body').animate({
            scrollTop: target
        }, 1000 );          

    },

    showHome: function () {

    	console.log("showHome");

    },

    // showLatestNews: function () {

    // 	console.log("showLatestNews");

    //     // if ( !this.exists( "news" ) ) {
    //     //     $("#widget_wrapper").append("<section id='news'></section>");
    //     //     new app.NewsView();
    //     // } 
    //     this.navTo("news");

    // },

    // showNewsItem: function () {

    // 	console.log("showNewsItem");

    //     // if ( !this.exists( "news" ) ) {
    //     //     new app.NewsView();
    //     // }
    //     this.navTo("news"); 

    // },

    // showAbout: function () {

    // 	console.log("showAbout");

    //     // if ( !this.exists( "biography" ) ) {
    //     //     $("#widget_wrapper").append("<section id='biography'></section>");
    //     //     new app.BiographyView();            
    //     // }
    //     this.navTo("about");

    // },
    
    // showProjectItem: function (id) {

    //     console.log("showProjectItem", id);

    //     new app.ProjectItemView({id:id}); 

    //     this.navTo("projects");

    // },    

    // showConcerts: function () {

    // 	console.log("showConcerts");

    //     // if ( !this.exists( "concerts" ) ) {
    //     //     $("#widget_wrapper").append("<section id='concerts'></section>");
    //     //     new app.ConcertsView();
    //     // }
    //     this.navTo("concerts");

    // },

    // showDiscography: function () {

    // 	console.log("showDiscography");

    //     // if ( !this.exists( "discography" ) ) {
    //     //     $("#widget_wrapper").append("<section id='discography'></section>");
    //     //     new app.DiscographyView();
    //     // }
    //     this.navTo("discography");

    // },
    
    // showLinks: function () {

    // 	console.log("showLinks");

    //     // if ( !this.exists( "links" ) ) {
    //     //     $("#widget_wrapper").append("<section id='links'></section>");
    //     //     new app.LinksView();
    //     // }
    //     this.navTo("links");

    // },
    
    // showContact: function () {

    // 	console.log("showContact");

    //     // if ( !this.exists( "contact" ) ) {
    //     //     $("#widget_wrapper").append("<section id='contact'></section>");
    //     //     new app.ContactView();
    //     // }
    //     this.navTo("contact");

    // }

});