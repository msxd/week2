<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework  - - >
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<- -[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	< [endif]- ->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	-->
	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl;?>/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl;?>/vendors/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl;?>/vendors/bootstrap/css/bootstrap-theme.css"/>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<?include_once('menu.php');?>




<?=$content;?>





<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/vendors/jquery/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/vendors/jquery/jquery.cookie.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/vendors/jquery/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/app.js"></script>
</body>
</html>
