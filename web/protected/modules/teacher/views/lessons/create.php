<?php
$this->breadcrumbs=array(
	'Уроки'=>array('index'),
	'Новый',
);

$this->menu=array(
	array('label'=>'Все уроки', 'url'=>array('index')),
);
?>

<h1>Новый урок</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'studentsData'=>$studentsData)); ?>