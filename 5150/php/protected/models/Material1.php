<?php

/**
 * This is the model class for table "Material".
 *
 * The followings are the available columns in table 'Material':
 * @property integer $id
 * @property string $ItemName
 * @property string $ItemDescription
 * @property string $TimeStamp
 * @property string $Citations
 * @property integer $User_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property MaterialComponents[] $materialComponents
 * @property MaterialPropVals[] $materialPropVals
 */
class Material extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Material';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ItemName, User_id', 'required'),
			array('ItemName, ItemDescription', 'length', 'max'=>255),
			array('Citations', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ItemName, ItemDescription, Citations', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'User_id'),
			'materialComponents' => array(self::HAS_MANY, 'MaterialComponents', 'Material_id'),
			'materialPropVals' => array(self::HAS_MANY, 'MaterialPropVals', 'Material_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ItemName' => 'Material Name',
			'ItemDescription' => 'Item Description',
			'TimeStamp' => 'Time Stamp',
			'Citations' => 'References (if applicable)',
			'User_id' => 'User',
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

		$criteria->compare('ItemName',$this->ItemName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
	public static function variablesAutoComplete($name='') {
 
        // Recommended: Secure Way to Write SQL in Yii 
    $sql= 'SELECT id ,Name AS label FROM Material WHERE Name LIKE :name';
        $name = $name.'%';
        return Yii::app()->db->createCommand($sql)->queryAll(true,array(':name'=>$name));
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Material the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
