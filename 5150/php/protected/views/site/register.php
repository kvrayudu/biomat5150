<?php $this->pageTitle=Yii::app()->name . ' - Register'; ?>

<h1>Register</h1>

<div class="yiiForm">
<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($form); ?>

<div class="simple">
<p class="hint" style="margin-left:0px;">
Please Note: 
<br/>
Your login name will be converted to lower case characters.
<br/>
This is to insure later use of these are not case-sentively forgotten.
</p>
<br/>
<p class="hint" style="margin-left:0px;">
Note: Your login name must be unique and a max of 32 characters.
</p>
<?php echo CHtml::activeLabel($form,'Username', array('style'=>'width:150px;')); ?>
<?php echo CHtml::activeTextField($form,'Username') ?>
</div>

<div class="simple">
<?php echo CHtml::activeLabel($form,'Password', array('style'=>'width:150px;')); ?>
<?php echo CHtml::activePasswordField($form,'Password') ?>
</div>

<div class="simple">
<?php echo CHtml::activeLabel($form,'Password2', array('style'=>'width:150px;')); ?>
<?php echo CHtml::activePasswordField($form,'Password2') ?>
</div>

<div class="simple">
<?php echo CHtml::activeLabel($form,'eMail', array('style'=>'width:150px;')); ?>
<?php echo CHtml::activeTextField($form,'eMail') ?>
</div>

<br/>


<br/>

<?php if(extension_loaded('gd')): ?>
<div class="simple">
        <?php echo CHtml::activeLabel($form,'verifyCode', array('style'=>'width:150px;')); ?>
        <div>
        <?php $this->widget('CCaptcha'); ?>
        <?php echo CHtml::activeTextField($form,'verifyCode'); ?>
        </div>
        <p class="hint">Please enter the letters as they are shown in the image above.
        <br/>Letters are not case-sensitive.</p>
</div>
<?php endif; ?>

<div class="action">
<?php echo CHtml::submitButton('Register'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->