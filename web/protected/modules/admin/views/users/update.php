<?php
$this->breadcrumbs=array(
    Constants::HEADER_MANAGE=>array('index'),
	Constants::HEADER_USERS=>array('index'),
	Constants::HEADER_EDIT,
);

    if(!$model->getIsNewRecord()){
        $model->PASSWORD_CONFIRM = $model->PASSWORD;
    }
    
?>

<h1>Редактирование данных пользователя</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
