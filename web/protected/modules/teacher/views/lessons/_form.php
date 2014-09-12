<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lessons-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="boxborder">
		<div style="float: left; width: 100px;">
			<div class="row">
				<?php echo CHtml::label('Дата', 'lessonDate'); ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'language'=>'ru',
					'name' => 'lessonDate',
					'value' => $model->isNewRecord ? date('d.m.Y') : date('d.m.Y', strtotime($model->LESSON_DATE)),
					'options'=>array(
						'showAnim'=>'fold',
						'dateFormat'=>'dd.mm.yy',
					),

					'htmlOptions'=>array(
						'style'=>'width: 80px;'
					),
				)); ?>


				<?php echo $form->error($model,'LESSON_DATE'); ?>
			</div>
		</div>
		<div style="float: left; width: 100px;">
			<div class="row">
				<?php echo CHtml::label('Время', 'lessonTime'); ?>
				<?php echo CHtml::dropDownList(
					'lessonTime',
					$model->isNewRecord ? DateTimeLib::getCurrTime(15) : date('H:i', strtotime($model->LESSON_DATE)),
					DateTimeLib::timePickerData(),
					array('style' => 'width: 80px;')
				); ?>
			</div>
		</div>
		<div style="float: right; width: 100px;">
			<div class="row">
				<?php echo CHtml::label('Время лекции', 'lessonHours'); ?>
				<?php echo CHtml::dropDownList(
						'lessonHours',
						$model->isNewRecord ? '01:00' : DateTimeLib::decimalToHours($model->HOURS),
						DateTimeLib::hoursPickerData(),
						array('style' => 'width: 80px;')
				); ?>
				<?php echo $form->error($model,'HOURS'); ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="row boxborder">
		<div style="float: left; width: 30%;">
			<?php echo $form->labelEx($model,'DESCRIPTION'); ?>
		</div>
		<div style="float: left; width: 70%;">
			<?php echo $form->textArea($model,'DESCRIPTION',array('rows'=>3, 'style'=>'width: 98%;', 'size'=>150,'maxlength'=>500)); ?>
			<?php echo $form->error($model,'DESCRIPTION'); ?>
		</div>
		<br class="clear" />
	</div>

	<div class="row boxborder">
		<div style="float: left; width: 30%;">
			<?php echo $form->labelEx($model,'COMMENT'); ?>
		</div>
		<div style="float: left; width: 70%;">
			<?php echo $form->textArea($model,'COMMENT',array('rows'=>3, 'style'=>'width: 98%;', 'size'=>150,'maxlength'=>500)); ?>
			<?php echo $form->error($model,'COMMENT'); ?>
		</div>
		<br class="clear" />
	</div>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$studentsData,
		//'filter'=>$model,

		'columns'=>array(
			array(
				'name'  => '#',
				'value' => '$row+1',
				'htmlOptions' => array('style' => 'text-align: center;'),
			),
			array(
				'name'=>'person.LAST_NAME',
			),
			array(
				'name'=>'person.FIRST_NAME',
			),
			array(
				'name'=>'person.PATRONYMIC',
			),

			array(
				'class' => 'CCheckBoxColumn',
				'value' => '$data->person->ID',
				'checked' => $model->isNewRecord ? 'true' : '(boolean)$data->PRESENCE_SIGN',
				'selectableRows' => 2,
				'id' => 'attendance',
			),
		),
	)); ?>
	<p class="note">Отметьте галочками присутствующих студентов</p>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->