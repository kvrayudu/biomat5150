<?php
/* @var $this FormulaController */
/* @var $data Formula */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FormulaID')); ?>:</b>
	<?php echo CHtml::encode($data->FormulaID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FormulaVariable')); ?>:</b>
	<?php echo CHtml::encode($data->FormulaVariable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FormulaText')); ?>:</b>
	<?php echo CHtml::encode($data->FormulaText); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TimeStamp')); ?>:</b>
	<?php echo CHtml::encode($data->TimeStamp); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Citations')); ?>:</b>
	<?php echo CHtml::encode($data->Citations); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DOI')); ?>:</b>
	<?php echo CHtml::encode($data->DOI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DependentVariable')); ?>:</b>
	<?php echo CHtml::encode($data->DependentVariable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DependentVariableLowRange')); ?>:</b>
	<?php echo CHtml::encode($data->DependentVariableLowRange); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DependentVariableHighRange')); ?>:</b>
	<?php echo CHtml::encode($data->DependentVariableHighRange); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsApproved')); ?>:</b>
	<?php echo CHtml::encode($data->IsApproved); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('User_id')); ?>:</b>
	<?php echo CHtml::encode($data->User_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ValidMaterials')); ?>:</b>
	<?php echo CHtml::encode($data->ValidMaterials); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ValidGroups')); ?>:</b>
	<?php echo CHtml::encode($data->ValidGroups); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Error')); ?>:</b>
	<?php echo CHtml::encode($data->Error); ?>
	<br />

	*/ ?>

</div>