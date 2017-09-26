<?php /*******************************************

    UPCOMING

**********************************************/ ?>

<script id="upcoming_template" type="text/template">

    <% if ( posts.length ) { %>
        <div>Upcoming Concerts: </div>
    <% } %>
    
    <% _.each(posts, function( post ){ %>

        <div class="upcoming_concert">
            <% if ( post.date.length ) { %>
                <h2><%= post.date %></h2>
            <% } %>
            <% // if ( post.group.length ) { %>
                <p><% // post.group[0].post_title %></p>
            <% // } %>
            <% if ( post.title.length ) { %>
                <p><a href="<%= post.link %>"><%= post.title %></a></p>
            <% } %>
        </div>

    <% }); %>

</script>

<?php /*******************************************

    PROJECTS

**********************************************/ ?>

<script id="project_wrapper_template" type="text/template">

    <div class="main_item">

        <div class="title_wrapper">
            <h1>Projects</h1>
        </div>      

        <ul id="project_list">
            <?php // get_projects(); ?>
        </ul>

        <div id="project_wrapper"></div>

    </div>

</script>

<script id="project_template" type="text/template">

    <% 
    data = this.model.attributes[0]; 
    console.log( 59, data );
    %>

    <div id="project-item-<%= data.slug %>" class="project_item_wrapper">
                 
        <!-- IMAGE -->
        <%  if ( data.image ) { %>
            <div class="main_image">
                <% console.log( 222, data.image ); %>
                <img class="<%= data.image_class %>" 
                    alt="Le Tone Vertical – <%= data.title %>" 
                    width="<%= data.image.width %>"   
                    height="<%= data.image.height %>"
                    data-thm="<%= data.image.sizes.thumbnail %>"
                    data-med="<%= data.image.sizes.medium %>" 
                    data-mdl="<%= data.image.sizes.medium_large %>" 
                    data-lrg="<%= data.image.sizes.large %>"
                    data-xlg="<%= data.image.sizes.extralarge %>" 
                    src="<%= data.image.sizes.thumbnail %>" />
            </div>
        <% } %>

        <div class="info_wrapper">
            <!-- IMAGE CREDITS -->
            <% if ( data.image_credit ) { %>
                <h4 class="image_credit">
                    <span class="fr">Crédits image : </span>
                    <span class="en">Image credits: </span>
                    <%= data.image_credit %>
                </h4>
            <% } %>

            <div class="item_content">

                <?php /* <div class="title_wrapper">
                    <h1><%= data.title %></h1>
                </div> */ ?>

                <!-- MUSICIANS -->
                <div class="text_block">
                    <div class="fr"><%= data.musicians %></div>
                    <div class="en">
                        <% if ( data.musicians_en ) { 
                            print(data.musicians_en);
                        } else {
                            print(data.musicians);   
                        } %>    
                    </div>
                </div>

                <!-- TEXT -->
                <div class="text_block">
                    <div class="fr"><%= data.text %></div>
                    <div class="en">
                        <% if ( data.text_en ) {
                            print(data.text_en);
                        } else {
                            print("No English translation.");
                        } %>
                    </div>
                </div>

                <!-- ADDTIONAL MEDIA -->
                <% if ( data.media.length ) { %>
                    <div class="additional_media">
                        <?php /* 
                        <% _.each( data.media, function( media ){ %>
                            <%
                            var additionalMedia = media.media.replace("src","data-src");
                            print additionalMedia;
                            %>   
                        <% }); %>
                        */ ?>
                    </div>
                <% } %>
                <!-- CONCERTS -->
                <div class="project_concerts"></div>
                <!-- DISCOGRAPHY -->
                <div class="project_discography"></div>
                <!-- DOCUMENTS -->
                <% if ( data.documents.length ) { %>
                    <h2 class='project_subtitle'>
                        <span class="fr">Téléchargements</span>
                        <span class="en">Downloads</span>
                    </h2>
                    <ul class="project_documents text_block">
                        <% _.each( data.documents, function( doc ){ %>
                            <li>
                                <a target="_blank" href="<%= doc.document.url %>"><%= doc.document.title %></a>
                            </li>
                        <% }); %>
                    </ul>
                <% } %>
                <!-- SOCIAL MEDIA -->
                <% if ( data.social_media.length ) { %>
                    <ul class="project_social_media text_block">
                        <% 
                        _.each( data.social_media, function( row ) {
                            var link = row.project_social_media_link;
                            if ( link !== "" ) {
                                print( "<li>" + app.Page.printIcon( link ) + "</li>" );
                            }
                        });
                        %>
                    </ul>
                <% } %>

            </div>

        </div><!-- END OF .INFO_WRAPPER -->

    </div><!-- END OF .PROJECT_ITEM_WRAPPER -->

</script>

<script id="project_album_template" type="text/template">
     
    <ul class="project_albums">
  
    <% _.each(posts, function( post ){
        
        // PARSE RESULT
        var data = post.attributes 
        %>

        <li class="project_album">
            <% console.log( 222, data.image ); %>
            <img class="" 
                alt="Le Tone Vertical – <%= data.title %>" 
                width="<%= data.image.width %>"   
                height="<%= data.image.height %>"
                data-thm="<%= data.image.sizes.thumbnail %>"
                data-med="<%= data.image.sizes.medium %>" 
                data-lrg="<%= data.image.sizes.large %>"
                data-xlg="<%= data.image.sizes.extralarge %>" 
                src="<%= data.image.sizes.thumbnail %>" />
            <p class="project_album_title">
                <p><%= data.title %></p>
                <p>
                    <a href="<%= data.buy %>">Buy Here</a>
                </p>
            </p>
        </li>

    <% }); %>

    </ul>
 
</script>

<?php /*******************************************

    CONCERTS

**********************************************/ ?>

<script id="concerts_sub_template" type="text/template">
    
    <% console.log( 245, posts ); %> 

    <% if ( posts.length === 0 ) { %>
        <p class="no_concerts">Currently no concerts.</p>
    <% } %>

    <% _.each(posts, function( post ){ %>

        <% 
        data = post.attributes; 
        console.log( 235, data );
        %> 

        <div class="concert">
            <div class="concert_date"><h2><%= data.date %></h2></div>
            <div class="concert_info">
                <p class="concert_group"><%= data.group[0].post_title %></p>
                <p><a target="_blank" href="<%= data.link %>"><%= data.venue %></a></p>
            </div>
        </div>

    <% }); %>

</script>

<?php /*******************************************

    DISCOGRAPHY

**********************************************/ ?>

<script id="discography_template" type="text/template">

    <div class="widget discography_widget">

        <div class="widget_content">
            
            <div class="close"></div>
         
            <div class="title_wrapper">
                <h1>Discography</h1>
            </div>

            <% _.each( this.collection.models, function( post ){ %>
                <div class="album">
                    <img src="<%= post.attributes.acf.album_cover.url %>" />
                    <p class="album_title"><%= post.attributes.title.rendered %></p>
                    <p><%= post.attributes.acf.album_group[0].post_title %></p>
                    <p>
                        <a target="_blank" href="<%= post.attributes.acf.album_link_label %>"><%= post.attributes.acf.album_label %></a>
                    </p>
                    <p><%= post.attributes.acf.album_year %></p>
                    <div class="album_info">
                        <%= post.attributes.acf.album_musicians %>
                        <%= post.attributes.acf.album_other_info %>
                    </div>
                    <h1>
                        <a class="album_buy" target="_blank" href="<%= post.attributes.acf.link_buy_online %>">Buy Online</a>
                    </h1>
                </div>
            <% }); %>

        </div> 

    </div> 

</script>
