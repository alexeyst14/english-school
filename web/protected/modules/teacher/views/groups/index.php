<?php
$this->breadcrumbs=array(
	'Выберите группу',
);
?>

<h1>Выберите группу</h1>
<div class="form">
	<?php echo CHtml::beginForm(); ?>
	<div class="row">
		<?php echo CHtml::label('Тип:', 'groupType'); ?>
		<?php echo CHtml::dropDownList("groupType", null, $groupTypes, array('style' => 'width: 150px;')); ?>
	</div>
	<div class="row">
		<?php echo CHtml::label('Сложность:', 'groupLevel'); ?>
		<?php echo CHtml::dropDownList("groupLevel", null, $groupLevels, array('style' => 'width: 150px;')); ?>
	</div>
	<div class="row">
		<?php echo CHtml::label('Группа:', 'group'); ?>
		<?php echo CHtml::dropDownList("group", null, array(), array('style' => 'width: 150px; float: left;')); ?>
		<div id="loading" style="margin-left: 5px; height: 16px; width: 16px; float: left;"></div>
		<br class="clear"/>
	</div>
	<div class="row">
		<?php echo CHtml::submitButton("Продолжить", array('id' => 'btn_continue', 'disabled' => 'disabled')); ?>
	</div>
	<?php echo CHtml::endForm(); ?>
</div>