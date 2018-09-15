<?php

/**
 * This is the model class for table "Material".
 *
 * The followings are the available columns in table 'Material':
 * @property integer $id
 * @property string $Name
 * @property string $Description
 * @property string $TimeStamp
 * @property string $Citations
 * @property integer $User_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Measurements[] $measurements
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
			array('Name, User_id', 'required'),
			//array('User_id', 'numerical', 'integerOnly'=>true),
			array('Name, Description', 'length', 'max'=>255),
			array('Citations', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, Name, Description, TimeStamp, Citations, User_id', 'safe', 'on'=>'search'),
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
			'measurements' => array(self::HAS_MANY, 'Measurements', 'Material_id'),
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
			'Description' => 'Description',
			'TimeStamp' => 'Time Stamp',
			'Citations' => 'Citations',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('TimeStamp',$this->TimeStamp,true);
		$criteria->compare('Citations',$this->Citations,true);
		$criteria->compare('User_id',$this->User_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * used for auto-complete
	 */
	public static function materialAutoComplete($name='') {
 
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
