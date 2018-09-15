<?php
/* @var $this FormulaController */
/* @var $model Formula */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FormulaID'); ?>
		<?php echo $form->textField($model,'FormulaID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FormulaVariable'); ?>
		<?php echo $form->textField($model,'FormulaVariable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FormulaText'); ?>
		<?php echo $form->textField($model,'FormulaText',array('size'=>60,'maxlength'=>8000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Description'); ?>
		<?php echo $form->textField($model,'Description',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TimeStamp'); ?>
		<?php echo $form->textField($model,'TimeStamp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Citations'); ?>
		<?php echo $form->textField($model,'Citations',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DOI'); ?>
		<?php echo $form->textField($model,'DOI',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DependentVariable'); ?>
		<?php echo $form->textField($model,'DependentVariable'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DependentVariableLowRange'); ?>
		<?php echo $form->textField($model,'DependentVariableLowRange'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DependentVariableHighRange'); ?>
		<?php echo $form->textField($model,'DependentVariableHighRange'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IsApproved'); ?>
		<?php echo $form->textField($model,'IsApproved'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'User_id'); ?>
		<?php echo $form->textField($model,'User_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ValidMaterials'); ?>
		<?php echo $form->textField($model,'ValidMaterials',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ValidGroups'); ?>
		<?php echo $form->textField($model,'ValidGroups',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Error'); ?>
		<?php echo $form->textField($model,'Error'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->