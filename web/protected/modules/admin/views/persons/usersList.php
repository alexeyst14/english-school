<?php
$this->breadcrumbs=array(
    'Управление'=>array('index'),
    'Пользовалели',
);

$this->menu=array(
    array('label'=>'Новый пользователь', 'url'=>array('create')),
);
?>
<h1>Пользователи</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    //'filter'=>$model,
    'columns'=>array(
        array(
            'name'=>'ID',
        ),
        array(
            'name'=>'LOGIN',
        ),
        array(
            'name'  => 'person_ID',
            'value' => 
                'Persons::model()->findByPk($data->person_ID)->LAST_NAME'
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); 

?>
