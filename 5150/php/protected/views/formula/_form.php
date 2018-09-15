<?php
/* @var $this FormulaController */
/* @var $model Formula */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formula-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'FormulaID'); ?>
		<?php echo $form->textField($model,'FormulaID'); ?>
		<?php echo $form->error($model,'FormulaID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FormulaVariable'); ?>
		<?php echo $form->textField($model,'FormulaVariable'); ?>
		<?php echo $form->error($model,'FormulaVariable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FormulaText'); ?>
		<?php echo $form->textField($model,'FormulaText',array('size'=>60,'maxlength'=>8000)); ?>
		<?php echo $form->error($model,'FormulaText'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Description'); ?>
		<?php echo $form->textField($model,'Description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'Description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TimeStamp'); ?>
		<?php echo $form->textField($model,'TimeStamp'); ?>
		<?php echo $form->error($model,'TimeStamp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Citations'); ?>
		<?php echo $form->textField($model,'Citations',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'Citations'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DOI'); ?>
		<?php echo $form->textField($model,'DOI',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'DOI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DependentVariable'); ?>
		<?php echo $form->textField($model,'DependentVariable'); ?>
		<?php echo $form->error($model,'DependentVariable'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DependentVariableLowRange'); ?>
		<?php echo $form->textField($model,'DependentVariableLowRange'); ?>
		<?php echo $form->error($model,'DependentVariableLowRange'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DependentVariableHighRange'); ?>
		<?php echo $form->textField($model,'DependentVariableHighRange'); ?>
		<?php echo $form->error($model,'DependentVariableHighRange'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IsApproved'); ?>
		<?php echo $form->textField($model,'IsApproved'); ?>
		<?php echo $form->error($model,'IsApproved'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'User_id'); ?>
		<?php echo $form->textField($model,'User_id'); ?>
		<?php echo $form->error($model,'User_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ValidMaterials'); ?>
		<?php echo $form->textField($model,'ValidMaterials',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'ValidMaterials'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ValidGroups'); ?>
		<?php echo $form->textField($model,'ValidGroups',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'ValidGroups'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Error'); ?>
		<?php echo $form->textField($model,'Error'); ?>
		<?php echo $form->error($model,'Error'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->