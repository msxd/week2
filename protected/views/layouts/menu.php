<?
$this->widget('zii.widgets.CMenu',array(
	'items'=>array(
		array('label'=>'Home', 'url'=>array('/site/index')),
		array('label'=>'Sign in', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
		array('label'=>'Sign up', 'url'=>array('/site/registration'), 'visible'=>Yii::app()->user->isGuest),
		array('label'=>'Logout ('.(!Yii::app()->user->isGuest ? Yii::app()->user->email : '').')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
	),
	'htmlOptions'=>array('id'=>'top')
));
?>