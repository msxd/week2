<?php
/* @var $this PostController */

$this->breadcrumbs=array(
	'Post',
);
?>

<?
$form = $this->beginWidget(
	'bootstrap.widgets.TbActiveForm',
	array(
		'id' => 'verticalForm',
	)
);

echo $form->textFieldRow($model, 'title', array('class' => 'span3'));
echo $form->textFieldRow($model, 'published', array('class' => 'span3'));
$this->widget(
	'bootstrap.widgets.TbCKEditor',
	array(
		'name'=>'some',
		'value'=>$model->body,
	)
);


$this->widget(
	'bootstrap.widgets.TbButton',
	array('buttonType' => 'submit', 'label' => 'Edit')
);

$this->endWidget();





?>




