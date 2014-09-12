<?php
$this->breadcrumbs=array(
    Constants::HEADER_MANAGE=>array('Persons/index'),
    Constants::HEADER_USERS=>array('users/index'),
    Constants::HEADER_NEW,
);

$this->menu=array(
	array('label'=>'Список пользователей', 'url'=>array('index')),
);
?>

<h1>Новый пользователь</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>