<?php
/* @var $this MaterialComponentsController */
/* @var $model MaterialComponents */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'material-components-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Value'); ?>
		<?php echo $form->textField($model,'Value'); ?>
		<?php echo $form->error($model,'Value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SetID'); ?>
		<?php echo $form->textField($model,'SetID'); ?>
		<?php echo $form->error($model,'SetID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Component_id'); ?>
		<?php echo $form->textField($model,'Component_id'); ?>
		<?php echo $form->error($model,'Component_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Material_id'); ?>
		<?php echo $form->textField($model,'Material_id'); ?>
		<?php echo $form->error($model,'Material_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->