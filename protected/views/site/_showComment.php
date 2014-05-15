<?php
/* @var $this CommentController */
/** @var Comment[] $comments */



?>
<div class="col-xs-8 col-xs-offset-2" id="comments">
	<?
	foreach($comments as $coment){
		$coment->showComment();
	}
	?>
</div>