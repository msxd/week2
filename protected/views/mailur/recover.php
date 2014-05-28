<?php
/* @var $this MailurController */

$this->breadcrumbs = array(
    'Mailur',
);



?>
<div id="form_signup" class="col-sm-offset-3 col-sm-6">
    <h2 align="center">Enter eMail</h2>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-password-recovery',
        'enableAjaxValidation' => false,
    )); ?>


    <?php echo $form->errorSummary($model); ?>

    <div class="form-group col-sm-12" style="text-align: right;">
        <?php echo $form->label($model, 'email', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-8">
            <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => 'Enter e-mail*', 'type' => 'email', 'required' => 'required')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="buttons text-center">
            <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-primary btn-lg')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->


