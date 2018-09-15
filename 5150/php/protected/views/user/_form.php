<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Username'); ?>
		<?php echo $form->textField($model,'Username',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Password'); ?>
		<?php echo $form->passwordField($model,'Password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'eMail'); ?>
		<?php echo $form->textField($model,'eMail',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'eMail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Affiliation'); ?>
		<?php echo $form->textField($model,'Affiliation',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Affiliation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Permissions'); ?>
		<?php echo $form->textField($model,'Permissions'); ?>
		<?php echo $form->error($model,'Permissions'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->