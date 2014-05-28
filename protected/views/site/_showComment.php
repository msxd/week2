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
			<div style="text-align:right"><button type="button" class="btn btn-xs" onclick="scroll_to_elem(\'addComment\',2000,' . $comment->id . ')">Ответить</button>' . ((Yii::app()->user->checkAccess(User::ROLE_MODER)) ? '<a href=""><sub><span class="glyphicon glyphicon-trash"></span></sub></a>' : '') . '</div>
			<footer><cite title="Email">by ' . $comment->email . '</cite> at <cite title="Created at">' . $comment->created_at . '</cite></footer>
		</blockquote>
	</div>';
    }
    ?>
</div>