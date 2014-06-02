<?php
/* @var $this ProfileController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form-horizontal col-xs-8 col-xs-offset-2" id="user_edit">

	<h1 class="text-center"><span class="glyphicon glyphicon-pencil"></span>My profile</h1>


	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'user-form',
		'enableAjaxValidation' => false,
	)); ?>

	<?php echo $form->errorSummary($model); ?>


	<div class="input-group col-xs-12 padingf">
		<span class="input-group-addon ads"><?php echo $form->labelEx($model, 'email'); ?></span>
		<?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
		<?php echo $form->error($model, 'email'); ?>
	</div>

	<div class="input-group col-xs-12 padingf">
		<span class="input-group-addon ads"><?php echo $form->labelEx($model, 'phone'); ?></span>
		<?php echo $form->textField($model, 'phone', array('class' => 'form-control')); ?>
		<?php echo $form->error($model, 'phone'); ?>
	</div>

	<div class="input-group col-xs-12 padingf">
		<span class="input-group-addon ads"><?php echo $form->labelEx($model, 'first_name'); ?></span>
		<?php echo $form->textField($model, 'first_name', array('class' => 'form-control')); ?>
		<?php echo $form->error($model, 'first_name'); ?>
	</div>

	<div class="input-group col-xs-12 padingf">
		<span class="input-group-addon ads"><?php echo $form->labelEx($model, 'last_name'); ?></span>
		<?php echo $form->textField($model, 'last_name', array('class' => 'form-control')); ?>
		<?php echo $form->error($model, 'last_name'); ?>
	</div>

	<div class="input-group col-xs-12 padingf">
		<span class="input-group-addon ads"><?php echo $form->labelEx($model, 'facebook_id'); ?></span>
		<?php echo $form->textField($model, 'facebook_id', array('class' => 'form-control')); ?>
		<?= $form->error($model, 'facebook_id'); ?>
	</div>


	<div class="buttons text-center padingf">
		<?= CHtml::submitButton('Save', array('class' => 'btn btn-default btn-lg')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div> <!-- form -->