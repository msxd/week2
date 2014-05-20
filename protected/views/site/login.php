<?php
/* @var UserController $this  */
/* @var User $model  */
/* @var CActiveForm $form  */
?>

<div id="form_sign" class="col-sm-offset-3 col-sm-6">
	<h2 align="center">Log In</h2>
<?php

	$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-login-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'form-horizontal'),
)); ?>


	<?php echo $form->errorSummary($model); ?>



	<div class="form-group">
		<?php echo $form->labelEx($model,'email',array('class'=>'col-sm-2 col-xs-8 control-label')); ?>
		<div class="col-sm-8">
			<?php echo $form->textField($model,'email',array('class'=>'form-control','placeholder'=>'Enter e-mail','type'=>'email','required'=>'required')); ?>
		</div>
	</div>


	<div class="form-group">
		<?php echo $form->labelEx($model,'pass',array('class'=>'col-sm-2 col-xs-4 control-label')); ?>
		<div class="col-sm-8">
			<?php echo $form->passwordField($model,'pass',array('class'=>'form-control','placeholder'=>'Enter password','required'=>'required')); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-8 col-sm-offset-2" style="text-align: right;">
			<?php echo '<a href="'.$this->createUrl('/mailur/recovery/').'">Forgot password?</a>'; ?>
		</div>
	</div>

	<div class="form-group" style="text-align: center;">

			<?php echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary btn-lg')); ?>

	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->