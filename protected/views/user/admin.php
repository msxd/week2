<?php
/* @var $this UserController */
/* @var $model User */

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

	<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
	<div class="search-form" style="display:none">
		<?php $this->renderPartial('_search', array(
			'model' => $model,
		)); ?>
	</div>
	<!-- search-form -->

	<?php $this

		->widget('bootstrap.widgets.TbGridView', array(
			'id' => 'user-grid',
			'type' => 'striped bordered condensed',
			'dataProvider' => $model->search(),
			'columns' => array(
				'id',
				'facebook_id',
				'email',
				'phone',
				'first_name',
				'last_name',
				'role_id',
				'deleted',
				array(
					'name' => 'approved',
					'header' => 'Approve',
					'htmlOptions' => array('style' => 'width:30px;text-align:center'),
					'type'=>'html',
					'value'=>'$data->approved==1?"<a href=\"dapprove/$data->id\"><span class=\"glyphicon glyphicon-ok\"></span></a>":"<a href=\"approve/$data->id\"><span class=\"glyphicon glyphicon-remove\"></span></a>"'
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
//				'new' => array
//				(
//					'label'=>'<span class="glyphicon glyphicon-th-large"></span>',
//					'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->id))',
//				),
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