<?php

/**
 * This is the model class for table "Formula".
 *
 * The followings are the available columns in table 'Formula':
 * @property integer $id
 * @property integer $FormulaID
 * @property integer $FormulaVariable
 * @property string $FormulaText
 * @property string $Name
 * @property string $Description
 * @property string $TimeStamp
 * @property string $Citations
 * @property string $DOI
 * @property integer $DependentVariable
 * @property integer $DependentVariableLowRange
 * @property integer $DependentVariableHighRange
 * @property integer $IsApproved
 * @property integer $User_id
 * @property string $ValidMaterials
 * @property string $ValidGroups
 * @property double $Error
 *
 * The followings are the available model relations:
 * @property Variables $formulaVariable
 * @property Variables $dependentVariable
 * @property User $user
 */
class Formula extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Formula';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FormulaID, FormulaVariable, FormulaText, Name, DependentVariable, IsApproved, User_id, ValidMaterials', 'required'),
			array('FormulaID, FormulaVariable, DependentVariable, DependentVariableLowRange, DependentVariableHighRange, IsApproved, User_id', 'numerical', 'integerOnly'=>true),
			array('Error', 'numerical'),
			array('FormulaText', 'length', 'max'=>8000),
			array('Name, Description', 'length', 'max'=>255),
			array('Citations, DOI, ValidMaterials, ValidGroups', 'length', 'max'=>1000),
			array('TimeStamp', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, FormulaID, FormulaVariable, FormulaText, Name, Description,  Citations, DOI, DependentVariable, DependentVariableLowRange, DependentVariableHighRange, IsApproved, User_id, ValidMaterials, ValidGroups', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			// 'formulaVariable' => array(self::BELONGS_TO, 'Variables', 'FormulaVariable'),
			// 'dependentVariable' => array(self::BELONGS_TO, 'Variables', 'DependentVariable'),
			// 'user' => array(self::BELONGS_TO, 'User', 'User_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'FormulaID' => 'Formula',
			'FormulaVariable' => 'Formula Variable',
			'FormulaText' => 'Formula Text',
			'Name' => 'Name',
			'Description' => 'Description',
			'TimeStamp' => 'Time Stamp',
			'Citations' => 'Citations',
			'DOI' => 'Doi',
			'DependentVariable' => 'Dependent Variable',
			'DependentVariableLowRange' => 'Dependent Variable Low Range',
			'DependentVariableHighRange' => 'Dependent Variable High Range',
			'IsApproved' => 'Is Approved',
			'User_id' => 'User',
			'ValidMaterials' => 'Valid Materials',
			'ValidGroups' => 'Valid Groups',
			'Error' => 'Error',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('FormulaID',$this->FormulaID);
		$criteria->compare('FormulaVariable',$this->FormulaVariable);
		$criteria->compare('FormulaText',$this->FormulaText,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('TimeStamp',$this->TimeStamp,true);
		$criteria->compare('Citations',$this->Citations,true);
		$criteria->compare('DOI',$this->DOI,true);
		$criteria->compare('DependentVariable',$this->DependentVariable);
		$criteria->compare('DependentVariableLowRange',$this->DependentVariableLowRange);
		$criteria->compare('DependentVariableHighRange',$this->DependentVariableHighRange);
		$criteria->compare('IsApproved',$this->IsApproved);
		$criteria->compare('User_id',$this->User_id);
		$criteria->compare('ValidMaterials',$this->ValidMaterials,true);
		$criteria->compare('ValidGroups',$this->ValidGroups,true);
		$criteria->compare('Error',$this->Error);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Formula the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function formulaAutoComplete($name='') {
 
        // Recommended: Secure Way to Write SQL in Yii 
    $sql= 'SELECT FormulaText as id, Name  AS label FROM Formula WHERE  Name LIKE :name';
        $name = $name.'%';
        return Yii::app()->db->createCommand($sql)->queryAll(true,array(':name'=>$name));
	}
}
