<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-md-6">
        <h2>Авторизация</h2>
        <?php $form=ActiveForm::begin([
            'method' => 'POST'
        ])?>
        <?= $form->field($model, 'email')?>
        <?= $form->field($model, 'password')->passwordInput()?>

        <div class="form-group">
            <button type = "submit">Войти</button>
        </div>
        <p>Еще нет аккаунта? <?= Html::a('Создать', ['/auth/sign-up'], ['class' => 'btn btn-primary']) ?>
        </p>
        <?php ActiveForm::end(); ?>
    </div>
</div>