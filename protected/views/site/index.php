<?php
/**
 * @var SiteController $this
 * @var Post[] $posts
 */
$this->pageTitle = Yii::app()->name;


if (isset($posts)) {
	$i = 0;
	foreach ($posts as $post) {
		echo '<div id="post" class="col-xs-offset-2 col-xs-8">
			<div class="row" id="title">
				<h3 class="text-center">' . strip_tags($post->title) . '</h3>
			</div>' . (($post->getPreviewImgURL()) ? '<center><img src="' . $post->getPreviewImgURL() . '"></img></center><br/>' : '') . MCText::shorten($post->body) .
			'<div class="text-right text-info">by ' . $post->user->first_name .'<br/>' . CHtml::link('Read more ['.count($post->comments).' comments]', array('site/view/' . $post->id)) . '</div>
			<div id="foo" class="row">';
		if (isset($post->created_at)) echo '<div class="col-xs-12">Created at: ' . $post->created_at . '</div>';
		if (isset($post->updated_at)) echo '<div class="col-xs-12">Updated at: ' . $post->updated_at . '</div></div>';
		echo '</div></div>';
	}
}
if (isset($pages)) {
	echo '<div class="col-xs-12 text-center">';
	$this->widget('CLinkPager', array(
		'pages' => $pages,
		'maxButtonCount' => 5, // максимальное вол-ко кнопок <- 1..2..3..4..5 ->
		'header' => ' ', //'<b>Перейти к странице:</b><br><br>', // заголовок над листалкой
		'firstPageLabel' => '<div style="height:17px;width:20px" class="glyphicon glyphicon-fast-backward"></div>',
		'prevPageLabel' => '<div style="height:17px;width:20px"  class="glyphicon glyphicon-backward"></div>',
		'nextPageLabel' => '<div style="height:17px;width:20px" class="glyphicon glyphicon-forward"></div>',
		'lastPageLabel' => '<div style="height:17px;width:20px" class="glyphicon glyphicon-fast-forward"></div>',
		'htmlOptions' => array('class' => 'pagination pagination-sm'),
		'selectedPageCssClass' => 'active'
	));
	echo '</div>';
}

?>


