<?php
/* @var $this PostController */

$this->breadcrumbs = array(
	'Post',
);
?>

<?


if (isset($model)) {
	foreach ($model as $post) {
		echo $post->user->first_name . " " . CHtml::link($post->title,array('post/update/'.$post->id)) . "<br/>"
			. $post->body . "<br/>" . $post->created_at . "<br/><br/><br/>";

	}
}





?>



