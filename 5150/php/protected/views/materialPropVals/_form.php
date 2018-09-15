<?php
/* @var $this MaterialPropValsController */
/* @var $model MaterialPropVals */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'material-prop-vals-form',
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
		<?php echo $form->labelEx($model,'Citations'); ?>
		<?php echo $form->textField($model,'Citations',array('size'=>60,'maxlength'=>8000)); ?>
		<?php echo $form->error($model,'Citations'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TimeStamp'); ?>
		<?php echo $form->textField($model,'TimeStamp'); ?>
		<?php echo $form->error($model,'TimeStamp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MeasurementGroup'); ?>
		<?php echo $form->textField($model,'MeasurementGroup'); ?>
		<?php echo $form->error($model,'MeasurementGroup'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IsApproved'); ?>
		<?php echo $form->textField($model,'IsApproved'); ?>
		<?php echo $form->error($model,'IsApproved'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SetID'); ?>
		<?php echo $form->textField($model,'SetID'); ?>
		<?php echo $form->error($model,'SetID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'User_id'); ?>
		<?php echo $form->textField($model,'User_id'); ?>
		<?php echo $form->error($model,'User_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Property_id'); ?>
		<?php echo $form->textField($model,'Property_id'); ?>
		<?php echo $form->error($model,'Property_id'); ?>
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