<?php
/* @var $this MaterialPropValsController */
/* @var $model MaterialPropVals */
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
        <?php echo $form->labelEx($model,'Property_id'); ?>
        <?php echo $form->dropDownList($model,'Property_id', CHtml::listData(Property::model()->findAll(), 'id', 'PropertyName')); ?>
        <?php echo $form->error($model,'Property_id'); ?>
    </div>

    <div class="row">


    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->