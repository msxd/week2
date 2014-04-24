<?php
/* @var $this PostController */

$this->breadcrumbs=array(
	'Post',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>


	<?php
/*

	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'postEdit',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// See class documentation of CActiveForm for details on this,
		// you need to use the performAjaxValidation()-method described there.
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'form-horizontal'),
	)); ?>

	<?
	$this->widget(
		'bootstrap.widgets.TbCKEditor',
		array(
			'name'=>'someTitle',
			'value'=>$model->title,

		)
	);

	$this->widget(
		'bootstrap.widgets.TbCKEditor',
		array(
			'name'=>'some',
			'value'=>$model->body,
		)
	);
	?>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary btn-lg')); ?>
	</div>
</div>

<?php $this->endWidget();*/ ?>







	<?php /** @var TbActiveForm $form */
	$form = $this->beginWidget(
		'bootstrap.widgets.TbActiveForm',
		array(
			'id' => 'horizontalForm',
			'type' => 'horizontal',
		)
	); ?>





<?

$this->widget(
	'bootstrap.widgets.TbCKEditor',
	array(
		'name'=>'some',
		'value'=>$model->body,
	)
);

	?>




<div class="form-actions">
	<?php $this->widget(
		'bootstrap.widgets.TbButton',
		array(
			'buttonType' => 'submit',
			'type' => 'primary',
			'label' => 'Submit'
		)
	); ?>


<?php
$this->endWidget();
?>
</div>
</p>


