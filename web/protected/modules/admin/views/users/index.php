<?php
$this->breadcrumbs=array(
    Constants::HEADER_MANAGE=>array('//admin/Persons/index'),
    Constants::HEADER_USERS,
);

$this->menu=array(
    array('label'=>Constants::HEADER_NEW_USER, 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Пользователи</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        array(
            'name'=>'LOGIN',
            'sortable'=>true,
        ),
        array(
            'name' =>'person_ID',
            'value'=>'$data->person->LAST_NAME
                .\' \'.mb_substr($data->person->FIRST_NAME,0,2)
                .\'. \'.mb_substr($data->person->PATRONYMIC,0,2)',
            'sortable'=>true,
        ),
        array(
            'header' => Yii::t('app', 'Тип'),
            'name' =>'personType',
            'value'=>'$data->person->personType->NAME',
            'sortable'=>true,
            'htmlOptions'=>array(style=>'width:16px; background-color: #E6EFC2;'),
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); 

?>
