<?php
/* @var $this ComponentController */
/* @var $model Component */

$this->breadcrumbs=array(
	'Components'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Component', 'url'=>array('index')),
	array('label'=>'Create Component', 'url'=>array('create')),
	array('label'=>'View Component', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Component', 'url'=>array('admin')),
);
?>

<h1>Update Component <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>