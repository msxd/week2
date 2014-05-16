<?php
/* @var $this PostController */

$this->breadcrumbs = array(
	'Post',
);
?>

<?
 $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-signin-form',
	'htmlOptions' => array('class' => 'form-horizontal', 'enctype'=>'multipart/form-data'),
	'enableAjaxValidation'=>false,
));

echo $form->textField($model, 'title', array('class' => 'span3'));


$this->widget(
	'bootstrap.widgets.TbCKEditor',
	array(
		'model' => $model,
		'attribute' => 'body',
	)
);

 echo $form->fileField($model, 'image');

$this->widget(
	'bootstrap.widgets.TbButton',
	array('buttonType' => 'submit', 'label' => 'Add')
);

$this->endWidget();





?>




