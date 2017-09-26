var app = app || {};

app.NewsCollection = Backbone.Collection.extend({

	url: ROOT + "/wp-json/custom/v1/news"
	
});