<?php
/* @var $this MaterialComponentsController */
/* @var $model MaterialComponents */

$this->breadcrumbs=array(
	'Material Components'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MaterialComponents', 'url'=>array('index')),
	array('label'=>'Create MaterialComponents', 'url'=>array('create')),
	array('label'=>'View MaterialComponents', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MaterialComponents', 'url'=>array('admin')),
);
?>

<h1>Update MaterialComponents <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>