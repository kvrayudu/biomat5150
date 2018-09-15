$(document).ready(function(){
	
	$("#add_material_btn").click(function(event){
		//alert("Add Mat Button Click with")
		event.preventDefault();
		//var name = $("#material_autocomplete").attr("value");
		var name = $("#material_autocomplete").val();
		var id = $("#material_autocomplete").attr("id");
		//alert("id=" + id);
		//alert("Material Name " + name)
		$("#mat_names").html($("#mat_names").html() +  name + ", " );
		$("#names").attr("value", $("#names").attr("value") +name+";");
	});
});

