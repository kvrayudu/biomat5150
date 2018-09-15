
<?php

/* @var $this GroupsController */
/* @var $model Groups */
$this->breadcrumbs=array(
	'Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Groups', 'url'=>array('index')),
	array('label'=>'Manage Groups', 'url'=>array('admin')),
);
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('jquery.ui');

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/group_input.js', CClientScript::POS_END);

?>

<h1>Create Groups</h1>

<?php //$this->renderPartial('_form', array('model'=>$model)); ?>

<form id="group_form" name="Groups" action=<?php echo Yii::app()->createUrl("groups/create"); ?>  method="post" >
<label for="group_name">Group Name:</label>
<input type="text" placeholder="Input Group Name Here" id = "group_name" width="100px" name="group_name"/>
<br/>
<!-- <input type="text" placeholder="Type Material Name Here..." width="100px" name="material_name">
 -->
 <br>

 <?php  $this->widget('ext.autoCompleteBasic', array(
			'model'=>$model,
			'attribute'=>'id',
			'name'=>'material_autocomplete',
			'source'=>Yii::app()->createUrl('homepage/materialAutoComplete'),
			'options'=>array(
				'minLength'=>'0',
			),
			'htmlOptions'=>array(
				'size'=>60,'maxlength'=>10000,
				),
		));
		?>
<button id="add_material_btn" type="button"> Insert Material</button>
<p id="mat_names">Materials in Group: </p>
<input id="names" type="hidden" value="" name="names">

<br>
<br>
<input type="submit" value="Submit Group">

</form>
