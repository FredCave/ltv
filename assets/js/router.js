var app = app || {};

app.MainRouter = Backbone.Router.extend({

	routes: {

        "projects/:name(/)"    : "showProjectItem",
   
        "*other"                : "showHome"

    },

    exists: function ( section ) {

        // console.log("Router.exists");

        return $("#" + section).length;

    },

    navTo: function ( section ) {

        console.log("Router.navTo", section);
        
        var target = $("#" + section).offset().top;
        // console.log( 26, target );

        _.delay( function(){
            $('html, body').animate({
                scrollTop: target
            }, 1000 );              
        }, 500 );
        
    },

    showHome: function () {

    	console.log("showHome");

        var hash = Backbone.history.location.hash;
        // console.log( 41, hash );

        if ( hash !== "" ) {
            // SCROLL TO SECTION
            this.navTo( hash.substring(2) );
        }

    },
    
    showProjectItem: function (name) {

        console.log("showProjectItem", name);

        this.navTo("projects");

        _.defer( function(){
            new app.ProjectItemView({name:name});             
        });

    }

});