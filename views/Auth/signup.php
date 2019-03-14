<?php
use yii\bootstrap\ActiveForm;
?>
<div class="row">
    <div class="col-md-6">
        <h2>Регистрация</h2>
        <?php $form=ActiveForm::begin([
            'method' => 'POST'
        ])?>
        <?= $form->field($model, 'fio')?>
        <?= $form->field($model, 'email')?>
        <?= $form->field($model, 'password')->passwordInput()?>
        <?= $form->field($model, 'passwordCompare')->passwordInput()?>


        <div class="form-group">
            <button type = "submit">Зарегистрировать</button>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

