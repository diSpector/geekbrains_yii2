<?php

use yii\Helpers\Html;
?>

<div class="row">
    <p>План на день:</p>
    <ul>
        <li><label>Дата</label>: <?= Html::encode($day->activities['dateAct']); ?></li>
        <li><label>Время</label>: <?= Html::encode($day->activities['timeStart']) . ' - ' . Html::encode($day->activities['timeEnd']); ?>
        </li>
        <li><label>Название</label>: <?= Html::encode($day->activities['title']); ?></li>
        <li><label>Описание</label>: <?= Html::encode($day->activities['description']); ?></li>

    </ul>
    <?= Html::a('Редактировать', ['/activity/edit'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Добавить событие', ['/activity/create'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Календарь', ['/calendar/view'], ['class' => 'btn btn-primary']) ?>

</div>