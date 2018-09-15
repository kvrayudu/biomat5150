<?php
/* @var $this DataViewController */

$this->breadcrumbs=array(
	'Data View'=>array('/dataView'),
	'View',
);
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/view.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerCssFile("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css");

?>


<h2><?php  echo "Material: " . $model->Name  ?> </h2>

<div >
	<span id="baseUrlDependent" style="display:none"><?php echo Yii::app()->createUrl("dataView/getDependentVariables") ?></span>
	<span id="baseUrlFormulas" style="display:none"><?php echo Yii::app()->createUrl("dataView/getFormulas") ?></span>
	<span id="baseUrlConstraints" style="display:none"><?php echo Yii::app()->createUrl("dataView/getConstraints") ?></span>
	<span id="baseUrlYVariables" style="display:none"><?php echo Yii::app()->createUrl("dataView/getPossibleYVariables") ?></span>
	<span id="baseUrlSubformulaConstraints" style="display:none"><?php echo Yii::app()->createUrl("dataView/getSubformulaConstraints") ?></span>

<form name="dataview" action=<?php echo Yii::app()->createUrl("dataView/plot"); ?>  method="get" >


<input type="hidden" id="material_id" name="Material_id" value=<?php  echo $model->id ?> >

<h3>Y-axis</h3>

<label for="variable">Variable: </label>
<input type="text" id="variable" name="variable" required>
<?php /*$models = Variables::model()->findAll(array('order' => 'Name'));
	 $list = CHtml::listData($models, 'id', 'Name');
	 echo CHtml::dropDownList('variable', "", $list, array('empty'=>"Select a Variable",'class'=>'var',  'id'=>"variable") ); */?>


<br>
<br>
<br>
<br>

<h3>X-axis</h3>
<label for="dependent_variable">Variable Plotted Against: </label>
<select class="var", id="dependent_variable" name="dependent_variable">
	<option>Pick one</option>

</select>

<br>
<br>

<div id="requestFormulaValues">

</div>

<label for="range"> <b>Plot X-Range: </b></label>
<span id="range"> 
	Lower Limit: <input type="number" name="range_low" value="0" >  
	Upper Limit: <input type="number" name="range_high" value="0" > 
	<span id="units"> Units </span>
</span>
<br>
<br>

<input type="checkbox" name="view_existing" value="yes"> View Existing Data Points <br>
<!-- Constrain the following factors:
 --><!-- 	to-do
 -->
<br>
<br>

<br>
<input type="checkbox" name="view_predicted_line" value="yes"> View Predicted Data Line</input> <br>
<br>

<div id="predicted" style="padding:20px">


<label for="formula">Equation to predict Y Var: </label>

<select id="formula" name="formula">
	<option>Pick one</option>

</select>




<br>

<div id="constraints">

</div>
<!-- 
<input type="checkbox" name="custom" value="yes"> Use Custom Composition</input><br>


<input type="checkbox" name="usda" value="yes"> Use USDA Composition<br> -->


</div>

<input type="submit" value="Plot">

</form>
</div>

