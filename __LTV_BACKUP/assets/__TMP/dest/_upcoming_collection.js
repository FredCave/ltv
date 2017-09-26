var app = app || {};

app.UpcomingCollection = Backbone.Collection.extend({

	url: ROOT + "/wp-json/custom/v1/upcoming"

});