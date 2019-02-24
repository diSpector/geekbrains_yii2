<?php

use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use kartik\time\TimePicker;


?>

<div class="row">
    <div class="col-lg-6"></div>
    <h2>Добавить событие:</h2>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($activity, 'title'); ?>
    <?= $form->field($activity, 'dateAct')->widget(DatePicker::class,
        [
            'options' =>
                ['class' => ['form-control']],
            'dateFormat' => 'dd-MM-yyyy',
        ]
    ); ?>
    <div class="row">
        <div class="col-lg-6">
    <?= $form->field($activity, 'timeStart')->widget(
        TimePicker::class,
        ['pluginOptions' =>
            [
                'showMeridian' => false
            ],
        ]); ?>
        </div>
        <div class="col-lg-6">
    <?= $form->field($activity, 'timeEnd')->widget(
        TimePicker::class,
        ['pluginOptions' =>
            [
                'showMeridian' => false
            ],
        ]); ?>
        </div>
    </div>
    <?= $form->field($activity, 'use_notification')->checkbox(); ?>
    <?= $form->field($activity, 'images[]')->fileInput(['multiple' => true]); ?>
    <?= $form->field($activity, 'description')->textarea(); ?>
    <?= $form->field($activity, 'is_blocked')->checkbox(); ?>
    <?= $form->field($activity, 'is_repeated')->checkbox(); ?>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Добавить</button>
    </div>
    <?php ActiveForm::end() ?>
</div>