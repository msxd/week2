<?php
/* @var $this ProfileController */
/* @var $model User */
/* @var $form CActiveForm */
?>
<div class="form-horizontal col-xs-8 col-xs-offset-2" id="user_edit">

	<h1 class="text-center"><span class="glyphicon glyphicon-pencil"></span>Change password</h1>


	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'user-form',
		'enableAjaxValidation' => false,
	)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="input-group col-xs-12 padingf">
		<span class="input-group-addon ads"><?php echo $form->labelEx($model, 'old_pass'); ?></span>
		<?php echo $form->passwordField($model, 'old_pass', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
		<?php echo $form->error($model, 'old_pass'); ?>
	</div>

	<div class="input-group col-xs-12 padingf">
		<span class="input-group-addon ads"><?php echo $form->labelEx($model, 'pass'); ?></span>
		<?php echo $form->passwordField($model, 'pass', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
		<?php echo $form->error($model, 'pass'); ?>
	</div>

	<div class="input-group col-xs-12 padingf">
		<span class="input-group-addon ads"><?php echo $form->labelEx($model, 'r_pass'); ?></span>
		<?php echo $form->passwordField($model, 'r_pass', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
		<?php echo $form->error($model, 'r_pass'); ?>
	</div>


	<div class="buttons text-center padingf">
		<?php echo CHtml::submitButton('Save', array('class' => 'btn btn-default btn-lg')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div> <!-- form -->
