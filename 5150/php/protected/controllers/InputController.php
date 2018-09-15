<?php

class InputController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	protected function beforeAction($action)
    {
        if(Yii::app()->user->isGuest)
        {
           $this->redirect(Yii::app()->createUrl('site/login'));  
			//return true;
        } else {
            //Yii::app()->request->redirect(Yii::app()->user->returnUrl);
			return true;
        }
    }


	public function actionView($id)
	{
		$this->render('point_input', array(
			'model'=>$this->loadMaterial($id),
		));
	}

	public function actionFormula($id)
	{


		$this->render('formula_input', array(
			'model'=>$this->loadMaterial($id),
		));
		

	}


	public function actionRange($id)
	{


		$this->render('range_input', array(
			'model'=>$this->loadMaterial($id),
		));
		

	}


	public function actionFormulaInput()
	{

		$material_id = $_POST['Material_id'];

		$materials = $_POST['materials'];
		$materials = explode(";",$materials ,-1);

		$material_ids = array();

		$material_id_rows = Yii::app()->db->createCommand()
			->select('id')
			->from('Material')
			->where(array('in', 'Name', $materials))
			->queryAll();

		foreach ($material_id_rows as $key => $value) {
			$material_ids[] = $value['id'];
		}

		$groups = $_POST['groups'];
		$groups = explode(";",$groups ,-1);
		$group_ids = array();

		$group_id_rows = Yii::app()->db->createCommand()
			->select('id')
			->from('Groups')
			->where(array('in', 'GroupName', $groups))
			->queryAll();


		foreach ($group_id_rows as $key => $value) {
			$group_ids[] = $value['id'];
			
		}


		$material_ids = ";".implode(";", $material_ids).";";
		$group_ids = ";".implode(";", $group_ids).";";
		

		if (isset($_POST['make_group'])) {
			$MakeGroup = $_POST['make_group'];
			if ($MakeGroup == "yes") {
				$group_model = new Groups;
				$group_model->MaterialsInGroup = $material_ids;
				if(isset($_POST['group_name'])){
					$group_model->GroupName = $_POST['group_name'];
				}
				else{
					$group_model->GroupName = $materials;
				}
				$group_model->save();
			}
		}

		
		$formula_text = $_POST['mostly_parsed_result'];
		$dependent_var_symbols = array();
		$dependent_var_ids = array();

		$matches = array();
		$subformula_texts = array();


		// preg_match_all("/\$([^\$\@])+\@/", $formula_text, $matches);

		preg_match_all('/&([^&@])+@/', $formula_text, $matches);


		//for each matched formula name, grab the text
		foreach ($matches[0] as $key => $formula_name) {

			$text = Yii::app()->db->createCommand()
				->selectDistinct('FormulaText')
				->from('Formula')
				->where("Name = :name")
				->queryAll($fetchAssociative=false, array(":name" => substr($formula_name, 1, -1)));
			
			$formula_text = preg_replace('/' .preg_quote($formula_name).   '/', "(". $text[0][0]. ")", $formula_text);




		}







		preg_match_all("/#([^#~])+~/", $formula_text, $matches);
		// $formula_text = preg_replace('/\^', )


		foreach ($matches[0] as $key => $string) {
			$dependent_var_symbols[] = substr($string, 1,-1);
		}

		$var_id_rows = Yii::app()->db->createCommand()
			->select('id')
			->from('Variables')
			->where(array('in', 'Symbol', $dependent_var_symbols))
			->queryAll();


		foreach ($var_id_rows as $key => $value) {
			$dependent_var_ids[] = $value['id'];
		}



		$max_formula_id = Yii::app()->db->createCommand()
			->select('MAX(FormulaID)')
			->from('Formula')
			->queryAll();

		$max_formula_id= 1 + $max_formula_id[0]['MAX(FormulaID)'];

		$measuredVariable = Yii::app()->db->createCommand()
			->select('id')
			->from('Variables')
			->where('Name = :name')
			->queryAll($fetchAssociative=false, array(":name"=>$_POST["property"]));
		$measuredVariable = $measuredVariable[0][0];

		foreach ($dependent_var_ids as $key => $var_id) {
			$new_formula = new Formula;

			$new_formula->FormulaVariable = $measuredVariable;
			$new_formula->Citations = $_POST['citations'];
			$new_formula->DOI = $_POST['doi'];
			$new_formula->ValidMaterials = ";".$material_ids;
			$new_formula->ValidGroups = $group_ids;
			$new_formula->Name = $_POST['formula_name'];
			$new_formula->FormulaID = $max_formula_id;
			$new_formula->FormulaText = $formula_text;
			$new_formula->Description = $_POST['description'];
			$new_formula->DependentVariable = $var_id;
			$new_formula->IsApproved = 0;
			$new_formula->User_id = Yii::app()->user->getId();
;


			$var =$new_formula->save();

		}


		$this->render('success_formula', array('material_id'=>$material_id));

	}


	public function actionParseFormula($string=''){

		$parsed = 'hey';

  		$valid = array('abs',   'acos',  'acosh', 'asin',  'asinh',
                'atan',  'atan2', 'atanh', 'cos',   'cosh',
                'exp',   'expm1', 'log',   'log10', 'log1p',
                'pi',    'pow',   'sin',   'sinh',  'sqrt',
                'tan',   'tanh'); //, '^');

  		$tokens = array('!01!',  '!02!',  '!03!',  '!04!',  '!05!',
                '!06!',  '!07!',  '!08!',  '!09!',  '!10!',
                '!11!',  '!12!',  '!13!',  '!14!',  '!15!',
                '!16!',  '!17!',  '!18!',  '!19!',  '!20!',
                '!21!',  '!22!');// , '!23!');

		
		$variable_symbols = Yii::app()->db->createCommand()
			->select('Symbol')
			->from('Variables')
			->queryAll($fetchAssociative=false);

		$formula_names = Yii::app()->db->createCommand()
			->selectDistinct('Name')
			->from('Formula')
			->queryAll($fetchAssociative=false);




		$count = 22;

		foreach ($variable_symbols as $key => $value) {
			$count++;
			$valid[] = "#" . $value[0] . "~";
			$tokens[] = "!" . strval($count) . "!";

		}

		foreach ($formula_names as $key => $value) {
			$count++;
			$valid[] = "&" . $value[0] . "@";
			$tokens[] = "!" . strval($count) . "!";

		}

		

		$parsed = str_replace($valid, $tokens, $string);


		$parsed = preg_replace("/[^\d\+\*\/\-\.(),! ]/", '', $parsed);


		$mostly_parsed = str_replace($tokens, $valid, $parsed);

		$parsed = preg_replace("/[#~&@]/", '', $mostly_parsed);

		$data = array("mostly_parsed"=>$mostly_parsed, "parsed"=>$parsed);

		echo CJSON::encode($data);




		// echo CJSON::encode($string);
	}

	

	public function loadMaterial($id)
	{
		$model=Material::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadGroup($id)
	{
		$model=Groups::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionPoint(){
		//need to add data series stuf...

		if (isset($_POST["data_type"])) {
			$material_id = $_POST['Material_id'];						
			$citations = $_POST['citations'];
			$doi = $_POST['doi'];


			//actually make series group
			$max_series_id = Yii::app()->db->createCommand()
				->select('MAX(SeriesID)')
				->from('Measurements')
				->queryAll();

			$max_series_id= 1 + $max_series_id[0]['MAX(SeriesID)'];
			$measurement = new Measurements;

			$factor_vals = array();
			$property_vals = array();


			foreach ($_POST["factors_val"] as $num => $value) {
			
				if($value){
					


				$factor_name = explode(",", $_POST['factors'][$num]);


				$factor_id = Yii::app()->db->createCommand()
					->select('id')
					->from('Variables')
					->where('Name LIKE :name')
					->queryAll($fetchAssociative=false, array(':name'=>$factor_name[0]));



				
					$measurement = new Measurements;
					$measurement->Value = ((double) $value);
					$measurement->Citations = $citations;
					$measurement->DOI = $doi;
					$measurement->IsApproved = 0;
					$measurement->Variable_id = ((int) $factor_id[0][0]);
					$measurement->Material_id = $material_id;
					$measurement->SeriesID = $max_series_id;
					$measurement->MeasurementGroup = 0;
					$measurement->User_id =  Yii::app()->user->getId();
;
					$measurement->IsFactor = 1;



					$var = $measurement->save();

					print_r($measurement->getErrors());
			// print_r("ugh");
					
		
					$factor_vals[$_POST["factors"][$num]] = $value;
				}



			if ($_POST["data_type"] == "single_point") {

				foreach ($_POST["properties_val"] as $num => $value) {
						
						if($value){

							$property_name = explode(",", $_POST['properties'][$num]);


							$property_id = Yii::app()->db->createCommand()
								->select('id')
								->from('Variables')
								->where('Name LIKE :name')
								->queryAll($fetchAssociative=false, array(':name'=>$property_name[0]));




							$measurement = new Measurements;
							$measurement->Value = ((double) $value);
							$measurement->Citations = $citations;
							$measurement->DOI = $doi;

							$measurement->IsApproved = 0;
							$measurement->Variable_id = ((int) $property_id[0][0]);
							$measurement->Material_id = $material_id;
							$measurement->SeriesID = $max_series_id;
							$measurement->MeasurementGroup = 0;
							$measurement->User_id =  Yii::app()->user->getId();
							$measurement->IsFactor = 0;


							$var = $measurement->save();

				
							$property_vals[$_POST["properties"][$num]] = $value;
						}
					}


			}
			else if ($_POST["data_type"] == "series") {
				ini_set('auto_detect_line_endings', true);



				

				$dependent_var_name = explode(",", $_POST['dependent_factor']);
				$independent_var_name = explode(",", $_POST['independent_property']);


				$dependent_var_id = Yii::app()->db->createCommand()
					->select('id')
					->from('Variables')
					->where('Name LIKE :name')
					->queryAll($fetchAssociative=false, array(':name'=>$dependent_var_name[0]));


				$independent_var_id = Yii::app()->db->createCommand()
					->select('id')
					->from('Variables')
					->where('Name LIKE :name')
					->queryAll($fetchAssociative=false, array(':name'=>$independent_var_name[0]));


				$dependent_vals = array();
				$independent_vals = array();
				if (isset($_FILES)) {
					if (end(explode(".", $_FILES["file"]["name"])) == "csv") {

						if ( ($handle = fopen($_FILES["file"]["tmp_name"], "r")) !== FALSE) {
							while ( ($data = fgetcsv($handle, 100, ",")) !== FALSE) {
								$dependent_vals[] =  $data[0];
								$independent_vals[] =  $data[1];

								
							}

							fclose($handle);

						}



					}
					else {
						echo "Problem with file upload.";
					}
				}


				for ($i=0; $i < count($dependent_vals); $i++) { 

					$dep_measurement = new Measurements;
					$dep_measurement->Value = ((double) $dependent_vals[$i]);
					$dep_measurement->Citations = $citations;
					$dep_measurement->DOI = $doi;
					$dep_measurement->Variable_id = (int) $dependent_var_id[0][0];
					$dep_measurement->IsApproved = 0;
					$dep_measurement->Material_id = $material_id;
					$dep_measurement->SeriesID = $max_series_id;
					$dep_measurement->MeasurementGroup = $i+1;
					$dep_measurement->User_id =  Yii::app()->user->getId();
					$dep_measurement->IsFactor = 1;


					$var = $dep_measurement->save();

					$indep_measurement = new Measurements;
					$indep_measurement->Value = ((double) $independent_vals[$i]);
					$indep_measurement->Citations = $citations;
					$indep_measurement->DOI = $doi;
					$indep_measurement->Variable_id = (int) $independent_var_id[0][0];
					$indep_measurement->IsApproved = 0;
					$indep_measurement->Material_id = $material_id;
					$indep_measurement->SeriesID = $max_series_id;
					$indep_measurement->MeasurementGroup = $i+1;
					$indep_measurement->User_id =  Yii::app()->user->getId();
					$indep_measurement->IsFactor = 0;


					$var = $indep_measurement->save();		
				}
			}



		}


		}





				

		$this->render('success', array('material_id'=>$material_id));





	}

public function actionRangeInput(){



	$this->render('success_range', array('material_id'=>$material_id));



}

	public function actionFactorsAutocomplete() {
        $term = trim($_GET['term']) ;
        if($term !='') {
            $variables =  Variables::factorsAutoComplete($term);
            echo CJSON::encode($variables);
            Yii::app()->end();
    }
  }


 public function actionFactorAutocomplete($name='') {

        $name = $name.'%';

	$names_assoc = Yii::app()->db->createCommand()
			->select('Name, SIUnit')
			->from('Variables')
			->where('Name LIKE :name AND IsFactor = 1')
			->queryAll($fetchAssociative=false, array(':name'=>$name));

	 $list = array();

	 foreach ($names_assoc as $index => $array) {
	 	$list[] = "" . $array[0] . ", " . $array[1] . "";
	 }

	 echo(CJSON::encode($list));



  }

  public function actionVariableAutocomplete($name='') {

        $name = $name.'%';

	$names_assoc = Yii::app()->db->createCommand()
			->select('Name, Symbol')
			->from('Variables')
			->where('Name LIKE :name')
			->queryAll($fetchAssociative=false, array(':name'=>$name));

	 $list = array();

	 foreach ($names_assoc as $index => $array) {
	 	$list[] = "" . $array[0] . ", " . $array[1] . "";
	 }

	 echo(CJSON::encode($list));



  }

public function actionVariableAutocompleteUnits($name='') {

        $name = $name.'%';

	$names_assoc = Yii::app()->db->createCommand()
			->select('Name, Symbol, SIUnit')
			->from('Variables')
			->where('Name LIKE :name')
			->queryAll($fetchAssociative=false, array(':name'=>$name));

	 $list = array();

	 foreach ($names_assoc as $index => $array) {
	 	$list[] = "" . $array[0] . ", " . $array[1] . ", " . $array[2];
	 }

	 echo(CJSON::encode($list));



  }




  public function actionPropertyAutocomplete($name='') {

        $name = $name.'%';

	$names_assoc = Yii::app()->db->createCommand()
			->select('Name, SIUnit')
			->from('Variables')
			->where('Name LIKE :name AND IsFactor = 0')
			->queryAll($fetchAssociative=false, array(':name'=>$name));

	 $list = array();

	 foreach ($names_assoc as $index => $array) {
	 	$list[] = "" . $array[0] . ", " . $array[1] . "";
	 }

	 echo(CJSON::encode($list));



  }


	public function actionPropertiesAutocomplete() {
        $term = trim($_GET['term']) ;
        if($term !='') {
      		$variables =  Variables::propertiesAutoComplete($term);
            echo CJSON::encode($variables);
            Yii::app()->end();
    }
  }
  
  
  public function actionGroupsAutocomplete() {
        $term = trim($_GET['term']) ;
 
        if($term !='') {
         
      $variables =  Groups::groupsAutoComplete($term);
            echo CJSON::encode($variables);
            Yii::app()->end();
    }
  }


public function actionFormulaAutocomplete() {
        $term = trim($_GET['term']) ;
 
        if($term !='') {
         
      $variables =  Formula::formulaAutoComplete($term);
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
				'propertyName'=>'propertyValue',
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