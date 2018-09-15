<?php
/* @var $this InputController */

$searchUrl = Yii::app()->createUrl("homepage");
$addUrl = Yii::app()->createUrl("input/") . "/". $material_id;


?>

<h2> Range submitted sucessfully! </h2>

<a href=<?php echo $searchUrl?>> Go back to search page</a>
<a href=<?php echo $addUrl?>>Add more points for this material<a>

