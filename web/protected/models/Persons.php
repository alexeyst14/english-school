<?php

/**
 * This is the model class for table "persons".
 *
 * The followings are the available columns in table 'persons':
 * @property integer $ID
 * @property string $FIRST_NAME
 * @property string $PATRONYMIC
 * @property string $LAST_NAME
 * @property integer $person_type_ID
 *
 * The followings are the available model relations:
 * @property Attendance[] $attendances
 * @property GroupMembers[] $groupMembers
 * @property Lessons[] $lessons
 * @property PersonType $personType
 * @property Users[] $users
 */
class Persons extends CActiveRecord
{
	const PERSON_TEACHER = 'teacher';
	const PERSON_STUDENT = 'student';
	const PERSON_ADMIN   = 'admin';

	/**
	 * Returns the static model of the specified AR class.
	 * @return Persons the static model class
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
		return 'persons';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('person_type_ID', 'required'),
			array('person_type_ID', 'numerical', 'integerOnly'=>true),
			array('FIRST_NAME, PATRONYMIC, LAST_NAME', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, FIRST_NAME, PATRONYMIC, LAST_NAME, person_type_ID', 'safe', 'on'=>'search'),
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
			'attendances' => array(self::HAS_MANY, 'Attendance', 'person_ID'),
			'groupMembers' => array(self::HAS_MANY, 'GroupMembers', 'person_ID'),
			'lessons' => array(self::HAS_MANY, 'Lessons', 'person_ID'),
			'personType' => array(self::BELONGS_TO, 'PersonType', 'person_type_ID'),
			'users' => array(self::HAS_MANY, 'Users', 'person_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'FIRST_NAME' => 'Имя',
			'PATRONYMIC' => 'Отчество',
			'LAST_NAME' => 'Фамилия',
			'person_type_ID' => 'Тип',
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
		$criteria->compare('FIRST_NAME',$this->FIRST_NAME,true);
		$criteria->compare('PATRONYMIC',$this->PATRONYMIC,true);
		$criteria->compare('LAST_NAME',$this->LAST_NAME,true);
		$criteria->compare('person_type_ID',$this->person_type_ID, true);

                $dataProvider = new CActiveDataProvider('Persons', array(
                    'criteria' => $criteria,
                    'sort'=>array(
                        'attributes'=>array('LAST_NAME', 'PATRONYMIC', 'FIRST_NAME'),
                        'defaultOrder'=>'LAST_NAME, PATRONYMIC, FIRST_NAME',
					),
                    'pagination' => array('pageSize' => Yii::app()->params['perPage'],
                    ),
                ));
		return $dataProvider;
	}
    
    public function getAll()
    {
        $persons = array();
        foreach ($this->findAllByAttributes(array('person_type_ID'=>1)) as $row) {
            $persons[$row->ID] = $row->LAST_NAME.' '.mb_substr($row->FIRST_NAME,0,2).'. '.mb_substr($row->PATRONYMIC,0,2);
        }
        foreach ($this->findAllByAttributes(array('person_type_ID'=>3)) as $row) {
            $persons[$row->ID] = $row->LAST_NAME.' '.mb_substr($row->FIRST_NAME,0,2).'. '.mb_substr($row->PATRONYMIC,0,2);
        }
        asort($persons);
        return $persons; 
    }

	/**
	 * Gets students in defined group by field group_ID
	 * @param int $groupId
	 * @return CActiveDataProvider
	 */
	public function getStudentsByGroupId($groupId)
	{
		$criteria = new CDbCriteria;
		$criteria->with = array('person');
		$criteria->compare('person.person_type_ID', 2);
		$criteria->compare('groups_ID', (int)$groupId);

		$studentsData = new CActiveDataProvider("GroupMembers", array(
			'criteria' => $criteria,
			'pagination' => false,
		));
		return $studentsData;
	}

	/**
	 * Gets students in defined lesson by field lesson_ID
	 * @param int $groupId
	 * @return CActiveDataProvider
	 */
	public function getStudentsByLessonId($lessonId) {

		$criteria = new CDbCriteria;
		$criteria->with = array('person');
		$criteria->compare('person.person_type_ID', 2);
		$criteria->compare('lessons_ID', (int)$lessonId);
		
		$studentsData = new CActiveDataProvider("Attendance", array(
			'criteria' => $criteria,
			'pagination' => false,
		));
		return $studentsData;
	}
}
