<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

    	<div class="row">
		<?php echo $form->label($model,'LAST_NAME'); ?>
		<?php echo $form->textField($model,'LAST_NAME',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FIRST_NAME'); ?>
		<?php echo $form->textField($model,'FIRST_NAME',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PATRONYMIC'); ?>
		<?php echo $form->textField($model,'PATRONYMIC',array('size'=>45,'maxlength'=>45)); ?>
	</div>

        <div class="row">
            <?php echo $form->label($model,'person_type_ID'); ?>
            <?php echo $form->dropDownList($model, 'person_type_ID',
                PersonType::model()->getAllTypes(), array('style' => 'width: 150px;')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->