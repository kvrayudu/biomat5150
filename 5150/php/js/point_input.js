$(document).ready(function(){


	var factor_count = 1;
	var property_count = 1;




updatePropertyAutocomplete();
updateFactorAutocomplete();






$(".property").change(function(){
		updateLabels($(this), "property");

	});

$(":input[name='data_type']").click(function(){
	var type = $(this).attr("value");
	console.log(type);

	$(".input_div").attr("style", "display:none");
	$("#"+type).attr("style", "");

});

$("#num_props").change(function(){

	var num = parseInt($("select option:selected").attr("value"));
	var span_clone = $("#prop").clone();

	$(".prop").detach();
	
	for (var i = 0; i < num; i++) {
		console.log("hey");
		span_clone = span_clone.attr("id", "prop"+num);
		$("#dependent_properties").append(span_clone.clone());
		
	}



});





	
	$(":input[id^='factors_select']").focusout(function(){
		updateLabels($(this), "factors");

	});
	
	$(":input[id^='property_select']").focusout(function(){
		updateLabels($(this), "property");

	});
	
	// $(".factor").change(function(){
	// 	console.log("hey");
	// 	updateLabels($(this), "factor");

	// });

	// $(".property").change(function(){
	// 	updateLabels($(this), "property");

	// });

	


	$('#add_factor_btn').click(function(event){
		event.preventDefault();

		console.log("button clicked");
		factor_count = factor_count +1;

		var select_clone = $("#factors_select1").clone();
		console.log(select_clone.attr("class"));
		select_clone.attr("num", factor_count);
		select_clone.attr("id", "factors_select"+factor_count);

		select_clone.attr("name", ("factors[" + factor_count+ "]"));

		var label_clone = $("#factors_label1").clone();
		label_clone.text("Factor " +factor_count);
		label_clone.attr("num", factor_count);
		label_clone.attr("id", "factors_label"+factor_count);
		label_clone.attr("for", ("factors_val" + factor_count));

		var textbox_clone = $("#factors1_val").clone();
		textbox_clone.attr("id","factors" +  factor_count + "_val");
		textbox_clone.attr("num", factor_count );
		textbox_clone.attr("name", ("factors_val[" + factor_count + "]" ));
		
		
		var unit_span_clone = $("#factors_units1").clone();
		unit_span_clone.attr("num", factor_count);
		unit_span_clone.attr("id", "factors_units"+factor_count);

		unit_span_clone.text("Units");

		$("#factors_vals").append("<br><label for=factors[" +factor_count +"] >" + "Factor " + factor_count + ": </label>");
		$("#factors_vals").append(select_clone);
		$("#factors_vals").append("<br>");
		$("#factors_vals").append(label_clone);

		$("#factors_vals").append(textbox_clone);
		// $("#factors_vals").append(unit_span_clone);
		$("#factors_vals").append("<br>");

		updateFactorAutocomplete();

	$(".factors").change(function(){
		updateLabels($(this), "factors");

	});

});


$('#add_property_btn').click(function(event){
		event.preventDefault();

		console.log("button clicked");
		property_count = property_count +1;

		var select_clone = $("#property_select1").clone();
		select_clone.val("");
		select_clone.attr("num", property_count);
		select_clone.attr("id", "property_select"+property_count);

		select_clone.attr("name", ("properties[" + property_count+ "]"));

		var label_clone = $("#property_label1").clone();
		label_clone.text("Property " +property_count);
		label_clone.attr("num", property_count);
		label_clone.attr("id", "property_label"+property_count);
		label_clone.attr("for", ("property_val" + property_count));

		var textbox_clone = $("#properties1_val").clone();
		textbox_clone.attr("id","properties" +  property_count + "_val");
		textbox_clone.attr("num", property_count );
		textbox_clone.attr("name", ("properties_val[" + property_count + "]" ));
		


		var error_label_clone = $("#property_error_label1").clone();
		error_label_clone.text("Error for measurement: ");
		error_label_clone.attr("num", property_count);
		error_label_clone.attr("id", "property_error_label"+property_count);
		error_label_clone.attr("for", ("property_error" + property_count));


		var error_clone = $("#properties1_error").clone();
		error_clone.attr("id","properties" +  property_count + "_val");
		error_clone.attr("num", property_count );
		error_clone.attr("name", ("properties_error[" + property_count + "]" ));
		// var unit_span_clone = $("#property_units1").clone();
		// unit_span_clone.attr("num", property_count);
		// unit_span_clone.attr("id", "property_units"+property_count);

		// unit_span_clone.text("Units");

			$("#property_vals").append("<br><label for=properties[" +property_count +"] >" + "Property " + property_count + ": </label>");
		$("#property_vals").append(select_clone);
		
		/*$("#property_vals").append("<?php $this->widget('ext.autoComplete', array( 'model'=>$modelvar, 'id'=>'factor_select2', 'attribute'=>'id', 'name'=>'factors[1]', 'source'=>Yii::app()->createUrl('input/factorsAutoComplete'), 'htmlOptions'=>array('style'=>'height:15px;','num'=>'2',), 'options'=>array( 'minLength'=>'0',),));?>");*/
		
		$("#property_vals").append("<br>");
		$("#property_vals").append(label_clone);

		$("#property_vals").append(textbox_clone);
		$("#property_vals").append(error_label_clone);

		$("#property_vals").append(error_clone);

		// $("#property_vals").append(unit_span_clone);
		$("#property_vals").append("<br>");

		console.log("should be changing");


		$(".property").change(function(){

			updateLabels($(this), "property");

		});
		updatePropertyAutocomplete();

	});



});
function updatePropertyAutocomplete(){

	$( ".property" ).autocomplete({
		source: function( request, response ) {
          $.getJSON( $("#property_autocomplete_url").text(), {
            name: request.term
          }, response );
       	 },


	});

}

function updateFactorAutocomplete(){

	$( ".factor" ).autocomplete({
		source: function( request, response ) {
			console.log("hey");
          $.getJSON( $("#factor_autocomplete_url").text(), {
            name: request.term
          }, response );
       	 },


	});

	$( ".factors" ).autocomplete({
		source: function( request, response ) {
			console.log("hey");
          $.getJSON( $("#factor_autocomplete_url").text(), {
            name: request.term
          }, response );
       	 },


	});

}


function updateLabels(x, type){
		var num = x.attr("num");
		console.log(num);

		  $("#" + type + "_label" + num).text( $("#" + type + "_select" + num ).val());
		  $("#" + type + "_units" + num).text( $("#hidden" + type + "_select" + num ).attr("value"));
}

