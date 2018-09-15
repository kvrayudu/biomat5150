<?php
/* @var $this GroupsController */
/* @var $model Groups */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groups-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'GroupName'); ?>
		<?php echo $form->textField($model,'GroupName',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'GroupName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MaterialsInGroup'); ?>
		<?php echo $form->textField($model,'MaterialsInGroup',array('size'=>60,'maxlength'=>8191)); ?>
		<?php echo $form->error($model,'MaterialsInGroup'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
