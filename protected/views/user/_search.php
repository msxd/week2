<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="input-group col-xs-12 padingf">
        <span class="input-group-addon ads"><?= $form->labelEx($model, 'id'); ?></span>
        <?= $form->textField($model, 'id', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
    </div>

    <div class="input-group col-xs-12 padingf">
        <span class="input-group-addon ads"><?= $form->labelEx($model, 'email'); ?></span>
        <?= $form->textField($model, 'email', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
    </div>

    <div class="input-group col-xs-12 padingf">
        <span class="input-group-addon ads"><?= $form->labelEx($model, 'last_name'); ?></span>
        <?= $form->textField($model, 'last_name', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
    </div>

    <div class="inline to-select col-xs-12 padingf">
        <div class="col-xs-4">
            <?= $form->labelEx($model, 'role_id', array('class' => 'col-xs-12')); ?>
            <?= $form->dropDownList($model, 'role_id', array(User::ROLE_USER => 'User', User::ROLE_MODER => 'Moderator', User::ROLE_ADMIN => 'Admin'), array('class' => 'form-control')); ?>
            <?= $form->error($model, 'role_id'); ?>
        </div>

        <div class="col-xs-4">
            <?= $form->labelEx($model, 'deleted', array('class' => 'col-xs-12')); ?>
            <?= $form->dropDownList($model, 'deleted', array(User::DEL_FALSE => 'Active', User::DEL_TRUE => 'Deleted'), array('class' => 'form-control')); ?>
            <?= $form->error($model, 'deleted'); ?>
        </div>

        <div class="col-xs-4">
            <?= $form->labelEx($model, 'approved', array('class' => 'col-xs-12')); ?>
            <?= $form->dropDownList($model, 'approved', array(User::APPROVE_FALSE => 'Not approved', User::APPROVE_TRUE => 'Approved'), array('class' => 'form-control')); ?>
            <?= $form->error($model, 'approved'); ?>
        </div>
    </div>

    <div class="row buttons">
        <?= CHtml::submitButton('Search', array('class' => 'btn btn-default btn-lg')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->