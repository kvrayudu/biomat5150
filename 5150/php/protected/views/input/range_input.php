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

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/range_input.js', CClientScript::POS_END);

?>


<br>
<a class=" tab nav_link " href=<?php echo Yii::app()->createUrl("input/" . $model->id); ?> >Point Input</a>
<a class=" tab nav_link" href=<?php echo Yii::app()->createUrl("input/formula/" . $model->id); ?> >Formula Input</a>
 <a class=" tab nav_link selected " href="#">Range Input</a>

<span id="property_autocomplete_url" hidden><?php echo Yii::app()->createUrl("input/propertyAutocomplete");?></span>
<span id="factor_autocomplete_url" hidden><?php echo Yii::app()->createUrl("input/factorAutocomplete");?></span>
<span id="variable_autocomplete_url" hidden><?php echo Yii::app()->createUrl("input/variableAutocompleteUnits");?></span>

<br>
<br>
<br>
<br>


<h2><?php  echo "Input Data for: " . $model->Name  ?> </h2>
<span><em> Can't find factor or property?</em> Email admin at <a mailto="akd1@cornell.edu">  akd1@cornell.edu.</a> </span> 



<br>
<br>

<form name="input" action=<?php echo Yii::app()->createUrl("input/rangeInput"); ?>  method="post" enctype="multipart/form-data">


<?php $form=$this->beginWidget('CActiveForm', 
    array(
        'id'=>'input',
        'enableClientValidation'=>true,
        'clientOptions'=>array('validateOnSubmit'=>true,'validateOnChange'=>true)
    )); ?>
<input type="hidden" name="Material_id" value=<?php  echo $model->id ?> >
<br>







<label for="variable">Variable: </label>
<input type="text" style="width:200px" class="variable" id="variable" name="variable" > 






<label for="low">   Low Value: </label>
<input type="text"  id="low" name="low" >

<label for="high"> High Value: </label>
<input type="text" id="high" name="high">

<br>


<br>




<div id="references" >
<h4 style="text-color:black;">Citations (*required) and DOI </h4>


<textarea  placeholder="Input references or citations here..." rows="5" cols="80" name="citations" > 
</textarea>

<textarea placeholder="Input DOI here..." rows="1" cols="80" name="doi">
</textarea>
<br>
<input type="submit" value="Submit Range Data">


<?php $this->endWidget(); ?>
</div>

</form>





