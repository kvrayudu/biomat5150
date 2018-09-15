<?php
/* @var $this MaterialPropValsController */
/* @var $model MaterialPropVals */

$this->breadcrumbs=array(
	'Material Prop Vals'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MaterialPropVals', 'url'=>array('index')),
	array('label'=>'Create MaterialPropVals', 'url'=>array('create')),
	array('label'=>'Update MaterialPropVals', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MaterialPropVals', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MaterialPropVals', 'url'=>array('admin')),
);
?>

<h1>View MaterialPropVals #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'Value',
		'Citations',
		'TimeStamp',
		'MeasurementGroup',
		'IsApproved',
		'SetID',
		'User_id',
		'Property_id',
		'Material_id',
	),
)); ?>
