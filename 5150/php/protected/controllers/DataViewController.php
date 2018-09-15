<?php

class DataViewController extends Controller
{

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionView($id)
	{
		

		$this->render('view', array(
			'model'=>$this->loadMaterial($id),
		));
	}


	public function actionGetPossibleYVariables($name, $material_id){


		$measurementSeriesIDRows = Yii::app()->db->createCommand()
			->selectDistinct('SeriesID')
			->from('Measurements')
			->where('Material_id='. $material_id)
			->queryAll();

		$measurementSeriesIDs = array();


		foreach ($measurementSeriesIDRows as $key => $array) {
			$measurementSeriesIDs[$key] = $array['SeriesID'];
		}

		$dependent_variable_ids = array();


		//should find all the single ones
		$dependent_variable_IDRows = Yii::app()->db->createCommand()
			->selectDistinct('Variable_id')
			->from('Measurements')
			->where(array('and', 'Material_id='. $material_id, 
					array('in', 'SeriesID', $measurementSeriesIDs)))
			->queryAll();


		foreach ($dependent_variable_IDRows as $key => $array) {
			$dependent_variable_ids[] = $array['Variable_id'];
		}





		$formula_vars = array();

		$groups = array();

		$material_string = '%;' .$material_id. ';%';

		//first grab the formulas for our material
		$FormulaIDS_variable_rows = Yii::app()->db->createCommand()
				->select('FormulaVariable')
				->from('Formula')
				->where( 'ValidMaterials LIKE :material')
				->queryAll($fetchAssociative=true, array(':material'=>$material_string));

		foreach ($FormulaIDS_variable_rows as $key => $rows) {
			
				$formulas_vars[] = $rows['FormulaVariable'];

		}


		
		$group_rows = Yii::app()->db->createCommand()
				->select('id')
				->from('Groups')
				->where( "MaterialsInGroup LIKE '%;" . $material_id. ";%'")
				->queryAll();

		// print_r($group_rows);
		
		foreach ($group_rows as $key => $row) {
			$group = $row['id'];
			$group = '%;' .$group . ';%';
			$FormulaIDS_variable_rows = Yii::app()->db->createCommand()
					->select('FormulaVariable')
					->from('Formula')
					->where( 'ValidGroups LIKE :group')
					->queryAll($fetchAssociative=true, array(':group'=>$group));
			

			foreach ($FormulaIDS_variable_rows as $index => $row) {
				$formulas_vars[] = $row['FormulaVariable'];
			}


		}


		if (count($formulas_vars)) {
			$all_var_ids = array_merge($dependent_variable_ids, $formulas_vars);
		}
		else{
			$all_var_ids = $dependent_variable_ids;
		}



		$name = $name . '%';


		$dependent_variables = Yii::app()->db->createCommand()
			->select('id, Name, SIUnit')
			->from('Variables')
			->where(array('and', "Name LIKE :name",
					array('in', 'id', $all_var_ids)))
			->queryAll($fetchAssociative=true,array(':name'=>$name));

		$response = array();

		foreach ($dependent_variables as $key => $value) {
			$response[] = $value['Name'] . " , " . $value['SIUnit'];
		}

		echo CJSON::encode($response);





	}


public function actionPlot(){
		$data = array();
		$material_id = $_GET['Material_id'];
		$material_name = $this->loadMaterial($material_id)->Name;

		foreach ($_GET as $key => $value) {
		//	print("\nkey is " . $key . " and value is " . $value . "\r\n"); 
		}


		$y_var_id = $_GET['variable'];
		$x_var_id = $_GET['dependent_variable'];

		$comma = strpos($y_var_id, ',');
		$y_var_id = substr($y_var_id, 0, $comma);

		$variable_id = Yii::app()->db->createCommand()
			->selectDistinct('id')
			->from('Variables')
			->where('Name= :name')
			->queryAll($fetchAssociative=true, array(':name' => $y_var_id));

		$y_var_id = $variable_id[0]['id'];
		$data['valid'] = 0;


		$data['range_low'] = $_GET['range_low'];
		$data['range_high'] = $_GET['range_high'];





		if (isset($_GET['view_predicted_line'])) {
			if ($_GET['view_predicted_line'] == "yes") {
				$data['valid'] = 1;
				if (isset($_GET['constraints'])) {
					$data['constraints'] = $_GET['constraints'];
					if(isset($_GET['choice'])){

						$data['subformulas'] = array();

							foreach ($_GET['choice'] as $key => $value) {
								if ($value == "data_value") {
									$data["constraints"][] = $_GET['choice_constraints'][$key];
								}
								if ($value == "formula") {
									$data['subformulas'][$key] = $_GET['formula_option_' . $key];
								}
							}

						}

					}

	
				$data['formula'] = $_GET['formula'];

			}
		}

		$this->render('plot', 
			array('material_name'=> $material_name, 
				  'material_id' => $material_id, 
				  'x_var_id' => $x_var_id, 
				  'y_var_id' =>$y_var_id,
				  'data'=>CJSON::encode($data)));


}







public function actionGetSubformulaConstraints($formula_id, $dependent_variable_id){

	$constraint_rows = Yii::app()->db->createCommand()
			->select('DependentVariable')
			->from('Formula')
			->where( "FormulaID=" . $formula_id . " AND NOT DependentVariable=" . $dependent_variable_id)
			->queryAll();

	$var_ids = array();
	foreach ($constraint_rows as $key => $value) {
		$var_ids[] = $value['DependentVariable'];

	}

	$constraints = array();
	foreach ($var_ids as $key => $id) {
		$model = $this->loadVariable($id);
		$constraints[$key] = array("Name"=>$model->Name, "Id"=>$model->id, "units"=>$model->SIUnit);
	}



	echo CJSON::encode($constraints);

}



public function actionGetConstraints($formula_id, $dependent_variable_id, $material_id){

	$constraints = array();


	//Get the rows for dependent variables that aren't this one. (Two-dim array)
	$constraint_rows = Yii::app()->db->createCommand()
			->select('DependentVariable')
			->from('Formula')
			->where( "FormulaID=" . $formula_id . " AND NOT DependentVariable=" . $dependent_variable_id)
			->queryAll();
	
	//Append the ID of each coefficient variable to var_ids
	$var_ids = array();
	foreach ($constraint_rows as $key => $value) {
		$var_ids[] = $value['DependentVariable'];//arraylist of integers

	}
	
	//Find the formulas where the coefficient is the formulaVariable
	$possible_sub_formulas = Yii::app()->db->createCommand()
			->selectDistinct('FormulaVariable, DependentVariable, FormulaID, FormulaText, Name')
			->from('Formula')
			->where( array('in', 'FormulaVariable', $var_ids))
			->queryAll();
	
	//choice_ids are the ids of the formula variables. 
	$choices = array();
	$choice_ids = array();
	foreach ($possible_sub_formulas as $key => $row) {
		$choice_ids[$row['FormulaVariable']] = $row['FormulaVariable'];
		if (!(array_key_exists($row['FormulaVariable'], $choices))) {
			$choices[$row['FormulaVariable']] = array();
		}
		//FormulaVariable and FormulaID correspond to a name and FormulaText
		$choices[$row['FormulaVariable']][$row['FormulaID']] = array("name" =>$row['Name'], "text" => $row['FormulaText']); 
		
	}
	//list of things i have choices for (Either a formula or a value)
	//list of all values I need

	$no_choices = array_diff($var_ids, $choice_ids);//list of IDs
	/*SELECT AVG(Value) from Measurements where Variable_id in $no_choices
	 * AND Material_id=$material_id*/
	$no_choice_pairs = Yii::app()->db->createcommand()
			->select(array('AVG(Value) as Value','Variable_id'))
			->from('Measurements')
			->where(array('and','Material_id='.$material_id,
					array('in','Variable_id',$no_choices)))
			->group('Variable_id')
			->queryAll();
	//Get the values and IDs from the query
	$no_choice_vals = array();
	$no_choice_ids = array();
	foreach ($no_choice_pairs as $key=>$row) {
		$no_choice_ids[] = $row['Variable_id'];
		$no_choice_vals[] = $row['Value'];
	}
	//Variables without formulae, give them names, IDs, and units
	foreach ($no_choices as $key => $id) {
		$index = array_search($id,$no_choice_ids);
		if(!($index===FALSE)){
			$value = $no_choice_vals[$index];
		}else{
			$value = 'NOT_FOUND';
		}
		$model = $this->loadVariable($id);
		$constraints[$key] = array("Name"=>$model->Name, "Id"=>$model->id, "units"=>$model->SIUnit, "Value"=>$value);
	}

	//Give the choice_constraints name,ID,units
	$choice_constraints = array();
	foreach ($choice_ids as $key => $id) {
		$model = $this->loadVariable($id);
		$choice_constraints[$id] = array();
		$choice_constraints[$id]["constraint"] = array("Name"=>$model->Name, "Id"=>$model->id, "units"=>$model->SIUnit);
		$choice_constraints[$id]["formulas"] = $choices[$id];
	}


	$to_return = array("no_choices"=>$constraints, "choices"=>$choice_constraints);

	echo CJSON::encode($to_return);


}


public function actionGetFormulas($material_id, $variable_name, $dependent_variable_id){



	$formulas = array();

	$groups = array();

	$variable_id = Yii::app()->db->createCommand()
			->selectDistinct('id')
			->from('Variables')
			->where('Name= :name')
			->queryAll($fetchAssociative=true, array(':name' => $variable_name));
		$variable_id = $variable_id[0]['id'];


	$group_rows = Yii::app()->db->createCommand()
			->select('id')
			->from('Groups')
			->where( "MaterialsInGroup LIKE '%;" . $material_id. ";%'")
			->queryAll();

	foreach ($group_rows as $key => $row) {
		$groups[] = $row['id'];
	}



	$FormulaIDS_variable_rows = Yii::app()->db->createCommand()
			->selectDistinct('FormulaID, FormulaText, Name, ValidMaterials, ValidGroups, DependentVariable')
			->from('Formula')
			->where( 'DependentVariable=' .$dependent_variable_id. ' AND FormulaVariable=' . $variable_id)
			->queryAll();


	foreach ($FormulaIDS_variable_rows as $key => $rows) {

		if (preg_match('/;'.$material_id . ';/', $rows['ValidMaterials']) 
			or (count(array_intersect($groups, explode(';', $rows['ValidGroups']))) >0 )   ) {
			$formulas[] = $rows; 
		}

	}













	echo CJSON::encode($formulas);
}



//function should return json dictionary of form [..."single_points":[[x1,y1], [x2, y2]], "series":["ID":["data":[[x,y],[x2,y2]]], "ID2":[ ]   ]

public function actionGetPoints($material_id, $y_var_id, $x_var_id, $data){


		$data_php = json_decode($data, true);
		$points = array();


		$points['Material_Name'] = $this->loadMaterial($material_id)->Name;
		$x_var = $this->loadVariable($x_var_id);
		$y_var = $this->loadVariable($y_var_id);


		$points['y_var_name'] = $y_var->Name;
		$points['x_var_name'] = $x_var->Name;

		$points['x_var_units'] = $x_var->SIUnit;
		$points['y_var_units'] = $y_var->SIUnit;

		$y_var_Rows = Yii::app()->db->createCommand()
			->selectDistinct('SeriesID')
			->from('Measurements')
			->where('Material_id='. $material_id . ' AND ' .'Variable_id=' . $y_var_id)
			->queryAll();

		


		$y_var_series = array();


		foreach ($y_var_Rows as $key => $array) {
			$y_var_series[] = $array['SeriesID'];
		}

		$x_var_Rows = Yii::app()->db->createCommand()
			->selectDistinct('SeriesID')
			->from('Measurements')
			->where('Material_id='. $material_id . ' AND ' .'Variable_id=' . $x_var_id)
			->queryAll();

		$x_var_series = array();

		foreach ($x_var_Rows as $key => $array) {
			$x_var_series[] = $array['SeriesID'];
		}


		//all series that have proper x,y pair somewhere
		$intersection = array_intersect($y_var_series, $x_var_series);


		$single_points_seriesID = array();
		$series_seriesID = array();


		foreach ($intersection as $index => $series_id) {

			$max_id = Yii::app()->db->createCommand()
			->select('MAX(MeasurementGroup)')
			->from('Measurements')
			->where('SeriesID='. $series_id)
			->queryAll($fetchAssociative=false);

			if ($max_id[0][0] == 0) {
				$single_points_seriesID[] = $series_id;
			}
			else{
				$series_seriesID[$series_id] = $max_id[0][0];

			}
		}


		//single points stuff

		$var_vals = Yii::app()->db->createCommand()
			->select('Value, Variable_id, SeriesID')
			->from('Measurements')
			->where(array('and', 'Material_id='. $material_id , 
					array('and', array('in', 'SeriesID', $single_points_seriesID), 
					array('in', 'Variable_id', array($x_var_id, $y_var_id)) )))
			->queryAll();

		$pairs = array();

		foreach ($single_points_seriesID as $key => $value) {
			$pairs[$value] = array();
		}


		foreach ($var_vals as $key => $array) {
				$pairs[$array['SeriesID']][$array['Variable_id']] = $array['Value'];  
		}

		$pts = array();
		foreach ($pairs as $group => $pair) {
				if (    ((double) $pairs[$group][$x_var_id]) >=  ((double) $data_php['range_low'])
					 and     ((double) $pairs[$group][$x_var_id]) <=  ((double) $data_php['range_high']) ) {
					$pts[] = array((double) $pairs[$group][$x_var_id], (double) $pairs[$group][$y_var_id]);
				}
		}

		$points['single_points'] = $pts;


		//series points stuff
		$points['series'] = array();

		foreach ($series_seriesID as $series_id => $max_group_count) {

			$pts = array();
			$groups =  array();

			for ($i=1; $i<=$max_group_count; $i++) { 
				$groups[] = $i;
			}


			$var_vals = Yii::app()->db->createCommand()
			->select('Value, Variable_id, MeasurementGroup')
			->from('Measurements')
			->where(array('and', 'Material_id='. $material_id , 
					array('and', 'SeriesID='. $series_id ,
					array('and', array('in', 'MeasurementGroup', $groups), 
					array('in', 'Variable_id', array($x_var_id, $y_var_id)) ))))
			->queryAll();

			$pairs = array();

			foreach ($groups as $key => $value) {
				$pairs[$value] = array();
			}


			foreach ($var_vals as $key => $array) {
					$pairs[$array['MeasurementGroup']][$array['Variable_id']] = $array['Value'];  
			}

			foreach ($pairs as $group => $pair) {
					if (    ((double) $pairs[$group][$x_var_id]) >=  ((double) $data_php['range_low'])
						 and     ((double) $pairs[$group][$x_var_id]) <=  ((double) $data_php['range_high']) ) {
						$pts[] = array((double) $pairs[$group][$x_var_id], (double) $pairs[$group][$y_var_id]);
					}
			}




			$series_stuff = array('data' => $pts,'id'=>$series_id );
			$points['series'][] = $series_stuff;
		} //end for each series_seriesID




		if ($data_php['valid']==1) {

			// $formula_id = Yii::app()->db->createCommand()
			// 	->select('id')
			// 	->from('Formula')
			// 	->where('FormulaID =' .  $data_php['formula'])
			// 	->queryAll($fetchAssociative=false);




			$Formula_name_row = Yii::app()->db->createCommand()
			->selectDistinct('FormulaText, Name')
			->from('Formula')
			->where( 'FormulaID=' .$data_php['formula'])
			->queryRow();

			$formula_text = $Formula_name_row['FormulaText'];
			$formula_name = $Formula_name_row['Name'];

			//substitute subformulas in
			if (isset($data_php['subformulas'])) {
			
				foreach ($data_php['subformulas'] as $var_id => $subformula_id) {
					$symbol = $this->loadVariable($var_id)->Symbol;

					$subformula_text_row = Yii::app()->db->createCommand()
						->selectDistinct('FormulaText')
						->from('Formula')
						->where( 'FormulaID=' .$subformula_id)
						->queryRow();

					$subformula_text = $subformula_text_row['FormulaText'];
					$formula_text = preg_replace('/#'.$symbol.'~/', $subformula_text, $formula_text);



				}
			}


			$new_text = $formula_text;


			if (isset($data_php['constraints'])) {
				foreach ($data_php['constraints'] as $var_id => $value) {
					$symbol = $this->loadVariable($var_id)->Symbol;
					$new_text = preg_replace('/#'.$symbol.'~/', $value, $new_text);
				}
			}

			$formula_points = array();
			$range = ( double) ($data_php['range_high'] - $data_php['range_low']);
			$x_var_name = $x_var->Symbol;

			for ($i=(double) $data_php['range_low']; $i <= (double) $data_php['range_high'] ; ($i = $i + ($range / 20))) { 


				//replace each dependent var with i and add to list of points
				$to_eval = preg_replace('/#'.$x_var_name.'~/', $i, $new_text);
				eval('$y_val =' .$to_eval . ';');				
				$formula_points[] = array((double) $i ,(double) $y_val);
			}





			$points['formula_pairs'] = $formula_points;
			// print_r($points['formula_pairs']);
		}


		echo CJSON::encode($points);
		
	}


	//for x-var
	public function actionGetDependentVariables($material_id, $variable_name){ 

		$variable_id = Yii::app()->db->createCommand()
			->selectDistinct('id')
			->from('Variables')
			->where('Name= :name')
			->queryAll($fetchAssociative=true, array(':name' => $variable_name));
		$variable_id = $variable_id[0]['id'];

		//all seriesIDs that measure the $variable_id
		$measurementSeriesIDRows = Yii::app()->db->createCommand()
			->selectDistinct('SeriesID')
			->from('Measurements')
			->where('Material_id='. $material_id .' AND Variable_id='. $variable_id)
			->queryAll();


		$measurementSeriesIDs = array();


		foreach ($measurementSeriesIDRows as $key => $array) {
			$measurementSeriesIDs[] = $array['SeriesID'];
		}
		$single_points_seriesID = array();
		$series_seriesID = array();

		foreach ($measurementSeriesIDs as $key => $series_id) {
			$max_id = Yii::app()->db->createCommand()
			->select('MAX(MeasurementGroup)')
			->from('Measurements')
			->where('SeriesID='. $series_id)
			->queryAll($fetchAssociative=false);

			if ($max_id[0][0] == 0) {
				$single_points_seriesID[] = $series_id;
			}
			else{
				$series_seriesID[] = $series_id;

			}

		}


		$dependent_variable_ids = array();

		$dependent_variable_IDRows = Yii::app()->db->createCommand()
			->selectDistinct('Variable_id, SeriesID')
			->from('Measurements')
			->where(array('and', 'IsFactor = 1',
					array('in', 'SeriesID', $single_points_seriesID)))
			->queryAll();



		foreach ($dependent_variable_IDRows as $key => $array) {
			$dependent_variable_ids[] = $array['Variable_id'];
		}

		$dependent_variable_ids_series = array();

		$dependent_variable_IDRows = Yii::app()->db->createCommand()
			->selectDistinct('Variable_id')
			->from('Measurements')
			->where(array('and', 'IsFactor = 1 AND MeasurementGroup > 0',
					array('in', 'SeriesID', $series_seriesID)))
			->queryAll();
		

		foreach ($dependent_variable_IDRows as $key => $array) {
			$dependent_variable_ids_series[] = $array['Variable_id'];
		}

		$var_ids = array_merge($dependent_variable_ids_series, $dependent_variable_ids);
		





		$formulas_vars = array();

		$material_string = '%;' .$material_id. ';%';
		//first grab the formula-driven dependent vars for our material
		$FormulaIDS_variable_rows = Yii::app()->db->createCommand()
				->selectDistinct('DependentVariable')
				->from('Formula')
				->where( 'FormulaVariable =' . $variable_id . ' AND ValidMaterials LIKE :material')
				->queryAll($fetchAssociative=true, array(':material'=>$material_string));

		foreach ($FormulaIDS_variable_rows as $key => $rows) {
			
				$formulas_vars[$rows['DependentVariable']] = $rows['DependentVariable'];

		}


		//do same for groups

		$group_rows = Yii::app()->db->createCommand()
				->select('id')
				->from('Groups')
				->where( "MaterialsInGroup LIKE '%;" . $material_id. ";%'")
				->queryAll();


		foreach ($group_rows as $key => $row) {
			$group = $row['id'];
			$group = '%;' .$group . ';%';
			$FormulaIDS_variable_rows = Yii::app()->db->createCommand()
					->selectDistinct('DependentVariable')
					->from('Formula')
					->where( 'FormulaVariable = ' . $variable_id . ' AND ValidGroups LIKE :group')
					->queryAll($fetchAssociative=true, array(':group'=>$group));
			

			foreach ($FormulaIDS_variable_rows as $index => $row) {
				$formulas_vars[$row['DependentVariable']] = $row['DependentVariable'];
			}

		}

		foreach ($formulas_vars as $key => $var_id) {
			$FormulaIDS_variable_rows = Yii::app()->db->createCommand()
					->selectDistinct('DependentVariable')
					->from('Formula')
					->where( 'FormulaVariable = ' . $var_id)
					->queryAll($fetchAssociative=true);

			foreach ($FormulaIDS_variable_rows as $key => $row) {
				$formulas_vars[$row['DependentVariable']] = $row['DependentVariable'];
			}

		}

		$dependent_variable_ids = array_merge($formulas_vars, $var_ids);

		$dependent_variables = Yii::app()->db->createCommand()
			->select('id, Name, SIUnit')
			->from('Variables')
			->where(array('in', 'id', $dependent_variable_ids))
			->queryAll();


		echo CJSON::encode($dependent_variables);



	}

	public function loadMaterial($id)
	{
		$model=Material::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadVariable($id)
	{
		$model=Variables::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionVariablesAutocomplete() {
        $term = trim($_GET['term']) ;
 
        if($term !='') {
            
      $variables =  Variables::variablesAutoComplete($term);
            echo CJSON::encode($variables);
            Yii::app()->end();
    }
  }



	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'variableName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
