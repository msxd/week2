<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<?php
		$this->cs->registerCssFile(Yii::app()->request->baseUrl . '/css/style.css');
		$this->cs->registerCssFile(Yii::app()->request->baseUrl . '/vendors/bootstrap/css/bootstrap.min.css');
		$this->cs->registerCssFile(Yii::app()->request->baseUrl . '/vendors/bootstrap/css/bootstrap-theme.css');
		$this->cs->registerScriptFile(Yii::app()->request->baseUrl . '/vendors/jquery/jquery-2.1.0.min.js', CClientScript::POS_END);
		$this->cs->registerCssFile(Yii::app()->request->baseUrl . '/vendors/bootstrap/js/bootstrap.min.js', CClientScript::POS_END);
		$this->cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/app.js', CClientScript::POS_END);
	?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<?include_once('_menu.php');?>




<?=$content;?>





</body>
</html>
