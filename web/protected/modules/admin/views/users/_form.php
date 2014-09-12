<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'person_ID'); ?>
        <?php echo $form->dropDownList($model, 'person_ID', Persons::model()->getAll(), array('style' => 'width: 200px;')); ?>
        <?php echo $form->error($model,'person_ID'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'LOGIN'); ?>
		<?php echo $form->textField($model,'LOGIN',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'LOGIN'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PASSWORD'); ?>
		<?php echo $form->passwordField($model,'PASSWORD',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'PASSWORD'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'PASSWORD_CONFIRM'); ?>
		<?php echo $form->passwordField($model,'PASSWORD_CONFIRM',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'PASSWORD_CONFIRM'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->