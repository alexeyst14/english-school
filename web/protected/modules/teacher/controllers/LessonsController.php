<?php

class LessonsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'roles' => array('teacher'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'roles' => array('teacher'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$this->render('view',array(
			'model'=>$model,
			'studentsData' => Persons::model()->getStudentsByLessonId($model->ID),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Lessons;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Lessons']))
		{
			$model->attributes=$_POST['Lessons'];
			if($model->save()) {
				// saving students attendance
				$attendance = isset($_POST['attendance']) && is_array($_POST['attendance']) ?
							  $_POST['attendance'] : array();
				Attendance::model()->saveAttendance((int)$model->ID, $_SESSION['group_ID'], $attendance);

				// redirect to view lesson
				$this->redirect(array('view','id'=>$model->ID));
			}
		}

		// render page
		$this->render('create',array(
			'model'        => $model,
			'studentsData' => Persons::model()->getStudentsByGroupId($_SESSION['group_ID']),
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Lessons']))
		{
			$model->attributes=$_POST['Lessons'];
			if($model->save()) {
				// saving students attendance
				$attendance = isset($_POST['attendance']) && is_array($_POST['attendance']) ?
							  $_POST['attendance'] : array();
				Attendance::model()->saveAttendance((int)$model->ID, $_SESSION['group_ID'], $attendance, false);
				$this->redirect(array('view','id'=>$model->ID));
			}
		}

		// render page
		$this->render('update',array(
			'model'=>$model,
			'studentsData' => Persons::model()->getStudentsByLessonId($model->ID),
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		// if no group - goto select group
		if (!isset($_SESSION['group_ID'])) {
			$this->redirect(array('groups'));
		};
/*
		$dataProvider=new CActiveDataProvider('Lessons', array(
			'criteria' => array(
				'condition' => 'groups_ID = ' . (int)$_SESSION['group_ID'],
				//'order'     => 'LESSON_DATE DESC',
			)
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
*/
		$model=new Lessons('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Lessons'])){
			$model->attributes=$_GET['Lessons'];
		}

		$this->render('index',array(
			'model'=>$model,
		));

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Lessons::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='lessons-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
