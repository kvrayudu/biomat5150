<?php

/**
 * This is the model class for table "Variables".
 *
 * The followings are the available columns in table 'Variables':
 * @property integer $id
 * @property string $Name
 * @property string $SIUnit
 * @property string $Description
 * @property integer $IsFactor
 * @property string $Symbol
 *
 * The followings are the available model relations:
 * @property Formula[] $formulas
 * @property Formula[] $formulas1
 * @property Measurements[] $measurements
 */
class Variables extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Variables';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, SIUnit, IsFactor', 'required'),
			array('IsFactor', 'numerical', 'integerOnly'=>true),
			array('Name, SIUnit, Description', 'length', 'max'=>255),
			array('Symbol', 'length', 'max'=>63),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, Name, SIUnit, Description, IsFactor, Symbol', 'safe', 'on'=>'search'),
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
			'formulas' => array(self::HAS_MANY, 'Formula', 'FormulaVariable'),
			'formulas1' => array(self::HAS_MANY, 'Formula', 'DependentVariable'),
			'measurements' => array(self::HAS_MANY, 'Measurements', 'Variable_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'Name' => 'Name',
			'SIUnit' => 'Siunit',
			'Description' => 'Description',
			'IsFactor' => 'Is Factor',
			'Symbol' => 'Symbol',
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
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('SIUnit',$this->SIUnit,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('IsFactor',$this->IsFactor);
		$criteria->compare('Symbol',$this->Symbol,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
public static function variablesAutoComplete($name='') {
 
        // Recommended: Secure Way to Write SQL in Yii 
    $sql= 'SELECT id ,Name AS label FROM Variables WHERE Name LIKE :name';
        $name = $name.'%';
        return Yii::app()->db->createCommand($sql)->queryAll(true,array(':name'=>$name));
	}
	
	public static function factorsAutoComplete($name='') {
 
        // Recommended: Secure Way to Write SQL in Yii 
    $sql= 'SELECT id , SIUnit,Name AS label FROM Variables WHERE IsFactor=1 and Name LIKE :name';
        $name = $name.'%';
        return Yii::app()->db->createCommand($sql)->queryAll(true,array(':name'=>$name));
	}
	
	
	public static function propertiesAutoComplete($name='') {
 
        // Recommended: Secure Way to Write SQL in Yii 
    $sql= 'SELECT id ,Name AS label FROM Variables WHERE IsFactor=0 and Name LIKE :name';
        $name = $name.'%';
        return Yii::app()->db->createCommand($sql)->queryAll(true,array(':name'=>$name));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Variables the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
