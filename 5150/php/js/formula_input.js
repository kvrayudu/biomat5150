$(document).ready(function(){


	$( "#variable" ).autocomplete({
		source: function( request, response ) {
          $.getJSON( $("#variable_autocomplete_url").attr("value"), {
            name: request.term
          }, response );
       	 },


	});


	$("#pow_btn").click(function(event){
		event.preventDefault();
		$("#formula_textarea").attr("value", $("#formula_textarea").attr("value") + "pow()");
	});

	$("#sin_btn").click(function(event){
		event.preventDefault();
		$("#formula_textarea").attr("value", $("#formula_textarea").attr("value" ) + "sin()");
	});
	$("#cos_btn").click(function(event){
		event.preventDefault();
		$("#formula_textarea").attr("value", $("#formula_textarea").attr("value" ) + "cos()");
	});
	$("#tan_btn").click(function(event){
		event.preventDefault();
		$("#formula_textarea").attr("value", $("#formula_textarea").attr("value" ) + "tan()");
	});


	$("#add_btn").click(function(){
		console.log($("#formula_textarea").attr("value"));
		$("#formula_textarea").attr("value", $("#formula_textarea").attr("value") + " + ");
	});

	$("#subtract_btn").click(function(event){
		event.preventDefault();
		$("#formula_textarea").attr("value", $("#formula_textarea").attr("value" ) + " - ");
	});

	$("#mult_btn").click(function(event){
		event.preventDefault();
		$("#formula_textarea").attr("value", $("#formula_textarea").attr("value" ) + " * ");
	});

	$("#div_btn").click(function(event){
		event.preventDefault();
		$("#formula_textarea").attr("value", $("#formula_textarea").attr("value" ) + " / ");
	});


	$("#insert_btn").click(function(event){
		event.preventDefault();
		var var_name = $("#variable").attr("value");

		var symbol = $("#variable").attr("value").split(', ')[1];


		$("#formula_textarea").attr("value", $("#formula_textarea").attr("value" ) + "#" +  symbol   + "~"  );
		
		if ($("#" + symbol).length > 0) {
			console.log("here");
			return;
		}


		var label_low = "<label id='"+ symbol +"' for='range_low_"+ var_name  +"' > Low Range for " + var_name + "</label>";
		var text_low = "<input type='text' name='range_low_" + var_name + "' >";
		var label_high = "<label for='range_high_"+ var_name  +"' > High Range for " + var_name + "</label>";
		var text_high = "<input type='text' name='range_high_" + var_name + "' ><br>";

		$("#valid_ranges").append(label_low);
		$("#valid_ranges").append(text_low);
		$("#valid_ranges").append(label_high);
		$("#valid_ranges").append(text_high);

	});

	$("#insert_formula_btn").click(function(event){
		event.preventDefault();

		console.log('hey');
		$("#formula_textarea").attr("value", $("#formula_textarea").attr("value" ) + "&" +  $("#formula_select").attr("value")   + "@"  );
	});

	$("#add_material_btn").click(function(event){
		event.preventDefault();
		$("#materials").attr("value", $("#materials").attr("value" ) +  $("#material_select").attr("value")   + ";"  );
	});

	$("#add_group_btn").click(function(event){
		event.preventDefault();
		$("#groups").attr("value", $("#groups").attr("value" ) +  $("#group_select").attr("value")   + ";"  );
	});

	$("#formula_textarea").change(function(){
		console.log($("#formula_textarea").attr("value"));

		$("#formula_textarea").attr("value", $("#formula_textarea").attr("value"));
		var string = $("#formula_textarea").attr("value");
		parse(string);		

		console.log($("#formula_textarea").attr("value"));
	});


	$("#formula_textarea").keypress(function(){
		var string = $("#formula_textarea").attr("value");
		parse(string);


	});
	$("#formula_textarea").mouseover(function(){
		var string = $("#formula_textarea").attr("value");
		parse(string);


	});

});

function parse(string) {
	$.ajax({
			url:$("#formula_parse_url").attr("value"),
			data: {"string": string},
			dataType: "json",
			success: function(data){
				if (data.parsed != "") {
					console.log("got some parsed stuff");
					$("#parse_result").html("<h3>Parsed Formula</h3>    " + "<span> " +data.parsed + "</span><input required type='hidden' name='mostly_parsed_result' value='" + data.mostly_parsed + "'>");

				}
				else{
					console.log("didnt get some parsed stuff");

				}
			}
		});
}
