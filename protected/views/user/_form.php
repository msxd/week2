<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<?

?>
<div class="form-horizontal col-xs-8 col-xs-offset-2" id="user_edit">

<h1 class="text-center"><span class="glyphicon glyphicon-pencil"></span><?echo ($create)?' Create user':' Update user #'.$model->id;?></h1>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>


	<div class="input-group col-xs-12">
		<span class="input-group-addon"><?php echo $form->labelEx($model,'email'); ?></span>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>


	<div class="input-group col-xs-12">
		<span class="input-group-addon ads"><?php echo $form->labelEx($model,'phone'); ?></span>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>



	<div class="input-group col-xs-12">
		<span class="input-group-addon ads"><?php echo $form->labelEx($model,'first_name'); ?></span>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="input-group col-xs-12">
		<span class="input-group-addon ads"><?php echo $form->labelEx($model,'last_name'); ?></span>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

<div class="inline to-select col-xs-12">
	<div class="col-xs-4">
		<?php echo $form->labelEx($model,'role_id',array('class'=>'col-xs-12')); ?>
		<?php echo $form->dropDownList($model,'role_id',array(User::ROLE_USER => 'User', User::ROLE_MODER => 'Moderator', User::ROLE_ADMIN => 'Admin'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'role_id'); ?>
	</div>

	<div class="col-xs-4">
		<?php echo $form->labelEx($model,'deleted',array('class'=>'col-xs-12')); ?>
		<?php echo $form->dropDownList($model,'deleted',array(User::DEL_FALSE=>'Active',User::DEL_TRUE=>'Deleted'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'deleted'); ?>
	</div>

	<div class="col-xs-4">
		<?php echo $form->labelEx($model,'approved',array('class'=>'col-xs-12')); ?>
		<?php echo $form->dropDownList($model,'approved',array(User::APPROVE_FALSE=>'Not approved',User::APPROVE_TRUE=>'Approved'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'approved'); ?>
	</div>
</div>
	<div class="input-group col-xs-12">
		<span class="input-group-addon ads"><?php echo $form->labelEx($model,'facebook_id'); ?></span>
		<?php echo $form->textField($model,'facebook_id',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'facebook_id'); ?>
	</div>


	<div class="buttons text-center">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-default btn-lg')); ?>
	</div>

<?php $this->endWidget(); ?>

</div> <!-- form -->