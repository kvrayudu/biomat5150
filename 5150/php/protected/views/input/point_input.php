<?php
/* @var $this InputController */

$this->breadcrumbs=array(
	'Input'=>array('/input'),
	'View',
);

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/input.css');
Yii::app()->getClientScript()->registerCssFile("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css");

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/point_input.js', CClientScript::POS_END);

?>


<br>
 <a class=" tab nav_link selected" href="#">Point Input</a>
<a class=" tab nav_link" href=<?php echo Yii::app()->createUrl("input/formula/" . $model->id); ?> >Formula Input</a>
<a class=" tab nav_link " href=<?php echo Yii::app()->createUrl("input/range/" . $model->id); ?> >Range Input</a>

<span id="property_autocomplete_url" hidden><?php echo Yii::app()->createUrl("input/propertyAutocomplete");?></span>
<span id="factor_autocomplete_url" hidden><?php echo Yii::app()->createUrl("input/factorAutocomplete");?></span>

<br>
<br>
<br>
<br>


<h2><?php  echo "Input Data for: " . $model->Name  ?> </h2>
<span><em> Can't find factor or property?</em> Email admin at <a mailto="akd1@cornell.edu">  akd1@cornell.edu.</a> </span> 



<br>
<br>

<form name="input" action=<?php echo Yii::app()->createUrl("input/point"); ?>  method="post" enctype="multipart/form-data">
<input type="radio" name="data_type" value="single_point" > Single Point Entry 
<input type="radio" name="data_type" value="series" > Data Series Entry <br>


<?php $form=$this->beginWidget('CActiveForm', 
    array(
        'id'=>'input',
        'enableClientValidation'=>true,
        'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>true)
    )); ?>
<input type="hidden" name="Material_id" value=<?php  echo $model->id ?> >
<br>

<div class="input_div" id="series" style="display:none">
	<h3>Properties</h3>

<label for="dependent_factor">Independent Factor: </label>
<input type="text" class="factor" id="dependent_factor" name="dependent_factor" > 

<p>Select Number of Dependent properties
<select id="num_props"> 
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
</select>

<div id="dependent_properties">

<span class="prop" id="prop">

<label for="independent_property">   Dependent Property: </label>
<input type="text" class="property" id="independent_property" name="independent_property" >

<label for="independent_property_error"> Error for dependent property: </label>
<input type="text" id="independent_property_error" name="independent_property_error[1]">

<br>
</span>

</div>



<p>Upload a .csv file with the series for the dependent factor in the first column, and the series for the independent property in the second. Do not include header names, or anything besides the numbers for each column. </p>

<label for="file">Filename:</label>
<input type="file" name="file" >


</div>

<div class="input_div" id="single_point" style="display:none">
	<h3>Properties</h3>

<?php /* $models = Variables::model()->findAllByAttributes(array('IsFactor' =>'0'), array('order' => 'Name'));
	 $list = CHtml::listData($models, 'id', 'Name');
	 $var = array();
	 foreach ($models as $key => $model) {
	 	$var[(string) $model->id] = array('units'=> ((string) $model->SIUnit));	
	 }

	 echo CHtml::dropDownList('properties[1]', "", $list, array('empty'=>"Select a property", 'class'=>"property", 'num'=>"1", 'id'=>"property_select1", 'options'=>$var) ); */?>
     
<?php 
$modelvar=new Variables;
		$modelvar->unsetAttributes();  // clear any default values
	    if(isset($_GET['Variables'])){
			$modelvar=new Variables('search');
			$modelvar->attributes=$_GET['Variables'];
		}
//  $this->widget('ext.autoComplete', array(
//     'model'=>$modelvar,
// 	'id'=>"property_select1",
// 	'attribute'=>'id',
//     'name'=>'properties[1]',
//     'source'=>Yii::app()->createUrl('input/propertiesAutoComplete'), 
// 	'htmlOptions'=>array(
//         'style'=>'height:15px;',
// 		 ), 
//     'options'=>array(
//         'minLength'=>'0',
// 		'num'=>"1",
//     ),
            
// ));
?>

<br>

<div id="property_vals">
	<label for="properties[1]">Select Property 1:</label>
	<input type="text" class="property" id="property_select1" name="properties[1]" num="1"> <br>
	<label id="property_label1" for="properties_val[1]">Property</label>
	<input type="text" id="properties1_val"  num="1" name="properties_val[1]" placeholder="Input value here..."> <!-- <span id="property_units1"> Units </span> -->
	<label id="property_error_label1" for="properties_error[1]" num="1"> Error for measurement: </label>
	<input type="text" id="properties1_error" num="1" name="properties_error[1]">
<br>
</div>
<br>

<p>Click "Add Property Value" to add associated data values for the recorded property. For example, if you measured a density of 4 kg/m^2, you could add the volume or mass here as well. </p>


<button id="add_property_btn">Add Property Value</button>
<br><br>
</div>

<br>




<h3>Factors </h3>
<!-- <label for="factors[0]">Temperature (in degrees K): </label>
<input type="number" id="temp" name="factors[0]"  >
 -->

<div id="factors_vals">
<label for="factors[1]" >Select Factor: </label>

	<input type="text" class="factors" id="factors_select1" name="factors[1]" num="1" > <br>
	<label id="factors_label1" for="factors_val[1]">Factors</label><input type="text" id="factors1_val" name="factors_val[1]" placeholder="Input value here..."> <!-- <span id="factors_units1"> Units </span> -->


<br>

</div>
<br>

<p>Click "Add Factor Value" to add associated data values for more factors. For example, if you measured a temperature of 400 K, you could add the volume or mass here as well. </p>

<button id="add_factor_btn" >Add Factor Value</button>
<br>
<br>
<br>

<h4>Error Measures</h4>
	
	<label for="error"> Error Value</label>
<input type="text" placeholder="Input Error Measure..." width="100px" name="error"></input>

<div id="references" >
<h4 style="text-color:black;">Citations (*required) and DOI </h4>


<textarea  placeholder="Input references or citations here..." rows="5" cols="80" name="citations" > 
</textarea>

<textarea placeholder="Input DOI here..." rows="1" cols="80" name="doi">
</textarea>
<br>
<input type="submit" value="Submit Input Data">


<?php $this->endWidget(); ?>
</div>

</form>




