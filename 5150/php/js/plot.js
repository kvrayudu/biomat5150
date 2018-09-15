$(document).ready(function(){

	var url_str = $("#baseUrl").text();
	var material_id = $("#material_id").attr("value");
	var x_var_id = $("#x_var_id").attr("value");
	var y_var_id = $("#y_var_id").attr("value");

	var data = $("#formula_data").attr("value");

	$.ajax({
			type:"GET",
			url:url_str,
			data: {"material_id": material_id,  "x_var_id": x_var_id, "y_var_id": y_var_id, "data":data},
			dataType: "json",
			success: function(point_data) 
			{ 
				console.log(point_data);


				var line = {}; 
				var series_arg = [];
				data = JSON.parse(data);
				if (data.valid==1) {
					line =	{
				            	type: 'line',
				                name: 'Predicted Line',
				                marker: {
				                	enabled:false
				                },
				                data:  point_data.formula_pairs,
				            }

				     series_arg.push(line);
				     

				}
				series_arg.push({
				                name: ' User Data Points',
				                color: 'rgba(83, 83, 223, .5)',
				                data: point_data.single_points});



				colors = [];
				for (var i = point_data.series.length - 1; i >= 0; i--) {
				
					var to_add = {name:'Series ' + point_data.series[i].id,
								  data: point_data.series[i].data};
					series_arg.push(to_add);


				};

				console.log(series_arg);

				$('#plot_div').highcharts({
				            chart: {
				                type: 'scatter',
				                zoomType: 'xy'
				            },
				            title: {
				                text: point_data.y_var_name + ' Versus ' + point_data.x_var_name 
				            },
				            subtitle: {
				                text: point_data.Material_Name
				            },
				            xAxis: {
				                title: {
				                    enabled: true,
				                    text: point_data.x_var_name + ' (' + point_data.x_var_units + ')'
				                },
				                startOnTick: true,
				                endOnTick: true,
				                showLastLabel: true
				            },
				            yAxis: {
				                title: {
				                    text: point_data.y_var_name + ' (' + point_data.y_var_units + ')'
				                }
				            },
				            
				            plotOptions: {
				                scatter: {
				                    marker: {
				                        radius: 5,
				                        states: {
				                            hover: {
				                                enabled: true,
				                                lineColor: 'rgb(100,100,100)'
				                            }
				                        }
				                    },
				                    states: {
				                        hover: {
				                            marker: {
				                                enabled: false
				                            }
				                        }
				                    },
				                    tooltip: {
				                        headerFormat: '<b>{series.name}</b><br>',
				                        pointFormat: '{point.x} ' +point_data.x_var_units +', {point.y} ' + point_data.y_var_units
				                    }
				                }
				            },
				            series: series_arg,
				            // [
				            // line,

				            // {
				            //     name: ' User Data Points',
				            //     color: 'rgba(83, 83, 223, .5)',
				            //     data: point_data.single_points
				    
				            // }, ],
				        }); //end of highcharts
								} //end of sucess call
	}); //end of ajax call



	});
