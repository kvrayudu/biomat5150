<?php
/* @var $this MaterialPropValsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Material Prop Vals',
);

$this->menu=array(
	array('label'=>'Create MaterialPropVals', 'url'=>array('create')),
	array('label'=>'Manage MaterialPropVals', 'url'=>array('admin')),
);
?>

<h1>Material Prop Vals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
