<?php
$this->breadcrumbs=array(
    Constants::HEADER_MANAGE,
);

$this->menu=array(
    array('label'=>Constants::HEADER_NEW, 'url'=>array('create')),
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

echo CHtml::link('Расширенный поиск ...','#',array('class'=>'search-button'));
?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array('model'=>$model,));?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    //'enableSorting'=>array('LAST_NAME'),
    'columns'=>array(
        array(
            'name'=>'person_type_ID',
			'filter' => CHtml::listData(PersonType::model()->findAll(), 'ID', 'NAME'),
			'value' => '$data->personType->NAME',
        ),
        array(
            'name'=>'LAST_NAME',
        ),
        array(
            'name'=>'FIRST_NAME',
        ),
        array(
            'name'=>'PATRONYMIC',
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); 

?>    

