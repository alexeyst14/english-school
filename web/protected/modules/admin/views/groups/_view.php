<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CODE')); ?>:</b>
	<?php echo CHtml::encode($data->CODE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('group_type_ID')); ?>:</b>
	<?php echo CHtml::encode($data->group_type_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('level_ID')); ?>:</b>
	<?php echo CHtml::encode($data->level_ID); ?>
	<br />


</div>