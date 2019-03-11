<?php
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use yii\Helpers\ArrayHelper;

?>

<div class="row">
    <div class="col-md-6"></div>
    <h2>Выбор нового дня</h2>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($day,'dayName')->widget(DatePicker::class,[]) ?>
    <?= $form->field($day, 'is_dayoff')->checkbox(); ?>
    <?= $form->field($day, 'activities')->dropDownList($day->activities, $day->params); ?>


    <div class="form-group">
        <button type="submit" class="btn btn-default">Отправить</button>
    </div>
    <?php ActiveForm::end() ?>
</div>