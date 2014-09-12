<?php
$this->breadcrumbs=array(
	Constants::HEADER_MANAGE=>array('index'),
	Constants::HEADER_GROUPS,
);

$this->menu=array(
	array('label'=>'List Groups', 'url'=>array('index')),
	array('label'=>'Create Groups', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('groups-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Groups</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'groups-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CODE',
		array(
			'name'   => 'group_type_ID',
			'value'  => '$data->groupType->NAME',
			'filter' => CHtml::listData(GroupType::model()->findAll(), 'ID', 'NAME'),
		),
		array(
			'name'   => 'level_ID',
			'value'  => '$data->level->NAME',
			'filter' => CHtml::listData(GroupLevel::model()->findAll(), 'ID', 'NAME'),
		),

		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
