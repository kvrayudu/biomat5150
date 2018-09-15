
<?php
/* @var $this DataViewController */

$this->breadcrumbs=array(
	'Data View'=>array('/dataView'),
	'View',
);
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/plot.js', CClientScript::POS_END);

?>


<h2><?php  echo "Material: " . $material_name;  ?> </h2>
<span id="baseUrl" style="display:none"><?php echo Yii::app()->createUrl("dataView/getPoints"); ?></span>
<span id="material_id" style="display:none" value=<?php echo $material_id; ?>>  </span>
<span id="x_var_id" style="display:none" value=<?php echo $x_var_id; ?>> </span>
<span id="y_var_id" style="display:none" value=<?php echo $y_var_id; ?>> </span>

<span id="formula_data" style="display:none" value=<?php echo $data; ?>> </span> 

<div id="plot_div">

</div>


<script src="http://code.highcharts.com/highcharts.js"></script>


<script src="http://code.highcharts.com/modules/exporting.js"></script>
