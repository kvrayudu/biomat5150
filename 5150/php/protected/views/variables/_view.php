<?php
/* @var $this VariablesController */
/* @var $data Variables */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SIUnit')); ?>:</b>
	<?php echo CHtml::encode($data->SIUnit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsFactor')); ?>:</b>
	<?php echo CHtml::encode($data->IsFactor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Symbol')); ?>:</b>
	<?php echo CHtml::encode($data->Symbol); ?>
	<br />


</div>