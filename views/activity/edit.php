<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use kartik\time\TimePicker;

//$is_block = $activityFromDB['is_blocked'] ? true : false;
//$is_repeat = $activityFromDB['is_repeated'] ? true : false;
//$notification = $activityFromDB['use_notification'] ? true : false;

$is_block = $activity['is_blocked'] ? true : false;
$is_repeat = $activity['is_repeated'] ? true : false;
$notification = $activity['use_notification'] ? true : false;

?>

<div class="row">
    <div class="col-md-6"></div>
    <h2>Редактировать событие:</h2>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($activity, 'title')->textInput(['value' => $activityFromDB['title']]); ?>
    <?= $form->field($activity, 'dateAct')->widget(DatePicker::class,
        [
            'options' =>
                ['class' => ['form-control']],
            'dateFormat' => 'dd-MM-yyyy',

        ]
    )->textInput(['value' => $activityFromDB['dateAct']]); ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($activity, 'timeStart')->widget(
                TimePicker::class,
                ['pluginOptions' =>
                    [
                        'showMeridian' => false,
                        'defaultTime' => $activityFromDB['timeStart'],
                    ],
                ]); ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($activity, 'timeEnd')->widget(
                TimePicker::class,
                ['pluginOptions' =>
                    [
                        'showMeridian' => false,
                        'defaultTime' => $activityFromDB['timeEnd'],

                    ],
                ]); ?>
        </div>
    </div>
    <?= $form->field($activity, 'use_notification')->checkbox(['checked' => $notification]); ?>
    <div class="row">
        <?php if (!empty($session['images'])) {
            foreach ($session['images'] as $image) {
                echo Html::img('/images/' . $image, ['class' => 'col-lg-3']);
            }
        } ?>
    </div>
    <?= $form->field($activity, 'images[]')->fileInput(['multiple' => true]); ?>

    <?= $form->field($activity, 'description')->textarea(['value' => $activityFromDB['description']]); ?>
    <?= $form->field($activity, 'is_blocked')->checkbox(['checked' => $is_block]); ?>
    <?= $form->field($activity, 'is_repeated')->checkbox(['checked' => $is_repeat]); ?>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Изменить</button>
    </div>
    <?php ActiveForm::end() ?>
</div>