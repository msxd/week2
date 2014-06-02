<?php
/* @var UserController $this */
/* @var User $model */

$this->breadcrumbs = array(
	'Users' => array('index'),
	'Manage',
);

$this->menu = array(
	array('label' => 'List User', 'url' => array('index')),
	array('label' => 'Create User', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="col-xs-offset-2 col-xs-8">
	<h1>Manage Users</h1>

	<p>
		You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
		or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
	</p>

	<?= CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
	<div class="search-form" style="display:none">
		<?php $this->renderPartial('_search', array(
			'model' => $model,
		)); ?>
	</div>
	<!-- search-form -->

	<?php $this->widget('bootstrap.widgets.TbGridView', array(
		'id' => 'user-grid',
		'type' => 'striped bordered condensed',
		'pager' => array(
			'header' => ' ', //'<b>Перейти к странице:</b><br><br>', // заголовок над листалкой
			'firstPageLabel' => '<div style="height:17px;width:20px" class="glyphicon glyphicon-fast-backward"></div>',
			'prevPageLabel' => '<div style="height:17px;width:20px"  class="glyphicon glyphicon-backward"></div>',
			'nextPageLabel' => '<div style="height:17px;width:20px" class="glyphicon glyphicon-forward"></div>',
			'lastPageLabel' => '<div style="height:17px;width:20px" class="glyphicon glyphicon-fast-forward"></div>',
			'htmlOptions' => array('class' => 'pagination pagination-sm', 'id' => 'adminPaginator'),
			'selectedPageCssClass' => 'active'
		),
		'dataProvider' => $model->search(),
		'columns' => array(
			'id',
			'facebook_id',
			'email',
			'phone',
			'first_name',
			'last_name',
			array(
				'name' => 'role_id',
				'header' => 'Role',
				'htmlOptions' => array('style' => 'width:30px;text-align:center;vertical-align: middle;'),
				'type' => 'html',
				'value' => function ($data) {
						if ($data->role_id == 0)
							return '<span class="label label-success" style="padding: 5px">User</span>';
						if ($data->role_id == 1)
							return '<span class="label label-warning" style="padding: 5px">Moderator</span>';
						if ($data->role_id == 2)
							return '<span class="label label-danger" style="padding: 5px">Admin</span>';

					},
			),
			array(
				'name' => 'deleted',
				'header' => 'Deleted',
				'htmlOptions' => array('style' => 'width:30px;text-align:center'),
				'type' => 'html',
				'value' => '$data->deleted!=1?"<a href=\"delete/$data->id/1\"><span class=\"glyphicon glyphicon-remove\"></span><br/>Delete</a>":"<a href=\"delete/$data->id/0\"><span class=\"glyphicon glyphicon-ok\"></span><br/>Restore</a>"',
			),
			array(
				'name' => 'approved',
				'header' => 'Approve',
				'htmlOptions' => array('style' => 'width:30px;text-align:center'),
				'type' => 'html',
				'value' => '$data->approved==1?"<a href=\"approve/$data->id/0\"><span class=\"glyphicon glyphicon-remove\"></span>Remove</a>":"<a href=\"approve/$data->id/1\"><span class=\"glyphicon glyphicon-ok\"></span>Approve</a>"'
//					'value' => function ($data) {
//							$title = $data->approved==User::APPROVE_TRUE ? '+' : '-';
//							return $title;
//						}
			),
			array(
				'header' => 'Actions',
				'class' => 'CButtonColumn',
				'template' => '{update}{delete}',
				'buttons' => array
				(
					'update' => array
					(
						'imageUrl' => false,
						'label' => '<span class="glyphicon glyphicon-pencil"></span>',
						'options' => array('title' => 'View'),
					),
					'delete' => array
					(
						'imageUrl' => false,
						'label' => '<span class="glyphicon glyphicon-trash"></span>',
						'options' => array('title' => 'Delete'),
					),
				),
			),
		),

	)); ?>
</div>