<?php
/* @var $this MaterialComponentsController */
/* @var $model MaterialComponents */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'Value'); ?>
		<?php echo $form->textField($model,'Value'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SetID'); ?>
		<?php echo $form->textField($model,'SetID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Component_id'); ?>
		<?php echo $form->textField($model,'Component_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Material_id'); ?>
		<?php echo $form->textField($model,'Material_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->