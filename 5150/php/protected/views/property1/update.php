<?php
/* @var $this PropertyController */
/* @var $model Property */

$this->breadcrumbs=array(
	'Properties'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Property', 'url'=>array('index')),
	array('label'=>'Create Property', 'url'=>array('create')),
	array('label'=>'View Property', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Property', 'url'=>array('admin')),
);
?>

<h1>Update Property <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>