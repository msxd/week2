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

$this->widget(
	'bootstrap.widgets.TbCKEditor',
	array(
		'model'=>$model,
		'attribute'=>'body',
	)
);


$this->widget(
	'bootstrap.widgets.TbButton',
	array('buttonType' => 'submit', 'label' => 'Add')
);

$this->endWidget();





?>




