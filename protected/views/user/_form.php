<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<?php

?>
<div class="form-horizontal col-xs-8 col-xs-offset-2" id="user_edit">

	<h1 class="text-center"><span
			class="glyphicon glyphicon-pencil"></span><?= ($create) ? ' Create user' : ' Update user #' . $model->id; ?>
	</h1>


	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'user-form',
		'enableAjaxValidation' => false,
	)); ?>

	<?= $form->errorSummary($model); ?>


	<div class="input-group col-xs-12 padingf">
		<span class="input-group-addon ads"><?= $form->labelEx($model, 'email'); ?></span>
		<?= $form->textField($model, 'email', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
		<?= $form->error($model, 'email'); ?>
	</div>

	<div class="input-group col-xs-12 padingf">
		<span class="input-group-addon ads"><?= $form->labelEx($model, 'phone'); ?></span>
		<?= $form->textField($model, 'phone', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
		<?= $form->error($model, 'phone'); ?>
	</div>

	<div class="input-group col-xs-12 padingf">
		<span class="input-group-addon ads"><?= $form->labelEx($model, 'first_name'); ?></span>
		<?= $form->textField($model, 'first_name', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
		<?= $form->error($model, 'first_name'); ?>
	</div>

	<div class="input-group col-xs-12 padingf">
		<span class="input-group-addon ads"><?= $form->labelEx($model, 'last_name'); ?></span>
		<?= $form->textField($model, 'last_name', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
		<?= $form->error($model, 'last_name'); ?>
	</div>

	<div class="inline to-select col-xs-12 padingf">
		<div class="col-xs-4">
			<?= $form->labelEx($model, 'role_id', array('class' => 'col-xs-12')); ?>
			<?= $form->dropDownList($model, 'role_id', array(User::ROLE_USER => 'User', User::ROLE_MODER => 'Moderator', User::ROLE_ADMIN => 'Admin'), array('class' => 'form-control')); ?>
			<?= $form->error($model, 'role_id'); ?>
		</div>

		<div class="col-xs-4">
			<?= $form->labelEx($model, 'deleted', array('class' => 'col-xs-12')); ?>
			<?= $form->dropDownList($model, 'deleted', array(User::DEL_FALSE => 'Active', User::DEL_TRUE => 'Deleted'), array('class' => 'form-control')); ?>
			<?= $form->error($model, 'deleted'); ?>
		</div>

		<div class="col-xs-4">
			<?= $form->labelEx($model, 'approved', array('class' => 'col-xs-12')); ?>
			<?= $form->dropDownList($model, 'approved', array(User::APPROVE_FALSE => 'Not approved', User::APPROVE_TRUE => 'Approved'), array('class' => 'form-control')); ?>
			<?= $form->error($model, 'approved'); ?>
		</div>
	</div>

	<div class="input-group col-xs-12 padingf">
		<span class="input-group-addon ads"><?= $form->labelEx($model, 'facebook_id'); ?></span>
		<?= $form->textField($model, 'facebook_id', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
		<?= $form->error($model, 'facebook_id'); ?>
	</div>


	<div class="buttons text-center padingf">
		<?= CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-default btn-lg')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div> <!-- form -->