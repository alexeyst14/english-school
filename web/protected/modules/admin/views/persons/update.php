<?php
$this->breadcrumbs=array(
    Constants::HEADER_MANAGE=>array('index'),
    Constants::HEADER_EDIT,
);

//$this->menu=array(
//    array('label'=>'Список уроков', 'url'=>array('index')),
//    array('label'=>'Новый урок', 'url'=>array('create')),
//);
    
?>

<h1>Редактирование персональных данных</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); 
?>