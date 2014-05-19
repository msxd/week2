<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */

?>

<div class="form">

	<?php  $form=$this->beginWidget('CActiveForm', array(
		'id'=>'users-signin-form',
		'htmlOptions' => array('class' => 'form-horizontal', 'enctype'=>'multipart/form-data'),
		'enableAjaxValidation'=>false,
	));
?>
	<div class="col-xs-8 col-xs-offset-2">
	<p id="to"></p>
	<?php echo $form->errorSummary($model);
	?>
		<div class="row">
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email'); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>
		<?
		$this->widget(
			'bootstrap.widgets.TbCKEditor',
			array(
				'model' => $model,
				'attribute' => 'body',
				'editorOptions' => array(
					// From basic `build-config.js` minus 'undo', 'clipboard' and 'about'
					'plugins' => 'basicstyles,toolbar,enterkey,entities,floatingspace,wysiwygarea,indentlist,link,list,dialog,dialogui,button,indent,fakeobjects'
				)
			)
		);
		?>



	<div class="row" style="visibility: hidden;">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo $form->textField($model,'parent_id'); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>
		<div class="row buttons">
			<?php echo CHtml::submitButton('Submit'); ?>
		</div>
	<div class="row" style="visibility: hidden;">
		<?php echo $form->labelEx($model,'post_id'); ?>
		<?php echo $form->textField($model,'post_id'); ?>
		<?php echo $form->error($model,'post_id'); ?>
	</div>






	<?php $this->endWidget(); ?>
		<a id="addComment"></a>
</div><!-- form -->

</div>