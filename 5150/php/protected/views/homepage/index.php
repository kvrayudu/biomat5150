<?php
/* @var $this HomepageController */
/* @var $model Material */
/* @var $form CActiveForm */



$form=$this->beginWidget('CActiveForm', array(
	'id'=>'homepage-form',
	'method'=>'get',
));
?>

 <h1>Biomaterial Database</h1>
<div class="wide form">
 <div class="row">
		<?php echo $form->label($model,'Material Name'); ?>
		<?php /* echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>255)); */?>
        <?php  $this->widget('ext.autoCompleteBasic', array(
			'model'=>$model,
			'attribute'=>'id',
			'name'=>'material_autocomplete',
			'source'=>Yii::app()->createUrl('homepage/materialAutoComplete'),  
			'options'=>array(
				'minLength'=>'0',
			),
			'htmlOptions'=>array(
				'size'=>60,'maxlength'=>255,
				),        
		));
		?>
        
</div> 

<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
</div>


<?php 
if (isset($_GET['Material'])) {

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'material-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'Name',
		'Description',
		'TimeStamp',
		'Citations',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view_data}{input}',
			'buttons'=>array(
				'view_data' => array( 
						'label' =>'View available property data',
						'imageUrl'=> Yii::app()->baseUrl . '/images/view.png',
						'url'=>'Yii::app()->createUrl("dataView/" . $data->id)',
			),
				'input' => array( 
						'label' =>'Input property data or formula',
						'imageUrl'=> Yii::app()->baseUrl . '/images/input.png',
						'url'=>'Yii::app()->createUrl("input/" . $data->id)',
			),
				),
		),
	),
)); 
}

?>



<div class="add_material_link">
	<a href=<?php echo Yii::app()->createUrl('material/create') ?> > Add a new material </a>
 </div>

</div>

<?php $this->endWidget(); ?>

