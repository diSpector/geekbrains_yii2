<?php

use yii\Helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;

?>

<div class="row">
    <h2>Календарь</h2>

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
            'action' => '/day/view'
        ]
        ); ?>
    <?= $form->field($calendar, 'dateAct')->widget(DatePicker::class,
        [
            'options' =>
                ['class' => ['form-control']],
            'dateFormat' => 'dd-MM-yyyy',
        ]
    ); ?>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Назначить/просмотреть события</button>
    </div>
    <p>Все события:</p>
    <div class = "row">
        <ul>
            <li><label>Название</label>: <?= Html::encode($calendar->activities['title']); ?></li>
            <li><label>Дата</label>: <?= Html::encode($calendar->activities['dateAct']); ?></li>
            <li>
                <label>Время</label>: <?= Html::encode($calendar->activities['timeStart']) . ' - ' . Html::encode($calendar->activities['timeEnd']); ?>
            </li>
            <li><label>Описание</label>: <?= Html::encode($calendar->activities['description']); ?></li>

        </ul>
    </div>

    <?php ActiveForm::end() ?>
    <?= Html::a('Добавить событие', ['/activity/create'], ['class' => 'btn btn-primary']) ?>

</div>