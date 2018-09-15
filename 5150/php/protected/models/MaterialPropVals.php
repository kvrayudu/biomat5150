<?php

/**
 * This is the model class for table "MaterialPropVals".
 *
 * The followings are the available columns in table 'MaterialPropVals':
 * @property integer $id
 * @property double $Value
 * @property string $Citations
 * @property string $TimeStamp
 * @property integer $MeasurementGroup
 * @property integer $IsApproved
 * @property integer $SetID
 * @property integer $User_id
 * @property integer $Property_id
 * @property integer $Material_id
 *
 * The followings are the available model relations:
 * @property Material $material
 * @property Property $property
 * @property User $user
 */
class MaterialPropVals extends CActiveRecord
{
	const STATUS_PENDING=1;
	const STATUS_APPROVED=2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'MaterialPropVals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Value, Citations, SetID, Property_id, Material_id', 'required'),
			array('MeasurementGroup, IsApproved, SetID, User_id, Property_id, Material_id', 'numerical', 'integerOnly'=>true),
			array('Value', 'numerical'),
			array('Citations', 'length', 'max'=>8000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('IsApproved', 'safe', 'on'=>'search'),
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
			'property' => array(self::BELONGS_TO, 'Property', 'Property_id'),
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
			'TimeStamp' => 'Time Stamp',
			'MeasurementGroup' => 'Measurement Group',
			'IsApproved' => 'Is Approved',
			'SetID' => 'Set',
			'User_id' => 'User',
			'Property_id' => 'Property',
			'Material_id' => 'Material',
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

		$criteria->compare('IsApproved',$this->IsApproved);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MaterialPropVals the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
