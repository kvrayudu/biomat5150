<?php
/* @var $this MaterialComponentsController */
/* @var $model MaterialComponents */

$this->breadcrumbs=array(
	'Material Components'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MaterialComponents', 'url'=>array('index')),
	array('label'=>'Manage MaterialComponents', 'url'=>array('admin')),
);
?>

<h1>Create MaterialComponents</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>