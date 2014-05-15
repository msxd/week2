<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */

?>

<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'comment-_addComment-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// See class documentation of CActiveForm for details on this,
		// you need to use the performAjaxValidation()-method described there.
		'enableAjaxValidation'=>false,
	)); ?>
	<div class="col-xs-8 col-xs-offset-2">
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<p id="to"></p>
	<?php echo $form->errorSummary($model);
	?>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textField($model,'body'); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row" style="visibility: hidden;">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo $form->textField($model,'parent_id'); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>

	<div class="row" style="visibility: hidden;">
		<?php echo $form->labelEx($model,'post_id'); ?>
		<?php echo $form->textField($model,'post_id'); ?>
		<?php echo $form->error($model,'post_id'); ?>
	</div>




	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

	<?php $this->endWidget(); ?>
		<a id="addComment"></a>
</div><!-- form -->

</div>