<?php
/* @var $this GroupsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Groups',
);

$this->menu=array(
	array('label'=>'Create Groups', 'url'=>array('create')),
	array('label'=>'Manage Groups', 'url'=>array('admin')),
);
?>

<h1>Groups</h1>

<?php 

$html = "<table><tr><td>Group Name </td><td>Materials in Group</td></tr>";

foreach ($names as $name => $name_list) {

    $html = $html . "<tr><td>$name</td><td>$name_list</td></tr>";

}

$html = $html . "</table>";

echo($html);

 ?>
