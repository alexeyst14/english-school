<?php

/**
 * This is the model class for table "attendance".
 *
 * The followings are the available columns in table 'attendance':
 * @property integer $ID
 * @property integer $PRESENCE_SIGN
 * @property integer $lessons_ID
 * @property integer $person_ID
 *
 * The followings are the available model relations:
 * @property Persons $person
 * @property Lessons $lessons
 */
class Attendance extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Attendance the static model class
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
		return 'attendance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lessons_ID, person_ID', 'required'),
			array('PRESENCE_SIGN, lessons_ID, person_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, PRESENCE_SIGN, lessons_ID, person_ID', 'safe', 'on'=>'search'),
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
			'lessons' => array(self::BELONGS_TO, 'Lessons', 'lessons_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'PRESENCE_SIGN' => 'Был',
			'lessons_ID' => 'Lessons',
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
		$criteria->compare('PRESENCE_SIGN',$this->PRESENCE_SIGN);
		$criteria->compare('lessons_ID',$this->lessons_ID);
		$criteria->compare('person_ID',$this->person_ID);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public function saveAttendance($lessonId, $groupId, array $attendance, $isNewRecord = true)
	{
		$connection = Yii::app()->db;

		/*
		 *  Processing array. Elements must be integer, and array must have
		 *  one element at the minimum.
		 */
		$attendance = array_map('intval', $attendance);
		array_unshift($attendance, 0);

		// Saving attendence
		// saving all students
		if ($isNewRecord) {
			$sql = "
				INSERT INTO attendance (PRESENCE_SIGN, lessons_ID, person_ID)
				SELECT 0, :lessonid, gm.person_ID
				FROM group_members gm
				INNER JOIN persons p ON p.ID = gm.person_ID
				WHERE p.person_type_ID = 2 AND gm.groups_ID = :groupid
			";
			$command=$connection->createCommand($sql);
			$command->bindParam(":lessonid",  $lessonId, PDO::PARAM_INT);
			$command->bindParam(":groupid",   $groupId, PDO::PARAM_INT);
			$command->execute();
		}

		// update presence students
		$sql = "
			UPDATE attendance SET PRESENCE_SIGN = 0
			WHERE lessons_ID = :lessonid
			AND person_ID NOT IN (" . join(',', $attendance) . ")
		";
		$command=$connection->createCommand($sql);
		$command->bindParam(":lessonid",  $lessonId, PDO::PARAM_INT);
		$command->execute();

		$sql = "
			UPDATE attendance SET PRESENCE_SIGN = 1
			WHERE lessons_ID = :lessonid
			AND person_ID IN (" . join(',', $attendance) . ")
		";
		$command=$connection->createCommand($sql);
		$command->bindParam(":lessonid",  $lessonId, PDO::PARAM_INT);
		$command->execute();
	}
}