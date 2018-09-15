<?php

/**
 * This is the model class for table "Measurements".
 *
 * The followings are the available columns in table 'Measurements':
 * @property integer $id
 * @property double $Value
 * @property string $Citations
 * @property double $Value_2
 * @property string $TimeStamp
 * @property integer $SeriesID
 * @property integer $MeasurementGroup
 * @property integer $IsApproved
 * @property integer $User_id
 * @property integer $Variable_id
 * @property integer $Material_id
 * @property string $DOI
 * @property integer $IsFactor
 * @property double $Error
 *
 * The followings are the available model relations:
 * @property Material $material
 * @property Variables $variable
 * @property User $user
 */
class Measurements extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Measurements';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Value, SeriesID, MeasurementGroup, IsApproved, User_id, Variable_id, Material_id', 'required'),
			array('SeriesID, MeasurementGroup, IsApproved, User_id, Variable_id, Material_id, IsFactor', 'numerical', 'integerOnly'=>true),
			array('Value, Value_2, Error', 'numerical'),
			array('Citations', 'length', 'max'=>8000),
			array('DOI', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, Value, Citations, Value_2, TimeStamp, SeriesID, MeasurementGroup, IsApproved, User_id, Variable_id, Material_id, DOI, IsFactor, Error', 'safe', 'on'=>'search'),
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
			'material' => array(self::BELONGS_TO, 'Material', 'Material_id'),
			'variable' => array(self::BELONGS_TO, 'Variables', 'Variable_id'),
			'user' => array(self::BELONGS_TO, 'User', 'User_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'Value' => 'Value',
			'Citations' => 'Citations',
			'Value_2' => 'Value 2',
			'TimeStamp' => 'Time Stamp',
			'SeriesID' => 'Series',
			'MeasurementGroup' => 'Measurement Group',
			'IsApproved' => 'Is Approved',
			'User_id' => 'User',
			'Variable_id' => 'Variable',
			'Material_id' => 'Material',
			'DOI' => 'Doi',
			'IsFactor' => 'Is Factor',
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
		$criteria->compare('Value',$this->Value);
		$criteria->compare('Citations',$this->Citations,true);
		$criteria->compare('Value_2',$this->Value_2);
		$criteria->compare('TimeStamp',$this->TimeStamp,true);
		$criteria->compare('SeriesID',$this->SeriesID);
		$criteria->compare('MeasurementGroup',$this->MeasurementGroup);
		$criteria->compare('IsApproved',$this->IsApproved);
		$criteria->compare('User_id',$this->User_id);
		$criteria->compare('Variable_id',$this->Variable_id);
		$criteria->compare('Material_id',$this->Material_id);
		$criteria->compare('DOI',$this->DOI,true);
		$criteria->compare('IsFactor',$this->IsFactor);
		$criteria->compare('Error',$this->Error);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Measurements the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
