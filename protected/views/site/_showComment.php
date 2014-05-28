<?php
/* @var $this CommentController */
/** @var Comment[] $comments */


?>
<div class="col-xs-8 col-xs-offset-2" id="comments">
    <?
    foreach ($comments as $comment) {
        echo '<div style="margin-left:' . ($comment->getLevel() * 20) . 'px">
		<blockquote>
			<p>' . $comment->body . '</p>
			<div style="text-align:right"><button type="button" class="btn btn-xs" onclick="scroll_to_elem(\'addComment\',2000,' . $comment->id . ')">Ответить</button>' . ((Yii::app()->user->checkAccess(User::ROLE_MODER)) ? '<button type="button" class="btn btn-xs" style="margin-left: 10px;width: 20px;" data-url="' . Yii::app()->createUrl('site/removecomment/' . $comment->id) . '" id="removeComment"><span class="glyphicon glyphicon-trash"></span></button>' : '') . '</div>
			<footer><cite title="Email">by ' . $comment->email . '</cite> at <cite title="Created at">' . $comment->created_at . '</cite></footer>
		</blockquote>
	</div>';
    }
    ?>
</div>