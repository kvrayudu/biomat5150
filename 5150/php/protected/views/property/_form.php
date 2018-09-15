<?php
/* @var $this PropertyController */
/* @var $model Property */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'property-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'PropertyName'); ?>
		<?php echo $form->textField($model,'PropertyName',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'PropertyName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SIUnit'); ?>
		<?php echo $form->textField($model,'SIUnit',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'SIUnit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Description'); ?>
		<?php echo $form->textField($model,'Description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->