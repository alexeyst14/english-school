<?php

/**
 * This is the model class for table "groups".
 *
 * The followings are the available columns in table 'groups':
 * @property integer $ID
 * @property string $CODE
 * @property integer $group_type_ID
 * @property integer $level_ID
 *
 * The followings are the available model relations:
 * @property GroupMembers[] $groupMembers
 * @property GroupType $groupType
 * @property GroupLevel $level
 * @property Lessons[] $lessons
 */
class Groups extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Groups the static model class
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
		return 'groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_type_ID, level_ID', 'required'),
			array('group_type_ID, level_ID', 'numerical', 'integerOnly'=>true),
			array('CODE', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, CODE, group_type_ID, level_ID', 'safe', 'on'=>'search'),
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
			'groupMembers' => array(self::HAS_MANY, 'GroupMembers', 'groups_ID'),
			'groupType' => array(self::BELONGS_TO, 'GroupType', 'group_type_ID'),
			'level' => array(self::BELONGS_TO, 'GroupLevel', 'level_ID'),
			'lessons' => array(self::HAS_MANY, 'Lessons', 'groups_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'CODE' => 'Группа',
			'group_type_ID' => 'Тип',
			'level_ID' => 'Сложность',
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
		$criteria->compare('CODE',$this->CODE,true);
		$criteria->compare('group_type_ID',$this->group_type_ID);
		$criteria->compare('level_ID',$this->level_ID);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Gets groups
	 * @return models Groups
	 */
	public function getGroups()
	{
		$criteria = new CDbCriteria();
		// admins can see all groups
		if (Yii::app()->user->role != Persons::PERSON_ADMIN) {
			$criteria->join = "INNER JOIN group_members gm ON gm.groups_ID = t.ID AND person_ID = " . Yii::app()->user->personId;
		}
		return Groups::model()->findAll($criteria);
	}
}