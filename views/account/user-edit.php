<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>

<div class="row">
    <div class="col-md-6"></div>
    <h2>Изменить данные:</h2>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($user, 'fio')->textInput(['value' => $user['fio']]); ?>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Изменить</button>
    </div>
    <?php ActiveForm::end() ?>
    <?= Html::a('Назад', '/account/index', ['class' => 'btn btn-info']); ?><br>

</div>
