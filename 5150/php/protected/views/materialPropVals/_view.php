<?php
/* @var $this MaterialPropValsController */
/* @var $data MaterialPropVals */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Value')); ?>:</b>
	<?php echo CHtml::encode($data->Value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Citations')); ?>:</b>
	<?php echo CHtml::encode($data->Citations); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TimeStamp')); ?>:</b>
	<?php echo CHtml::encode($data->TimeStamp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MeasurementGroup')); ?>:</b>
	<?php echo CHtml::encode($data->MeasurementGroup); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsApproved')); ?>:</b>
	<?php echo CHtml::encode($data->IsApproved); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SetID')); ?>:</b>
	<?php echo CHtml::encode($data->SetID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('User_id')); ?>:</b>
	<?php echo CHtml::encode($data->User_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Property_id')); ?>:</b>
	<?php echo CHtml::encode($data->Property_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Material_id')); ?>:</b>
	<?php echo CHtml::encode($data->Material_id); ?>
	<br />

	*/ ?>

</div>