<?php

use yii\bootstrap\ActiveForm;

?>

<div class="row">
    <div class="col-md-6"></div>
    <h2>Создание новой активности</h2>
    <?php $form = ActiveForm::begin([
    ]); ?>
    <?= $form->field($activity, 'title'); ?>
    <?= $form->field($activity, 'description')->textarea(); ?>
    <?=$form->field($activity,'use_notification')->checkbox();?>
    <?= $form->field($activity,'email',[
            'enableAjaxValidation'=>true,
            'enableClientValidation'=>false]);?>
    <?=$form->field($activity,'email_repeat');?>
    <?=$form->field($activity,'date_start');?>
    <?=$form->field($activity,'as_repeat')->dropDownList([1,2,3,4,5])?>
    <?= $form->field($activity, 'is_blocked')->checkbox(); ?>
    <?= $form->field($activity, 'is_repeated')->checkbox(); ?>
    <?=$form->field($activity,'image')->fileInput();?>


    <div class="form-group">
        <button type="submit" class="btn btn-default">Отправить</button>
    </div>
    <?php ActiveForm::end() ?>
</div>