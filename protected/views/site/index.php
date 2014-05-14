<?php
/**
 * @var SiteController $this
 * @var Post[] $posts
 */
//Yii::app()->bootstrap->init();
$this->pageTitle = Yii::app()->name;
?>

<p class="text">
	<?
	if (Yii::app()->user->isGuest) {
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
			$i = 0;
			foreach ($posts as $post) {
				echo $post->user->first_name . " " . CHtml::link($post->title, array('site/view/' . $post->id)) . "<br/>";
				if (isset($_GET['pid']))
					echo($post->body);
				else
					echo substr(strip_tags($post->body), 0, strrpos(substr(strip_tags($post->body), 0, 250), ' ')) . "... " . CHtml::link('view all', array('site/view/' . $post->id));
				echo "<br/> Created: " . $post->created_at;
				if (strtotime($post->updated_at) > 0) {
					echo '||Last update: ' . $post->updated_at;
				}

				if (isset($_GET['pid'])) {

					echo '<br/>Comments:<hr/>';
					echo '<div align="left">';
					if (isset($post->comments)) {
						foreach ($post->comments as $comment) {
							echo '<div style="padding-left:'.($comment->hierarchy->getLevel()*20).'px;">';
							echo '<br/>' . $comment->created_at . ' ' . $comment->body.' (L'.$comment->getLevel().') ';
							echo '<a onclick="scroll_to_elem(\'addComment\',\'20\',\''.$comment->id.'\')"> Ответ</a> ID: ' . $comment->id;
							echo '</div>';

						}

					}
					echo '</div>';
					$model = Comment::model();
					$model->post_id = $post->id;
					$this->renderPartial('_addComment', array('model' => $model));
					if (isset($_POST['Comment'])) {
						if($model->actionAddComment()){
							$this->redirect(Yii::app()->createUrl('/site/view/'.$post->id));
						}

					}

				}
				echo "<br/><br/>";
				$i += 1;
			}
			if ($i == 0) {
				echo 'All news comming soon';
			}
		}
		if (isset($pages) && empty($_GET['pid'])) {
			$this->widget('CLinkPager', array(
				'pages' => $pages,
				'maxButtonCount' => 5, // максимальное вол-ко кнопок <- 1..2..3..4..5 ->
				'header' => ' ', //'<b>Перейти к странице:</b><br><br>', // заголовок над листалкой
			));
		}

		if (isset($errors)) {
			foreach ($errors as $error) {
				echo $error;
			}
		}

	}
	/*
		Yii::app()->mailer->AddAddress('valikov.ids@gmail.com');
		Yii::app()->mailer->Body = 'body';
		Yii::app()->mailer->Send();
	*/
	?>
</p>

