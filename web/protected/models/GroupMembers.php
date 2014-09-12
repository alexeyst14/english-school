<?php

/**
 * This is the model class for table "group_members".
 *
 * The followings are the available columns in table 'group_members':
 * @property integer $ID
 * @property integer $groups_ID
 * @property integer $person_ID
 *
 * The followings are the available model relations:
 * @property Persons $person
 * @property Groups $groups
 */
class GroupMembers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GroupMembers the static model class
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
		return 'group_members';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('groups_ID, person_ID', 'required'),
			array('groups_ID, person_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, groups_ID, person_ID', 'safe', 'on'=>'search'),
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
			'groups' => array(self::BELONGS_TO, 'Groups', 'groups_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'groups_ID' => 'Groups',
			'person_ID' => 'Person',
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
		$criteria->compare('groups_ID',$this->groups_ID);
		$criteria->compare('person_ID',$this->person_ID);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}