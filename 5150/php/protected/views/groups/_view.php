<?php
/* @var $this GroupsController */
/* @var $data Groups */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GroupName')); ?>:</b>
	<?php echo CHtml::encode($data->GroupName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MaterialsInGroup')); ?>:</b>
	<?php echo CHtml::encode($data->MaterialsInGroup); ?>
	<br />


</div>