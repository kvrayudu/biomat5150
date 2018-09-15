<?php
/* @var $this MaterialComponentsController */
/* @var $data MaterialComponents */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Value')); ?>:</b>
	<?php echo CHtml::encode($data->Value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SetID')); ?>:</b>
	<?php echo CHtml::encode($data->SetID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Component_id')); ?>:</b>
	<?php echo CHtml::encode($data->Component_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Material_id')); ?>:</b>
	<?php echo CHtml::encode($data->Material_id); ?>
	<br />


</div>