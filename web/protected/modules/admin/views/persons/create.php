<?php
$this->breadcrumbs=array(
	Constants::HEADER_MANAGE=>array('index'),
	Constants::HEADER_NEW,
);

/*$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);*/
?>

<h1>Новый человек</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>