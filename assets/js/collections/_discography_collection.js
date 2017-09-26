var app = app || {};

app.DiscographyCollection = Backbone.Collection.extend({

	url: ROOT + "/wp-json/custom/v1/albums"

});