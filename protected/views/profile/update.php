<?php
/* @var $this ProfileController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Profile', 'url'=>array('index')),
	array('label'=>'Edit profile', 'url'=>array('edit')),
	array('label'=>'Change password', 'url'=>array('change')),
);
?>

<h1>Profile <?php echo $model->last_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>