<?php
/**
 * @var SiteController $this
 * @var Post $post
 */
//Yii::app()->bootstrap->init();
$this->pageTitle = Yii::app()->name;


if (isset($post))
	$post->showPost($this);


	if (isset($errors)) {
		foreach ($errors as $error) {
			?>
			<div class="alert alert-danger alert-dismissable text-center" style="margin-top: 20%">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true"
						onclick="closeIt(this)">&times;</button>
				<?= $error; ?>
			</div>
		<?
		}
	}
?>