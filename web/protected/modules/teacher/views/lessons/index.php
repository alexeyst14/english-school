<?php
$this->breadcrumbs=array(
	'Уроки',
);

$this->menu=array(
	array('label'=>'Новый урок', 'url'=>array('create')),
);
?>

<h1>Уроки</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$model->search(),
    'filter'=>$model,
	'afterAjaxUpdate' => "
		function(){
			jQuery('#".CHtml::activeId($model, 'LESSON_DATE')."').datepicker({
				showAnim: 'fold',
				dateFormat: 'dd.mm.yy'
			})
		}
	",
    'columns'=>array(
        array(
            'name'  => 'LESSON_DATE',
			'value' => 'date("d.m.Y H:i", strtotime($data->LESSON_DATE))',
			'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model' => $model,
				'attribute' => 'LESSON_DATE',
				'options'=>array(
					'showAnim'=>'fold',
					'dateFormat'=>'dd.mm.yy',
				),
			), true),
        ),
        array(
            'name'  => 'groups_ID',
			'value' => '$data->groups->CODE',
			'filter' => CHtml::listData(Groups::model()->getGroups(),'ID','CODE'),
        ),
        array(
            'name'=>'DESCRIPTION',
        ),
        array(
            'name'=>'COMMENT',
        ),
        array(
            'name'=>'HOURS',
			'value'=>'DateTimeLib::decimalToHours($data->HOURS)',
			'sortable' => false,
			'filter' => false,

        ),
        array(
            'class'=>'CButtonColumn',
			'template' => '{view} {update}',
        ),
    ),
)); ?>