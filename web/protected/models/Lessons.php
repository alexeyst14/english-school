<?php

/**
 * This is the model class for table "lessons".
 *
 * The followings are the available columns in table 'lessons':
 * @property integer $ID
 * @property string $LESSON_DATE
 * @property string $COMMENT
 * @property string $DESCRIPTION
 * @property integer $person_ID
 * @property integer $groups_ID
 * @property double $HOURS
 *
 * The followings are the available model relations:
 * @property Attendance[] $attendances
 * @property Persons $person
 * @property Groups $groups
 */
class Lessons extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Lessons the static model class
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
		return 'lessons';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('COMMENT, DESCRIPTION', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, LESSON_DATE, COMMENT, DESCRIPTION, person_ID, groups_ID', 'safe', 'on'=>'search'),
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
			'attendances' => array(self::HAS_MANY, 'Attendance', 'lessons_ID'),
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
			'LESSON_DATE' => 'Дата',
			'COMMENT' => 'Комментарий',
			'DESCRIPTION' => 'Описание',
			'person_ID' => 'Преподаватель',
			'groups_ID' => 'Группа',
			'HOURS' => 'Часы',
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
		$date = !empty($this->LESSON_DATE) ? date('Y-m-d', strtotime($this->LESSON_DATE)) : $this->LESSON_DATE;
		$criteria->compare('LESSON_DATE', $date, true);
		$criteria->compare('COMMENT',$this->COMMENT,true);
		$criteria->compare('DESCRIPTION',$this->DESCRIPTION,true);
		$criteria->compare('person_ID',$this->person_ID);
		$criteria->compare('groups_ID',$this->groups_ID);
		if (Yii::app()->user->role == Persons::PERSON_ADMIN) {
			$criteria->compare('groups_ID',$this->groups_ID);
		} else {
			$criteria->compare('groups_ID',$_SESSION['group_ID']);
		}
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'LESSON_DATE DESC',
			),
		));

	}

	protected function beforeSave()
	{
		// setup LESSON_DATE
		$datetime = strtotime($_POST['lessonDate'] . ' ' . $_POST['lessonTime'] . ':00');
		$this->LESSON_DATE = date('Y-m-d H:i:00', $datetime);

		// setup HOURS
		$this->HOURS = DateTimeLib::hoursToDecimal($_POST['lessonHours']);

		// setup groups_ID
		$this->groups_ID = (int) $_SESSION['group_ID'];

		// setup person_ID
		$this->person_ID = Yii::app()->user->personId;
		return true;
	}
}