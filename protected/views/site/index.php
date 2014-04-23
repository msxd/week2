<?php
/**
 * @var SiteController $this
 * @var Post[] $posts
 */

$this->pageTitle = Yii::app()->name;
?>
<p id="text">
	<?
	if (!Yii::app()->user->isGuest) {
		echo '<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum auctor diam neque.
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

</p>';
		echo CHtml::link('Sign In', array('/site/login'), array('class' => 'btn btn-primary btn-lg', 'style' => 'margin-right:10px'));
		echo CHtml::link('Sign Up', array('/site/registration'), array('class' => 'btn btn-primary btn-lg'));
	} else {
		if (isset($posts)) {
			foreach ($posts as $post) {
				echo $post->user->first_name . " " . CHtml::link($post->title,array('site/index&pid='.$post->id)) . "<br/>"
					. $post->body . "<br/>" . $post->created_at . "<br/>";
			}
		}
		if (isset($errors)) {
			foreach ($errors as $error) {
				echo $error;
			}
		}

	}
	?>
</p>

