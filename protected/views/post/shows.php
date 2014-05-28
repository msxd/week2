<?php
/* @var $this PostController */

$this->breadcrumbs = array(
    'Post',
);

ini_set('display_errors', 1);
error_reporting(E_ALL);

?>

<?

/** @var Post[] $posts */
//if (isset($model)) {
//	foreach ($model as $post) {
//        /** @var Post $post */
//        echo '<div id="post" class="col-xs-offset-2 col-xs-8">
//			<div class="row" id="title">
//				<h3 class="text-center">' . strip_tags($post->title) . ' ('.(($post->published==1)?'published':'unpublished').')</h3>
//			</div>' . (($post->getPreviewImgURL())?'<img src="'.$post->getPreviewImgURL().'"></img>':'sa') . MCText::shorten($post->body) .
//            '<div class="text-right text-info">by ' . $post->user->first_name . '<br/>' . CHtml::link(' [edit]', array('post/update/' . $post->id)) . '</div>
//			<div id="foo" class="row">';
//        if (isset($post->created_at)) echo '<div class="col-xs-12">Created at: ' . $post->created_at . '</div>';
//        if (isset($post->updated_at)) echo '<div class="col-xs-12">Updated at: ' . $post->updated_at . '</div></div>';
//        echo '</div></div>';
//
//	}
//}

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'post-grid',
    'type' => 'striped bordered condensed',
    'pager' => array(
        'firstPageLabel' => '<div style="height:17px;width:20px" class="glyphicon glyphicon-fast-backward"></div>',
        'prevPageLabel' => '<div style="height:17px;width:20px"  class="glyphicon glyphicon-backward"></div>',
        'nextPageLabel' => '<div style="height:17px;width:20px" class="glyphicon glyphicon-forward"></div>',
        'lastPageLabel' => '<div style="height:17px;width:20px" class="glyphicon glyphicon-fast-forward"></div>',
        'htmlOptions' => array('class' => 'pagination pagination-sm', 'id' => 'adminPaginator'),
        'selectedPageCssClass' => 'active'
    ),
    'dataProvider' => Post::model()->search(),
    'columns' => array(
        'id',
        'title',
        array('name' => 'body',
            'header' => 'Body',
            'value' => 'MCText::shorten($data->body)',
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
            'htmlOptions' => array('style' => 'width:30px;text-align:center'),
            'type' => 'html',
            'value' => '$data->published==1?"<a href=\"hide/$data->id\"><span class=\"glyphicon glyphicon-remove\"></span><br/>Delete</a>":"<a href=\"unhide/$data->id\"><span class=\"glyphicon glyphicon-ok\"></span><br/>Restore</a>"',
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




