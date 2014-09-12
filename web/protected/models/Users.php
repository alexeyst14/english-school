<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $ID
 * @property string $LOGIN
 * @property string $PASSWORD
 * @property integer $person_ID
 *
 * The followings are the available model relations:
 * @property Persons $person
 */
class Users extends CActiveRecord
{

    public $PASSWORD_CONFIRM;
    public $personType;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('person_ID, LOGIN, PASSWORD, PASSWORD_CONFIRM', 'required'),
			array('person_ID', 'numerical', 'integerOnly'=>true),
			array('LOGIN, PASSWORD', 'length', 'max'=>45),
                        array('PASSWORD', 'compare', 'compareAttribute'=>'PASSWORD_CONFIRM'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, LOGIN, PASSWORD, person_ID', 'safe', 'on'=>'search'),
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
			'person' => array(self::BELONGS_TO, 'Persons', 'person_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'LOGIN' => 'Логин',
			'PASSWORD' => 'Пороль',
			'person_ID' => 'Сотрудник',
                        'PASSWORD_CONFIRM' => 'Подтвердите пороль',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('ID',$this->ID);
		$criteria->compare('LOGIN',$this->LOGIN,true);
		$criteria->compare('PASSWORD',$this->PASSWORD,true);
		$criteria->compare('person_ID',$this->person_ID);
                $criteria->with = array('person','person.personType');

                $sort = new CSort;
                $sort->attributes = array(
                            'LOGIN',
                            'person_ID'=>array(
                                'asc' => ' person.LAST_NAME',
                                'desc' => ' person.LAST_NAME DESC'
                            ),
                            'personType'=>array(
                                'asc' => ' personType.NAME',
                                'desc' => ' personType.NAME DESC'
                            ));
                $sort->defaultOrder = 'LOGIN';

                $dataProvider=new CActiveDataProvider('Users', array(
                    'sort'=>$sort,
                    'criteria'=>$criteria
                ));

		return $dataProvider;
	}

	protected function beforeSave()
	{
            $this->PASSWORD = md5($PASSWORD_CONFIRM);
            return parent::beforeSave();
	}
}