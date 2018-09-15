<?php
/* @var $this MaterialPropValsController */
/* @var $model MaterialPropVals */
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
		<?php echo $form->label($model,'Value'); ?>
		<?php echo $form->textField($model,'Value'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Citations'); ?>
		<?php echo $form->textField($model,'Citations',array('size'=>60,'maxlength'=>8000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TimeStamp'); ?>
		<?php echo $form->textField($model,'TimeStamp'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MeasurementGroup'); ?>
		<?php echo $form->textField($model,'MeasurementGroup'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IsApproved'); ?>
		<?php echo $form->textField($model,'IsApproved'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SetID'); ?>
		<?php echo $form->textField($model,'SetID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'User_id'); ?>
		<?php echo $form->textField($model,'User_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Property_id'); ?>
		<?php echo $form->textField($model,'Property_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Material_id'); ?>
		<?php echo $form->textField($model,'Material_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->