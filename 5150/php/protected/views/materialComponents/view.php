<?php
/* @var $this MaterialComponentsController */
/* @var $model MaterialComponents */

$this->breadcrumbs=array(
	'Material Components'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MaterialComponents', 'url'=>array('index')),
	array('label'=>'Create MaterialComponents', 'url'=>array('create')),
	array('label'=>'Update MaterialComponents', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MaterialComponents', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MaterialComponents', 'url'=>array('admin')),
);
?>

<h1>View MaterialComponents #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Value',
		'SetID',
		'Component_id',
		'Material_id',
		'id',
	),
)); ?>
