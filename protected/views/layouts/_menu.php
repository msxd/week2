<?
$user = Yii::app()->user;
$this->widget('zii.widgets.CMenu',array(
	'items'=>array(
		array('label'=>'Home', 'url'=>array('/site/index')),
		array('label'=>'Sign in', 'url'=>array('/site/login'), 'visible'=>$user->isGuest),
		array('label'=>'Sign up', 'url'=>array('/site/registration'), 'visible'=>$user->isGuest),
		array('label'=>'Logout ('.(!$user->isGuest ? Yii::app()->user->email : '').')', 'url'=>array('/site/logout'), 'visible'=>!$user->isGuest),
		//array('label'=>'Edit all posts', 'url'=>array('/post/index'), 'visible'=>$user->checkAccess(User::ROLE_MODER)),
		array('label'=>'Edit users', 'url'=>array('/user/index'), 'visible'=>$user->checkAccess(User::ROLE_MODER)),
		array('label'=>'Add post', 'url'=>array('/post/add'), 'visible'=>!$user->isGuest),
		array('label'=>(($user->checkAccess(User::ROLE_MODER))?'All':'My').' posts', 'url'=>array('/post/index/'), 'visible'=>!($user->isGuest)),
		array('label'=>'Profile', 'url'=>array('/profile/index'), 'visible'=>!$user->isGuest),
	),
	'htmlOptions'=>array('id'=>'top')
));
?>