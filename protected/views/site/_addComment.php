<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */

?>

<div class="form">

	<?php  $form=$this->beginWidget('CActiveForm', array(
		'id'=>'users-signin-form',
		'htmlOptions' => array('class' => 'form-horizontal'),
		'enableAjaxValidation'=>false,
	));
?>

		<div class="col-xs-8 col-xs-offset-2"  id="add-comment">
			<?php echo $form->errorSummary($model);
			?>

			<div class="row">
				<div class="col-xs-8">
					<?php echo $form->error($model, 'email'); ?>
					<?=$form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => 'email', 'style' => 'border-radius:10px 10px 0 0;border-bottom:none;',(Yii::app()->user->isGuest)?'':'disabled'=>'disabled','value'=>(!Yii::app()->user->isGuest)?Yii::app()->user->email:'')); ?>
				</div>
				<div class="btn" style="padding-top: 7px; border-radius: 10px 10px 0 0; box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3) inset">
					to <span id="to">post</span>
				</div>
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
			<?php echo CHtml::submitButton('Send', array('class' => 'btn btn-primary','style' => 'border-radius:0 0 10px 10px;border-top:none;')); ?>



			<div class="row" style="visibility: hidden;">
				<?php echo $form->labelEx($model, 'parent_id'); ?>
				<?php echo $form->textField($model, 'parent_id'); ?>
				<?php echo $form->error($model, 'parent_id'); ?>

			</div>
			<div class="row" style="visibility: hidden;">
				<?php echo $form->labelEx($model, 'post_id'); ?>
				<?php echo $form->textField($model, 'post_id'); ?>
				<?php echo $form->error($model, 'post_id'); ?>
			</div>




	<?php $this->endWidget(); ?>
		<a id="addComment"></a>
<!-- form -->

</div></div>