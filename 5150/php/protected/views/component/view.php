<?php
/* @var $this ComponentController */
/* @var $model Component */

$this->breadcrumbs=array(
	'Components'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Component', 'url'=>array('index')),
	array('label'=>'Create Component', 'url'=>array('create')),
	array('label'=>'Update Component', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Component', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Component', 'url'=>array('admin')),
);
?>

<h1>View Component #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ComponentName',
	),
)); ?>
