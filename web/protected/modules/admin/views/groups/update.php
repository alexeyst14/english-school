<?php
$this->breadcrumbs=array(
	Constants::HEADER_GROUPS=>array('index'),
	Constants::HEADER_EDIT,
);

$this->menu=array(
	array('label'=>'List Groups', 'url'=>array('index')),
	array('label'=>'Create Groups', 'url'=>array('create')),
	array('label'=>'View Groups', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Groups', 'url'=>array('admin')),
);
?>

<h1>Update Groups <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>