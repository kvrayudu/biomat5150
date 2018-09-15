<?php
/* @var $this PropertyController */
/* @var $data Property */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PropertyName')); ?>:</b>
	<?php echo CHtml::encode($data->PropertyName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SIUnit')); ?>:</b>
	<?php echo CHtml::encode($data->SIUnit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />


</div>