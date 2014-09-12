<?php
$this->breadcrumbs=array(
	'Уроки'=>array('index'),
	date('d.m.Y H:i', strtotime($model->LESSON_DATE)) => array('view','id'=>$model->ID),
);

$this->menu=array(
	array('label'=>'Уроки', 'url'=>array('index')),
	array('label'=>'Новый урок', 'url'=>array('create')),
	array('label'=>'Изменить это урок', 'url'=>array('update', 'id'=>$model->ID)),
);
?>

<h1>Информация об уроке от <?php echo date("d.m.Y H:i", strtotime($model->LESSON_DATE)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'groups.CODE',
		'DESCRIPTION',
		'COMMENT',
		array(
			'label' => 'Преподаватель',
			'value' => $model->person->LAST_NAME .' '. $model->person->FIRST_NAME .' '. $model->person->PATRONYMIC,
		),
	),
)); ?>

<br/>
<h3>Студенты</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$studentsData,
	//'filter'=>$model,

	'columns'=>array(
		array(
			'name'  => '#',
			'value' => '$row+1',
			'htmlOptions' => array('style' => 'text-align: center;'),
		),
		array(
			'name'=>'person.LAST_NAME',
		),
		array(
			'name'=>'person.FIRST_NAME',
		),
		array(
			'name'=>'person.PATRONYMIC',
		),
		array(
			'name'  => 'PRESENCE_SIGN',
			'value' => '$data->PRESENCE_SIGN ? "Да" : "Нет"',
			'htmlOptions' => array('style' => 'text-align: center;'),
		),
	),
)); ?>
