<?php

$user = Yii::app()->user;

function getItems()
{
	$user = Yii::app()->user;
	return array(
		array('label' => 'Home', 'url' => array('/site/index')),
		array('label' => 'Sign in', 'url' => array('/site/login'), 'visible' => $user->isGuest),
		array('label' => 'Sign up', 'url' => array('/site/registration'), 'visible' => $user->isGuest),
		array('label' => 'Logout (' . (!$user->isGuest ? Yii::app()->user->email : '') . ')', 'url' => array('/site/logout'), 'visible' => !$user->isGuest),
		array('label' => 'Edit users', 'url' => array('/user/index'), 'visible' => $user->checkAccess('editUser')),
		array('label' => 'Add post', 'url' => array('/post/add'), 'visible' => !$user->isGuest),
		array('label' => (($user->checkAccess('editPost')) ? 'All' : 'My') . ' posts', 'url' => array('/post/index/'), 'visible' => !($user->isGuest)),
		array('label' => 'Profile', 'url' => array('/profile/index'), 'visible' => !$user->isGuest),
	);
}

$this->widget('zii.widgets.CMenu', array(
	'items' => getItems(),
	'htmlOptions' => array('id' => 'top', 'class' => 'col-xs-12 text-right hidden-xs')
));


$this->widget('zii.widgets.CMenu', array(
	'items' => getItems(),
	'htmlOptions' => array('id' => 'top-xs', 'class' => 'col-xs-12 text-center visible-xs')
));
