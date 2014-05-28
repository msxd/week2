<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div id="form_signup" class="col-sm-offset-3 col-sm-6">
    <h2 align="center">Log In</h2>
    <?

    ?>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-registration-form',
        'enableAjaxValidation' => false,
    )); ?>


    <?php echo $form->errorSummary($model); ?>

    <div class="form-group col-sm-12" style="text-align: right;">
        <?php echo $form->label($model, 'email', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-8">
            <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'placeholder' => 'Enter e-mail*', 'type' => 'email', 'required' => 'required')); ?>
        </div>
    </div>

    <div class="form-group col-sm-12" style="text-align: right;">
        <?php echo $form->label($model, 'pass', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-8">
            <?php echo $form->passwordField($model, 'pass', array('class' => 'form-control', 'placeholder' => 'Enter password*', 'required' => 'required')); ?>
        </div>
    </div>

    <div class="form-group col-sm-12" style="text-align: right;">
        <?php echo $form->label($model, 'r_pass', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-8">
            <?php echo $form->passwordField($model, 'r_pass', array('class' => 'form-control', 'placeholder' => 'Enter password again*', 'required' => 'required')); ?>
        </div>
    </div>

    <div class="form-group col-sm-12" style="text-align: right;">
        <?php echo $form->label($model, 'first_name', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-8">
            <?php echo $form->textField($model, 'first_name', array('class' => 'form-control', 'placeholder' => 'Enter first name*', 'type' => 'text', 'required' => 'required')); ?>
        </div>
    </div>

    <div class="form-group col-sm-12" style="text-align: right;">
        <?php echo $form->label($model, 'last_name', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-8">
            <?php echo $form->textField($model, 'last_name', array('class' => 'form-control', 'placeholder' => 'Enter last name*', 'type' => 'text', 'required' => 'required')); ?>
        </div>
    </div>

    <div class="form-group col-sm-12" style="text-align: right;">
        <?php echo $form->label($model, 'facebook_id', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-8">
            <?php echo $form->textField($model, 'facebook_id', array('class' => 'form-control', 'placeholder' => 'Enter facebook id', 'type' => 'text')); ?>
        </div>
    </div>

    <div class="form-group col-sm-12" style="text-align: right;">
        <?php echo $form->label($model, 'phone', array('class' => 'col-sm-2 control-label')); ?>
        <div class="col-sm-8">
            <?php echo $form->textField($model, 'phone', array('class' => 'form-control', 'placeholder' => 'Enter phone number', 'type' => 'tel')); ?>
        </div>
    </div>


    <div class="form-group" style="text-align: center;">
        <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-primary btn-lg')); ?>

    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->