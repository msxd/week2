<?php
/* @var PostController $this */

$this->breadcrumbs = array(
    'Post',
);
?>

<div class="form-horizontal col-xs-8 col-xs-offset-2" id="user_post">
    <?
    $this->renderPartial('_form', array('model' => $model));
    ?>


</div>

