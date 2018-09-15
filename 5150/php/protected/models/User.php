<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $id
 * @property string $Username
 * @property string $Password
 * @property string $eMail
 * @property string $Affiliation
 * @property integer $Permissions
 *
 * The followings are the available model relations:
 * @property Formula[] $formulas
 * @property Material[] $materials
 * @property Measurements[] $measurements
 */
 
class User extends CActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'User';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
		public $Password2;
        public $verifyCode; 
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		
		/*return array(
			array('Username, Password, Permissions', 'required'),
			array('Permissions', 'numerical', 'integerOnly'=>true),
			array('Username, Password, eMail, Affiliation', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, Username, Password, eMail, Affiliation, Permissions', 'safe', 'on'=>'search'),
		);*/
		
		return array(
                        /* Due to a fellow user's observation this note is being 
                        * posted for users. Using filters, you can combine certain
                        * variables together to simplify the processing. Where this
                        * was pointed out was for the question and answer filtering
                        * to lowercase. In fact the username as well. Technically
                        * the more efficient way is to process them as followed:
                        * array('username,question,answer', 'filter', 'filter'=>'strtolower'),
                        */
                        array('Username','length','max'=>32),
                        // convert username to lower case
                        array('Username', 'filter', 'filter'=>'strtolower'),
                        array('Password','length','max'=>64, 'min'=>6),
                        array('Password2','length','max'=>64, 'min'=>6),
                        // compare password to repeated password
                        array('Password', 'compare', 'compareAttribute'=>'Password2'), 
                        array('eMail','length','max'=>256),
                        // make sure eMail is a valid eMail
                        array('eMail','email'),
                        // make sure username and eMail are unique
                        array('Username, eMail', 'unique'), 
                        
                        array('Username, Password,  eMail, verifyCode', 'required'),
                        // verifyCode needs to be entered correctly
                        array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
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
			'formulas' => array(self::HAS_MANY, 'Formula', 'User_id'),
			'materials' => array(self::HAS_MANY, 'Material', 'User_id'),
			'measurements' => array(self::HAS_MANY, 'Measurements', 'User_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'Username' => 'Username',
			'Password' => 'Password',
			'eMail' => 'E Mail',
			'Affiliation' => 'Affiliation',
			'Permissions' => 'Permissions',
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
		$criteria->compare('Username',$this->Username,true);
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('eMail',$this->eMail,true);
		$criteria->compare('Affiliation',$this->Affiliation,true);
		$criteria->compare('Permissions',$this->Permissions);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
