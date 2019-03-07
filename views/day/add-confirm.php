<?php

use yii\Helpers\Html;

?>

<div class="row">
    <p>Вы добавили следующее событие на день:</p>

    <ul>
        <li><label>День</label>: <?= Html::encode($day->dayName) ?></li>
        <li><label>Выходной</label>: <?= Html::encode($day->is_dayoff) ?></li>
        <li><label>Событие</label>: <?= Html::encode($day->activities) ?></li>
    </ul>
    <?= Html::a('Распланировать другой день', ['/day/add'], ['class'=>'btn btn-primary']) ?>
</div>