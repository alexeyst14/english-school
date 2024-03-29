<?php

/**
 * This is the model class for table "person_type".
 *
 * The followings are the available columns in table 'person_type':
 * @property integer $ID
 * @property string $NAME
 *
 * The followings are the available model relations:
 * @property Persons[] $persons
 */
class PersonType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PersonType the static model class
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
		return 'person_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NAME', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, NAME', 'safe', 'on'=>'search'),
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
			'persons' => array(self::HAS_MANY, 'Persons', 'person_type_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'NAME' => 'Тип персоны',
			'ROLE' => 'Роль',
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
		$criteria->compare('NAME',$this->NAME,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    
    public function getAllTypes()
    {
        $personTypes = array();
        $personTypes[''] = 'Все';
        foreach ($this->findAll() as $row) {
            $personTypes[$row->ID] = $row->NAME;
        }
        return $personTypes;
    }
    
}