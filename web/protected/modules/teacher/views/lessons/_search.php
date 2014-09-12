<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID'); ?>
		<?php echo $form->textField($model,'ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LESSON_DATE'); ?>
		<?php echo $form->textField($model,'LESSON_DATE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COMMENT'); ?>
		<?php echo $form->textField($model,'COMMENT',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DESCRIPTION'); ?>
		<?php echo $form->textField($model,'DESCRIPTION',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'person_ID'); ?>
		<?php echo $form->textField($model,'person_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'groups_ID'); ?>
		<?php echo $form->textField($model,'groups_ID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->