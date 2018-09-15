<?php
/* @var $this MaterialPropValsController */
/* @var $model MaterialPropVals */

$this->breadcrumbs=array(
	'Material Prop Vals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MaterialPropVals', 'url'=>array('index')),
	array('label'=>'Manage MaterialPropVals', 'url'=>array('admin')),
);
?>

<h1>Create MaterialPropVals</h1>

<?php $this->renderPartial('create_form', array('model'=>$model)); ?>