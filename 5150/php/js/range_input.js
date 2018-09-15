$(document).ready(function(){



$( ".variable" ).autocomplete({
		source: function( request, response ) {
          $.getJSON( $("#variable_autocomplete_url").text(), {
            name: request.term
          }, response );
       	 },


	});



});
