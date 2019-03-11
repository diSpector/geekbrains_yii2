<?php
use \yii\bootstrap\ActiveForm;
?>

<div class="row">
    <div class="col-md-6"></div>
    <h2>Редактировать пользователя:</h2>
    <?php $form = \yii\bootstrap\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($user, 'email')->textInput(['value' => $user['email'],'disabled' => true]); ?>
    <?= $form->field($user, 'fio')->textInput(['value' => $user['fio']]); ?>

    <div class="form-group">
        <button type="submit" class="btn btn-default">Изменить</button>
    </div>
    <?php ActiveForm::end() ?>
</div>
