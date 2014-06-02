<?php  $form = $this->beginWidget('CActiveForm', array(
	'id' => 'users-signin-form',
	'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
	'enableAjaxValidation' => false,
));
?>


<div class="row">
	<div class="col-xs-6 inline">
		<?= $form->textField($model, 'title', array('class' => 'form-control col-xs-12 post-up-adds', 'placeholder' => 'Title')); ?>
	</div>
	<div class="col-xs-2">
		<?
		if (Yii::app()->user->checkAccess('editPost')) {
			echo $form->dropDownList($model, 'published', array(Post::PUBLISHED_FALSE => 'Hidden', Post::PUBLISHED_TRUE => 'Published'), array('class' => 'form-control  post-up-adds'));
		}
		?>
	</div>
</div>
<?
$this->widget(
	'bootstrap.widgets.TbCKEditor',
	array(
		'model' => $model,
		'attribute' => 'body',
	)
);
?>

<?
echo $form->fileField($model, 'image');

if (!$model->isNewRecord) {
	echo $form->checkBox($model, 'remove_img');
	echo $form->label($model, 'remove_img');
	echo '<br/>';
}
?>


<div class="buttons text-center padingf">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-default btn-lg')); ?>
</div>

<?php $this->endWidget(); ?>

</div> <!-- form -->