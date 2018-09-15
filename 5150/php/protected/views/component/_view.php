<?php
/* @var $this ComponentController */
/* @var $data Component */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ComponentName')); ?>:</b>
	<?php echo CHtml::encode($data->ComponentName); ?>
	<br />


</div>