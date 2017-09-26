// var app = app || {};

// app.ConcertView = Backbone.View.extend({
	
// 	tagName: "li",

// 	className: "concert widget",

// 	initialize: function (){

// 		console.log("ConcertView.initialize");

// 	},

//     events: {
//     },

//     template: _.template( $('#upcoming_template').html() ),

//     render: function() {

//     	console.log( "ConcertView.render" );

//     	// GET DATE
//         var concert_date = moment(this.model.attributes.date),
//             formatted_date;

//     	// IF TIME IS OTHER THAN DEFAULT
//     	if ( concert_date.hour() !== 0 ) {
// 			formatted_date = concert_date.format("D/MM/YYYY, HH:mm");
//     	} else {
// 			formatted_date = concert_date.format("D/MM/YYYY");
//     	}

//         this.model.attributes.date = formatted_date;

// 		this.$el.html( this.template( this.model.attributes ) );

// 		return this;

//     }

// });