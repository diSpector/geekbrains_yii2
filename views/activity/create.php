<?php

use yii\bootstrap\ActiveForm;

?>

<div class="row">
    <div class="col-md-6"></div>
    <h2>Создание новой активности</h2>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($activity, 'title'); ?>
    <?= $form->field($activity, 'description')->textarea(); ?>
    <?= $form->field($activity, 'is_blocked')->checkbox(); ?>
    <?= $form->field($activity, 'is_repeated')->checkbox(); ?>


    <div class="form-group">
        <button type="submit" class="btn btn-default">Отправить</button>
    </div>
    <?php ActiveForm::end() ?>
</div>