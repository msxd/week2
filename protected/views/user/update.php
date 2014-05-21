<?php
/* @var $this UserController */
/* @var $model User */


?>
<div style="">
<?
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
);
?>

		<?php $this->renderPartial('_form', array('model' => $model,'create'=>false)); ?>


</div>