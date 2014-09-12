<?php
$this->breadcrumbs=array(
	'Persons'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Persons', 'url'=>array('index')),
	array('label'=>'Create Persons', 'url'=>array('create')),
	array('label'=>'Update Persons', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Persons', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Persons', 'url'=>array('admin')),
);
?>

<h1>View Persons #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'FIRST_NAME',
		'PATRONYMIC',
		'LAST_NAME',
		'person_type_ID',
	),
)); ?>
