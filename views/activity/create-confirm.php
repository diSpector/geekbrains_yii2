<?php

use yii\helpers\Html;

?>

<div class="row">
    <p>Вы ввели следующую информацию:</p>

    <ul>
        <li><label>Заголовок активности</label>: <?= Html::encode($activity->title) ?></li>
        <li><label>Описание активности</label>: <?= Html::encode($activity->description) ?></li>
        <li><label>Блокирующее</label>: <?= Html::encode($activity->is_blocked?'Да':'Нет') ?></li>
        <li><label>Повторяющееся</label>: <?= Html::encode($activity->is_repeated?'Да':'Нет') ?></li>
        <li>
            <?=Html::img('/images/'.$activity->image,[])?>
            <?=Html::getInputName($activity,'title');?>
        </li>
    </ul>
    <?= Html::a('Создать новую активность', ['/activity/create'], ['class'=>'btn btn-primary']) ?>
</div>
