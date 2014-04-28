<?
$user = Yii::app()->user;
$this->widget('zii.widgets.CMenu',array(
	'items'=>array(
		array('label'=>'Home', 'url'=>array('/site/index')),
		array('label'=>'Sign in', 'url'=>array('/site/login'), 'visible'=>$user->isGuest),
		array('label'=>'Sign up', 'url'=>array('/site/registration'), 'visible'=>$user->isGuest),
		array('label'=>'Logout ('.(!$user->isGuest ? Yii::app()->user->email : '').')', 'url'=>array('/site/logout'), 'visible'=>!$user->isGuest),
		array('label'=>'Admin', 'url'=>array('/post/index'), 'visible'=>$user->checkAccess('2')),
		array('label'=>'Moderator', 'url'=>array('/post/index'), 'visible'=>$user->checkAccess('1')),
		array('label'=>'Users', 'url'=>array('/post/index'), 'visible'=>$user->checkAccess('0')),
	),
	'htmlOptions'=>array('id'=>'top')
));

?>