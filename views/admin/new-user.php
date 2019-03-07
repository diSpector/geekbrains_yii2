<?php
use yii\widgets\ActiveForm;
?>
<div class="row">
    <div class="col-md-6">
        <h2>Создание нового пользователя</h2>
        <?php $form=ActiveForm::begin([
            'method' => 'POST'
        ])?>
        <?= $form->field($model, 'email')?>
        <?= $form->field($model, 'password')->passwordInput()?>
        <?= $form->field($model, 'passwordCompare')->passwordInput()?>


        <div class="form-group">
            <button type = "submit" class = "btn btn-primary">Создать пользователя</button>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
