var app = app || {};

app.MainRouter = Backbone.Router.extend({

	routes: {

        "_projects/:id" : "showProjectItem",
   
        "*other"    : "showHome"

    },

    exists: function ( section ) {

        // console.log("Router.exists");

        return $("#" + section).length;

    },

    navTo: function ( section ) {

        console.log("Router.navTo", section);
        
        var target = $("#" + section).offset().top;
        console.log( 26, target );

        _.delay( function(){
            $('html, body').animate({
                scrollTop: target
            }, 1000 );              
        }, 1000 );
        
    },

    showHome: function () {

    	console.log("showHome");

    },
    
    showProjectItem: function (id) {

        console.log("showProjectItem", id);

        new app.ProjectItemView({id:id}); 

        this.navTo("projects");

    }

});