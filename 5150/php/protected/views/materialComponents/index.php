<?php
/* @var $this MaterialComponentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Material Components',
);

$this->menu=array(
	array('label'=>'Create MaterialComponents', 'url'=>array('create')),
	array('label'=>'Manage MaterialComponents', 'url'=>array('admin')),
);
?>

<h1>Material Components</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
