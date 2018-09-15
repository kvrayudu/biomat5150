<?php
/* @var $this FormulaController */
/* @var $model Formula */
/* @var $form CActiveForm */

// <?php
// public function actionInput()
// {
//     $model=new Formula;

//     // uncomment the following code to enable ajax-based validation
    
//     if(isset($_POST['ajax']) && $_POST['ajax']==='formula-input-form')
//     {
//         echo CActiveForm::validate($model);
//         Yii::app()->end();
//     }
    

//     if(isset($_POST['Formula']))
//     {
//         $model->attributes=$_POST['Formula'];
//         if($model->validate())
//         {
//             // form inputs are valid, do something here
//             return;
//         }
//     }
//     $this->render('input',array('model'=>$model));
// }

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formula-input-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'FormulaProperty'); ?>
		<?php echo $form->textField($model,'FormulaProperty'); ?>
		<?php echo $form->error($model,'FormulaProperty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FormulaText'); ?>
		<?php echo $form->textField($model,'FormulaText'); ?>
		<?php echo $form->error($model,'FormulaText'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name'); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'References'); ?>
		<?php echo $form->textField($model,'References'); ?>
		<?php echo $form->error($model,'References'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Description'); ?>
		<?php echo $form->textField($model,'Description'); ?>
		<?php echo $form->error($model,'Description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ValidMaterials'); ?>
		<?php echo $form->textField($model,'ValidMaterials'); ?>
		<?php echo $form->error($model,'ValidMaterials'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ValidGroups'); ?>
		<?php echo $form->textField($model,'ValidGroups'); ?>
		<?php echo $form->error($model,'ValidGroups'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->