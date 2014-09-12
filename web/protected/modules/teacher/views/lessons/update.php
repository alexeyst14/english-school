<?php
$this->breadcrumbs=array(
	'Уроки'=>array('index'),
	date('d.m.Y H:i', strtotime($model->LESSON_DATE)) => array('view','id'=>$model->ID),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Уроки', 'url'=>array('index')),
	array('label'=>'Новый урок', 'url'=>array('create')),
);
?>

<h1>Редактирование урока за дату <?php echo date('d.m.Y H:i', strtotime($model->LESSON_DATE)); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'studentsData' => $studentsData)); ?>