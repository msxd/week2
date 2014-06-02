<?php
/* @var UserController $this */
/* @var User $model */

$this->breadcrumbs = array(
	'Users' => array('index'),
	'Create',
);

$this->menu = array(
	array('label' => 'List User', 'url' => array('index')),
	array('label' => 'Manage User', 'url' => array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model' => $model, 'create' => true)); ?>