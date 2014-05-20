<?php
/**
 * @var SiteController $this
 * @var Post[] $posts
 */
//Yii::app()->bootstrap->init();
$this->pageTitle = Yii::app()->name;
?>


<?
if (Yii::app()->user->isGuest) {
	?>
	<p class="text-center col-xs-offset-2 col-xs-8" id="hmessage"> Lorem ipsum dolor sit amet, consectetur adipiscing
		elit. Vestibulum auctor diam neque.
		Aenean venenatis metus a sem ornare vestibulum. Ut pretium bibendum arcu, ut vulputate turpis
		malesuada quis. Morbi pulvinar elementum nulla convallis dapibus. Proin a vulputate elit, quis
		varius mi. Donec pulvinar leo eleifend arcu consectetur, at egestas metus condimentum. Curabitur
		ultrices ultricies purus. Donec vehicula lectus enim, vitae ornare eros ultricies a. Nulla iaculis
		magna ut dui elementum porttitor. Sed blandit, orci nec feugiat varius, magna leo aliquet felis,
		sit amet luctus tortor felis ut leo. Pellentesque habitant morbi tristique senectus et netus et
		malesuada fames ac turpis egestas. Etiam dignissim ipsum vitae lorem luctus, sit amet dictum sem
		pharetra. Cras fermentum, arcu a rhoncus pulvinar, purus libero cursus velit, faucibus bibendum
		nisi justo eu libero. Aenean nec massa sapien. Mauris quis purus sem.
		In pharetra gravida mi non tempor. Quisque vehicula, orci quis dapibus varius,
		tortor magna tristique odio, et commodo neque dui ac metus. Nulla at tellus lorem.
		Proin vel consequat purus. Sed at odio id lacus hendrerit rhoncus. Fusce at luctus tellus.
		Quisque posuere nibh nec est venenatis aliquam. Nam et auctor diam, elementum rhoncus nibh.
		Ut ac ultricies lectus, nec tempor arcu. Donec sit amet metus convallis, pretium purus sed,
		ultricies quam. Suspendisse ut tortor odio. Nam faucibus augue in libero tincidunt gravida
		sit amet vitae felis. Vivamus mauris elit, iaculis ut massa ut, sagittis porta nunc. Aenean a
		lectus nisi.

	</p>
	<div id="hbuttons" class="col-xs-12 text-center">
		<?= CHtml::link('Sign In', array('/site/login'), array('class' => 'btn btn-primary btn-md', 'style' => 'margin-right:10px')); ?>
		<?= CHtml::link('Sign Up', array('/site/registration'), array('class' => 'btn btn-primary btn-md')); ?>
	</div>
<?
} else {
	if (isset($posts)) {
		$i = 0;
			foreach ($posts as $post) {
				echo '<div id="post" class="col-xs-offset-2 col-xs-8">
			<div class="row" id="title">
				<h3 class="text-center">' . strip_tags($post->title) . '</h3>
			</div>' . $post->getPreviewImgURL() . MCText::shorten($post->body) .
					'<div class="text-right text-info">by ' . $post->user->first_name . '<br/>' . CHtml::link('Read more', array('site/view/' . $post->id)) . '</div>
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
}
?>


