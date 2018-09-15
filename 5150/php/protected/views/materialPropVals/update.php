<?php
/* @var $this MaterialPropValsController */
/* @var $model MaterialPropVals */

$this->breadcrumbs=array(
	'Material Prop Vals'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MaterialPropVals', 'url'=>array('index')),
	array('label'=>'Create MaterialPropVals', 'url'=>array('create')),
	array('label'=>'View MaterialPropVals', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MaterialPropVals', 'url'=>array('admin')),
);
?>

<h1>Update MaterialPropVals <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>