<?php
/* @var $this InputController */

$this->breadcrumbs=array(
	'Input'=>array('/input'),
	'View',
);

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('jquery.ui');
    
    Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/input.css');

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/formula_input.js', CClientScript::POS_END);

?>

<br>
<a class=" tab nav_link " href=<?php echo Yii::app()->createUrl("input/" . $model->id); ?> >Point Input</a>
<a class=" tab nav_link selected" href="#" >Formula Input</a>
<a class=" tab nav_link " href=<?php echo Yii::app()->createUrl("input/range/" . $model->id); ?> >Range Input</a>


<br>
<br>
<br>
<br>
<span id="variable_autocomplete_url" style="display:none" value=<?php echo Yii::app()->createUrl("input/variableAutocomplete"); ?>> </span>
<span id="formula_parse_url" style="display:none" value=<?php echo Yii::app()->createUrl("input/parseFormula"); ?>> </span>

<h2><?php  echo "Input Data for: " . $model->Name  ?> </h2>
<span><em> Can't find factor or property?</em> Email admin at akd1@cornell.edu.</span> 
<div >
<form id="formula_input_form" name="input" action=<?php echo Yii::app()->createUrl("input/formulaInput"); ?>  method="post" >

<input type="hidden" name="Material_id" value=<?php  echo $model->id ?> >
<br>

<h3>Please input formula name:  <input required type="text" name="formula_name" placeholder="Input Formula Name" > </input></h3>

<br>
<!-- <label for="factors[0]">Temperature (in degrees K): </label>
<input type="number" id="temp" name="factors[0]"  >
 -->
<label for="material">Insert material (property or factor): </label>

<?php /* $models = Material::model()->findAll(array('order' => 'Name'));
	 $list = CHtml::listData($models, 'Name', 'Name');

	 echo CHtml::dropDownList('material', "", $list, 
	 			array('empty'=>"Select a material", 'class'=>"material", 'id'=>"material_select") ); */
				?>
<?php  $this->widget('ext.autoComplete', array(
    'model'=>$model,
	//'class'=>"material",
	'id'=>"material_select",
    'attribute'=>'id',
    'name'=>'material',
    'source'=>Yii::app()->createUrl('homepage/materialAutoComplete'), 
	'htmlOptions'=>array(
        'style'=>'height:15px;',
    ), 
    //'options'=>$var,
            
));
?>
<button id="add_material_btn" > Add more materials</button>

<textarea placeholder="Add more valid materials here..." form="formula_input_form" readonly name="materials" rows="5" cols="80" id="materials" >
<?php  echo $model->Name . ";";  ?>
</textarea>

 <br>
<input type="checkbox" name="make_group" value="yes"> Make this set of materials a group: </input>
<input type="text" name="group_name" placeholder="New group name" > </input>

<br>
<br>
<br>

<label for="material">If valid for a group of materials: </label>
<?php /*$models = Groups::model()->findAll(array('order' => 'GroupName'));
	 $list = CHtml::listData($models, 'GroupName', 'GroupName');

	 echo CHtml::dropDownList('group', "", $list, 
	 			array('empty'=>"Select a group", 'class'=>"group", 'id'=>"group_select") ); */?>
                
 <?php   $this->widget('ext.autoComplete', array(
    'model'=>$model,
	
	'id'=>"group_select",
    'attribute'=>'id',
    'name'=>'group',
    'source'=>Yii::app()->createUrl('input/groupsAutocomplete'), 
	'htmlOptions'=>array(
        'style'=>'height:15px;',
    ), 
    
));
?>               
<button id="add_group_btn"> Add more groups</button>

<textarea placeholder="Add more valid groups here..."  readonly rows="5" cols="80" id="groups" name="groups">
</textarea>
<br><br><br>



<h3>Property Measured</h3>
<br>
<label for="property">Measured Property: </label>
<?php /*$models = Variables::model()->findAllByAttributes(array('IsFactor' =>'0'), array('order' => 'Name'));
	 $list = CHtml::listData($models, 'id', 'Name');

	 echo CHtml::dropDownList('property', "", $list, 
	 			array('empty'=>"Select a property", 'class'=>"property", 'id'=>"property_select") ); */?>
                
<?php   $this->widget('ext.autoComplete', array(
    'model'=>$model,
	
	'id'=>"property_select",
    'attribute'=>'id',
    'name'=>'property',
    'source'=>Yii::app()->createUrl('input/propertiesAutocomplete'), 
	'htmlOptions'=>array(
        'style'=>'height:15px;',
    ), 
    
));
?>    

<br>

<br>

<button id="sin_btn" type="button"> sin</button>
<button id="cos_btn" type="button"> cos</button>
<button id="tan_btn" type="button"> tan</button>
<button id="add_btn" type="button"> +</button>
<button id="subtract_btn" type="button"> - </button>
<button id="mult_btn" type="button"> *</button>
<button id="div_btn" type="button"> /</button>
<button id="pow_btn" type="button"> pow()</button>

<label for="variable">Insert variable (property or factor): </label>
<input type="text" name="variable" id="variable">
<?php /*$models = Variables::model()->findAll(array('order' => 'Name'));
	 $list = CHtml::listData($models, 'Name', function($variable){
	 	return CHtml::encode($variable->Name . ", " . $variable->SIUnit);
	 });
	 
	 echo CHtml::dropDownList('variable', "", $list, 
	 			array('empty'=>"Select a variable", 'class'=>"variable", 'id'=>"variable_select") );*/ ?>
   <?php             
//    $this->widget('ext.autoComplete', array(
//     'model'=>$model,
	
// 	'id'=>"variable_select",
//     'attribute'=>'id',
//     'name'=>'variable',
//     'source'=>Yii::app()->createUrl('dataView/variablesAutocomplete'), 
// 	'htmlOptions'=>array(
//         'style'=>'height:15px;',
//     ), 
    
// ));
?>                

<button id="insert_btn" type="button"> Insert</button>
<br>
<br>

<p> Note that pow(base, exponent) =  base^exponent </p>
<div id="valid_ranges">
</div>
<br>
<label for="formula"> Insert a formula for property: </label>
<?php /*$models = Formula::model()->findAll(array('order' => 'Name'));
	 $list = CHtml::listData($models, 'FormulaText', 'Name');

	 echo CHtml::dropDownList('formula', "", $list, 
	 			array('empty'=>"Select a formula", 'class'=>"formula", 'id'=>"formula_select") ); */?>
                
<?php  
$modelfor=new Formula;
		$modelfor->unsetAttributes();  // clear any default values
	    if(isset($_GET['Formula'])){
			$modelfor=new Formula('search');
			$modelfor->attributes=$_GET['Formula'];
		}

 $this->widget('ext.autoComplete', array(
    'model'=>$modelfor,
	
	'id'=>"formula_select",
    'attribute'=>'id',
    'name'=>'formula',
    'source'=>Yii::app()->createUrl('input/formulaAutocomplete'), 
	'htmlOptions'=>array(
        'style'=>'height:15px;',
    ), 
    
));
?>
<button id="insert_formula_btn" type="button"> Insert Formula</button>

<br>

<textarea required placeholder="Input formula here..." rows="5" cols="80" id="formula_textarea" name="formula_text">
</textarea>


<div id="parse_result" >

</div>

<br>
<br>

<h4>Error Measures</h4>
	<label for="r_squared">R^2 Value</label>
<input type="text" placeholder="Input R^2 here..."  name="r_squared">
</input type="text">
	<label for="std_error">Standard Error Value</label>
<input type="text" placeholder="Input Standard Error..." width="100px" name="std_error">
</input type="text">

<br>
<br>
<br>
<h4>Description</h4>
<textarea placeholder="Input description here..." rows="5" cols="80" name="description">
</textarea>
<h4 style="text-color:black;">Citations (*required) and DOI </h4>

<textarea required placeholder="Input references or citations here..." rows="5" cols="80" name="citations">
</textarea>

<textarea placeholder="Input DOI here..." rows="1" cols="80" name="doi">
</textarea>


<br>





<input type="submit" value="Submit Formula">
</form>

