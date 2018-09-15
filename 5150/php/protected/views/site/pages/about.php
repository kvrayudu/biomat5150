<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>About</h1>

<p>This site is meant for users to store, retrieve, and visualize physical properties of food materials.</p>
<br>
<br>
<p>To start your adventure, type a food name into the input box and click 'Search'. This will bring you to a page listing the names of foods matching the input. For each food there will be two options, represented by little icons of a magnifying glass and a pencil. The magnifying glass will lead you to a page where you can view formula data corresponding to a chosen input food. The pencil icon will allow the input of new data points representing measurements of properties like temperature, density, thermal conductivity,etc...</p>
<br>
<p>In the data view page, you can select data for plotting. For a given food, there will be choices for the y-axis variable, and the corresponding x-axis variables (These are provided such that there is a formula that maps from the x-axis to the chosen y-axis variable. Select the desired range for the x-axis variable and select both checkboxes. Given the prior selections, the site will automatically determine the possible formulae. If the formula requires composition information for the chosen food (E.G. is not a function of only the x-variable), input boxes will appear, filled with the food's composition information for the given properties if it exists (i.e. if there are measurements for carbohydrates and fat, those will be filled in), or 'NOT_FOUND' if the property is not found in the database. The 'Plot' button will chart the given formula and points.</p>
<br>
<br>
<p>The update page will allow you to input data points or new formulas.</p>
<br>
<br>
<h2>What is a Formula?</h2>
<br>
<p>A formula relates a variable to another variable. For example, "#D = pow(10,(-4.4977  + (-581.28) / (115.71 - #Tk~)))" relates viscosity to temperature in Kelvin for certain oils. Some formulae require only one variable, such as the previous example, but others require composition information, such as the fat content or carbohydrate content.</p>
