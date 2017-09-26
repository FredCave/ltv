var app = app || {};

app.PreviousCollection = Backbone.Collection.extend({

	url: ROOT + "/wp-json/custom/v1/previous"

});