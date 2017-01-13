function ajaxLoad ( section ) {
    console.log( "ajaxLoad", section );
    // APPEND ANIMATION
    var coll = $("#coll_content"),
        animation = $('<div class="loading"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
    coll.append(animation);
    // LOAD CONTENT    
    $.ajax({
        url: myAjax.ajaxurl,
        data: {
            "action"    : "loader",
            "section"   : section
        },
        success:function(data) {
            // IF LAST CHARACTER IS 1 OR 0 – REMOVE
            var lastChar = parseInt( data.slice(-1) );
            if ( lastChar === 1 || lastChar === 0 ) {
                data = data.slice(0, -1);
            }
            // LOAD NEW SECTION IN MAIN COLUMN
            $("#main_column").append(data);
            // CHECK IF IMAGES HAVE LOADED
            console.log( 23, $("#main_column .main_content:last-child") );
            var delay = 0;
            $("#main_column .main_content:last-child img").on("load", function(){
                // IF NOT YET LOADED ADD DELAY
                if ( $(this).height() == 0 ) {
                    delay = 500;
                }
                // ADD LOADED CLASS TO NEW CONTENT
                setTimeout( function(){
                    $("#main_column").find("[data-slug='" + section + "']").fadeIn(1000).addClass("loaded");
                }, delay );                
            }); 
            // UPDATE MENU CURRENT
            menuCurrent();
            // MEDIA CHECK
            mediaCheck();
        },
        error: function(errorThrown){
            console.log(errorThrown);
            // $("#main_column").append(errorThrown);
        }
    }); 

 	
}


