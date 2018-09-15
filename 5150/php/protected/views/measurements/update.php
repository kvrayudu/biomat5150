<?php
/* @var $this MeasurementsController */
/* @var $model Measurements */

$this->breadcrumbs=array(
	'Measurements'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Measurements', 'url'=>array('index')),
	array('label'=>'Create Measurements', 'url'=>array('create')),
	array('label'=>'View Measurements', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Measurements', 'url'=>array('admin')),
);
?>

<h1>Update Measurements <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>