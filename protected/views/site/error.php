<?php
/* @var SiteController $this */
/* @var array $error */
$this->pageTitle = Yii::app()->name . ' - Error';
$this->breadcrumbs = array(
	'Error',
);
?>

<div class="alert alert-danger alert-dismissable text-center" style="width: 50%;
margin: 20% auto;">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true"
			onclick="closeIt(this)">&times;</button>
	<h2>Error <?= $code; ?></h2>
	<?= $message; ?>
</div>
