<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'groups-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'CODE'); ?>
		<?php echo $form->textField($model,'CODE',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'CODE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group_type_ID'); ?>
		<?php echo $form->textField($model,'group_type_ID'); ?>
		<?php echo $form->error($model,'group_type_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'level_ID'); ?>
		<?php echo $form->textField($model,'level_ID'); ?>
		<?php echo $form->error($model,'level_ID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->