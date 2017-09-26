var app = app || {};

app.ContactModel = Backbone.Model.extend({
	
	url : ROOT + "/wp-json/custom/v1/contact"

});