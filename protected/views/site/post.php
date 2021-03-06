<?php
/**
 * @var SiteController $this
 * @var Post $post
 */
//Yii::app()->bootstrap->init();
$this->pageTitle = Yii::app()->name;


if (isset($post)) {
	echo '<div id="post" class="col-xs-offset-2 col-xs-8">
				<div class="row" id="title">
					<h3 class="text-center">' . strip_tags($post->title) . '</h3>
				</div>
			<div id="content">' . (($post->getImgURL()) ? '<img src="' . $post->getImgURL() . '"></img>' : '') . $post->body . '</div>' .
		'<div class="text-right text-info">by ' . $post->user->first_name . '</div>' .
		'<div id="foo" class="row">';
	if (isset($post->created_at)) echo '<div class="col-xs-12">Created at: ' . $post->created_at . '</div>';
	if (isset($post->updated_at)) echo '<div class="col-xs-12">Updated at: ' . $post->updated_at . '</div>';
	echo '</div>
	</div>';

	$model = Comment::model();
	$model->post_id = $this->id;
	$this->renderPartial('_showComment', array('comments' => $post->comments));
	$this->renderPartial('_addComment', array('model' => $model));
}
?>