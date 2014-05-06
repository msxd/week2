<?php
/* @var $this ProfileController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'Profile', 'url'=>array('index')),
	array('label'=>'Edit profile', 'url'=>array('edit')),
	array('label'=>'Change password', 'url'=>array('change')),
);
?>

<h1>User</h1>

<?php



$this->widget(
	'bootstrap.widgets.TbGridView',
	array(
		'type' => 'striped',
		'dataProvider' => $dataProvider,
		'columns' => array(
			array('name'=>'id', 'header'=>'#', 'htmlOptions'=>array('style'=>'width: 60px')),
			array('name'=>'email', 'header'=>'Email address','htmlOptions'=>array('style'=>'text-align:left')),
			array('name'=>'first_name', 'header'=>'First name','htmlOptions'=>array('style'=>'text-align:left')),
			array('name'=>'last_name', 'header'=>'Last name','htmlOptions'=>array('style'=>'text-align:left')),
			array('name'=>'facebook_id', 'header'=>'Facebook','htmlOptions'=>array('style'=>'text-align:left')),
			array('name'=>'phone', 'header'=>'Phone','htmlOptions'=>array('style'=>'text-align:left'))
		),
	)
);

?>
