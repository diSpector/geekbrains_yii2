<?php

use yii\Helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
//$date = $activity->dateAct;
//// преобразовать дату из БД в дату по заданному формату
//$correctDate = date(\Yii::$app->params['date_format']['date_format_for_user'], strtotime($date));
?>

<div class="row">
    <h2>Календарь</h2>

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
//            'action' => '/day/view'
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
    <?php ActiveForm::end() ?>

    <p>Все события:</p>
    <?php if(empty($calendar->activities)): ?>
    <p>Cобытий нет</p>
    <?php else: ?>
    <?php foreach ($calendar->activities as $activity): ?>
    <div class = "row">
        <ul>
            <li><label>Название</label>: <?= Html::encode($activity['title']); ?></li>
            <li><label>Дата</label>: <?= Html::encode(date(\Yii::$app->params['date_format']['date_format_for_user'], strtotime($activity['dateAct']))); ?></li>
            <li>
                <label>Время</label>: <?= Html::encode($activity['timeStart']) . ' - ' . Html::encode($activity['timeEnd']); ?>
            </li>
            <li><label>Описание</label>: <?= Html::encode($activity['description']); ?></li>
        </ul>
        <?= Html::a('Редактировать', ["/activity/edit/" . $activity['id']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ["/activity/delete/" . $activity['id']], ['class' => 'btn btn-danger', 'data-confirm'=> 'Вы действительно хотите удалить активность?']) ?>

    </div>
    <?php endforeach; ?>
    <?php endif; ?>
    <br>
    <?= Html::a('Добавить событие', ['/activity/create'], ['class' => 'btn btn-info']) ?>

</div>