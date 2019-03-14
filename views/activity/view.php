<?php

use \yii\helpers\Html;
$is_block = $activity['is_blocked'] ? 'Да' : 'Нет';
$is_repeat = $activity['is_repeated'] ? 'Да' : 'Нет';
$notification = $activity['use_notification'] ? 'Да' : 'Нет';
?>

<div class="row">
    <h2>Просмотр активности:</h2>
    <p>Название: <?= $activity->title; ?></p>
    <p>Дата и время: <?= date('d-m-Y', strtotime($activity->dateAct)) . ", ". $activity->timeStart . " - " . $activity->timeEnd; ?></p>
    <p>Описание: <?= $activity->description; ?></p>
    <p>Использовать уведомления: <?= $notification; ?></p>
    <p>Повторяющееся событие: <?= $is_repeat; ?></p>
    <p>Блокирующее событие: <?= $is_block; ?></p>

    <?= Html::a('Редактировать', ['/activity/edit/' . $activity->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Вернуться', ['/activity/all'], ['class' => 'btn btn-success']) ?>

</div>
