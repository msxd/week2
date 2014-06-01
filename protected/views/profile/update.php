<?php
/* @var ProfileController $this */
/* @var User $model */

$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'Profile', 'url' => array('index')),
    array('label' => 'Change password', 'url' => array('change')),
);
?>
<div class="col-xs-offset-2 col-xs-8">
    <h1>Profile <?php echo $model->last_name; ?></h1>

    <?php $this->renderPartial('_form', array('model' => $model)); ?>
</div>