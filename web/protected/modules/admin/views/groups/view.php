<?php
$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Groups', 'url'=>array('index')),
	array('label'=>'Create Groups', 'url'=>array('create')),
	array('label'=>'Update Groups', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Groups', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Groups', 'url'=>array('admin')),
);
?>

<h1>View Groups #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'CODE',
		'group_type_ID',
		'level_ID',
	),
)); ?>
