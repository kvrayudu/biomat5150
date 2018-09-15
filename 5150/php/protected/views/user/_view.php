<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Username')); ?>:</b>
	<?php echo CHtml::encode($data->Username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Password')); ?>:</b>
	<?php echo CHtml::encode($data->Password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eMail')); ?>:</b>
	<?php echo CHtml::encode($data->eMail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Affiliation')); ?>:</b>
	<?php echo CHtml::encode($data->Affiliation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Permissions')); ?>:</b>
	<?php echo CHtml::encode($data->Permissions); ?>
	<br />


</div>