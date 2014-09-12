<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'persons-_form-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    
    <div class="row">
        <?php echo $form->labelEx($model,'person_type_ID'); ?>
        <?php echo $form->dropDownList($model, 'person_type_ID',
            PersonType::model()->getAllTypes(), array('style' => 'width: 150px;')); ?>        
        <?php echo $form->error($model,'person_type_ID'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'FIRST_NAME'); ?>
        <?php echo $form->textField($model,'FIRST_NAME'); ?>
        <?php echo $form->error($model,'FIRST_NAME'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'PATRONYMIC'); ?>
        <?php echo $form->textField($model,'PATRONYMIC'); ?>
        <?php echo $form->error($model,'PATRONYMIC'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'LAST_NAME'); ?>
        <?php echo $form->textField($model,'LAST_NAME'); ?>
        <?php echo $form->error($model,'LAST_NAME'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->