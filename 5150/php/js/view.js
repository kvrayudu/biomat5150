$(document).ready(function(){
	var count = 1;
	var material_id = $("#material_id").attr("value");
	var url_str = $("#baseUrlDependent").text();
	var auto_url_str =  $("#baseUrlYVariables").text();
	var subformula_url_str =  $("#baseUrlSubformulaConstraints").text();




	$( "#variable" ).autocomplete({
		source: function( request, response ) {
			console.log(auto_url_str);
			console.log(auto_url_str);
          $.getJSON(auto_url_str, {
            name: request.term,
            material_id: material_id,
          }, response );
       	 },


	});






	$("#variable").focusout(function(){
		var variable_name = $("#variable").attr("value");
		console.log("HelloWorlds " + $("#variable").value);
		variable_name = "Thermal Conductivity , W/m K"
		variable_name = variable_name.split(', ')[0];

		$("#dependent_variable").empty();
		$("#dependent_variable").append("<option>Pick one</option>");

		$.ajax({
			type:"GET",
			url:url_str,
			data: {"material_id": material_id,  "variable_name": variable_name},
			dataType: "json",
			success: function(x) 
				{ 
					for (var i = x.length - 1; i >= 0; i--) {
						
						$("#dependent_variable").append("<option value='" + x[i].id +"'" + "units='"+ x[i].SIUnit+"'> "+ x[i].Name + "</option>");


					}

					$("#dependent_variable").change(function(){
						$("#units").text($("#dependent_variable option:selected" ).attr("units"));
				
					});

				} //end of sucess call
	}); //end of ajax call

	

	});


	$("#dependent_variable").change(function(){
		
		var variable_name = $("#variable").attr("value");
		variable_name = "Thermal Conductivity , W/m K"
		variable_name = variable_name.split(', ')[0];
		var dependent_variable_id = $("#dependent_variable option:selected").attr("value");
		var material_id = $("#material_id").attr("value");
		var url_str = $("#baseUrlFormulas").text();

		$.ajax({
			type:"GET",
			url:url_str,
			data: {"material_id": material_id,  "variable_name": variable_name, "dependent_variable_id":dependent_variable_id},
			dataType: "json",
			success: function(x) 
				{ 
					for (var i = x.length - 1; i >= 0; i--) {

						$("#formula").append("<option value='" + x[i].FormulaID +"'" + "text='"+ x[i].FormulaText+"'> "+ x[i].Name + "</option>");
					}		

				} //end of sucess call
	}); //end of ajax call



	});


$("#formula").change(function(){
		
		var dependent_variable_id = $("#dependent_variable option:selected").attr("value");
		var formula_id = $("#formula option:selected").attr("value");
		$("#constraints").empty();

		var url_str = $("#baseUrlConstraints").text();

		$.ajax({
			type:"GET",
			url:url_str,
			data: {"formula_id": formula_id,  "dependent_variable_id":dependent_variable_id, "material_id":material_id},
			dataType: "json",
			success: function(x) 
				{ 

					var no_choices = x.no_choices;
					console.log(no_choices);
					for (var key in no_choices) {
						var con = no_choices[key];
						console.log(con);
						$("#constraints").append("<br><strong>" + con.Name + ": </strong><br>");
						$("#constraints").append("<label for=constraints[" +con.Id + "]> " + con.Name + "</label>");
						$("#constraints").append("<input value="+con.Value+" type='text' name=constraints[" +con.Id + "]></input>");
						$("#constraints").append("<span > " + con.units + "</span><br>");

					}
					var choices = x.choices;
					for(var key in choices){
						var con = choices[key].constraint;
						$("#constraints").append("<br><strong>" + con.Name + ": </strong><br>");
						$("#constraints").append('<input type="radio" name="choice[' + con.Id +']" value="data_value" > Input Data Value <input type="radio" name="choice[' + con.Id +']" value="formula" > Use Formula <br>');
						$("#constraints").append('<div  class="choice' + con.Id + '" id="data_value_div' + con.Id + '"></div>');
						$("#data_value_div" + con.Id).append('<label for=choice_constraints[' +con.Id + ']>' + con.Name + '</label>');
						$("#data_value_div" + con.Id).append("<input type='text' name=choice_constraints[" +con.Id + "]></input>");
						$("#data_value_div" + con.Id).append("<span > " + con.units + "</span><br>");

						var select_box = "<div 	 class='choice" + con.Id + "' id='formula_div" + con.Id + "'><select class='subformula' id='formula_option_" + key + "' name='formula_option_" +key  + "'>";
						select_box = select_box + "<option value='none'>Pick one</option>"; 
						for (var FormulaID in choices[key].formulas) {
							var name = choices[key].formulas[FormulaID].name;
							select_box = select_box + "<option value='" + FormulaID +"'>" + name + "</option>";
						};
						select_box = select_box + "</select></div>";


				
						$("#constraints").append(select_box);


						$(":input[name='choice[" +con.Id + "]']").click(function(){
							var type = $(this).attr("value");
							$(".choice" + con.Id).attr("style", "display:none");
							$("#"+type + "_div" + con.Id).attr("style", "");
						});


						$(".subformula").change(function(){

							var dependent_variable_id = $("#dependent_variable option:selected").attr("value");
							var id = $(this).attr("id");
							console.log("#" + id + " option:selected");
							var formula_id = $("#" + id + " option:selected").attr("value");
							console.log("changing");
							console.log(formula_id);
							$.ajax({
								type:"GET",
								url:subformula_url_str,
								data: {"formula_id": formula_id,  "dependent_variable_id":dependent_variable_id},
								dataType: "json",
								success: function(data){

									for (var i = data.length - 1; i >= 0; i--) {
										var con = data[i];

										if ($(":input[name='constraints[" + con.Id + "]']").length == 0 ) {
											$("#constraints").append("<br><strong>" + con.Name + ": </strong><br>");
											$("#constraints").append("<label for=constraints[" +con.Id + "]> " + con.Name + "</label>");
											$("#constraints").append("<input type='text' name=constraints[" +con.Id + "]></input>");
											$("#constraints").append("<span > " + con.units + "</span><br>");
										}
									}




								} //end of success func
							}); //end of ajax call

					}); //end of subformula on change

					}
				} //end of sucess call
	}); //end of ajax call



	});




});


