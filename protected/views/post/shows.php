<?php
/* @var PostController $this */

$this->breadcrumbs = array(
	'Post',
);

ini_set('display_errors', 1);
error_reporting(E_ALL);

?>

<?

/** @var Post[] $posts */
$this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'post-grid',
	'type' => 'striped bordered condensed',
	'pager' => array(
		'header' => ' ',
		'firstPageLabel' => '<div style="height:17px;width:20px" class="glyphicon glyphicon-fast-backward"></div>',
		'prevPageLabel' => '<div style="height:17px;width:20px"  class="glyphicon glyphicon-backward"></div>',
		'nextPageLabel' => '<div style="height:17px;width:20px" class="glyphicon glyphicon-forward"></div>',
		'lastPageLabel' => '<div style="height:17px;width:20px" class="glyphicon glyphicon-fast-forward"></div>',
		'htmlOptions' => array('class' => 'pagination pagination-sm', 'id' => 'adminPaginator'),
		'selectedPageCssClass' => 'active'
	),
	'dataProvider' => (Yii::app()->user->checkAccess('editPost')) ? Post::model()->search() : Post::model()->ownPosts()->search(),
	'columns' => array(
		'id',
		'title',
		array('name' => 'body',
			'header' => 'Body',
			'value' => 'MCText::preview($data->body)',
		),
		array('name' => 'user',
			'header' => 'User',
			'value' => '$data->user->email',
		),
		array('name' => 'created_at',
			'header' => 'Created'
		),
		array('name' => 'updated_at',
			'header' => 'Updated'
		),
		array(
			'name' => 'published',
			'header' => 'Published',
			'visible' => Yii::app()->user->checkAccess('editPost'),
			'htmlOptions' => array('style' => 'width:30px;text-align:center'),
			'type' => 'html',
			'value' => '$data->published==1?"<a href=\"hide/$data->id/t\"><span class=\"glyphicon glyphicon-remove\"></span><br/>Delete</a>":"<a href=\"hide/$data->id/f\"><span class=\"glyphicon glyphicon-ok\"></span><br/>Restore</a>"',
		),
		array('name' => 'img_path',
			'header' => 'Image'
		),
		array(
			'header' => '',
			'class' => 'CButtonColumn',
			'template' => '{update}',
			'buttons' => array
			(
				'update' => array
				(
					'imageUrl' => false,
					'label' => '<span class="glyphicon glyphicon-pencil"></span>',
					'options' => array('title' => 'edit', 'class' => 'text-center'),
				),
			),
		),
	),

));






?>


