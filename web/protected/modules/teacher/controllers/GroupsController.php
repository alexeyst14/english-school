<?php

class GroupsController extends Controller
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
				'actions'=>array('index', 'getgroupsajax'),
				'roles'=>array('teacher'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actionIndex()
	{
		// redirec if group selected
		if (isset($_POST['group']) && (int)$_POST['group'] > 0) {
			$_SESSION['group_ID'] = (int)$_POST['group'];
			$this->redirect(array('/teacher/lessons'));
		}

		// append jquery and javascript
		$cs = Yii::app()->clientScript;
	    $cs->registerCoreScript('jquery');
		$cs->registerScriptFile(Yii::app()->getRequest()->getBaseUrl(true) . '/js/groups/groups.js');

		// render page
		$this->render('index',array(
			'groupTypes'  => GroupType::model()->getAllTypes(),
			'groupLevels' => GroupLevel::model()->getAllLevels(),
		));
	}

	public function actionGetGroupsAjax()
	{
		$groups = array();
		Yii::app()->request->getPost('groupType');
		Yii::app()->request->getPost('groupLevel');

		$criteria = new CDbCriteria();
		$criteria->compare('group_type_ID', (int)Yii::app()->request->getQuery('groupType'));
		$criteria->compare('level_ID', (int)Yii::app()->request->getQuery('groupLevel'));

		// admins can see all groups
		if (Yii::app()->user->role != Persons::PERSON_ADMIN) {
			$criteria->join = "INNER JOIN group_members gm ON gm.groups_ID = t.ID AND person_ID = " . Yii::app()->user->personId;;
		}

		$model = Groups::model()->findAll($criteria);

		foreach ($model as $row) {
			$groups[$row->ID] = $row->CODE;
		}
		echo json_encode($groups);
	}

}
